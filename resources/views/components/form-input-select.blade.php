<x-form-input {{ $attributes }}>

    <select name="{{ $attributes['name'] }}" id="{{ $attributes['name'] }}"
        class="form-select @error($attributes['name']) is-invalid @enderror">

        @if ($placeholder ?? $attributes['placeholder'] ?? false)
            <option value="">{{ $placeholder ?? $attributes['placeholder'] }}</option>
        @endif

        @if (isset($options))
            @foreach ($options as $value => $label)
                <option value="{{ $value }}" @selected(old($attributes['name'], $attributes['value']) == $value)>{{ $label }}</option>
            @endforeach
        @endif
    </select>

</x-form-input>
