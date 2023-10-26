<x-content>
    <section id="content-header" class="d-flex flex-wrap my-1">

        <h3>Dashboard</h3>

    </section>

    <section id="content-body">
        <div class="row g-3">
            <div class="col-12 col-sm-6">
                <div class="card bg-{{ $balance['status'] }}-subtle border-{{ $balance['status'] }}-subtle">
                    <div class="card-body text-center">
                        <div class="card-title fw-bolder">Saldo rekening</div>
                        <div class="my-2 fs-2">{{ money_format($balance['this_month']) }}</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-body-secondary">Bulan lalu</div>
                                <div class="fw-bolder">{{ money_format($balance['last_month']) }}</div>
                                @if ($balance['this_month'] >= $balance['last_month'])
                                    <div class="text-success">
                                        <i class="bi bi-arrow-up"></i>
                                        {{ number_format(abs($balance['from_last_month'])) }}
                                    </div>
                                @else
                                    <div class="text-danger">
                                        <i class="bi bi-arrow-down"></i>
                                        {{ number_format(abs($balance['from_last_month'])) }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <div class="text-body-secondary">Rata-rata</div>
                                <div class="fw-bolder">{{ money_format($balance['average']) }}</div>
                                @if ($balance['this_month'] >= $balance['average'])
                                    <div class="text-success">
                                        <i class="bi bi-arrow-up"></i>
                                        {{ number_format(abs($balance['from_average'])) }}
                                    </div>
                                @else
                                    <div class="text-danger">
                                        <i class="bi bi-arrow-down"></i>
                                        {{ number_format(abs($balance['from_average'])) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card bg-{{ $mutation['status'] }}-subtle border-{{ $mutation['status'] }}-subtle">
                    <div class="card-body text-center">
                        <div class="card-title fw-bolder">Mutasi</div>
                        <div class="my-2 fs-2">{{ money_format($mutation['this_month']) }}</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-body-secondary">Bulan lalu</div>
                                <div class="fw-bolder">{{ money_format($mutation['last_month']) }}</div>
                                @if ($mutation['this_month'] >= $mutation['last_month'])
                                    <div class="text-success">
                                        <i class="bi bi-arrow-up"></i>
                                        {{ number_format(abs($mutation['from_last_month'])) }}
                                    </div>
                                @else
                                    <div class="text-danger">
                                        <i class="bi bi-arrow-down"></i>
                                        {{ number_format(abs($mutation['from_last_month'])) }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <div class="text-body-secondary">Rata-rata</div>
                                <div class="fw-bolder">{{ money_format($mutation['average']) }}</div>
                                @if ($mutation['this_month'] >= $mutation['average'])
                                    <div class="text-success">
                                        <i class="bi bi-arrow-up"></i>
                                        {{ number_format(abs($mutation['from_average'])) }}
                                    </div>
                                @else
                                    <div class="text-danger">
                                        <i class="bi bi-arrow-down"></i>
                                        {{ number_format(abs($mutation['from_average'])) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card bg-{{ $income['status'] }}-subtle border-{{ $income['status'] }}-subtle">
                    <div class="card-body text-center">
                        <div class="card-title fw-bolder">Penerimaan</div>
                        <div class="my-2 fs-2">{{ money_format($income['this_month']) }}</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-body-secondary">Bulan lalu</div>
                                <div class="fw-bolder">{{ money_format($income['last_month']) }}</div>
                                @if ($income['this_month'] >= $income['last_month'])
                                    <div class="text-success">
                                        <i class="bi bi-arrow-up"></i>
                                        {{ number_format(abs($income['from_last_month'])) }}
                                    </div>
                                @else
                                    <div class="text-danger">
                                        <i class="bi bi-arrow-down"></i>
                                        {{ number_format(abs($income['from_last_month'])) }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <div class="text-body-secondary">Rata-rata</div>
                                <div class="fw-bolder">{{ money_format($income['average']) }}</div>
                                @if ($income['this_month'] >= $income['average'])
                                    <div class="text-success">
                                        <i class="bi bi-arrow-up"></i>
                                        {{ number_format(abs($income['from_average'])) }}
                                    </div>
                                @else
                                    <div class="text-danger">
                                        <i class="bi bi-arrow-down"></i>
                                        {{ number_format(abs($income['from_average'])) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <div class="card bg-{{ $expense['status'] }}-subtle border-{{ $expense['status'] }}-subtle">
                    <div class="card-body text-center">
                        <div class="card-title fw-bolder">Pengeluaran</div>
                        <div class="my-2 fs-2">{{ money_format($expense['this_month']) }}</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="text-body-secondary">Bulan lalu</div>
                                <div class="fw-bolder">{{ money_format($expense['last_month']) }}</div>
                                @if ($expense['this_month'] >= $expense['last_month'])
                                    <div class="text-danger">
                                        <i class="bi bi-arrow-up"></i>
                                        {{ number_format(abs($expense['from_last_month'])) }}
                                    </div>
                                @else
                                    <div class="text-success">
                                        <i class="bi bi-arrow-down"></i>
                                        {{ number_format(abs($expense['from_last_month'])) }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-6">
                                <div class="text-body-secondary">Rata-rata</div>
                                <div class="fw-bolder">{{ money_format($expense['average']) }}</div>
                                @if ($expense['this_month'] >= $expense['average'])
                                    <div class="text-danger">
                                        <i class="bi bi-arrow-up"></i>
                                        {{ number_format(abs($expense['from_average'])) }}
                                    </div>
                                @else
                                    <div class="text-success">
                                        <i class="bi bi-arrow-down"></i>
                                        {{ number_format(abs($expense['from_average'])) }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center fw-bolder mb-4">Rekening</div>
                        <div class="canvas-container" style="position: relative; height: 40vh;">
                            <canvas id="account-chart" class="mx-auto my-auto"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center fw-bolder mb-4">Pengeluaran</div>
                        <div class="canvas-container" style="position: relative; height: 40vh;">
                            <canvas id="expense-chart" class="mx-auto my-auto"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title text-center fw-bolder mb-4">6 bulan terakhir</div>
                        <div class="canvas-container" style="position: relative; height: 40vh;">
                            <canvas id="balance-chart" class="mx-auto my-auto"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title fw-bolder text-center">Penerimaan terakhir</div>
                        <hr>
                        <ul class="list-group list-group-flush mt-3">
                            @foreach ($last_activities['income'] as $income)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 text-body-secondary">
                                            {{ $income->activity_date->diffForHumans() }}
                                            &minus;
                                            Penerimaan {{ $income->category->name }}
                                        </div>
                                        <div class="col-12 col-sm-6 order-3 order-sm-2 text-end fw-bold">
                                            {{ money_format($income->debit) }}
                                        </div>
                                        <div class="col-12 order-2 order-sm-3">{{ $income->description }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title fw-bolder text-center">Pengeluaran terakhir</div>
                        <hr>
                        <ul class="list-group list-group-flush mt-3">
                            @foreach ($last_activities['expense'] as $expense)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 text-body-secondary">
                                            {{ $expense->activity_date->diffForHumans() }}
                                            &minus;
                                            Pengeluaran {{ $expense->category->name }}
                                        </div>
                                        <div class="col-12 col-sm-6 order-3 order-sm-2 text-end fw-bold">
                                            {{ money_format($expense->credit) }}
                                        </div>
                                        <div class="col-12 order-2 order-sm-3">{{ $expense->description }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function makeAccountChart() {
            const accounts = {{ Js::from($accounts) }}

            new Chart(document.getElementById('account-chart'), {
                type: 'doughnut',
                data: {
                    labels: accounts.map(account => account.name),
                    datasets: [{
                        data: accounts.map(account => account.balance)
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                }
            });
        }

        function makeExpenseChart() {
            const expenses = {{ Js::from($this_month_expense_by_category) }}

            new Chart(document.getElementById('expense-chart'), {
                type: 'doughnut',
                data: {
                    labels: expenses.map(expense => expense.category),
                    datasets: [{
                        data: expenses.map(expense => expense.total)
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                }
            });
        }

        function makeBalanceChart() {
            const activities = {{ Js::from($last_6_month->values()) }}

            new Chart(document.getElementById('balance-chart'), {
                type: 'bar',
                data: {
                    labels: activities.map(activity => activity.activity_month),
                    datasets: [{
                        label: 'Saldo',
                        data: activities.map(activity => activity.closing_balance)
                    }, {
                        label: 'Penerimaan',
                        data: activities.map(activity => activity.debit),
                    }, {
                        label: 'Pengeluaran',
                        data: activities.map(activity => activity.credit),
                    }, {
                        label: 'Mutasi',
                        data: activities.map(activity => activity.debit - activity.credit),
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                }
            });
        }

        document.addEventListener('DOMContentLoaded', e => makeAccountChart() || makeExpenseChart() || makeBalanceChart())
    </script>
</x-content>
