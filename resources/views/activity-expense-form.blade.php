@isset($activity)
    @props([
        'title' => 'Edit pengeluaran',
        'action' => "/activity/{$activity->id}",
        'name' => "activity-edit-{$activity->id}",
        'method' => 'put',
        'activity_date' => $activity->activity_date->toDateString(),
        'category_id' => $activity->category_id,
        'account_id' => $activity->account_id,
        'description' => $activity->description,
        'credit' => $activity->credit,
    ])
@else
    @props([
        'title' => 'Pengeluaran baru',
        'action' => '/activity',
        'name' => 'activity-create',
        'method' => 'post',
        'activity_date' => '',
        'category_id' => '',
        'account_id' => '',
        'description' => '',
        'credit' => '',
    ])
@endisset

<x-content>
    <section class="my-1">
        <h3>{{ $title }}</h3>

        <div class="my-4"></div>

        <form action="{{ $action }}" name="{{ $name }}" method="post">

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="_method" value="{{ $method }}" />
            <input type="hidden" name="activity_type" value="expense">
            <input type="hidden" name="debit" value="0" />

            <x-form-input-date name="activity_date" label="Tanggal" help="Tanggal pengeluaran."
                value="{{ $activity_date }}" />

            <x-form-input-select name="category_id" label="Kategori" placeholder="Pilih kategori"
                help="Kategori pengeluaran" :options="$categories->pluck('name', 'id')" value="{{ $category_id }}" />

            <x-form-input-select name="account_id" label="Rekening" placeholder="Pilih rekening"
                help="Rekening digunakan untuk pengeluaran" :options="$accounts->pluck('name', 'id')" value="{{ $account_id }}" />

            <x-form-input-textarea name="description" label="Uraian" help="Keterangan asal dan tujuan pengeluaran"
                value="{{ $description }}" />

            <x-form-input-money name="credit" label="Nominal" help="Nominal pengeluaran" value="{{ $credit }}" />

            <hr>

            <x-form-button-submit />
        </form>
    </section>
</x-content>
