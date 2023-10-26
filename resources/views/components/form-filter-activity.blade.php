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
        <x-select name="activity_type" placeholder="Semua aktifitas" :options="['income' => 'Penerimaan', 'expense' => 'Pengeluaran']" />
    </div>

    <div class="col-auto">
        <x-select name="category_id" placeholder="Semua kategori" :options="$categories->pluck('name', 'id')" />
    </div>

    <div class="col-auto">
        <x-select name="account_id" placeholder="Semua rekening" :options="$accounts->pluck('name', 'id')" />
    </div>
</div>
