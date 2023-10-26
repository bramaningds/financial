<x-content title="Aktifitas :: AtBram">
    <section id="content-header" class="d-flex flex-wrap my-1">

        <h3>Aktifitas</h3>

        <div class="ms-auto">
            <x-button-reset-filter />
            <x-button-dropdown-create caption="Aktifitas baru">
                <x-button-dropdown-create-item href="/activity/create?activity_type=income">
                    <i class="bi bi-journal-arrow-up"></i>
                    &nbsp;Penerimaan
                </x-button-dropdown-create-item>
                <x-button-dropdown-create-item href="/activity/create?activity_type=expense">
                    <i class="bi bi-journal-arrow-down"></i>
                    &nbsp;Pengeluaran
                </x-button-dropdown-create-item>
            </x-button-dropdown-create>
        </div>

        <form action="/activity" class="w-100 py-1">
            <x-input-group-search />
            <x-form-filter-activity :users="$users" :accounts="$accounts" :categories="$categories" />
        </form>

    </section>

    <section id="content-body" class="mb-2">
        <div class="row g-2">
            @foreach (range(0, 1) as $index)
                <div class="col-12 col-md-6">
                    @foreach ($activities->nth(2, $index) as $activity)
                        <article id="activity-{{ $activity->id }}" class="mb-2">
                            <x-card-activity :activity="$activity" />

                            <x-form-delete action="/activity/{{ $activity->id }}"
                                id="delete-activity-form-{{ $activity->id }}" />

                            <x-modal-delete id="delete-activity-modal-{{ $activity->id }}"
                                form-id="delete-activity-form-{{ $activity->id }}">
                                <x-slot name="title">Konfirmasi aktifitas</x-slot>
                                <p>Anda yakin menghapus aktifitas ini?</p>
                                <p>
                                <div class="text-body-secondary">Uraian</div>
                                <div>{{ $activity->description }}</div>
                                <div class="text-body-secondary">Nominal</div>
                                <div>{{ money_format($activity->mutation) }}</div>
                                </p>
                            </x-modal-delete>
                        </article>
                    @endforeach
                </div>
            @endforeach
        </div>

        {{ $activities->links() }}
    </section>
</x-content>
