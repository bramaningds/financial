<section class="delete-confirmation">

    <form action="/activity/{{ $activity->id }}" method="post" id="activity-delete-{{ $activity->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="delete" />
    </form>

    <div class="modal fade" tabindex="-1" id="deleteActivityModal{{ $activity->id }}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi hapus {{ $activity->activity_type == 'income' ? 'penerimaan' : 'pengeluaran' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin menghapus {{ $activity->activity_type == 'income' ? 'penerimaan' : 'pengeluaran' }} berikut?</p>
                    <p>{{ $activity->description }}</p>
                    <p>{{ $activity->mutation }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger"
                        form="activity-delete-{{ $activity->id }}">Delete</button>
                </div>
            </div>
        </div>
    </div>

</section>
