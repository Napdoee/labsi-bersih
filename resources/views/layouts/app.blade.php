<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LabSI Bersih') }}</title>
    <link rel="icon" href="{{ asset('logo.png') }}" type="image/jpeg">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    <style>
        :root {
            --primary: #4F46E5;
            --primary-light: #818CF8;
            --secondary: #10B981;
            --accent: #F59E0B;
            --bg-main: #F8FAFC;
            --bg-card: #FFFFFF;
            --text-main: #1E293B;
            --text-muted: #64748B;
            --sidebar-bg: #0F172A;
            --sidebar-text: #94A3B8;
            --sidebar-active: #FFFFFF;
            --border: #E2E8F0;
            --glass: rgba(255, 255, 255, 0.7);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            line-height: 1.5;
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            color: var(--sidebar-text);
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 100;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .logo-placeholder {
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-placeholder img {
            height: 100%;
            width: auto;
        }

        .brand-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            letter-spacing: -0.5px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
        }

        .nav-group-title {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1rem;
            padding-left: 0.75rem;
            opacity: 0.5;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            text-decoration: none;
            color: var(--sidebar-text);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-item:hover, .nav-item.active {
            background-color: rgba(255, 255, 255, 0.05);
            color: var(--sidebar-active);
        }

        .nav-item.active {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        /* Content Wrapper */
        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            margin-left: 260px;
            transition: all 0.3s ease;
        }

        @media (max-width: 1024px) {
            .content-wrapper {
                margin-left: 0;
            }
        }

        /* Header Styles */
        .header {
            height: 70px;
            background-color: var(--glass);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            color: var(--text-main);
            cursor: pointer;
            padding: 0.5rem;
        }

        @media (max-width: 1024px) {
            .mobile-toggle {
                display: block;
            }
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: var(--border);
            object-fit: cover;
            border: 2px solid white;
            box-shadow: var(--shadow-sm);
        }

        /* Main Content Area */
        .main-content {
            padding: 1.5rem;
            animation: fadeIn 0.5s ease-out;
        }

        @media (min-width: 768px) {
            .main-content {
                padding: 2rem;
            }
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-main);
        }

        @media (min-width: 768px) {
            .page-title {
                font-size: 1.75rem;
            }
        }

        .page-subtitle {
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        /* Utility Cards */
        .card {
            background-color: var(--bg-card);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        /* Grid and Components */
        .grid-container {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1rem;
        }

        @media (min-width: 768px) {
            .grid-container {
                gap: 1.5rem;
            }
        }

        /* Responsive Grid Spans */
        .col-4, .col-6, .col-8, .col-12 {
            grid-column: span 12;
        }

        @media (min-width: 768px) {
            .col-4 { grid-column: span 6; }
            .col-6 { grid-column: span 6; }
            .col-8 { grid-column: span 12; }
        }

        @media (min-width: 1200px) {
            .col-4 { grid-column: span 4; }
            .col-8 { grid-column: span 8; }
        }

        .stat-card {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .stat-info .stat-label {
            font-size: 0.85rem;
            color: var(--text-muted);
        }

        /* Utility Classes */
        .flex-header {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
        }

        @media (min-width: 640px) {
            .flex-header {
                flex-direction: row;
                justify-content: space-between;
                align-items: center;
            }
        }

        .alert {
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            border: 1px solid transparent;
            font-size: 0.9rem;
        }

        .alert-success { background-color: #DCFCE7; border-color: #86EFAC; color: #166534; }
        .alert-error { background-color: #FEF2F2; border-color: #FECACA; color: #991B1B; }

        /* Badge Styles */
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }

        .badge-success { background-color: #DCFCE7; color: #166534; }
        .badge-warning { background-color: #FEF3C7; color: #92400E; }
        .badge-info { background-color: #E0E7FF; color: #3730A3; }
        .badge-danger { background-color: #FEE2E2; color: #B91C1C; }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--border);
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: #4338CA;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        /* Table Styles */
        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 600px;
        }

        th {
            text-align: left;
            padding: 1rem;
            font-size: 0.8rem;
            text-transform: uppercase;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 1rem;
            font-size: 0.9rem;
            border-bottom: 1px solid var(--border);
        }

        /* Sidebar Overlay */
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 90;
            display: none;
        }

        @media (max-width: 1024px) {
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body x-data="{ sidebarOpen: false }" @keydown.escape="sidebarOpen = false">
    <div class="dashboard-container">
        <!-- Sidebar Overlay (Mobile Only) -->
        <div class="sidebar-overlay" :class="{ 'show': sidebarOpen }" @click="sidebarOpen = false"></div>

        <!-- Sidebar -->
        <aside class="sidebar" :class="{ 'open': sidebarOpen }">
            <div class="sidebar-header">
                <div class="logo-placeholder">
                    <img src="{{ asset('logo.png') }}" alt="Logo">
                </div>
                <button class="mobile-toggle" @click="sidebarOpen = false" style="margin-left: auto; color: white;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-group-title">Main Menu</div>
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    <span>Dashboard</span>
                </a>

                @can('report_assistant_lateness')
                <a href="{{ route('kelas.keterlambatan.index') }}" class="nav-item {{ request()->routeIs('kelas.keterlambatan.*') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <span>Keterlambatan</span>
                </a>
                @endcan

                @can('report_trash')
                <a href="{{ route('kelas.sampah.index') }}" class="nav-item {{ request()->routeIs('kelas.sampah.*') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                    <span>Lapor Sampah</span>
                </a>
                @endcan

                @canany(['report_broken_item', 'view_broken_item_reports'])
                <a href="{{ route('kelas.barang-rusak.index') }}" class="nav-item {{ request()->routeIs('kelas.barang-rusak.*') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    <span>Lapor Barang Rusak</span>
                </a>
                @endcanany

                <div class="nav-group-title" style="margin-top: 1.5rem;">Account</div>
                <a href="{{ route('profile.edit') }}" class="nav-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <span>My Profile</span>
                </a>
            </nav>

            <div style="padding: 1.5rem; border-top: 1px solid rgba(255,255,255,0.05);">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item" style="background: none; border: none; width: 100%; cursor: pointer;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Content Area -->
        <div class="content-wrapper">
            <!-- Header -->
            <header class="header">
                <button class="mobile-toggle" @click="sidebarOpen = true">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                </button>

                <div class="header-actions">
                    <a href="{{ route('profile.edit') }}" class="user-dropdown" style="text-decoration: none; color: inherit;">
                        @auth
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->displayName) }}&background=4F46E5&color=fff" alt="Avatar" class="avatar">
                        <div style="display: none; flex-direction: column;" class="md:flex">
                            <span style="font-size: 0.9rem; font-weight: 600;">{{ auth()->user()->displayName }}</span>
                            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: capitalize;">{{ str_replace('_', ' ', auth()->user()->getRoleNames()->first() ?? 'Member') }}</span>
                        </div>
                        @endauth
                    </a>
                </div>
            </header>

            <!-- Main Content -->
            <main class="main-content">
                @isset($header)
                    <div class="page-header">
                        {{ $header }}
                    </div>
                @endisset
                
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
