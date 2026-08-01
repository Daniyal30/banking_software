<?php

namespace App\DataTables;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class TransactionsDataTable extends DataTable
{
    public function dataTable(Builder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('type', function (Transaction $transaction) {
                $badge = $transaction->type === 'credit' ? 'success' : 'danger';
                $label = $transaction->type === 'credit' ? 'Credit' : 'Debit';

                return '<span class="badge bg-' . $badge . '">' . $label . '</span>';
            })
            ->editColumn('amount', fn (Transaction $transaction) => number_format((float) $transaction->amount, 2))
            ->editColumn('transaction_date', fn (Transaction $transaction) => $transaction->transaction_date->format('d-M-Y'))
            ->addColumn('action', function (Transaction $transaction) {
                return view('transactions._actions', compact('transaction'))->render();
            })
            ->rawColumns(['type', 'action']);
    }

    public function query(Transaction $model): Builder
    {
        return $model->newQuery()->orderByDesc('transaction_date');
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->setTableId('transactions-table')
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
            ['data' => 'type', 'name' => 'type', 'title' => 'Type'],
            ['data' => 'transaction_date', 'name' => 'transaction_date', 'title' => 'Date'],
            ['data' => 'amount', 'name' => 'amount', 'title' => 'Amount'],
            ['data' => 'description', 'name' => 'description', 'title' => 'Description'],
            ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
        ];
    }

    public function filename(): string
    {
        return 'Transactions_' . date('YmdHis');
    }
}
