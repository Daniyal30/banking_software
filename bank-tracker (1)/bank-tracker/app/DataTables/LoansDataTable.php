<?php

namespace App\DataTables;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class LoansDataTable extends DataTable
{
    public function dataTable(Builder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('lender_name', fn (Loan $loan) => $loan->lender->name)
            ->editColumn('amount', fn (Loan $loan) => number_format((float) $loan->amount, 2))
            ->addColumn('paid_amount', fn (Loan $loan) => number_format($loan->paid_amount, 2))
            ->addColumn('remaining_amount', function (Loan $loan) {
                $badge = $loan->is_cleared ? 'success' : 'warning';

                return '<span class="badge bg-' . $badge . '">' . number_format($loan->remaining_amount, 2) . '</span>';
            })
            ->editColumn('loan_date', fn (Loan $loan) => $loan->loan_date->format('d-M-Y'))
            ->addColumn('action', function (Loan $loan) {
                return view('loans._actions', compact('loan'))->render();
            })
            ->rawColumns(['remaining_amount', 'action']);
    }

    public function query(Loan $model): Builder
    {
        return $model->newQuery()->with('lender')->withSum('payments as paid_amount_sum', 'amount')->orderByDesc('loan_date');
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->setTableId('loans-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1, 'desc')
            ->parameters([
                'responsive' => true,
                'autoWidth' => false,
            ]);
    }

    protected function getColumns(): array
    {
        return [
            ['data' => 'lender_name', 'name' => 'lender.name', 'title' => 'Lender'],
            ['data' => 'loan_date', 'name' => 'loan_date', 'title' => 'Date'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Loan Amount'],
            ['data' => 'paid_amount', 'name' => 'paid_amount', 'title' => 'Paid', 'orderable' => false, 'searchable' => false],
            ['data' => 'remaining_amount', 'name' => 'remaining_amount', 'title' => 'Remaining', 'orderable' => false, 'searchable' => false],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
        ];
    }

    public function filename(): string
    {
        return 'Loans_' . date('YmdHis');
    }
}
