<?php

namespace App\DataTables;

use App\Handbook;
use Yajra\Datatables\Services\DataTable;

/**
 * Class HandbooksDataTable
 * @package App\DataTables
 */
class HandbooksDataTable extends DataTable
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
            ->eloquent($handbooks = $this->query())
            ->addColumn('action', function($handbook){
                return '
                    <a href="'. route('admin.handbooks.edit', ['handbooks' => $handbook->id]) .'"
                    class="btn btn-xs btn-primary">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a class="btn ajax-delete btn-xs btn-danger" data-id="'. $handbook->id .'"
                    data-action="'. route('admin.handbooks.destroy', ['handbooks' => $handbook->id]) .'">
                      <i class="fa fa-remove"></i>
                    </a>
                ';
            })
            ->editColumn('created_at', function($handbook) {
                if ($handbook->created_at) {
                    return $handbook->created_at->format('d.m.Y H:i:s');
                }
                return null;
            })
            ->editColumn('updated_at', function($handbook) {
                if ($handbook->updated_at) {
                    return $handbook->updated_at->format('d.m.Y H:i:s');
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
        $handbooks = Handbook::select();
        return $this->applyScopes($handbooks);
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
        return 'handbooks';
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
