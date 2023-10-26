<section class="delete-confirmation">

    <form action="/account/{{ $account->id }}" method="post" id="account-delete-{{ $account->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="_method" value="delete" />
    </form>

    <div class="modal fade" tabindex="-1" id="deleteAccountModal{{ $account->id }}">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi hapus rekening</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda yakin menghapus rekening <strong>{{ $account->name }}</strong>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger"
                        form="account-delete-{{ $account->id }}">Delete</button>
                </div>
            </div>
        </div>
    </div>

</section>
