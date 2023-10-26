<x-form-input {{ $attributes }}>

    <input
        id="{{ $attributes['name'] }}"
        type="password"
        name="{{ $attributes['name'] }}"
        class="form-control @error($attributes['name']) is-invalid @enderror"
        value="{{ old($attributes['name'], $attributes['value'] ?? '') }}" 
        autocomplete="off"/>

</x-form-input>