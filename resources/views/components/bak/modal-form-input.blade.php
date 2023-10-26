<div class="mb-3">

    <label for="{{ $attributes['name'] }}" class="form-label">{{ $attributes['label'] }}</label>

    {{ $slot }}

    <label for="{{ $attributes['name'] }}" class="invalid-feedback"></label>
    <label for="{{ $attributes['name'] }}" class="form-text">{{ $attributes['help'] ?? '' }}</label>

</div>