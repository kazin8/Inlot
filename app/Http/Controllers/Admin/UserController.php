<?php

namespace App\Http\Controllers\Admin;

use App\Address;
use App\City;
use App\Company;
use App\HintList;
use App\Region;
use App\User;
use Mail;

use App\DataTables\UsersDataTable;


use App\Http\Requests;
use App\Http\Requests\UserRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Mockery\CountValidator\Exception;

class UserController extends Controller
{

    /**
     * Constructor of class
     */
    public function __construct()
    {
        ;
    }

    /**
     * Render list of users.
     *
     * @param UsersDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.index');
    }

    /**
     * View users's create page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $regions = Region::lists('name', 'id');

        return view('admin.users.create', compact('regions'));
    }

    /**
     * Store new user in DB.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(UserRequest $request)
    {
        $user = new User();

        $user->fill($request->only('name', 'phone', 'email', 'login', 'password'));
        $user->type = HintList::getUserTypeByCode($request->input('type'));
        $user->is_admin = false;

        if ($user->save()) {
            $this->storeOrUpdateAddress($user, $request);

            if ($request->input('type') == 'entity') {
                $this->storeOrUpdateCompany($user, $request);
            }

            Session::flash('success_message', 'Элемент успешно сохранен!');
            return redirect()->route('admin.users.index');
        }

        throw new \Exception('Произошла необратимая ошибка!');
    }

    /**
     * View user's edit page.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        $regions = Region::lists('name', 'id');
        $currentRegionId = $user->address ? $user->address->region_id : null;
        $cities = $currentRegionId ? City::where(['region_id' => $currentRegionId])->lists('name', 'id') : [];
        $currentCityId = $user->address ? $user->address->city_id : null;

        return view('admin.users.edit', compact('user', 'regions', 'cities', 'currentRegionId', 'currentCityId'));
    }

    /**
     * Update of user.
     *
     * @param User $user
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(User $user, UserRequest $request)
    {
        $allowToSell = (!$user->may_sell and $request->input('may_sell'));
        $forbidToSell = ($user->may_sell and !$request->input('may_sell'));

        if ($request->password) {
            $user->fill($request->only('name', 'phone', 'email', 'login', 'may_sell', 'password'));
        } else {
            $user->fill($request->only('name', 'phone', 'email', 'login', 'may_sell'));
        }

        if ($user->save()) {
            if ($allowToSell) {
                $user->goods()->withTrashed()->update(['active' => true]);

                $this->sendEmailToUserAboutPermissionToSell($user);
            }
            if ($forbidToSell) {
                $user->goods()->withTrashed()->update(['active' => false]);

                $this->sendEmailToUserAboutForbidToSell($user);
            }

            $this->storeOrUpdateAddress($user, $request);

            if ($request->input('type') == HintList::getUserTypeByCode('entity')) {
                $this->storeOrUpdateCompany($user, $request);
            }

            Session::flash('success_message', 'Элемент успешно сохранен!');
            return redirect()->back();
        }

        throw new \Exception('Произошла необратимая ошибка!');
    }

    private function sendEmailToUserAboutPermissionToSell(User $user)
    {
        Mail::send('admin.emails.permission_to_sell', [], function($m) use (&$user) {
            $m->to($user->email)->subject('Разрешение на продажу товаров.');
        });
    }

    private function sendEmailToUserAboutForbidToSell(User $user)
    {
        Mail::send('admin.emails.forbid_to_sell', [], function($m) use (&$user) {
            $m->to($user->email)->subject('Запрет на продажу товаров.');
        });
    }

    /**
     * Store or update(if it don't exists) user's company.
     *
     * @param User $user
     * @param UserRequest $request
     * @throws \Mockery\CountValidator\Exception
     */
    protected function storeOrUpdateCompany(User $user, UserRequest $request)
    {
        $company = Company::firstOrNew(['user_id' => $user->id]);
        $company->name = $request->input('company');
        $company->inn = $request->input('inn');

        if (! $user->company()->save($company)) {
            throw new Exception('Произошла необратимая ошибка!');
        }
    }

    /**
     * Store or update(if it don't exists) user's address.
     *
     * @param User $user
     * @param Request $request
     * @throws \Mockery\CountValidator\Exception
     */
    protected function storeOrUpdateAddress(User $user, Request $request)
    {
        $address = Address::firstOrNew(['user_id' => $user->id]);
        $address->fill($request->only('region_id', 'city_id', 'address', 'postcode', 'description'));

        if (! $user->address()->save($address)) {
            throw new Exception('Произошла необратимая ошибка!');
        }
    }

    /**
     * Delete of administrator from DB.
     *
     * @param User $user
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(User $user, Request $request)
    {
        if ($request->ajax()) {
            $user->delete($request->all());

            return response(['msg' => 'Удаление успешно!', 'status' => 'success']);
        }

        return response(['msg' => 'Ошибка при удалении!', 'status' => 'failed']);
    }

    /**
     * Multiple delete users from DB.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroyMany(Request $request)
    {
        if ($request->ajax()) {
            $ids = json_decode($request->ids);

            if (count($ids)) {
                User::destroy($ids);

                return response(['msg' => 'Удаление успешно!', 'status' => 'success']);
            }
        }
        return response(['msg' => 'Ошибка при удалении!', 'status' => 'failed']);
    }

}
