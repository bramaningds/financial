<x-content title="Rekening :: AtBram">
    <section id="content-header" class="d-flex flex-wrap my-1">

        <h3>Kategori aktifitas</h3>

        <div class="ms-auto">
            <x-button-reset-filter />
            <x-button-create>Kategori aktifitas baru</x-button-create>
        </div>

        <form action="/category" class="w-100 py-1">
            <x-input-group-search />
        </form>

    </section>

    <section id="content-body" class="my-2">
        <div class="row gx-2 gy-4">

            @foreach (['income', 'expense'] as $activity_type)
                <div class="col-12 col-md-6">
                    @foreach ($categories->where('activity_type', $activity_type) as $category)
                        <article id="category-{{ $category->id }}">
                            <x-card-category :category="$category" />

                            <x-form-delete action="/category/{{ $category->id }}"
                                id="delete-category-form-{{ $category->id }}" />

                            <x-modal-delete id="delete-category-modal-{{ $category->id }}"
                                form-id="delete-category-form-{{ $category->id }}">
                                <x-slot name="title">Konfirmasi hapus kategori</x-slot>
                                <p>Anda yakin menghapus kategori <strong>{{ $category->name }}</strong>?</p>
                            </x-modal-delete>
                        </article>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
</x-content>
