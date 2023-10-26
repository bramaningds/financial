<section class="content-detail">
    <div class="card mb-2">
        <div class="card-header">
            <div class="row align-items-center g-0">
                <div class="row align-items-center g-0">
                    <div class="col-auto text-truncate" style="max-width: 70%;">
                        <h5 class="m-0">{{ $category->name }}</h5>
                    </div>
                    <div class="col-auto ms-auto">
                        <a href="#detail-{{ $category->id }}" class="btn" role="button" data-bs-toggle="collapse">
                            <i class="bi bi-info-circle"></i>&nbsp;&nbsp;Info</a>
                    </div>
                    <div class="col-auto">
                        <a href="#" class="text-body" data-bs-toggle="dropdown" data-bs-auto-close="true">
                            <i class="bi bi-three-dots-vertical"></i>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="/activity?category_id={{ $category->id }}" class="dropdown-item"
                                        role="button">
                                        <i class="bi bi-archive"></i>
                                        &nbsp;Lihat aktifitas</a>
                                </li>
                                <li>
                                    <a href="/category/{{ $category->id }}/edit" class="dropdown-item" role="button">
                                        <i class="bi bi-pencil"></i>
                                        &nbsp;Edit</a>
                                </li>
                                <li>
                                    <a href="#delete-category-modal-{{ $category->id }}" data-bs-toggle="modal"
                                        class="dropdown-item text-danger" role="button">
                                        <i class="bi bi-trash"></i>
                                        &nbsp;Hapus</a>
                                </li>
                            </ul>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                @if ($category->description)
                    <div class="col-12">
                        <div class="mb-2">{{ $category->description }}</div>
                    </div>
                @endif
                <div class="col-5 text-body-secondary">Jenis aktifitas</div>
                <div class="col-7 text-end">
                    <strong>{{ $category->activity_type == 'income' ? 'Penerimaan' : 'Pengeluaran' }}</strong>
                </div>
            </div>
            <div class="row collapse" id="detail-{{ $category->id }}">
                <div class="w-100 my-2">
                    <hr class="my-0">
                </div>
                <div class="col-5 text-body-secondary">Aktifitas terakhir</div>
                <div class="col-7 text-end text-truncate">
                    <div>
                        {{ $category->latest_activity?->activity_date->translatedFormat('l, d F Y') ?? '-' }}
                    </div>
                    <div>{{ money_format($category->latest_activity?->mutation) ?? '-' }}</div>
                </div>
                <div class="w-100 my-1"></div>
                <div class="col-6 text-body-secondary">Aktifitas bulan ini</div>
                <div class="col-6 text-end">
                    <div>
                        {{ money_format($category->this_month_activities->sum('debit') - $category->this_month_activities->sum('credit')) }}
                    </div>
                    <div>{{ $category->this_month_activities->count() }} aktifitas</div>
                </div>
            </div>
        </div>
    </div>
</section>
