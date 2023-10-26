<x-form-input {{ $attributes }}>

    <div class="input-group @error($attributes['name']) is-invalid @enderror">
        <span class="input-group-text">Rp.</span>
        <input type="number" name="{{ $attributes['name'] }}" id="{{ $attributes['name'] }}"
            class="form-control @error($attributes['name']) is-invalid @enderror"
            value="{{ old($attributes['name'], $attributes['value'] ?? '') }}" autocomplete="off" />
    </div>

</x-form-input>
