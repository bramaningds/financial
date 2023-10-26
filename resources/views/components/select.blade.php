<select class="form-select {{ request($attributes['name']) ? 'border-primary-subtle' : '' }}"
    name="{{ $attributes['name'] }}" onchange="this.form.submit()">

    <option value="">{{ $attributes['placeholder'] }}</option>

    @foreach ($options as $value => $label)
        <option value="{{ $value }}" @selected(request($attributes['name']) == $value)>{{ $label }}</option>
    @endforeach

</select>