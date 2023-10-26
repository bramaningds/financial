<x-content title="Rekening :: AtBram">
    <section id="content-header" class="d-flex flex-wrap my-1">

        <h3>Rekening kas</h3>

        <div class="ms-auto">
            <x-button-reset-filter />
            <x-button-create>Rekening baru</x-button-create>
        </div>

        <form action="/account" class="w-100 py-1">
            <x-input-group-search />
        </form>

    </section>

    <section id="content-body" class="my-2">
        <div class="row g-2">
            @foreach (range(0, 1) as $index)
                <div class="col-12 col-md-6">
                    @foreach ($accounts->nth(2, $index) as $account)
                        <article id="account-{{ $account->id }}" class="mb-2">
                            <x-card-account :account="$account" />

                            <x-form-delete action="/account/{{ $account->id }}"
                                id="delete-account-form-{{ $account->id }}" />

                            <x-modal-delete id="delete-account-modal-{{ $account->id }}"
                                form-id="delete-account-form-{{ $account->id }}">
                                <x-slot name="title">Konfirmasi hapus rekening</x-slot>
                                <p>Anda yakin menghapus rekening <strong>{{ $account->name }}</strong>?</p>
                            </x-modal-delete>
                        </article>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

</x-content>
