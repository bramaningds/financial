<x-modal-form id="{{ $attributes['id'] }}" title="Edit penerimaan" name="income-edit-{{ $activity->id }}" method="put"
    action="/activity/{{ $activity->id }}">

    <input type="hidden" name="activity_type" value="income">
    <input type="hidden" name="credit" value="0">

    <x-modal-form-date name="activity_date" label="Tanggal" help="Tanggal penerimaan."
        value="{{ $activity->activity_date->toDateString() }}" />

    <x-modal-form-select name="category_id" label="Kategori" placeholder="Pilih kategori" help="Kategori penerimaan"
        :options="$categories->pluck('name', 'id')" value="{{ $activity->category_id }}" />

    <x-modal-form-select name="account_id" label="Rekening" placeholder="Pilih rekening"
        help="Rekening digunakan untuk penerimaan" :options="$accounts->pluck('name', 'id')" value="{{ $activity->account_id }}" />

    <x-modal-form-textarea name="description" label="Uraian" help="Keterangan asal dan tujuan penerimaan"
        value="{{ $activity->description }}" />
    <x-modal-form-money name="debit" label="Nominal" help="Nominal penerimaan" value="{{ $activity->debit }}" />
</x-modal-form>
