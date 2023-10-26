@isset($user)
    @props([
        'title' => 'Edit user',
        'action' => "/user/{$user->id}",
        'name' => "user-edit-{$user->id}",
        'method' => 'put',
    ])
@else
    @props([
        'title' => 'User baru',
        'action' => '/user',
        'name' => 'user-create',
        'method' => 'post',
    ])
@endisset

<x-content>
    <section class="my-1">
        <h3>{{ $title }}</h3>

        <div class="my-4"></div>

        <form action="{{ $action }}" name="{{ $name }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="_method" value="{{ $method }}" />

            <x-form-input-text name="name" label="Nama" value="{{ $user->name ?? '' }}" />
            <x-form-input-email name="email" label="Email" value="{{ $user->email ?? '' }}" />

            <x-form-input-password name="password" label="Password" />
            <x-form-input-password name="password_confirm" label="Konfirmasi password" />

            <hr>

            <x-form-button-submit />
        </form>
    </section>
</x-content>
