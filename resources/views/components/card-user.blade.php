<article>
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center g-0">
                <div class="col-auto text-truncate" style="max-width: 70%;">
                    <h5 class="m-0">{{ $user->name }}</h5>
                </div>
                <div class="col-auto ms-auto">
                    <a href="#detail-{{ $user->id }}" class="btn" role="button" data-bs-toggle="collapse">
                        <i class="bi bi-info-circle"></i>&nbsp;&nbsp;Info</a>
                </div>
                <div class="col-auto">
                    <a href="#" class="text-body" data-bs-toggle="dropdown" data-bs-auto-close="true">
                        <i class="bi bi-three-dots-vertical"></i>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="/activity?user_id={{ $user->id }}" class="dropdown-item" role="button">
                                    <i class="bi bi-archive"></i>
                                    &nbsp;Lihat aktifitas</a>
                            </li>
                            <li>
                                <a href="/transfer?user_id={{ $user->id }}" class="dropdown-item" role="button">
                                    <i class="bi bi-wallet"></i>
                                    &nbsp;Lihat transfer</a>
                            </li>
                            <li>
                                <a href="/user/{{ $user->id }}/edit" class="dropdown-item" role="button">
                                    <i class="bi bi-pencil"></i>
                                    &nbsp;Edit</a>
                            </li>
                            <li>
                                <a href="#delete-user-modal-{{ $user->id }}" class="dropdown-item text-danger"
                                    data-bs-toggle="modal" role="button">
                                    <i class="bi bi-trash"></i>
                                    &nbsp;Hapus</a>
                            </li>
                        </ul>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-auto">
                    <span class="text-body-secondary">Tanggal daftar</span>
                </div>
                <div class="col-auto ms-auto text-end">{{ $user->created_at->translatedFormat('l, d F Y') }}
                </div>
                <div class="w-100"></div>
                <div class="col-auto">
                    <span class="text-body-secondary">Email</span>
                </div>
                <div class="col-auto ms-auto text-end">{{ $user->email }}</div>
            </div>
            <div class="row collapse" id="detail-{{ $user->id }}">
                <div class="w-100 my-2">
                    <hr class="my-0">
                </div>
                <div class="col-auto text-body-secondary">Aktifitas terakhir</div>
                <div class="col-auto ms-auto text-end">
                    <div>
                        {{ $user->latest_activity?->activity_date->translatedFormat('l, d F Y') ?? '-' }}
                    </div>
                    <div>
                        {{ money_format(($user->latest_activity?->debit ?? 0) - ($user->latest_activity?->credit ?? 0)) }}
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-auto text-body-secondary">Aktifitas bulan ini</div>
                <div class="col-auto ms-auto text-end">
                    <div>
                        {{ money_format($user->this_month_activities->sum('debit') - $user->this_month_activities->sum('credit')) }}
                    </div>
                    <div>{{ $user->this_month_activities->count() }} aktifitas</div>
                </div>
                <div class="w-100 my-1"></div>
                <div class="col-auto text-body-secondary">Transfer terakhir</div>
                <div class="col-auto ms-auto text-end">
                    <div>
                        {{ $user->latest_transfer?->transfer_date->translatedFormat('l, d F Y') ?? '-' }}
                    </div>
                    <div>
                        {{ money_format($user->latest_transfer?->amount ?? 0) }}
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-auto text-body-secondary">Transfer bulan ini</div>
                <div class="col-auto ms-auto text-end">
                    <div>
                        {{ money_format($user->this_month_transfers->sum('amount')) }}
                    </div>
                    <div>{{ $user->this_month_transfers->count() }} transfer</div>
                </div>
            </div>
        </div>
    </div>
</article>
