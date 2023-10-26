@php
    $monthNames = generateMonthNames();
@endphp
<x-content>
    <section class="content-header my-1">
        <h3>Laporan ringkasan keuangan</h3>

        <div class="my-4"></div>

        <form action="/report/summary" method="get">
            <div class="row g-2 align-items-end flex-nowrap overflow-x-auto py-2">
                <div class="col-auto">
                    <label for="period_start" class="form-label text-body-secondary">Tanggal awal</label>
                    <select name="period_start" id="period_start" class="form-select">
                        @foreach ($period_options as $value => $text)
                            <option value="{{ $value }}" @selected(request('period_start') == $value)>{{ $text }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <label for="period_end" class="form-label text-body-secondary">Tanggal akhir</label>
                    <select name="period_end" id="period_end" class="form-select">
                        @foreach ($period_options as $value => $text)
                            <option value="{{ $value }}" @selected(request('period_end') == $value)>{{ $text }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-auto">
                    <a href="/report/summary" class="btn btn-outline-secondary form-control px-3">Reset</a>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary form-control px-3">Filter</button>
                </div>
            </div>
        </form>
    </section>

    <hr>

    <section class="content-body pt-2">
        <article class="card p-4">
            <h4 class="text-center">Laporan Ringkasan Keuangan</h4>
            <p class="subtitle text-center">Periode: {{ $period_start }} &minus; {{ $period_end }}</p>

            <div class="table-responsive mt-4">
                <table class="table table-borderless border">
                    <thead>
                        <tr class="text-center  border-bottom">
                            <th class="text-start">Bulan</th>
                            <th class="border-start">Debet</th>
                            <th class="border-start">Kredit</th>
                            <th class="border-start">Mutasi</th>
                            <th class="border-start">Saldo</th>
                        </tr>
                        <tr>
                            <td>Saldo awal</td>
                            <td class="border-start"></td>
                            <td class="border-start"></td>
                            <td class="border-start"></td>
                            <td class="border-start text-end">{{ money_format($summary->first()->opening_balance) }}</td>
                        </tr>
                    </thead>
                    <tbody class="border-bottom">
                        @foreach ($summary as $line)
                            <tr class="text-end">
                                <td class="text-start">{{ $monthNames[$line->activity_month] }} {{ $line->activity_year }}</td>
                                <td class="border-start">{{ money_format($line->debit) }}</td>
                                <td class="border-start">{{ money_format($line->credit) }}</td>
                                <td class="border-start">{{ money_format($line->mutation) }}</td>
                                <td class="border-start"></td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="text-end">
                            <td class="text-start">Total</td>
                            <td class="border-start">{{ money_format($summary->sum('debit')) }}</td>
                            <td class="border-start">{{ money_format($summary->sum('credit')) }}</td>
                            <td class="border-start">{{ money_format($summary->sum('mutation')) }}</td>
                            <td class="border-start"></td>
                        </tr>
                        <tr>
                            <td>Saldo akhir</td>
                            <td class="border-start"></td>
                            <td class="border-start"></td>
                            <td class="border-start"></td>
                            <td class="border-start text-end">{{ money_format($summary->last()->closing_balance) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </article>
    </section>
</x-content>
