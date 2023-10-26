<x-content title="Transfer :: AtBram">
    <section id="content-header" class="d-flex flex-wrap my-1">

        <h3>Transfer</h3>

        <div class="ms-auto">
            <x-button-reset-filter />
            <x-button-create>Transfer baru</x-button-create>
        </div>

        <form action="/transfer" class="w-100 py-1">
            <x-input-group-search />

            <div class="row g-2 flex-nowrap overflow-x-auto py-2">
                <div class="col-auto">
                    <x-select name="period" placeholder="Periode transfer" :options="[
                        'today' => 'Hari ini',
                        'this-week' => 'Minggu ini',
                        'this-month' => 'Bulan ini',
                        'last-3-month' => '3 bulan terakhir',
                        'last-6-month' => '6 bulan terakhir',
                        'this-year' => 'Tahun ini',
                    ]" />
                </div>

                <div class="col-auto">
                    <x-select name="user_id" placeholder="Semua pengguna" :options="$users->pluck('name', 'id')" />
                </div>

                <div class="col-auto">
                    <x-select name="from_id" placeholder="Rekening asal" :options="$accounts->pluck('name', 'id')" />
                </div>

                <div class="col-auto">
                    <x-select name="to_id" placeholder="Rekening tujuan" :options="$accounts->pluck('name', 'id')" />
                </div>
            </div>
        </form>

    </section>

    <section id="content-body" class="mb-2">
        <div class="row g-2">
            @foreach (range(0, 1) as $index)
                <div class="col-12 col-md-6">
                    @foreach ($transfers->nth(2, $index) as $transfer)
                        <div class="mb-2">
                            <x-card-transfer :transfer="$transfer" />
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        {{ $transfers->links() }}
    </section>
</x-content>
