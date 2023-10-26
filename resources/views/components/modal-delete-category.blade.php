<x-modal-delete id="deleteCategoryModal{{ $category->id }}" form-id="delete-category-{{ $category->id }}">
    <x-slot name="title">Konfirmasi hapus kategori</x-slot>
    <x-slot name="body">
        <p>Anda yakin menghapus kategori <strong>{{ $category->name }}</strong>?</p>
    </x-slot>
</x-modal-delete>