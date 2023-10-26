<x-modal-form-input {{ $attributes }}>

    <select class="form-select" name="{{ $attributes['name'] }}" id="{{ $attributes['name'] }}">
        @if ($attributes['placeholder'] ?? false)
            <option value="">{{ $attributes['placeholder'] }}</option>
        @endif
        @foreach ($options as $value => $label)
            <option value="{{ $value }}" @selected(old($attributes['name'], $value) == $attributes['value'])>{{ $label }}</option>
        @endforeach
    </select>

</x-modal-form-input>
