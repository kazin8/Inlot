<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\DataTables\PagesDataTable;
use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminPageRequest;
use Illuminate\Support\Facades\Session;

/**
 * Class PageController
 * @package App\Http\Controllers\Admin
 */
class PageController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
    }

    /**
     * Show the index of page module.
     *
     * @param PagesDataTable $dataTable
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(PagesDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.index');
    }

    /**
     * Show the edit of page module.
     *
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', ['page'=>$page]);
    }

    /**
     * @param Page $page
     * @param AdminPageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(Page $page, AdminPageRequest $request)
    {
        $page->fill($request->all());

        $page->active = $request->input('active', false);

        if ($page->save()){
            Session::flash('success_message', 'Элемент успешно сохранен!');
            return redirect()->back();
        }

        throw new \Exception('Произошла необрабатываемая ошибка');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
         return view('admin.pages.create');
    }

    /**
     * @param AdminPageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(AdminPageRequest $request)
    {
        $page = new Page();

        $page->fill($request->all());

        $page->active = $request->input('active', false);
        $page->creator_id = Auth::user()->id;

        if ($page->save()){
            Session::flash('success_message', 'Элемент успешно сохранен!');
            return redirect()->route('pages.index');
        }
        throw new \Exception('Произошла необрабатываемая ошибка');
    }

    /**
     * Delete record from table
     *
     * @param Page $page
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroy(Page $page, Request $request) {
        if ( $request->ajax() ) {
            $page->delete($request->all());

            return response(['msg' => 'Удаление успешно!', 'status' => 'success']);
        }
        return response(['msg' => 'Ошибка удаления!', 'status' => 'failed']);
    }

    /**
     * Multiple delete records from table.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function destroyMany(Request $request)
    {
        if ($request->ajax()) {
            $ids = json_decode($request->ids);
            if (count($ids)) {
                Page::destroy($ids);

                return response(['msg' => 'Удаление успешно!', 'status' => 'success']);
            }
        }
        return response(['msg' => 'Ошибка удаления!', 'status' => 'failed']);
    }
}
