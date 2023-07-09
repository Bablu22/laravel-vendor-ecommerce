<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\VendorProduct;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class VendorProductDataTable extends DataTable
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
                $editBtn = "<a href='" . route('vendor.product.edit', $query->id) . "' class='btn btn-sm btn-primary'><i class='far fa-edit'></i></a>";
                $deleteBtn = "<a href='" . route('vendor.product.destroy', $query->id) . "' class='btn btn-sm btn-danger delete-item ms-2'><i class='far fa-trash-alt'></i></a>";

                $moreBtn = '<div class="btn-group  dropstart ms-2">
                <button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item has-icon" href="' . route('vendor.product-image-gallery.index', ['product' => $query->id]) . '"><i class="far fa-images"></i> Image Gallery</a></li>
                    <li><a class="dropdown-item has-icon" href="' . route('vendor.products-variant.index', ['product' => $query->id]) . '"><i class="fas fa-th-large"></i> Variants</a></li>
                </ul>
            </div>';

                return $editBtn . $deleteBtn . $moreBtn;
            })

            ->addColumn('image', function ($query) {
                return "<img width='70px' src='" . asset($query->thumbnail) . "' ></img>";
            })
            ->addColumn('type', function ($query) {
                $badgeClass = '';
                $badgeText = '';

                switch ($query->product_type) {
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

                return '<span class="badge bg-' . $badgeClass . '">' . $badgeText . '</span>';

            })
            ->addColumn('status', function ($query) {
                if ($query->status == 1) {

                    $button = '<div class="form-check form-switch">
                <input checked class="form-check-input change-status" type="checkbox" id="flexSwitchCheckDefault" data-id="' . $query->id . '"></div>';
                } else {
                    $button = '<div class="form-check form-switch">
                <input class="form-check-input change-status" type="checkbox" id="flexSwitchCheckDefault" data-id="' . $query->id . '"></div>';
                }
                return $button;
            })
            ->addColumn('approved', function ($query) {
                if ($query->is_approved === 1) {
                    return '<i class="badge bg-success">Approved</i>';
                } else {
                    return '<i class="badge bg-warning">Pending</i>';
                }
            })
            ->rawColumns(['image', 'type', 'status', 'action', 'approved'])
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
            ->setTableId('vendorproduct-table')
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
            Column::make('image')->width(150),
            Column::make('name'),
            Column::make('price'),
            Column::make('approved'),
            Column::make('type')->width(100),
            Column::make('status'),
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
        return 'VendorProduct_' . date('YmdHis');
    }
}