<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($product) {
                return '<a href="' . route('admin.product.edit', $product->id) . '" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                <a href="' . route('admin.product.destroy', $product->id) . '" class="btn btn-sm btn-danger delete-item" id="delete"><i class="fa fa-trash"></i></a>

                <div class="dropdown dropleft d-inline ml-1">
                      <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-cog"></i>
                      </button>

                      <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <a class="dropdown-item has-icon" href="' . route('admin.product-image-gallery.index', ['product' => $product->id]) . '"><i class="fa fa-image"></i> Image Gallery</a>

                        <a class="dropdown-item has-icon" href="' . route('admin.product-variant.index', ['product' => $product->id]) . '"><i class="fa fa-tag"></i>Variant</a>

                        <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
                      </div>
                    </div>
                ';
            })
            ->addColumn('thumbnail', function ($product) {
                return '<img src="' . asset($product->thumbnail) . '" height="50px" width="50px">';
            })
            ->addColumn('status', function ($product) {
                // add badge
                if ($product->status == 1) {
                    return '<span class="badge badge-success">Active</span>';
                } else {
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('product_type', function ($product) {
                $badgeClass = '';
                $badgeText = '';

                switch ($product->product_type) {
                    case 'new_arrival':
                        $badgeClass = 'success';
                        $badgeText = 'New Arrival';
                        break;
                    case 'featured_product':
                        $badgeClass = 'primary';
                        $badgeText = 'Featured Product';
                        break;
                    case 'top_product':
                        $badgeClass = 'warning';
                        $badgeText = 'Top Product';
                        break;
                    case 'best_product':
                        $badgeClass = 'warning';
                        $badgeText = 'Best Product';
                        break;
                    default:
                        $badgeClass = 'secondary';
                        $badgeText = 'None';
                        break;
                }

                return '<span class="badge badge-' . $badgeClass . '">' . $badgeText . '</span>';
            })

            ->addColumn('change_status', function ($query) {
                if ($query->status == 1) {
                    return '<label class="custom-switch">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input change-status" data-id="' . $query->id . '" checked>
                    <span class="custom-switch-indicator"></span>

                  </label>';
                } else {
                    return '<label class="custom-switch ">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input change-status" data-id="' . $query->id . '">
                    <span class="custom-switch-indicator"></span>

                  </label>';
                }
            })
            ->rawColumns(['thumbnail', 'status', 'action', 'product_type', 'change_status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
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
            Column::make('thumbnail'),
            Column::make('name'),
            Column::make('quantity'),
            Column::make('product_type'),
            Column::make('price'),
            Column::make('status'),
            Column::make('change_status'),
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
        return 'Product_' . date('YmdHis');
    }
}