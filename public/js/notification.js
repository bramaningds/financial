@if ($notification = $notification ?? (session('notification') ?? false))
<div class="toast-container bottom-0 end-0 p-4">
    <div id="notification" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong>{{ $notification['title'] ?? 'Notification' }}</strong>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
        <div class="toast-body">{{ $notification['message'] ?? $notification }}</div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        bootstrap.Toast.getOrCreateInstance(document.getElementById('notification')).show()
    })
</script>
@endif

