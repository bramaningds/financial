<x-form-input {{ $attributes }}>

    <input type="text" id="{{ $attributes['name'] }}" name="{{ $attributes['name'] }}"
        class="form-control @error($attributes['name']) is-invalid @enderror"
        value="{{ old($attributes['name'], $attributes['value'] ?? '') }}" autocomplete="off" />

</x-form-input>
