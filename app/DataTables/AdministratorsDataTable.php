<?php

namespace App\DataTables;

use App\User;
use Yajra\Datatables\Services\DataTable;

/**
 * Class AdministratorsDataTable
 * @package App\DataTables
 */
class AdministratorsDataTable extends DataTable
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
            ->eloquent($administrators = $this->query())
            ->addColumn('action', function($administrator){
                return '
                    <a href="'. route('admin.administrators.edit', ['administrators' => $administrator->id]) .'"
                    class="btn btn-xs btn-primary">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn ajax-delete btn-xs btn-danger" data-id="'. $administrator->id .'"
                    data-action="'. route('admin.administrators.destroy', ['administrators' => $administrator->id]) .'">
                      <i class="fa fa-remove"></i>
                    </a>
                ';
            })
            ->editColumn('created_at', function($administrator) {
                if ($administrator->created_at) {
                    return $administrator->created_at->format('d.m.Y H:i:s');
                }
                return null;
            })
            ->editColumn('updated_at', function($administrator) {
                if ($administrator->updated_at) {
                    return $administrator->updated_at->format('d.m.Y H:i:s');
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
        $administrators = User::select()->administrators();
        return $this->applyScopes($administrators);
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
            'name' => ['title' => 'ФИО'],
            'login' => ['title' => 'Логин'],
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
        return 'administrators';
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
