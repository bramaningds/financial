<section class="content-detail">
    <div class="card mb-2">
        <div class="card-header">
            <div class="float-end">
                <a href="#" class="text-secondary" data-bs-toggle="dropdown" data-bs-auto-close="true">
                    <i class="bi bi-three-dots-vertical"></i>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a href="/activity/{{ $activity->id }}/edit"
                                class="dropdown-item" role="button">
                                <i class="bi bi-pencil"></i>
                                &nbsp;Edit</a>
                        </li>
                        <li>
                            <a href="#delete-activity-modal-{{ $activity->id }}"
                                class="dropdown-item text-danger" data-bs-toggle="modal" role="button">
                                <i class="bi bi-trash"></i>
                                &nbsp;Hapus</a>
                        </li>
                    </ul>
                </a>
            </div>
            <div class="fw-bold">{{ $activity->activity_date->translatedFormat('l, d F Y') }}</div>

            @if (!request('user_id'))
                <div class="text-body-secondary">{{ $activity->user->name }}</div>
            @endif
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if (request('keyword'))
                        {!! str_ireplace(request('keyword'), '<strong>' . request('keyword') . '</strong>', $activity->description) !!}
                    @else
                        {{ $activity->description }}
                    @endif
                </div>
    
                @if (!request('activity_type'))
                    <div class="col-12 col-md-auto d-flex justify-content-between me-2">
                        <span class="text-body-secondary">Jenis&nbsp;</span>
                        <span
                            class="text-body">{{ $activity->activity_type == 'income' ? 'Penerimaan' : 'Pengeluaran' }}</span>
                    </div>
                @endif
                @if (!request('category_id'))
                    <div class="col-12 col-md-auto d-flex justify-content-between me-2">
                        <span class="text-body-secondary">Kategori&nbsp;</span>
                        <span class="text-body">{{ $activity->category->name }}</span>
                    </div>
                @endif
                @if (!request('account_id'))
                    <div class="col-12 col-md-auto d-flex justify-content-between me-2">
                        <span class="text-body-secondary">Rekening&nbsp;</span>
                        <span class="text-body">{{ $activity->account->name }}</span>
                    </div>
                @endif
                <div class="w-100"></div>
                <div class="col-12 col-md-auto ms-md-auto d-flex justify-content-between">
                    <span class="text-body-secondary d-md-none">Nominal&nbsp;</span>
                    <span class="fw-bold">{{ money_format($activity->mutation) }}</span>
                </div>
            </div>
        </div>
    </div>
</section>