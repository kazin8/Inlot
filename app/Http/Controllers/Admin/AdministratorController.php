<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\DataTables\AdministratorsDataTable;
use App\Http\Requests\AdministratorRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

/**
 * Class AdministratorController
 * @package App\Http\Controllers\Admin
 */
class AdministratorController extends Controller
{
    /**
     * Constructor of class
     */
    public function __construct()
    {
        ;
    }

    /**
     * Render list of administrators.
     *
     * @param AdministratorsDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(AdministratorsDataTable $dataTable)
    {
        return $dataTable->render('admin.administrators.index');
    }

    /**
     * View administrator's create page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.administrators.create');
    }

    /**
     * Store new administrator in DB.
     *
     * @param AdministratorRequest $request - validation rules and request data.
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(AdministratorRequest $request)
    {
        $administrator = new User();

        $administrator->fill($request->all());
        $administrator->is_admin = true;

        if ($administrator->save()) {
            Session::flash('success_message', 'Элемент успешно сохранен!');
            return redirect()->route('admin.administrators.index');
        }

        throw new \Exception('Произошла необратимая ошибка!');
    }

    /**
     * View administrator's edit page.
     *
     * @param User $administrator
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $administrator)
    {
        return view('admin.administrators.edit', ['administrator' => $administrator]);
    }

    /**
     * Update of administrator.
     *
     * @param User $administrator
     * @param AdministratorRequest $request - validation rules and request data.
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(User $administrator, AdministratorRequest $request)
    {
        if ($request->password) {
            $administrator->fill($request->all());
        } else {
            $administrator->fill($request->except(['password']));
        }

        if ($administrator->save()) {
            Session::flash('success_message', 'Элемент успешно сохранен!');
            return redirect()->back();
        }

        throw new \Exception('Произошла необратимая ошибка!');
    }

    /**
     * Delete of administrator from DB.
     *
     * @param User $administrator
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(User $administrator, Request $request)
    {
        if (Auth::user()->id != $administrator->id) {
            if ($request->ajax()) {
                $administrator->delete($request->all());

                return response(['msg' => 'Удаление успешно!', 'status' => 'success']);
            }
        }
        return response(['msg' => 'Ошибка при удалении!', 'status' => 'failed']);
    }

    /**
     * Multiple delete administrators from DB.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroyMany(Request $request)
    {
        if ($request->ajax()) {
            $ids = json_decode($request->ids);

            $key = array_search(Auth::user()->id, $ids);
            if ($key !== false) {
                unset($ids[$key]);
            }

            if (count($ids)) {
                User::destroy($ids);

                return response(['msg' => 'Удаление успешно!', 'status' => 'success']);
            }
        }
        return response(['msg' => 'Ошибка при удалении!', 'status' => 'failed']);
    }
}
