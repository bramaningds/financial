@isset($activity)
    @props([
        'title' => 'Edit penerimaan',
        'action' => "/activity/{$activity->id}",
        'name' => "activity-edit-{$activity->id}",
        'method' => 'put',
        'activity_date' => $activity->activity_date->toDateString(),
        'category_id' => $activity->category_id,
        'account_id' => $activity->account_id,
        'description' => $activity->description,
        'debit' => $activity->debit,
    ])
@else
    @props([
        'title' => 'Penerimaan baru',
        'action' => '/activity',
        'name' => 'activity-create',
        'method' => 'post',
        'activity_date' => '',
        'category_id' => '',
        'account_id' => '',
        'description' => '',
        'debit' => '',
    ])
@endisset

<x-content>
    <section class="my-1">
        <h3>{{ $title }}</h3>

        <div class="my-4"></div>

        @foreach ($errors->messages() as $key => $messages)
            @continue(in_array($key, ['activity_date', 'category_id', 'account_id', 'description', 'debit']))

            <div class="alert alert-danger">
                <p class="fw-bold">
                    <i class="bi bi-exclamation-circle"></i>
                    <span class="ms-2">{{ $key }}</span>
                </p>
                @foreach ($messages as $message)
                    <p><i class="bi bi-dot"></i>&nbsp;{{ $message }}</p>
                @endforeach
            </div>
        @endforeach

        <form action="{{ $action }}" name="{{ $name }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="_method" value="{{ $method }}" />

            <input type="hidden" name="activity_type" value="income">
            <input type="hidden" name="credit" value="0" />

            <x-form-input-date name="activity_date" label="Tanggal" help="Tanggal penerimaan."
                value="{{ $activity_date }}" />

            <x-form-input-select name="category_id" label="Kategori" placeholder="Pilih kategori"
                help="Kategori penerimaan" :options="$categories->pluck('name', 'id')" value="{{ $category_id }}" />

            <x-form-input-select name="account_id" label="Rekening" placeholder="Pilih rekening"
                help="Rekening digunakan untuk penerimaan" :options="$accounts->pluck('name', 'id')" value="{{ $account_id }}" />

            <x-form-input-textarea name="description" label="Uraian" help="Keterangan asal dan tujuan penerimaan"
                value="{{ $description }}" />

            <x-form-input-money name="debit" label="Nominal" help="Nominal penerimaan" value="{{ $debit }}" />

            <hr>

            <x-form-button-submit />
        </form>
    </section>
</x-content>
