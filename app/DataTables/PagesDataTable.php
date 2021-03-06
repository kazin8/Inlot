<?php

namespace App\DataTables;

use App\Page;
use Yajra\Datatables\Services\DataTable;

/**
 * Class PagesDataTable
 * @package App\DataTables
 */
class PagesDataTable extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($pages = $this->query())
            ->addColumn('action', function($page){
                return '
                    <a href="/pages/'.$page->slug.'" target="_blank" class="btn btn-xs btn-success">
                      <i class="fa fa-eye"></i>
                    </a>
                    <a href="'. route('pages.edit', ['pages' => $page->id]) .'" class="btn btn-xs btn-primary">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn ajax-delete btn-xs btn-danger" data-id="'. $page->id .'"
                    data-action="'. route('pages.delete', ['pages' => $page->id]) .'">
                      <i class="fa fa-remove"></i>
                    </a>
                ';
            })
            ->editColumn('created_at', function($page) {
                if ($page->created_at) {
                    return $page->created_at->format('d.m.Y H:i:s');
                }
                return null;
            })
            ->editColumn('updated_at', function($page) {
                if ($page->updated_at) {
                    return $page->updated_at->format('d.m.Y H:i:s');
                }
                return null;
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $pages = Page::select();
        return $this->applyScopes($pages);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'id' => ['title' => 'ID'],
            'name' => ['title' => 'Название'],
            'slug' => ['title' => 'ЧПУ'],
            'created_at' => ['title' => 'Дата создания'],
            'updated_at' => ['title' => 'Дата редактирования'],
            'action' => ['title' => 'Действия', 'searchable' => false, 'orderable' => false]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pages';
    }

    /**
     * Get default builder parameters.
     *
     * @return array
     */
    protected function getBuilderParameters()
    {
        return [
            'order'   => [[0, 'desc']],
            'language' => [
                'url' => '//cdn.datatables.net/plug-ins/1.10.11/i18n/Russian.json'
            ],
            'dom' => 'Bfrtip',
            'buttons' => [
                "csv",
                "excel",
                "pdf",
                "print",
                "reset",
                "reload",
                "selectAll",
                "selectNone"
            ],
            'rowId' => 'id',
            'select' => [
                'style' => 'multi'
            ]
        ];
    }
}
