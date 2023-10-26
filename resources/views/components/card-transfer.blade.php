<article>
    <div class="card mb-2">
        <div class="card-header">
            <div class="float-end">
                <a href="#" class="text-secondary" data-bs-toggle="dropdown" data-bs-auto-close="true">
                    <i class="bi bi-three-dots-vertical"></i>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="/transfer/{{ $transfer->id }}/edit" class="dropdown-item" role="button">
                                <i class="bi bi-pencil"></i>
                                &nbsp;Edit</a>
                        </li>
                        <li>
                            <a href="/transfer/{{ $transfer->id }}/edit" class="dropdown-item text-danger"
                                role="button">
                                <i class="bi bi-trash"></i>
                                &nbsp;Hapus</a>
                        </li>
                    </ul>
                </a>
            </div>
            <div class="fw-bold">{{ $transfer->transfer_date->translatedFormat('l, d F Y') }}</div>
            @if (!request('user_id'))
                <div class="text-body-secondary">{{ $transfer->user->name }}</div>
            @endif
        </div>
        <div class="card-body">
            <div class="row g-2">
                <div class="col-12">
                    @if (request('keyword'))
                        {!! str_ireplace(request('keyword'), '<strong>' . request('keyword') . '</strong>', $transfer->description) !!}
                    @else
                        {{ $transfer->description }}
                    @endif
                </div>
                @if (!request('from_id'))
                    <div class="col-12 col-md-auto d-flex justify-content-between me-2">
                        <span class="text-body-secondary">Rekening asal&nbsp;</span>
                        <span>{{ $transfer->from_account->name }}</span>
                    </div>
                @endif
                @if (!request('to_id'))
                    <div class="col-12 col-md-auto d-flex justify-content-between me-2">
                        <span class="text-body-secondary">Rekening tujuan&nbsp;</span>
                        <span>{{ $transfer->to_account->name }}</span>
                    </div>
                @endif
                <div class="w-100 m-0"></div>
                <div class="col-12 col-md-auto ms-md-auto d-flex justify-content-between">
                    <span class="text-body-secondary d-md-none">Nominal&nbsp;</span>
                    <span class="fw-bold">{{ money_format($transfer->amount) }}</span>
                </div>
            </div>
        </div>
    </div>
</article>
