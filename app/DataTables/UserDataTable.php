<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Layout;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{

    protected $tableId;
    protected $defaultPageLength;
    protected $createRoute;
    protected $rowActionView;
    protected $excludeColumnsFromExcelExportTitles;
    protected $excludeColumnsFromPdfExportTitles;
    protected $excludeColumnsFromCsvExportTitles;
    protected $excludeColumnsFromPrintExportTitles;
    protected $excludeColumnsFromCopyExportTitles;

    public function __construct()
    {
        $this->createRoute = route('users.create');
        $this->tableId = 'user-table';
        $this->defaultPageLength = 15;
        $this->rowActionView = 'users.action';
        $this->excludeColumnsFromExcelExportTitles = ['Action', ''];
        $this->excludeColumnsFromPdfExportTitles = ['Action', ''];
        $this->excludeColumnsFromCsvExportTitles = ['Action', ''];
        $this->excludeColumnsFromPrintExportTitles = ['Action', ''];
        $this->excludeColumnsFromCopyExportTitles = ['Action', ''];
    }
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view($this->rowActionView, compact('row'))->render();
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->addTableClass('table table-bordered table-striped table-hover table-responsive shadow-lg')
            ->setTableId($this->tableId)
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->destroy(true)
            ->serverSide(true)
            ->processing(true)
            ->layout($this->getLayout())
            ->searching(true)
            ->search(['smart', 'regex'])
            ->searchPanes(true)
            ->paging(true)
            ->ordering(true)
            ->info(true)
            ->scrollX(true)
            // ->fixedHeaderFooter(true)
            // ->scrollY('75vh')
            // ->scrollY('75vh')
            // ->responsive(true)
            ->colReorder(true)
            ->rowReorder(true)
            ->autoWidth(true)
            ->lengthMenu([[5, 10, 15, 25, 50, 100, -1], [5, 10, 15, 25, 50, 100, 'All']])
            ->lengthChange(true)
            ->pageLength($this->defaultPageLength)
            ->orderBy([2, 'asc'])
            ->orderMulti(true)
            ->selectSelector('td:first-child')
            ->selectStyleMultiShift()
            ->selectInfo(true)
            ->selectItemsRow()
            ->stateSave(false)
            ->buttons($this->getButtons())
            ->columnDefs([
                // Checkbox Column
                [
                    'orderable' => false,
                    'render' => ['select'],
                    'targets' => 0,
                ]
            ])
            ->parameters($this->getParameters());
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('')
                ->exportable(false)
                ->printable(false)
                ->width(30)
                ->addClass('text-center'),
            Column::make('id')->addClass('text-center')->visible(false),
            Column::make('name'),
            Column::make('email'),
            Column::make('email_verified_at'),
            Column::make('created_at')
                ->title('Created At')
                ->render($this->getDateRenderFunction('created_at')),
            Column::make('updated_at')
                ->title('Updated At')
                ->render($this->getDateRenderFunction('updated_at')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'User_' . date('YmdHis');
    }

    protected function getParameters(): array
    {
        return [
            'initComplete' => $this->getInitCompleteFunction()
        ];
    }

    protected function getInitCompleteFunction(): string
    {
        return '';
    }

    protected function createButton(array $buttonConfig): Button
    {
        $button = Button::make($buttonConfig['name'])
            ->attr(['title' => $buttonConfig['title'], 'class' => $buttonConfig['class']]);

        if ($buttonConfig['extend']) {
            $button->extend($buttonConfig['extend']);
        }

        if ($buttonConfig['icon']) {
            $button->text("<i class=\"{$buttonConfig['icon']}\"></i> {$buttonConfig['iconLabel']}");
        }

        if ($buttonConfig['buttonLabel']) {
            $button->text($buttonConfig['buttonLabel']);
        }

        if ($buttonConfig['action']) {
            $button->action($buttonConfig['action']);
        }

        if ($buttonConfig['exportOptions']) {
            $button->exportOptions($buttonConfig['exportOptions']);
        }

        return $button;
    }

    protected function getButtons(): array
    {
        $buttons = [
            ['name' => '', 'icon' => 'fas fa-plus', 'title' => 'Add New', 'iconLabel' => 'Add', 'buttonLabel' => '', 'action' => $this->create(), 'class' => 'btn btn-primary btn-sm', 'extend' => '', 'exportOptions' => []],
            ['name' => 'excel', 'icon' => 'fas fa-file-excel', 'title' => 'Export to Excel', 'iconLabel' => '', 'buttonLabel' => '', 'action' => '', 'class' => 'btn btn-success btn-sm', 'extend' => '', 'exportOptions' => ['columns' => $this->excludeColumnsFromExcelExport($this->excludeColumnsFromExcelExportTitles)]],
            ['name' => 'csv', 'icon' => 'fas fa-file-csv', 'title' => 'Export to CSV', 'iconLabel' => '', 'buttonLabel' => '', 'action' => '', 'class' => 'btn btn-info btn-sm', 'extend' => '', 'exportOptions' => ['columns' => $this->excludeColumnsFromCsvExport($this->excludeColumnsFromCsvExportTitles)]],
            ['name' => 'pdf', 'icon' => 'fas fa-file-pdf', 'title' => 'Export to PDF', 'iconLabel' => '', 'buttonLabel' => '', 'action' => '', 'class' => 'btn btn-danger btn-sm', 'extend' => '', 'exportOptions' => ['columns' => $this->excludeColumnsFromPdfExport($this->excludeColumnsFromPdfExportTitles)]],
            ['name' => 'print', 'icon' => 'fas fa-print', 'title' => 'Print', 'iconLabel' => '', 'buttonLabel' => '', 'action' => '', 'class' => 'btn btn-warning btn-sm', 'extend' => '', 'exportOptions' => ['columns' => $this->excludeColumnsFromPrintExport($this->excludeColumnsFromPrintExportTitles)]],
            ['name' => 'copy', 'icon' => 'fas fa-copy', 'title' => 'Copy to Clipboard', 'iconLabel' => '', 'buttonLabel' => '', 'action' => '', 'class' => 'btn btn-secondary btn-sm', 'extend' => '', 'exportOptions' => ['columns' => $this->excludeColumnsFromCopyExport($this->excludeColumnsFromCopyExportTitles)]],
            ['name' => '', 'icon' => 'fas fa-sync-alt', 'title' => 'Reload', 'iconLabel' => '', 'buttonLabel' => '', 'action' => $this->reload(), 'class' => 'btn btn-dark btn-sm', 'extend' => '', 'exportOptions' => []],
            ['name' => '', 'icon' => 'fas fa-undo-alt', 'title' => 'Reset', 'iconLabel' => '', 'buttonLabel' => '', 'action' => $this->reset(), 'class' => 'btn btn-light border btn-sm', 'extend' => '', 'exportOptions' => []],
        ];

        return array_map([$this, 'createButton'], $buttons);
    }

    private function create(): string
    {
        return 'function() { window.location.href = "' . route('users.create') . '"; }';
    }

    private function reload(): string
    {
        return 'function() {
            window.LaravelDataTables["' . $this->tableId . '"].ajax.reload();
        }';
    }

    private function reset(): string
    {
        return 'function() {
            location.reload();
        }';
    }

    private function getDateRenderFunction(string $column): string
    {
        return "function() {
            return new Date(this.$column).toLocaleString();
        }";
    }

    private function getLayout(): Layout
    {
        return Layout::make([

            'topStart' => 'buttons',
            'topEnd' => [
                'search' => [
                    'placeholder' => 'Search...',
                    'text' => '',
                ],
                'buttons' => [
                    [
                        'extend' => 'colvis',
                        'text' => '<i class="fas fa-columns"></i>',
                        'titleAttr' => 'Columns Visibility',
                        'className' => 'btn btn-sm',
                        'postfixButtons' => ['colvisRestore'],
                    ],

                ],
            ],
            'bottomStart' => ['pageLength', 'info'],
            'bottomEnd' => [
                'paging' => [
                    'buttons' => 5,
                    'type' => 'simple'
                ]
            ],
        ]);
    }

    public function excludeColumnsFromExcelExport(array $columns): string
    {
        $excluded = array_map(fn($column) => 'title="' . $column . '"', $columns);
        return ':visible:not([' . implode(']):not([', $excluded) . '])';
    }

    public function excludeColumnsFromCsvExport(array $columns): string
    {
        $excluded = array_map(fn($column) => 'title="' . $column . '"', $columns);
        return ':visible:not([' . implode(']):not([', $excluded) . '])';
    }

    public function excludeColumnsFromPdfExport(array $columns): string
    {
        $excluded = array_map(fn($column) => 'title="' . $column . '"', $columns);
        return ':visible:not([' . implode(']):not([', $excluded) . '])';
    }

    public function excludeColumnsFromPrintExport(array $columns): string
    {
        $excluded = array_map(fn($column) => 'title="' . $column . '"', $columns);
        return ':visible:not([' . implode(']):not([', $excluded) . '])';
    }

    public function excludeColumnsFromCopyExport(array $columns): string
    {
        $excluded = array_map(fn($column) => 'title="' . $column . '"', $columns);
        return ':visible:not([' . implode(']):not([', $excluded) . '])';
    }
}
