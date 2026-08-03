@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('css')
    <style>
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 22px 24px;
            display: flex;
            align-items: center;
            gap: 18px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            border-left: 5px solid var(--accent);
            transition: transform .15s ease, box-shadow .15s ease;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.10);
        }

        .stat-card .stat-icon {
            width: 54px;
            height: 54px;
            min-width: 54px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #fff;
            background: var(--accent);
        }

        .stat-card .stat-label {
            font-size: 13px;
            color: #8a94a6;
            text-transform: uppercase;
            letter-spacing: .04em;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .stat-card .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            line-height: 1.2;
        }

        .stat-card.card-lenders  { --accent: #4c6ef5; }
        .stat-card.card-credit   { --accent: #2fb380; }
        .stat-card.card-debit    { --accent: #e5484d; }
        .stat-card.card-loan     { --accent: #7048e8; }
        .stat-card.card-remaining{ --accent: #f5a623; }
    </style>
@stop

@section('content')
    <div class="row g-3">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card card-lenders">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div>
                    <div class="stat-label">Total Lenders</div>
                    <div class="stat-value">{{ $lendersCount }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card card-credit">
                <div class="stat-icon"><i class="fas fa-arrow-down"></i></div>
                <div>
                    <div class="stat-label">Total Credit</div>
                    <div class="stat-value">{{ number_format($totalCredit) }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card card-debit">
                <div class="stat-icon"><i class="fas fa-arrow-up"></i></div>
                <div>
                    <div class="stat-label">Total Debit</div>
                    <div class="stat-value">{{ number_format($totalDebit) }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card card-loan">
                <div class="stat-icon"><i class="fas fa-money-bill-wave"></i></div>
                <div>
                    <div class="stat-label">Total Loan</div>
                    <div class="stat-value">{{ number_format($totalLoan) }}</div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3">
            <div class="stat-card card-remaining">
                <div class="stat-icon"><i class="fas fa-hourglass-half"></i></div>
                <div>
                    <div class="stat-label">Remaining Loan</div>
                    <div class="stat-value">{{ number_format($remainingLoan) }}</div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        console.log("AdminLTE dashboard loaded.");
    </script>
@stop
