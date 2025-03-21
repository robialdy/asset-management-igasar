<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>


  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
  {{-- extension --}}
  {{-- datatable --}}
  <link rel="stylesheet" href="{{ asset('assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/compiled/css/table-datatable.css') }}">
  {{-- alert --}}
<link rel="stylesheet" href="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.css') }}">

</head>

<body>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
    <div class="sidebar-header position-relative">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="index.html"><h6>SARANA & PRASARANA</h6></a>
            </div>
            <div class="sidebar-toggler  x">
                <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
            </div>
        </div>
    </div>
    <div class="sidebar-menu">
        <ul class="menu">
            <li class="sidebar-title">Menu</li>

            <li class="sidebar-item {{ request()->is('admin') ? 'active' : '' }}">
                <a href="{{ route('dashboard.admin') }}" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="sidebar-item has-sub {{ request()->is('admin/issue*') || request()->is('admin/procurement*') ? 'active' : '' }}">
                <a href="#" class='sidebar-link'>
                    <i class="bi bi-send"></i>
                    <span>Request</span>
                </a>

                <ul class="submenu {{ request()->is('admin/procurement*') ? 'active' : '' }}">
                    <li class="submenu-item">
                        <a href="{{ route('procurement') }}" class="submenu-link">Pengadaan</a>
                    </li>

                    <li class="submenu-item {{ request()->is('admin/issue*') ? 'active' : '' }}">
                        <a href="{{ route('admin.issue') }}" class="submenu-link">Issue</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item {{ request()->is('admin/ownership*') ? 'active' : '' }}">
                <a href="{{ route('ownership') }}" class='sidebar-link'>
                    <i class="bi bi-card-list"></i>
                    <span>Ownership</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->is('admin/asset*') ? 'active' : '' }}">
                <a href="{{ route('asset') }}" class='sidebar-link'>
                    <i class="bi bi-box-seam-fill"></i>
                    <span>Asset</span>
                </a>
            </li>


            <li class="sidebar-item {{ request()->is('admin/user*') ? 'active' : '' }}">
                <a href="{{ route('user') }}" class='sidebar-link'>
                    <i class="bi bi-person-fill"></i>
                    <span>Users</span>
                </a>
            </li>

            <li class="sidebar-item has-sub {{ request()->is('admin/category*') || request()->is('admin/division*') ? 'active' : '' }}">
                <p class='sidebar-link' style="cursor:pointer;">
                    <i class="bi bi-pentagon-fill"></i>
                    <span>Master Data</span>
                </p>

                <ul class="submenu ">
                    <li class="submenu-item  {{ request()->is('admin/category*') ? 'active' : '' }}">
                        <a href="{{ route('category') }}" class="submenu-link">Category</a>
                    </li>

                    <li class="submenu-item {{ request()->is('admin/division*') ? 'active' : '' }}">
                        <a href="{{ route('division') }}" class="submenu-link">Division</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
        </div>
        <div id="main" class='layout-navbar navbar-fixed'>
            <header>
                <nav class="navbar navbar-expand navbar-light navbar-top">
                    <div class="container-fluid">
                        <a href="#" class="burger-btn d-block">
                            <i class="bi bi-justify fs-3"></i>
                        </a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mb-lg-0">
                                <li class="nav-item dropdown me-3">
                                    <a class="nav-link active dropdown-toggle text-gray-600" href="#" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        <i class='bi bi-bell bi-sub fs-4'></i>
                                        <span class="badge badge-notification bg-danger">7</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end notification-dropdown" aria-labelledby="dropdownMenuButton">
                                        <li class="dropdown-header">
                                            <h6>Notifications</h6>
                                        </li>
                                        <li class="dropdown-item notification-item">
                                            <a class="d-flex align-items-center" href="#">
                                                <div class="notification-icon bg-primary">
                                                    <i class="bi bi-cart-check"></i>
                                                </div>
                                                <div class="notification-text ms-4">
                                                    <p class="notification-title font-bold">Successfully check out</p>
                                                    <p class="notification-subtitle font-thin text-sm">Order ID #256</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="dropdown-item notification-item">
                                            <a class="d-flex align-items-center" href="#">
                                                <div class="notification-icon bg-success">
                                                    <i class="bi bi-file-earmark-check"></i>
                                                </div>
                                                <div class="notification-text ms-4">
                                                    <p class="notification-title font-bold">Homework submitted</p>
                                                    <p class="notification-subtitle font-thin text-sm">Algebra math homework</p>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <p class="text-center py-2 mb-0"><a href="#">See all notification</a></p>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-menu d-flex">
                                        <div class="user-name text-end me-3">
                                            <h6 class="mb-0 text-gray-600">{{ Auth::user()->first_name }}</h6>
                                            <p class="mb-0 text-sm text-gray-600">{{ Auth::user()->role }}</p>
                                        </div>
                                        <div class="user-img d-flex align-items-center">
                                            <div class="avatar avatar-md">
                                                <img src="{{ asset('assets/static/images/picture/blank_profile.png') }}">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton" style="min-width: 11rem;">
                                    <li>
                                        <h6 class="dropdown-header">Hello, {{ Auth::user()->first_name }}!</h6>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('dashboard.admin') }}"><i class="bi bi-grid-fill me-2"></i>Dashboard</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="{{ route('auth.logout') }}">
                                            <button type="submit" class="btn btn-link ms-2"><i
                                                class="icon-mid bi bi-box-arrow-left me-2"></i> Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>
            <div id="main-content">

<div class="page-heading">
    @yield('content')
</div>

            </div>
            <footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="https://saugi.me">Saugi</a></p>
        </div>
    </div>
</footer>
        </div>
    </div>
    {{-- SPA --}}
    {{-- <script src="https://unpkg.com/@hotwired/turbo"></script>
        <script>
        document.addEventListener("turbo:load", function() {
            // inisiaisi kembali
            $('#table1').DataTable();
            $('#table3').DataTable();
        });
        </script>
    </script> --}}


    <script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
    <script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/compiled/js/app.js') }}"></script>
    {{-- extensi --}}
    {{-- datatable --}}
    <script src="{{ asset('assets/extensions/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/extensions/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/static/js/pages/datatables.js') }}"></script>
    {{-- sweetalert --}}
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>

    {{-- notifikasi --}}
    <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })
    </script>
    @if (session('success'))
    <script>
    Toast.fire({
        icon: 'success',
        title: '{{ session("success") }}'
    })
    </script>
    @endif
</body>

</html>
