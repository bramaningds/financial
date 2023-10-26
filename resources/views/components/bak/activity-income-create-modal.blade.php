<x-modal-form id="{{ $attributes['id'] }}" title="Penerimaan baru" name="income-create" method="post" action="/activity">
    <input type="hidden" name="activity_type" value="income">
    <input type="hidden" name="credit" value="0">

    <x-modal-form-date name="activity_date" label="Tanggal" help="Tanggal penerimaan." />
    <x-modal-form-select name="category_id" label="Kategori" placeholder="Pilih kategori" help="Kategori penerimaan"
        :options="$categories->pluck('name', 'id')" />

    <x-modal-form-select name="account_id" label="Rekening" placeholder="Pilih rekening"
        help="Rekening digunakan untuk penerimaan" :options="$accounts->pluck('name', 'id')" />

    <x-modal-form-textarea name="description" label="Uraian" help="Keterangan asal dan tujuan penerimaan" />
    <x-modal-form-money name="debit" label="Nominal" help="Nominal penerimaan" />
</x-modal-form>