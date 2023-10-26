<x-content>
    <section class="my-1">
        <h3>{{ isset($transfer) ? 'Edit transfer' : 'Transfer baru' }}</h3>

        <div class="my-4"></div>

        <form action="/transfer/{{ $transfer->id ?? '' }}" method="post"
            name="transfer-{{ isset($transfer) ? 'create' : 'edit' }}">

            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="_method" value="{{ isset($transfer) ? 'put' : 'post' }}" />

            <x-form-input-date name="transfer_date" label="Tanggal" help="Tanggal transfer."
                value="{{ isset($transfer) ? $transfer->transfer_date->toDateString() : '' }}" />

            <x-form-input-select name="from_id" label="Rekening asal" placeholder="Pilih rekening"
                help="Rekening digunakan sebagai sumber dana" :options="$accounts->pluck('name', 'id')"
                value="{{ $transfer->from_id ?? '' }}" />

            <x-form-input-select name="to_id" label="Rekening asal" placeholder="Pilih rekening"
                help="Rekening digunakan sebagai tujuan transfer" :options="$accounts->pluck('name', 'id')"
                value="{{ $transfer->to_id ?? '' }}" />

            <x-form-input-textarea name="description" label="Keterangan" help="Informasi tujuan transfer."
                value="{{ $transfer->description ?? '' }}" />

            <x-form-input-money name="amount" label="Nominal" help="Nominal transfer"
                value="{{ $transfer->amount ?? '' }}" />

            <hr>

            <x-form-button-submit />
        </form>
    </section>
</x-content>
