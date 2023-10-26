<div class="modal fade" id="{{ $attributes['id'] }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{ $attributes['title'] }}</h5>
                <button type="reset" form="{{ $attributes['name'] }}" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ $attributes['action'] }}" method="POST" name="{{ $attributes['name'] }}"
                    id="{{ $attributes['name'] }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <input type="hidden" name="_modal" value="{{ $attributes['id'] }}">
                    <input type="hidden" name="_method" value="{{ $attributes['method'] }}">

                    {{ $slot }}
                </form>
            </div>

            <div class="modal-footer">
                <button type="reset" form="{{ $attributes['name'] }}" data-bs-dismiss="modal"
                    class="btn btn-secondary">Cancel</button>
                <button type="submit" form="{{ $attributes['name'] }}"
                    class="btn btn-{{ $attributes['method'] == 'delete' ? 'danger' : 'primary' }}">{{ $attributes['method'] == 'delete' ? 'OK' : 'Save' }}</button>
            </div>

        </div>
    </div>
</div>