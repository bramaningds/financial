<x-content>
    <section class="content-header my-1">
        <h3>Laporan keuangan</h3>

        <div class="my-4"></div>

        <form action="/report/statement" method="get">
            <div class="row g-2 align-items-end flex-nowrap overflow-x-auto py-2">
                <div class="col-auto">
                    <label for="period_start" class="form-label text-body-secondary">Tanggal awal</label>
                    <select name="period_start" id="period_start" class="form-select">
                        @foreach ($period_options as $value => $text)
                            <option value="{{ $value }}" @selected(request('period_start') == $value)>
                                {{ $text }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <label for="period_end" class="form-label text-body-secondary">Tanggal akhir</label>
                    <select name="period_end" id="period_end" class="form-select">
                        @foreach ($period_options as $value => $text)
                            <option value="{{ $value }}" @selected(request('period_end') == $value)>
                                {{ $text }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <a href="/report/statement" class="btn btn-outline-secondary form-control px-3">Reset</a>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary form-control px-3">Filter</button>
                </div>
            </div>
        </form>
    </section>

    <hr class="pb-1">

    <article class="card p-4">
        <h4 class="text-center">Laporan Keuangan</h4>
        <p class="subtitle text-center">
            Periode: {{ $statements->first()->period_string }} &minus;{{ $statements->last()->period_string }}
        </p>

        <div class="table-responsive py-4">
            <table class="table table-sm table-borderless w-auto m-auto">
                <thead>

                    @if ($statements->unique('year')->count() > 1)
                        <tr>
                            <td></td>

                            @foreach ($statements->groupBy('year') as $year => $annual_items)
                                @if ($annual_items->unique('month')->count() >= 8)
                                    <th colspan="{{ $annual_items->unique('month')->count() }}" class="text-center">
                                        <div class="d-flex justify-content-around">
                                            <span>{{ $year }}</span>
                                            <span>{{ $year }}</span>
                                            <span>{{ $year }}</span>
                                        </div>
                                    </th>
                                @elseif ($annual_items->unique('month')->count() >= 5)
                                    <th colspan="{{ $annual_items->unique('month')->count() }}" class="text-center">
                                        <div class="d-flex justify-content-around">
                                            <span>{{ $year }}</span>
                                            <span>{{ $year }}</span>
                                        </div>
                                    </th>
                                @else
                                    <th colspan="{{ $annual_items->unique('month')->count() }}" class="text-center">
                                        {{ $year }}
                                    </th>
                                @endif
                            @endforeach
                        </tr>
                    @endif

                    <tr class="border-bottom border-secondary">
                        <td style="min-width: 160px;"></td>

                        @foreach ($statements->groupBy('year')->map(fn($item) => $item->unique('month')->pluck('month_name'))->flatten() as $month_name)
                            <th class="text-end text-truncate" style="min-width: 100px;">{{ $month_name }}</th>
                        @endforeach
                    </tr>
                </thead>

                @foreach ($statements->groupBy('activity_type') as $activity_type => $activity_type_items)
                    <tbody>
                        <tr>
                            <th>{{ $activity_type == 'income' ? 'Penerimaan' : 'Pengeluaran' }}</th>
                            <td colspan="{{ $statements->groupBy('period')->count() }}"></td>
                        </tr>

                        @foreach ($activity_type_items->groupBy('category_name') as $category_name => $category_items)
                            <tr>
                                <td class="ps-4">{{ $category_name }}</td>

                                @foreach ($category_items->map(fn($item) => $item->mutation_string) as $mutation_string)
                                    <td class="text-end">{{ $mutation_string }}</td>
                                @endforeach
                            </tr>
                        @endforeach

                        <tr>
                            <td class="ps-4">
                                Total {{ $activity_type == 'income' ? 'Penerimaan' : 'Pengeluaran' }}
                            </td>

                            @foreach ($activity_type_items->groupBy('period')->map(fn($item) => $item->sum('mutation')) as $total)
                                <th class="border-top text-end">{{ money_format($total, '') }}</th>
                            @endforeach
                        </tr>
                    </tbody>

                    <tbody>
                        <tr>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                @endforeach

                <tfoot>
                    <tr>
                        <th>Mutasi</th>

                        @foreach ($statements->groupBy('period')->map(fn($item) => $item->sum('mutation')) as $total)
                            <th class="border-top border-secondary text-end">{{ money_format($total, '') }}</th>
                        @endforeach
                    </tr>

                    <tr>
                        <td>Saldo awal</td>

                        @foreach ($balances as $balance)
                            <td class="text-end">{{ money_format($balance->opening_balance, '') }}</td>
                        @endforeach
                    </tr>

                    <tr>
                        <td>&nbsp;</td>
                    </tr>

                    <tr>
                        <th>Saldo akhir</th>

                        @foreach ($balances as $balance)
                            <th class="border-top border-bottom border-secondary text-end">
                                {{ money_format($balance->closing_balance, '') }}</th>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
    </article>

    <style>
        tr td:first-child,
        tr th:first-child {
            position: sticky;
            left: 0;
        }
    </style>
</x-content>
