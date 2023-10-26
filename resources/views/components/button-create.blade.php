<a href="{{ $attributes['href'] ?? request()->url() . '/create' }}" 
    class="btn btn-sm btn-primary">
    {{ $slot }}
</a>