<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Bank BPR Jawa Timur</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png') }}" type="image/x-icon">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <!--
    =========================================================
    * ArchitectUI HTML Theme Dashboard - v1.0.0
    =========================================================
    * Product Page: https://dashboardpack.com
    * Copyright 2019 DashboardPack (https://dashboardpack.com)
    * Licensed under MIT (https://github.com/DashboardPack/architectui-html-theme-free/blob/master/LICENSE)
    =========================================================
    * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
    -->
    <link href="{{ asset('') }}main.css" rel="stylesheet">
    <link href="{{ asset('') }}custom.css" rel="stylesheet">
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <link href="{{ asset('assets/vendor/select2-develop/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
        integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    @yield('extraCSS')
</head>
<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header">
        <div class="app-header header-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                            data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                <span>
                    <button type="button"
                        class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
            </div>
            <div class="app-header__content">
                <div class="app-header-left">


                </div>
                <div class="app-header-right">
                    <div class="header-btn-lg pr-0">
                        <div class="widget-content p-0">
                            <div class="widget-content-wrapper">
                                <div class="widget-content-left  ml-3 header-user-info">
                                    <div class="widget-heading">
                                        {{ auth()->user()->name }}
                                    </div>
                                </div>
                                <div class="widget-content-left">
                                    <div class="btn-group">
                                        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            class="p-0 btn">
                                            <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg"
                                                alt="">
                                            <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                        </a>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="{{ url('administrator/ganti-password', auth()->user()->id) }}">
                                                <i
                                                    class="metismenu-icon fa fa-fingerprint icon-gradient bg-arielle-smile mr-1"></i>
                                                Ganti Password
                                            </a>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" data-toggle="modal"
                                                data-target="#exampleModal">
                                                <i
                                                    class="metismenu-icon fa fa-sign-out-alt icon-gradient bg-love-kiss mr-1"></i>
                                                Logout
                                            </a>
                                            {{-- <button type="button" tabindex="0" class="dropdown-item">Logout</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-main">
            <div class="app-sidebar sidebar-shadow">
                <div class="app-header__logo">
                    <div class="logo-src"></div>
                    <div class="header__pane ml-auto">
                        <div>
                            <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="app-header__mobile-menu">
                    <div>
                        <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
                <div class="app-header__menu">
                    <span>
                        <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                            <span class="btn-icon-wrapper">
                                <i class="fa fa-ellipsis-v fa-w-6"></i>
                            </span>
                        </button>
                    </span>
                </div>
                <div class="scrollbar-sidebar">
                    <div class="app-sidebar__inner">
                        <ul class="vertical-nav-menu">
                            @php
                                $has_permission_dashboard = \App\Http\Controllers\Controller::hasPermission('Dashboard');
                            @endphp
                            @if ($has_permission_dashboard)
                                <li class="app-sidebar__heading">Dashboards</li>
                                <li>
                                    <a href="{{ url('administrator/dashboard') }}"
                                        class="{{ Request::segment(2) == 'dashboard' ? 'mm-active' : '' }}">
                                        {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                        <i class="metismenu-icon fa fa-tachometer-alt icon-gradient bg-arielle-smile"></i>
                                        Dashboard
                                    </a>
                                </li>
                            @endif

                            @php
                                $master_menu = \Spatie\Permission\Models\Permission::where('name', 'like', 'Master%')->pluck('name')->toArray();
                                $has_permission_master = [];
                                for ($i=0; $i< count($master_menu); $i++) {
                                    $has_permission = \App\Http\Controllers\Controller::hasPermission($master_menu[$i]);
                                    $has_permission_master[$master_menu[$i]] = $has_permission;
                                }

                                $no_master_menu_allowed = true; // if all has_permission_master is false
                                foreach ($has_permission_master as $item) {
                                    if ($item) {
                                        $no_master_menu_allowed = false;
                                        break;
                                    }
                                }
                            @endphp
                            @if (!$no_master_menu_allowed)
                                <li class="app-sidebar__heading">Master</li>

                                @if ($has_permission_master['Master User'])
                                    <li>
                                        <a href="{{ url('administrator/user') }}"
                                            class="{{ Request::segment(2) == 'user' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i class="metismenu-icon fa fa-users icon-gradient bg-arielle-smile"></i>
                                            User
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Role'])
                                    <li>
                                        <a href="{{ url('administrator/role') }}"
                                            class="{{ Request::segment(2) == 'role' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i class="metismenu-icon fa fa-list-alt icon-gradient bg-arielle-smile"></i>
                                            Role
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Profil Perusahaan'])
                                    <li>
                                        <a href="{{ url('administrator/profil') }}"
                                            class="{{ Request::segment(2) == 'profil' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i
                                                class="metismenu-icon fa fa-address-card icon-gradient bg-arielle-smile"></i>
                                            Profil Perusahaan
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Vidio Intro'])
                                    <li>
                                        <a href="{{ url('administrator/intro-vidio') }}"
                                            class="{{ Request::segment(2) == 'intro-vidio' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i class="metismenu-icon fa fa-film icon-gradient bg-arielle-smile"></i>
                                            Vidio Intro
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Kebijakan Privasi'])
                                    <li>
                                        <a href="{{ url('administrator/kebijakan-privasi') }}"
                                            class="{{ Request::segment(2) == 'kebijakan-privasi' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i class="metismenu-icon fa fa-user-shield icon-gradient bg-arielle-smile"></i>
                                            Kebijakan Privasi
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Syarat dan Ketentuan'])
                                    <li>
                                        <a href="{{ url('administrator/sk') }}"
                                            class="{{ Request::segment(2) == 'sk' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i class="metismenu-icon fa fa-handshake icon-gradient bg-arielle-smile"></i>
                                            Syarat dan Ketentuan
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Bunga'])
                                    <li>
                                        <a href="{{ url('administrator/bunga') }}"
                                            class="{{ Request::segment(2) == 'bunga' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i
                                                class="metismenu-icon fa fa-file-invoice-dollar icon-gradient bg-arielle-smile"></i>
                                            Bunga
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Tenor'])
                                    <li>
                                        <a href="{{ url('administrator/tenor') }}"
                                            class="{{ Request::segment(2) == 'tenor' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i
                                                class="metismenu-icon fa fa-business-time icon-gradient bg-arielle-smile"></i>
                                            Tenor
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Cabang'])
                                    <li>
                                        <a href="{{ url('administrator/kota') }}"
                                            class="{{ Request::segment(2) == 'kota' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i class="metismenu-icon fa fa-home icon-gradient bg-arielle-smile"></i>
                                            Cabang
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Kurs'])
                                    <li>
                                        <a href="{{ url('administrator/kurs') }}"
                                            class="{{ Request::segment(2) == 'kurs' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i class="metismenu-icon fa fa-dollar-sign icon-gradient bg-arielle-smile"></i>
                                            Kurs
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Laporan Keuangan'])
                                    <li>
                                        <a href="{{ url('administrator/laporan-keuangan') }}"
                                            class="{{ Request::segment(2) == 'laporan-keuangan' ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon fa fa-book icon-gradient bg-arielle-smile"></i>
                                            Laporan Keuangan
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Tata Kelola Perusahaan'])
                                    <li>
                                        <a href="{{ url('administrator/tata-kelola-perusahaan') }}"
                                            class="{{ Request::segment(2) == 'tata-kelola-perusahaan' ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon fa fa-briefcase icon-gradient bg-arielle-smile"></i>
                                            Tata Kelola Perusahaan
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Tanggung Jawab Perusahaan'])
                                    <li>
                                        <a href="{{ route('tanggung-jawab-perusahaan.index') }}"
                                            class="{{ Request::segment(2) == 'tanggung-jawab-perusahaan' ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon fa fa-book icon-gradient bg-arielle-smile"></i>
                                            Tanggung Jawab Perusahaan
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_master['Master Jumbotron'])
                                    <li>
                                        <a href="{{ route('jumbotrons.index') }}"
                                            class="{{ Request::segment(2) == 'jumbotrons' ? 'mm-active' : '' }}">
                                            {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                            <i
                                                class="metismenu-icon fa fa-address-card icon-gradient bg-arielle-smile"></i>
                                            Jumbotron
                                        </a>
                                    </li>
                                @endif
                            @endif

                            @php
                                $tentang_menu = \Spatie\Permission\Models\Permission::where('name', 'like', 'Tentang BPR%')->pluck('name')->toArray();
                                $has_permission_tentang = [];
                                for ($i=0; $i< count($tentang_menu); $i++) {
                                    $has_permission = \App\Http\Controllers\Controller::hasPermission($tentang_menu[$i]);
                                    $has_permission_tentang[$tentang_menu[$i]] = $has_permission;
                                }
                                $no_tentang_menu_allowed = true; // if all has_permission_tentang is false
                                foreach ($has_permission_tentang as $item) {
                                    if ($item) {
                                        $no_tentang_menu_allowed = false;
                                        break;
                                    }
                                }
                            @endphp
                            @if (!$no_tentang_menu_allowed)
                                <li class="app-sidebar__heading">Tentang BPR</li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon fa fa-landmark icon-gradient bg-arielle-smile"></i>
                                        Tentang BPR
                                        <i
                                            class="metismenu-state-icon
                                            pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        @if ($has_permission_tentang['Tentang BPR - Sejarah'])
                                            <li>
                                                <a href="{{ url('administrator/about?t=sejarah') }}">
                                                    <i class="metismenu-icon">
                                                    </i>Sejarah
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_tentang['Tentang BPR - Visi Misi'])
                                            <li>
                                                <a href="{{ url('administrator/about?t=visi-misi') }}">
                                                    <i class="metismenu-icon">
                                                    </i>Visi Misi
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_tentang['Tentang BPR - Peranan'])
                                            <li>
                                                <a href="{{ url('administrator/about?t=peranan') }}">
                                                    <i class="metismenu-icon">
                                                    </i>Peranan
                                                </a>
                                            </li>
                                        @endif
                                        
                                        {{-- <li>
                                            <a href="{{ url('administrator/about?t=struktur') }}">
                                                <i class="metismenu-icon">
                                                </i>Struktur Organisasi
                                            </a>
                                        </li> --}}

                                        @if ($has_permission_tentang['Tentang BPR - Manajemen'])
                                            <li>
                                                <a href="{{ url('administrator/about?t=manajemen') }}">
                                                    <i class="metismenu-icon">
                                                    </i>Manajemen
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_tentang['Tentang BPR - Identitas Perusahaan'])
                                            <li>
                                                <a href="{{ url('administrator/about?t=identitas') }}">
                                                    <i class="metismenu-icon">
                                                    </i>Identitas Perusahaan
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @php
                                $transparansi_menu = \Spatie\Permission\Models\Permission::where('name', 'like', 'Transparansi%')->pluck('name')->toArray();
                                $has_permission_transparansi = [];
                                for ($i=0; $i< count($transparansi_menu); $i++) {
                                    $has_permission = \App\Http\Controllers\Controller::hasPermission($transparansi_menu[$i]);
                                    $has_permission_transparansi[$transparansi_menu[$i]] = $has_permission;
                                }

                                $no_transparansi_menu_allowed = true; // if all has_permission_transparansi is false
                                foreach ($has_permission_transparansi as $item) {
                                    if ($item) {
                                        $no_transparansi_menu_allowed = false;
                                        break;
                                    }
                                }
                            @endphp

                            @if (!$no_transparansi_menu_allowed)
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon fa fa-eye icon-gradient bg-arielle-smile"></i>
                                        Transparansi
                                        <i
                                            class="metismenu-state-icon
                                            pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        @if ($has_permission_transparansi['Transparansi - Hukum Perusahaan'])
                                            <li>
                                                <a href="{{ url('administrator/about?t=hukum') }}">
                                                    <i class="metismenu-icon">
                                                    </i>Hukum Perusahaan
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_transparansi['Transparansi - Komposisi Saham'])
                                            <li>
                                                <a href="{{ url('administrator/about?t=komposisi') }}">
                                                    <i class="metismenu-icon">
                                                    </i>Komposisi Saham
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_transparansi['Transparansi - Tata Kelola Perusahaan'])
                                            <li>
                                                <a href="{{ url('administrator/about?t=tata_kelola') }}">
                                                    <i class="metismenu-icon">
                                                    </i>Tata Kelola Perusahaan
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @php
                                $produk_layanan_menu = \Spatie\Permission\Models\Permission::where('name', 'like', 'Produk & Layanan%')->pluck('name')->toArray();
                                $has_permission_produk_layanan = [];
                                for ($i=0; $i< count($produk_layanan_menu); $i++) {
                                    $has_permission = \App\Http\Controllers\Controller::hasPermission($produk_layanan_menu[$i]);
                                    $has_permission_produk_layanan[$produk_layanan_menu[$i]] = $has_permission;
                                }

                                $no_produk_layanan_menu_allowed = true; // if all has_permission_produk_layanan is false
                                foreach ($has_permission_produk_layanan as $item) {
                                    if ($item) {
                                        $no_produk_layanan_menu_allowed = false;
                                        break;
                                    }
                                }
                            @endphp
                            @if (!$no_produk_layanan_menu_allowed)
                                <li class="app-sidebar__heading">Produk & Layanan</li>
                                <li>
                                    <a href="#">
                                        <i class="metismenu-icon fa fa-store icon-gradient bg-arielle-smile"></i>
                                        Produk & Layanan
                                        <i
                                            class="metismenu-state-icon
                                            pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul>
                                        @if ($has_permission_produk_layanan['Produk & Layanan - Master Jenis'])
                                            <li>
                                                <a href="{{ route('jenis-produk-layanan.index') }}">
                                                    <i class="metismenu-icon">
                                                    </i>Master Jenis
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_produk_layanan['Produk & Layanan - Master Konten'])
                                            <li>
                                                <a href="{{ route('item-produk-layanan.index') }}">
                                                    <i class="metismenu-icon">
                                                    </i>Master Konten
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                    </ul>
                                </li>
                            @endif

                            @php
                                $has_permission_umkm_binaan = \App\Http\Controllers\Controller::hasPermission('UMKM Binaan');
                            @endphp
                            @if ($has_permission_umkm_binaan)
                                <li class="app-sidebar__heading">UMKM Binaan</li>
                                <li>
                                    <a href="{{ url('administrator/umkm-binaan') }}"
                                        class="{{ Request::segment(2) == 'umkm-binaan' ? 'mm-active' : '' }}">
                                        {{-- <i class="metismenu-icon pe-7s-rocket"></i> --}}
                                        <i
                                            class="metismenu-icon fa fa-user-friends icon-gradient bg-arielle-smile"></i>
                                        UMKM Binaan
                                    </a>
                                </li>
                            @endif

                            @php
                                $berita_info_menu = \Spatie\Permission\Models\Permission::where('name', 'like', 'Berita & Info%')->pluck('name')->toArray();
                                $has_permission_berita_info = [];
                                for ($i=0; $i< count($berita_info_menu); $i++) {
                                    $has_permission = \App\Http\Controllers\Controller::hasPermission($berita_info_menu[$i]);
                                    $has_permission_berita_info[$berita_info_menu[$i]] = $has_permission;
                                }
                                
                                $no_berita_info_menu_allowed = true; // if all has_permission_berita_info is false
                                foreach ($has_permission_berita_info as $item) {
                                    if ($item) {
                                        $no_berita_info_menu_allowed = false;
                                        break;
                                    }
                                }
                            @endphp

                            @if (!$no_berita_info_menu_allowed)
                                <li class="app-sidebar__heading">Berita & Info</li>
                                <li>
                                    <a href="#"
                                        class="{{ Request::segment(2) == 'berita-info' ? 'mm-active' : '' }}"
                                        {{ Request::segment(2) == 'berita-info' ? 'aria-expanded="true"' : '' }}>
                                        <i class="metismenu-icon far fa-newspaper icon-gradient bg-arielle-smile"></i>
                                        Berita & Info
                                        <i
                                            class="metismenu-state-icon
                                            pe-7s-angle-down caret-left"></i>
                                    </a>
                                    <ul
                                        class="{{ Request::segment(2) == 'berita-info' ? 'mm-collapse mm-show' : '' }}">
                                        @if ($has_permission_berita_info['Berita & Info - Kategori Berita'])
                                            <li>
                                                <a href="{{ url('administrator/berita-info/kategori-berita') }}"
                                                    class="{{ Request::segment(3) == 'kategori-berita' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon"></i>
                                                    Kategori Berita
                                                </a>
                                            </li>
                                        @endif
                                        
                                        @if ($has_permission_berita_info['Berita & Info - Berita'])
                                            <li>
                                                <a href="{{ url('administrator/berita-info/berita') }}"
                                                    class="{{ Request::segment(3) == 'berita' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon"></i>
                                                    Berita
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_berita_info['Berita & Info - Promo'])
                                            <li>
                                                <a href="{{ url('administrator/berita-info/promo') }}"
                                                    class="{{ Request::segment(3) == 'promo' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon">
                                                    </i>Promo
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_berita_info['Berita & Info - ePaper UMKM'])
                                            <li>
                                                <a href="{{ url('administrator/berita-info/epaper') }}"
                                                    class="{{ Request::segment(3) == 'epaper' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon">
                                                    </i>ePaper UMKM
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_berita_info['Berita & Info - Penghargaan'])
                                            <li>
                                                <a href="{{ url('administrator/berita-info/penghargaan') }}"
                                                    class="{{ Request::segment(3) == 'penghargaan' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon">
                                                    </i>Penghargaan
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_berita_info['Berita & Info - Peta Cabang'])
                                            <li>
                                                <a href="{{ url('administrator/berita-info/peta-cabang') }}"
                                                    class="{{ Request::segment(3) == 'peta-cabang' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon">
                                                    </i>Peta Cabang
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_berita_info['Berita & Info - Karier'])
                                            <li>
                                                <a href="{{ url('administrator/berita-info/karier') }}"
                                                    class="{{ Request::segment(3) == 'karier' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon">
                                                    </i>Karier
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_berita_info['Berita & Info - Data Pengaduan Nasabah'])
                                            <li>
                                                <a href="{{ route('pengaduan-nasabah') }}"
                                                    class="{{ Request::segment(3) == 'pengaduan-nasabah' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon">
                                                    </i>Data Pengaduan Nasabah
                                                </a>
                                            </li>
                                        @endif
                                        
                                        @if ($has_permission_berita_info['Berita & Info - Tips Keamanan & Info Terkini'])
                                            <li>
                                                <a href="{{ url('administrator/berita-info/tips-info-terkini') }}"
                                                    class="{{ Request::segment(3) == 'tips-info-terkini' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon">
                                                    </i>Tips Keamanan & Info Terkini
                                                </a>
                                            </li>
                                        @endif

                                        @if ($has_permission_berita_info['Berita & Info - Jaringan Kantor Kas'])
                                            <li>
                                                <a href="{{ url('administrator/berita-info/jaringan-kantor') }}"
                                                    class="{{ Request::segment(3) == 'jaringan-kantor' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon">
                                                    </i>Jaringan Kantor Kas
                                                </a>
                                            </li>
                                        @endif
                                        
                                        @if ($has_permission_berita_info['Berita & Info - Pengumuman Lelang Jaminan'])
                                            <li>
                                                <a href="{{ url('administrator/berita-info/pengumuman-lelang-jaminan') }}"
                                                    class="{{ Request::segment(3) == 'pengumuman-lelang-jaminan' ? 'mm-active' : '' }}">
                                                    <i class="metismenu-icon">
                                                    </i>Pengumuman Lelang Jaminan
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif


                            @php
                                $has_permission_kategori_faq = \App\Http\Controllers\Controller::hasPermission('Kategori FAQ');
                                $has_permission_item_faq = \App\Http\Controllers\Controller::hasPermission('Item FAQ');
                                $no_faq_menu_allowed = !$has_permission_kategori_faq && !$has_permission_item_faq; // if all faq menu is false
                            @endphp
                            @if (!$no_faq_menu_allowed)
                                <li class="app-sidebar__heading">FAQ</li>
                                @if ($has_permission_kategori_faq)
                                    <li>
                                        <a href="{{ url('administrator/kategori-faq') }}"
                                            class="{{ Request::segment(4) == 'kategori-faq' ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon far fa-question-circle icon-gradient bg-arielle-smile">
                                            </i>Kategori FAQ
                                        </a>
                                    </li>
                                @endif

                                @if ($has_permission_item_faq)
                                    <li>
                                        <a href="{{ url('administrator/items-faq') }}"
                                            class="{{ Request::segment(4) == 'items-faq' ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon far fa-list-alt icon-gradient bg-arielle-smile">
                                            </i>Item FAQ
                                        </a>
                                    </li>
                                @endif

                                @php
                                    $has_permission_list_pengajuan = \App\Http\Controllers\Controller::hasPermission('List Pengajuan Kredit');
                                @endphp
                                @if ($has_permission_list_pengajuan)
                                    <li class="app-sidebar__heading">Pengajuan Kredit</li>
                                    <li>
                                        <a href="{{ url('administrator/pengajuan-kredit') }}"
                                            class="{{ Request::segment(5) == 'pengajuan-kredit' ? 'mm-active' : '' }}">
                                            <i class="metismenu-icon far fa-list-alt icon-gradient bg-arielle-smile">
                                            </i>List Pengajuan Kredit
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="app-main__outer">
                @yield('content')
                <div class="app-wrapper-footer">
                    <div class="app-footer">
                        <div class="app-footer__inner">
                            <div class="app-footer-left">
                                <ul class="nav">
                                    <li class="nav-item">
                                        <a href="javascript:void(0);" class="nav-link">
                                            &copy; Bank BPR Jawa Timur 2021
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('') }}assets/scripts/main.js"></script>
    {{-- logout modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Pilih tombol logout untuk melanjutkan.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">
                        Cancel
                    </button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    @yield('extraJS')
    <script src="{{ asset('assets/vendor/select2-develop/dist/js/select2.min.js') }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/29.0.0/classic/ckeditor.js"></script> --}}
    <script>
        // ClassicEditor
        //     .create(document.querySelector('.ck-editor'))
        //     .catch(error => {
        //         console.error(error);
        //     });

        // ClassicEditor
        //     .create(document.querySelector('.ck-editor2'))
        //     .catch(error => {
        //         console.error(error);
        //     });
        $(".select2").select2();
    </script>
</body>

</html>
