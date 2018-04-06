<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DataTables\HandbooksDataTable;
use App\Handbook;
use App\HandBookContent;
use Mockery\CountValidator\Exception;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\HandbookRequest;

class HandbookController extends Controller
{

    /**
     * Constructor of class.
     */
    public function __construct()
    {
        ;
    }

    /**
     * Render list of handbooks.
     *
     * @param HandbooksDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(HandbooksDataTable $dataTable)
    {
        return $dataTable->render('admin.handbooks.index');
    }

    /**
     * View handbook's create page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.handbooks.create');
    }

    /**
     * Store new handbook in DB.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Mockery\CountValidator\Exception
     */
    public function store(Request $request)
    {
        $handbook = new Handbook();

        $handbook->fill($request->only('name'));

        if ($handbook->save()) {
            $records = [];

            foreach ($request->get('names') as $recordName) {
                if ($recordName) {
                    $records[] = new HandBookContent(['name' => $recordName]);
                }
            }

            if (count($records)) {
                if ($handbook->records()->saveMany($records)) {
                    Session::flash('success_message', 'Элемент успешно сохранен!');
                }
            }

            return redirect()->route('admin.handbooks.index');
        }

        throw new Exception('Произошла необратимая ошибка!');
    }

    /**
     * View handbook's edit page.
     *
     * @param Handbook $handbook
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Handbook $handbook)
    {
        return view('admin.handbooks.edit', ['handbook' => $handbook]);
    }

    /**
     * Update the handbook.
     *
     * @param Handbook $handbook
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Mockery\CountValidator\Exception
     */
    public function update(Handbook $handbook, Request $request)
    {
        $handbook->fill($request->only('name'));

        $records = [];

        if (count($request->get('old_names'))) {
            foreach ($request->get('old_names') as $key => $recordName) {
                if ($recordName) {
                    $record = HandBookContent::findOrFail($key);
                    $record->name = $recordName;
                    $records[] = $record;
                }
            }
        }

        if (count($request->get('names'))) {
            foreach ($request->get('names') as $recordName) {
                if ($recordName) {
                    $records[] = new HandBookContent(['name' => $recordName]);
                }
            }
        }

        if ($handbook->save() and $handbook->records()->saveMany($records)) {
            Session::flash('success_message', 'Элемент успешно сохранен!');
            return redirect()->back();
        }

        throw new Exception('Произощла необратимая ошибка!');
    }

    /**
     * Destroy the handbook.
     *
     * @param Handbook $handbook
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Handbook $handbook, Request $request)
    {
        if ($request->ajax()) {
            $handbook->delete($request->all());

            return response(['msg' => 'Удаление успешно!', 'status' => 'success']);
        }

        return response(['msg' => 'Ошибка при удалении!', 'status' => 'failed']);
    }

    /**
     * Multiple destroy of handbooks.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroyMany(Request $request)
    {
        if ($request->ajax()) {
            $ids = json_decode($request->ids);

            if (count($ids)) {
                Handbook::destroy($ids);

                return response(['msg' => 'Удаление успешно!', 'status' => 'success']);
            }
        }
        return response(['msg' => 'Ошибка при удалении!', 'status' => 'failed']);
    }

    /**
     * Destroy of record of handbook.
     *
     * @param HandBookContent $record
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroyRecord(HandBookContent $record, Request $request)
    {
        if ($request->ajax()) {
            $record->delete();

            return response(['msg' => 'Удаление успешно!', 'status' => 'success']);
        }

        return response(['msg' => 'Ошибка при удалении!', 'status' => 'failed']);
    }

}
