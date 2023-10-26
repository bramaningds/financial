<div class="mb-3">

    <div class="row">
        <div class="col-12 col-md-3 text-md-end">
            <label for="{{ $attributes['name'] }}" class="form-label">{{ $attributes['label'] }}</label>
        </div>
        <div class="col-12 col-md-7">
            {{ $slot }}

            @error($attributes['name'])
                <label for="{{ $attributes['name'] }}" class="invalid-feedback">{{ $message }}</label>
            @enderror
        
            @if ($attributes['help'] ?? false)
                <label for="{{ $attributes['name'] }}" class="form-text">{{ $attributes['help'] }}</label>
            @endif        
        </div>
    </div>
    
</div>
