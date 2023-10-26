<x-content>
    <ul class="nav nav-underline">
        <li class="nav-item">
            <a class="nav-link {{ active_if_request('type', 'summary', true) }}" href="/report?type=summary">Ringkasan penerimaan dan pengeluaran</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ active_if_request('type', 'expense') }}" href="/report?type=expense">Ringkasan pengeluaran per kategori</a>
        </li>
    </ul>
</x-content>
