@props([
    'action' => $attributes['action'] ?? "/{$attributes['entity-name']}/{$attributes['entity-id']}",
    'id' => $attributes['id'] ?? "{$attributes['entity-name']}-delete-form-{$attributes['entity-id']}"
])

<section class="delete-form">
    <form action="{{ $action }}" id="{{ $id }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="delete" />
    </form>
</section>
