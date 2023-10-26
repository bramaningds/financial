<x-modal-form-input {{ $attributes }}>

    <input
        id="{{ $attributes['name'] }}"
        type="date"
        name="{{ $attributes['name'] }}"
        class="form-control"
        value="{{ old($attributes['name'], $attributes['value'] ?? '') }}"
        autocomplete="off" />

</x-modal-form-input>