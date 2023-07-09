<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editBtn = "<a href='" . route('admin.brand.edit', $query->id) . "' class='btn btn-primary'><i class='fa fa-edit'></i> Edit</a>";

                $deleteBtn = "<a href='" . route('admin.brand.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='fa fa-trash'></i> Delete</a>";

                return $editBtn . $deleteBtn;

            })
            ->addColumn('logo', function ($brand) {
                return '<img src="' . asset($brand->logo) . '" width="100px" alt="' . $brand->name . '">';
            })
            ->editColumn('is_featured', function ($brand) {
                return $brand->is_featured == 1 ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
            })
            ->addColumn('status', function ($brand) {
                return $brand->status == 1 ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
            })
            ->addColumn('Change Status', function ($brand) {

                if ($brand->status == 1) {
                    return '<label class="custom-switch ">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input change-status" data-id="' . $brand->id . '" checked>
                    <span class="custom-switch-indicator"></span>

                  </label>';
                } else {
                    return '<label class="custom-switch ">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input change-status" data-id="' . $brand->id . '">
                    <span class="custom-switch-indicator"></span>

                  </label>';
                }
            })
            ->rawColumns(['logo', 'action', 'status', 'Change Status', 'is_featured'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('brand-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('logo'),
            Column::make('name'),
            Column::make('is_featured'),
            Column::make('status'),
            Column::make('Change Status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Brand_' . date('YmdHis');
    }
}