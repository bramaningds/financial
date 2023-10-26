<section class="content-detail">
    <div class="card">
        <div class="card-header">
            <div class="row align-items-center g-0">
                <div class="col-auto text-truncate" style="max-width: 70%;">
                    <h5 class="m-0">{{ $account->name }}</h5>
                </div>
                <div class="col-auto ms-auto">
                    <a href="#detail-{{ $account->id }}" class="btn" role="button" data-bs-toggle="collapse">
                        <i class="bi bi-info-circle"></i>&nbsp;&nbsp;Info</a>
                </div>
                <div class="col-auto">
                    <a href="#" class="text-body" data-bs-toggle="dropdown" data-bs-auto-close="true">
                        <i class="bi bi-three-dots-vertical"></i>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="/activity?account_id={{ $account->id }}" class="dropdown-item" role="button">
                                    <i class="bi bi-archive"></i>
                                    &nbsp;Lihat aktifitas</a>
                            </li>
                            <li>
                                <a href="/account/{{ $account->id }}/edit" class="dropdown-item" role="button">
                                    <i class="bi bi-pencil"></i>
                                    &nbsp;Edit</a>
                            </li>
                            <li>
                                <a href="/account/{{ $account->id }}" class="dropdown-item text-danger"
                                    data-bs-target="#delete-account-modal-{{ $account->id }}" data-bs-toggle="modal"
                                    role="button">
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
                @if ($account->description)
                    <div class="col-12">{{ $account->description }}</div>
                @endif
                <div class="w-100 my-1"></div>
                <div class="col-auto text-body-secondary">Tanggal dibuat</div>
                <div class="col-auto ms-auto text-end">
                    {{ $account->created_at->translatedFormat('l, d F Y') }}
                </div>
                <div class="w-100 my-1"></div>
                <div class="col-auto text-body-secondary align-self-center">Saldo</div>
                <div class="col-auto ms-auto fs-5 text-end">
                    <strong>{{ money_format($account->balance) }}</strong>
                </div>
            </div>
            <div class="row collapse" id="detail-{{ $account->id }}">
                <div class="w-100 my-2">
                    <hr class="my-0">
                </div>

                <div class="col-5 text-body-secondary">Saldo bulan lalu</div>
                <div class="col-7 text-end">
                    {{ money_format($account->balance - $account->this_month_activities->sum('debit') + $account->this_month_activities->sum('credit')) }}
                </div>
                <div class="w-100 my-1"></div>

                <div class="col-6 text-body-secondary">Aktifitas terakhir</div>
                <div class="col-6 text-end">
                    <div>
                        {{ $account->latest_activity?->activity_date->translatedFormat('l, d F Y') ?? '-' }}
                    </div>
                    <div>
                        {{ money_format(($account->latest_activity?->debit ?? 0) - ($account->latest_activity?->credit ?? 0)) }}
                    </div>
                </div>
                <div class="w-100 my-1"></div>
                <div class="col-6 text-body-secondary">Aktifitas bulan ini</div>
                <div class="col-6 text-end">
                    <div>
                        {{ money_format($account->this_month_activities->sum('debit') - $account->this_month_activities->sum('credit')) }}
                    </div>
                    <div>{{ $account->this_month_activities->count() }} aktifitas</div>
                </div>
                <div class="w-100 my-1"></div>
                <div class="col-auto text-body-secondary">Transfer masuk terakhir</div>
                <div class="col-auto ms-auto text-end">
                    <div>
                        {{ $account->latest_transfer_in?->transfer_date->translatedFormat('l, d F Y') ?? '-' }}
                    </div>
                    <div>
                        {{ money_format($account->latest_transfer_in?->amount ?? 0) }}
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-auto text-body-secondary">Transfer masuk bulan ini</div>
                <div class="col-auto ms-auto text-end">
                    {{ money_format($account->this_month_transfers_in->sum('amount')) }}
                </div>
                <div class="w-100 my-1"></div>
                <div class="col-auto text-body-secondary">Transfer keluar terakhir</div>
                <div class="col-auto ms-auto text-end">
                    <div>
                        {{ $account->latest_transfer_out?->transfer_date->translatedFormat('l, d F Y') ?? '-' }}
                    </div>
                    <div>
                        {{ money_format($account->latest_transfer_out?->amount ?? 0) }}
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-auto text-body-secondary">Transfer keluar bulan ini</div>
                <div class="col-auto ms-auto text-end">
                    {{ money_format($account->this_month_transfers_out->sum('amount')) }}
                </div>
            </div>
        </div>
    </div>
</section>