<x-modal-form id="{{ $attributes['id'] }}" title="Edit pengeluaran" name="expense-edit-{{ $attributes['id'] }}" method="post" action="/activity">
    <input type="hidden" name="activity_type" value="expense">
    <input type="hidden" name="debit" value="0">

    <x-modal-form-date name="activity_date" label="Tanggal" help="Tanggal pengeluaran." value="{{ $activity->activity_date->toDateString() }}" />
    <x-modal-form-select name="category_id" label="Kategori" placeholder="Pilih kategori" help="Kategori pengeluaran"
        :options="$categories->pluck('name', 'id')" value="{{ $activity->category_id }}" />

    <x-modal-form-select name="account_id" label="Rekening" placeholder="Pilih rekening"
        help="Rekening digunakan untuk pengeluaran" :options="$accounts->pluck('name', 'id')" value="{{ $activity->account_id }}" />

    <x-modal-form-textarea name="description" label="Uraian" help="Keterangan asal dan tujuan pengeluaran" value="{{ $activity->description }}" />
    <x-modal-form-money name="credit" label="Nominal" help="Nominal pengeluaran" value="{{ $activity->credit }}" />
</x-modal-form>