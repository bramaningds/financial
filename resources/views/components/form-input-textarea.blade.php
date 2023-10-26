<x-form-input {{ $attributes }}>

    <textarea 
        name="{{ $attributes['name'] }}" 
        id="{{ $attributes['name'] }}" 
        class="form-control @error($attributes['name']) is-invalid @enderror" 
        cols="30" 
        rows="5">{{ old($attributes['name'], $attributes['value'] ?? '') }}</textarea>

</x-form-input>
