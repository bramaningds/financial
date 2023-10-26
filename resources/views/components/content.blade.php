<x-layout title="{{ $attributes['title'] ?? 'AtBram' }}">

    <header><x-navigation /></header>

    <main class="container py-3">{{ $slot }}</main>

</x-layout>
