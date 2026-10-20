<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rental Mobil')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary:    #4f46e5;
            --primary-dk: #3730a3;
            --accent:     #06b6d4;
            --success:    #10b981;
            --warning:    #f59e0b;
            --danger:     #ef4444;
            --bg:         #0f172a;
            --bg2:        #1e293b;
            --bg3:        #334155;
            --text:       #f1f5f9;
            --text-muted: #94a3b8;
            --border:     #334155;
            --radius:     10px;
            --shadow:     0 4px 24px rgba(0,0,0,0.35);
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 240px;
            flex-shrink: 0;
            background: var(--bg2);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: sticky;
            top: 0;
        }
        .sidebar-brand {
            padding: 24px 20px 20px;
            border-bottom: 1px solid var(--border);
        }
        .sidebar-brand h2 {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -.3px;
        }
        .sidebar-brand p {
            font-size: .72rem;
            color: var(--text-muted);
            margin-top: 2px;
        }
        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
        }
        .nav-label {
            font-size: .67rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            padding: 0 8px;
            margin-bottom: 8px;
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: var(--radius);
            text-decoration: none;
            color: var(--text-muted);
            font-size: .875rem;
            font-weight: 500;
            transition: all .2s;
            margin-bottom: 2px;
        }
        .nav-item:hover, .nav-item.active {
            background: rgba(79,70,229,.18);
            color: var(--primary);
        }
        .nav-item svg { width: 18px; height: 18px; flex-shrink: 0; }

        /* ── Main ── */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .topbar {
            background: var(--bg2);
            border-bottom: 1px solid var(--border);
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .topbar-title { font-size: 1rem; font-weight: 600; }
        .topbar-badge {
            font-size: .75rem;
            background: rgba(79,70,229,.2);
            color: var(--primary);
            padding: 4px 10px;
            border-radius: 99px;
            font-weight: 600;
        }
        .content { padding: 28px; flex: 1; }

        /* ── Cards ── */
        .card {
            background: var(--bg2);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
        }
        .card-header {
            padding: 18px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .card-header h5 { font-size: .95rem; font-weight: 600; }
        .card-body { padding: 24px; }

        /* ── Table ── */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; font-size: .875rem; }
        thead th {
            background: var(--bg3);
            padding: 11px 16px;
            text-align: left;
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: var(--text-muted);
        }
        tbody td { padding: 12px 16px; border-bottom: 1px solid var(--border); vertical-align: middle; }
        tbody tr:last-child td { border-bottom: none; }
        tbody tr:hover { background: rgba(255,255,255,.03); }

        /* ── Buttons ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: var(--radius);
            font-size: .875rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            border: none;
            transition: all .2s;
        }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-primary:hover { background: var(--primary-dk); }
        .btn-success { background: var(--success); color: #fff; }
        .btn-success:hover { background: #059669; }
        .btn-warning { background: var(--warning); color: #000; }
        .btn-warning:hover { background: #d97706; }
        .btn-danger  { background: var(--danger); color: #fff; }
        .btn-danger:hover  { background: #dc2626; }
        .btn-secondary { background: var(--bg3); color: var(--text); }
        .btn-secondary:hover { background: #475569; }
        .btn-sm { padding: 5px 11px; font-size: .78rem; }

        /* ── Form ── */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            margin-bottom: 6px;
            font-size: .85rem;
            font-weight: 500;
            color: var(--text-muted);
        }
        .form-control, .form-select {
            width: 100%;
            padding: 10px 14px;
            background: var(--bg3);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            color: var(--text);
            font-size: .9rem;
            font-family: inherit;
            transition: border-color .2s;
            outline: none;
        }
        .form-control:focus, .form-select:focus { border-color: var(--primary); }
        .form-control.is-invalid, .form-select.is-invalid { border-color: var(--danger); }
        .invalid-feedback { font-size: .8rem; color: var(--danger); margin-top: 4px; }

        /* ── Alerts ── */
        .alert {
            padding: 12px 18px;
            border-radius: var(--radius);
            margin-bottom: 20px;
            font-size: .875rem;
            font-weight: 500;
        }
        .alert-success { background: rgba(16,185,129,.15); border: 1px solid rgba(16,185,129,.4); color: #34d399; }
        .alert-danger  { background: rgba(239,68,68,.15);  border: 1px solid rgba(239,68,68,.4);  color: #f87171; }

        /* ── Badge ── */
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 99px;
            font-size: .72rem;
            font-weight: 600;
        }
        .badge-success  { background: rgba(16,185,129,.2);  color: #34d399; }
        .badge-warning  { background: rgba(245,158,11,.2);  color: #fbbf24; }
        .badge-danger   { background: rgba(239,68,68,.2);   color: #f87171; }
        .badge-info     { background: rgba(6,182,212,.2);   color: #22d3ee; }

        /* ── Pagination ── */
        .pagination { display: flex; gap: 4px; margin-top: 20px; justify-content: flex-end; }
        .pagination a, .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 34px;
            height: 34px;
            padding: 0 8px;
            border-radius: 8px;
            font-size: .8rem;
            text-decoration: none;
            border: 1px solid var(--border);
            color: var(--text-muted);
        }
        .pagination .active span {
            background: var(--primary);
            border-color: var(--primary);
            color: #fff;
        }

        /* ── Detail list ── */
        .detail-list { display: grid; grid-template-columns: 180px 1fr; gap: 12px 0; }
        .detail-list dt { font-size: .82rem; color: var(--text-muted); padding: 8px 0; }
        .detail-list dd { font-size: .9rem; padding: 8px 0; border-bottom: 1px solid var(--border); }

        /* ── Misc ── */
        .page-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .page-header h1 { font-size: 1.4rem; font-weight: 700; }
        .car-img { width: 56px; height: 40px; object-fit: cover; border-radius: 6px; }
        .car-img-placeholder {
            width: 56px; height: 40px; border-radius: 6px;
            background: var(--bg3); display: flex; align-items: center; justify-content: center;
            color: var(--text-muted); font-size: .65rem; text-align: center;
        }
    </style>
</head>
<body>

{{-- ── Sidebar ── --}}
<aside class="sidebar">
    <div class="sidebar-brand">
        <h2>🚗 RentalMobil</h2>
        <p>Sistem Manajemen Rental</p>
    </div>
    <nav class="sidebar-nav">
        <p class="nav-label">Menu Utama</p>
        <a href="{{ route('cars.index') }}"
           class="nav-item {{ request()->routeIs('cars.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8 17H16M3 11l1.5-5h15l1.5 5M3 11v5a1 1 0 001 1h1a1 1 0 001-1v-1h12v1a1 1 0 001 1h1a1 1 0 001-1v-5M3 11h18"/>
            </svg>
            Data Mobil
        </a>
        <a href="{{ route('rentals.index') }}"
           class="nav-item {{ request()->routeIs('rentals.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            Transaksi Rental
        </a>
    </nav>
</aside>

{{-- ── Main Content ── --}}
<div class="main">
    <header class="topbar">
        <span class="topbar-title">@yield('title', 'Dashboard')</span>
        <span class="topbar-badge">Admin</span>
    </header>

    <main class="content">
        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">✗ {{ session('error') }}</div>
        @endif

        @yield('content')
    </main>
</div>

</body>
</html>
