<x-content title="Pengguna :: AtBram">
    <section id="content-header" class="d-flex flex-wrap my-1">

        <h3>Pengguna</h3>

        <div class="ms-auto">
            <x-button-reset-filter />
            <x-button-create>Pengguna baru</x-button-create>
        </div>

        <form action="/user" class="w-100 py-1">
            <x-input-group-search />
        </form>

    </section>

    <section id="content-body" class="mb-2">
        <div class="row g-2">
            @foreach (range(0, 1) as $index)
                <div class="col-12 col-md-6">
                    @foreach ($users->nth(2, $index) as $user)
                        <article class="mb-2">
                            <x-card-user :user="$user" />
                        </article>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>
</x-content>
