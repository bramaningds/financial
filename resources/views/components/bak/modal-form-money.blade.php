<x-modal-form-input {{ $attributes }}>

    <div class="input-group">
        <span class="input-group-text">Rp.</span>
        <input type="number" name="{{ $attributes['name'] }}" id="{{ $attributes['name'] }}" class="form-control"
            value="{{ old($attributes['name'], $attributes['value'] ?? '') }}"
            autocomplete="off" />
    </div>

</x-modal-form-input>
