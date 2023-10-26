<x-modal-form-input {{ $attributes }}>

    <textarea 
        name="{{ $attributes['name'] }}" 
        id="{{ $attributes['name'] }}" 
        class="form-control" 
        cols="30" 
        rows="5">{{ old($attributes['name'], $attributes['value'] ?? '') }}</textarea>

</x-modal-form-input>
