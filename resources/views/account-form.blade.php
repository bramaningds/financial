<x-content>
    <section class="my-1">
        <h3>{{ isset($account) ? 'Edit rekening' : 'Rekening baru' }}</h3>

        <div class="my-4"></div>

        <form action="/account/{{ $account->id ?? '' }}" method="post" name="account-create">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="_method" value="{{ isset($account) ? 'put' : 'post' }}" />

            <x-form-input-text name="name" label="Nama rekening" help="Nama rekening harus unik"
                value="{{ $account->name ?? '' }}" />

            <x-form-input-textarea name="description" label="Keterangan" help="Informasi tambahan"
                value="{{ $account->description ?? '' }}" />

            <hr>

            <x-form-button-submit />
        </form>
    </section>
</x-content>
