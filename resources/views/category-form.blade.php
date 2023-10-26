<x-content>
    <section class="my-1">
        <h3>{{ isset($category) ? 'Edit kategori' : 'Kategory baru' }}</h3>

        <div class="my-4"></div>

        <form action="/category/{{ $category->id ?? '' }}" method="post" name="category-create">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="_method" value="{{ isset($category) ? 'put' : 'post' }}" />

            <x-form-input-text name="name" label="Nama rekening" help="Nama rekening harus unik"
                value="{{ $category->name ?? '' }}" />

            <x-form-input-select name="activity_type" label="Jenis aktifitas" placeholder="Pilih jenis aktifitas"
                value="{{ $category->activity_type ?? '' }}" :options="['income' => 'Penerimaan', 'expense' => 'Pengeluaran']" />

            <x-form-input-textarea name="description" label="Keterangan" help="Informasi tambahan"
                value="{{ $category->description ?? '' }}" />

            <hr>

            <x-form-button-submit />
        </form>
    </section>
</x-content>
