<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Frozeria Stok</title>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f5f6fa;          /* ganti dari #0f1117 */
            --surface: #ffffff;     /* ganti dari #1a1d27 */
            --surface2: #f0f2f8;    /* ganti dari #22263a */
            --border: #e2e6f0;      /* ganti dari #2e3347 */
            --text: #1a1d2e;        /* ganti dari #e8eaf0 */
            --muted: #6b7280;       /* ganti dari #8b90a7 */
            --accent: #4f8ef7;      /* tetap sama */
            --accent-hover: #3a7af5;/* tetap sama */
            --danger: #ef4444;      /* tetap sama */
            --danger-hover: #dc2626;/* tetap sama */
            --warning: #f59e0b;     /* tetap sama */
            --success: #22c55e;     /* tetap sama */
            --cyan: #06b6d4;        /* tetap sama */
            --radius: 8px;
            --radius-lg: 12px;
            --shadow: 0 4px 24px rgba(0,0,0,0.08); /* ganti opacity shadow */
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            min-height: 100vh;
        }
        /* NAVBAR */
        .navbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 24px;
            display: flex;
            align-items: center;
            gap: 0;
            height: 52px;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-brand {
            font-family: 'Space Grotesk', sans-serif;
            font-weight: 700;
            font-size: 17px;
            color: #1a1d2e;
            letter-spacing: -0.3px;
            margin-right: 32px;
            text-decoration: none;
        }
        .navbar-brand span {
            color: var(--accent);
        }
        .navbar-badge {
            font-size: 10px;
            font-weight: 600;
            background: var(--surface2);
            color: var(--muted);
            border: 1px solid var(--border);
            padding: 2px 7px;
            border-radius: 20px;
            margin-left: 8px;
            vertical-align: middle;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .nav-links {
            display: flex;
            gap: 2px;
            align-items: center;
            flex: 1;
        }
        .nav-link {
            padding: 6px 14px;
            border-radius: var(--radius);
            color: #6b7280;
            text-decoration: none;
            font-weight: 500;
            font-size: 13.5px;
            transition: all 0.15s;
        }
        .nav-link:hover { color: var(--text); background: var(--surface2); }
        .nav-link.active { color: var(--text); background: var(--surface2); }
        .nav-actions { display: flex; gap: 8px; align-items: center; margin-left: auto; }
        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            border-radius: var(--radius);
            border: none;
            cursor: pointer;
            font-family: 'DM Sans', sans-serif;
            font-size: 13.5px;
            font-weight: 600;
            transition: all 0.15s;
            text-decoration: none;
        }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: var(--accent-hover); }
        .btn-danger { background: var(--danger); color: #fff; }
        .btn-danger:hover { background: var(--danger-hover); }
        .btn-ghost {
            background: transparent;
            color: var(--muted);
            border: 1px solid var(--border);
        }
        .btn-ghost:hover { background: var(--surface2); color: var(--text); }
        .btn-sm { padding: 5px 10px; font-size: 12.5px; }
        .btn-edit { background: var(--surface2); color: var(--accent); border: 1px solid var(--border); }
        .btn-edit:hover { background: var(--accent); color: #fff; border-color: var(--accent); }
        .btn-del { background: var(--surface2); color: var(--danger); border: 1px solid var(--border); }
        .btn-del:hover { background: var(--danger); color: #fff; border-color: var(--danger); }
        .btn-detail { background: var(--surface2); color: var(--text); border: 1px solid var(--border); }
        .btn-detail:hover { background: var(--surface2); color: var(--accent); }
        /* MAIN CONTENT */
        .main { padding: 28px 32px; }
        /* .main { padding: 28px 32px; max-width: 1200px; margin: 0 auto; } */
        /* CARDS */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px 24px;
        }
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 18px 22px;
        }
        .stat-card .label {
            font-size: 12px;
            color: var(--muted);
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }
        .stat-card .value {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 30px;
            font-weight: 700;
            color: var(--text);
        }
        .stat-card.warning .value { color: var(--warning); }
        .stat-card.danger .value { color: var(--danger); }
        /* TABLE */
        .table-wrap {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
        }
        table { width: 100%; border-collapse: collapse; }
        thead th {
            background: var(--surface2);
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 1px solid var(--border);
        }
        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.12s;
        }
        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--surface2); }
        td { padding: 12px 16px; color: var(--text); vertical-align: middle; }
        /* BADGE */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11.5px;
            font-weight: 600;
        }
        .badge-blue { background: rgba(79,142,247,0.15); color: var(--accent); }
        .badge-green { background: rgba(34,197,94,0.15); color: var(--success); }
        .badge-yellow { background: rgba(245,158,11,0.15); color: var(--warning); }
        .badge-red { background: rgba(239,68,68,0.15); color: var(--danger); }
        .badge-cyan { background: rgba(6,182,212,0.15); color: var(--cyan); }
        .badge-gray { background: var(--surface2); color: var(--muted); }
        /* SEARCH BAR */
        .search-row {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 16px;
        }
        .input, .select {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            padding: 8px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13.5px;
            outline: none;
            transition: border 0.15s;
        }
        .input::placeholder { color: var(--muted); }
        .input:focus, .select:focus { border-color: var(--accent); }
        .select option { background: var(--surface2); color: var(--text); }
        .search-input { flex: 1; }
        /* FORM */
        .form-group { margin-bottom: 16px; }
        .form-label {
            display: block;
            font-size: 12.5px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 6px;
        }
        .form-label .req { color: var(--danger); }
        .form-input, .form-select, .form-textarea {
            width: 100%;
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            padding: 9px 14px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border 0.15s;
        }
        .form-input::placeholder { color: var(--muted); }
        .form-input:focus, .form-select:focus, .form-textarea:focus { border-color: var(--accent); }
        .form-textarea { resize: vertical; min-height: 80px; }
        .form-select option { background: var(--surface2); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-error { color: var(--danger); font-size: 12px; margin-top: 4px; }
        /* FOTO UPLOAD */
        .foto-upload-area {
            border: 2px dashed var(--border);
            border-radius: var(--radius-lg);
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: border 0.15s;
            position: relative;
            margin-bottom: 8px;
        }
        .foto-upload-area:hover { border-color: var(--accent); }
        .foto-upload-area .icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 12px;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .foto-upload-area p { color: var(--muted); font-size: 13px; }
        .foto-upload-area p span { color: var(--accent); font-weight: 600; }
        .foto-upload-area .size-hint { font-size: 11.5px; color: var(--muted); margin-top: 4px; }
        .foto-preview { max-width: 100%; max-height: 200px; object-fit: contain; border-radius: var(--radius); }
        /* PAGINATION */
        .pagination {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 14px 16px;
            border-top: 1px solid var(--border);
            justify-content: space-between;
        }
        .pagination-info { color: var(--muted); font-size: 13px; }
        .pagination-links { display: flex; gap: 4px; }
        .page-btn {
            padding: 5px 10px;
            border-radius: var(--radius);
            border: 1px solid var(--border);
            background: transparent;
            color: var(--muted);
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }
        .page-btn:hover { background: var(--surface2); color: var(--text); }
        .page-btn.active { background: var(--accent); color: #fff; border-color: var(--accent); }
        .page-btn.disabled { opacity: 0.4; pointer-events: none; }
        /* ALERT / FLASH */
        .alert {
            padding: 12px 16px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            font-size: 13.5px;
            font-weight: 500;
        }
        .alert-success { background: rgba(34,197,94,0.12); border: 1px solid rgba(34,197,94,0.3); color: var(--success); }
        .alert-danger  { background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.3); color: var(--danger); }
        /* BREADCRUMB */
        .breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            color: var(--muted);
        }
        .breadcrumb a { color: var(--muted); text-decoration: none; }
        .breadcrumb a:hover { color: var(--text); }
        .breadcrumb-sep { opacity: 0.4; }
        .breadcrumb-current { color: var(--text); font-weight: 500; }
        /* MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        .modal-overlay.active { display: flex; }
        .modal {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 28px;
            max-width: 400px;
            width: 90%;
            box-shadow: var(--shadow);
        }
        .modal-icon {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(245,158,11,0.15);
            border: 1px solid rgba(245,158,11,0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
        }
        .modal h3 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 17px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .modal p { color: var(--muted); font-size: 13.5px; line-height: 1.6; margin-bottom: 22px; }
        .modal-actions { display: flex; gap: 10px; justify-content: flex-end; }
        /* PAGE HEADER */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }
        .page-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 22px;
            font-weight: 700;
        }
        /* DETAIL PAGE */
        .detail-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 28px;
        }
        .detail-foto {
            width: 120px;
            height: 120px;
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--surface2);
            overflow: hidden;
            flex-shrink: 0;
        }
        .detail-foto img { width: 100%; height: 100%; object-fit: cover; }
        .detail-header { display: flex; gap: 20px; align-items: flex-start; margin-bottom: 28px; }
        .detail-name { font-family: 'Space Grotesk', sans-serif; font-size: 22px; font-weight: 700; margin-bottom: 6px; }
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .detail-field {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 14px 16px;
        }
        .detail-field .field-label {
            font-size: 11.5px;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .detail-field .field-value {
            font-size: 16px;
            font-weight: 600;
            color: var(--text);
        }
        .detail-field.full { grid-column: span 2; }
        /* SECTION TITLE */
        .section-title {
            font-size: 11px;
            font-weight: 700;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--border);
        }
        /* BANTUAN */
        .help-section { margin-bottom: 28px; }
        .help-step {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            margin-bottom: 10px;
        }
        .help-num {
            width: 24px;
            height: 24px;
            background: var(--accent);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            flex-shrink: 0;
        }
        /* RESPONSIVE ACTIONS in TABLE */
        .table-actions { display: flex; gap: 6px; align-items: center; }
        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: var(--muted);
        }
        .empty-state svg { margin-bottom: 12px; opacity: 0.3; }
        /* category badge colors cycle */
        .cat-Ayam     { background: rgba(79,142,247,0.15); color: var(--accent); }
        .cat-Sapi     { background: rgba(245,158,11,0.15); color: var(--warning); }
        .cat-Seafood  { background: rgba(6,182,212,0.15); color: var(--cyan); }
        .cat-Sayuran  { background: rgba(34,197,94,0.15); color: var(--success); }
        .cat-default  { background: var(--surface2); color: var(--muted); }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar">
    <a href="{{ route('dashboard') }}" class="navbar-brand">Frozeria <span>Stok</span></a>
    <div class="nav-links">
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">Kategori</a>
        <a href="{{ route('bantuan') }}" class="nav-link {{ request()->routeIs('bantuan') ? 'active' : '' }}">Bantuan</a>
    </div>
    <div class="nav-actions">
        @if(request()->routeIs('dashboard'))
        <a href="{{ route('barang.create') }}" class="btn btn-primary btn-sm">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Tambah Barang
        </a>
        @endif
        @if(request()->routeIs('kategori.*'))
        <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm">
            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Tambah Kategori
        </a>
        @endif
    </div>
</nav>

<div class="main">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @yield('content')
</div>

<!-- DELETE MODAL -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal">
        <div class="modal-icon">
            <svg width="22" height="22" fill="none" stroke="#f59e0b" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v4m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
        </div>
        <h3>Hapus barang?</h3>
        <p id="deleteMessage">Data akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.</p>
        <div class="modal-actions">
            <button class="btn btn-ghost" onclick="closeDeleteModal()">Batal</button>
            <form id="deleteForm" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

<script>
function confirmDelete(url, name, type) {
    document.getElementById('deleteMessage').textContent =
        'Data ' + name + ' akan dihapus secara permanen dari sistem. Tindakan ini tidak dapat dibatalkan.';
    document.getElementById('deleteForm').action = url;
    document.getElementById('deleteModal').classList.add('active');
}
function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) closeDeleteModal();
});
</script>
@stack('scripts')
</body>
</html>