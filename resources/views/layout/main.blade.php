<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="../img/logo/husker.png" rel="icon">

    <title>{{ $title }}</title>

    <link href="../../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="../../css/ruang-admin.css" rel="stylesheet">
    
    <!-- Select2 -->
    <link href="../../vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css">
    
    <!-- Bootstrap Touchspin -->
    <link href="../../vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css" rel="stylesheet">
    
    <!-- Bootstrap DatePicker -->
    <link href="../../vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <img src="../../img/logo/husker.png" alt="Husker Logo" class="sidebar-logo">
                </div>

                <div class="sidebar-brand-text mx-2">
                    {{ Auth::user()->name }} Page
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Dashboard -->
            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                <a class="nav-link" href="{{ request()->is('/') ? '#' : '/' }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Content
            </div>

            {{-- Hanya admin yang dapat melihat Forms --}}
            @can('role', ['admin'])

            @php
                $formActive =
                    request()->url() === route('transaksi.store') ||
                    request()->url() === route('tinta.store') ||
                    request()->url() === route('stok_kain.store') ||
                    request()->url() === route('kain.store') ||
                    request()->url() === route('produksi.store') ||
                    request()->url() === route('roll.store') ||
                    request()->url() === route('stok_kertas.store') ||
                    request()->url() === route('berat.store') ||
                    request()->url() === route('kertas.store') ||
                    request()->url() === route('stok_tinta.store') ||
                    request()->url() === route('warna.store') ||
                    request()->url() === route('volume.store');
            @endphp

            <!-- Forms -->
            <li class="nav-item {{ $formActive ? 'active' : '' }}">

                <a class="nav-link {{ $formActive ? '' : 'collapsed' }}"
                    href="#"
                    data-toggle="collapse"
                    data-target="#collapseForm"
                    aria-expanded="{{ $formActive ? 'true' : 'false' }}"
                    aria-controls="collapseForm">

                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Forms</span>
                </a>

                <div id="collapseForm"
                    class="collapse {{ $formActive ? 'show' : '' }}"
                    aria-labelledby="headingForm"
                    data-parent="#accordionSidebar">

                    <div class="bg-white py-2 collapse-inner rounded">

                        <h6 class="collapse-header">
                            Forms
                        </h6>

                        <a class="collapse-item {{ request()->url() === route('transaksi.store') ? 'active' : '' }}"
                            href="{{ route('transaksi.store') }}">
                            Transaksi
                        </a>

                        <a class="collapse-item {{ request()->url() === route('tinta.store') ? 'active' : '' }}"
                            href="{{ route('tinta.store') }}">
                            Tinta
                        </a>

                        <hr class="sidebar-divider">

                        <a class="collapse-item {{ request()->url() === route('stok_kain.store') ? 'active' : '' }}"
                            href="{{ route('stok_kain.store') }}">
                            Stok Kain
                        </a>
                        <a class="collapse-item {{ request()->url() === route('kain.store') ? 'active' : '' }}"
                            href="{{ route('kain.store') }}">
                            Kain
                        </a>
                        <a class="collapse-item {{ request()->url() === route('produksi.store') ? 'active' : '' }}"
                            href="{{ route('produksi.store') }}">
                            Produksi
                        </a>
                        <a class="collapse-item {{ request()->url() === route('roll.store') ? 'active' : '' }}"
                            href="{{ route('roll.store') }}">
                            Roll
                        </a>

                        <hr class="sidebar-divider">

                        <a class="collapse-item {{ request()->url() === route('stok_kertas.store') ? 'active' : '' }}"
                            href="{{ route('stok_kertas.store') }}">
                            Stok Kertas
                        </a>
                        <a class="collapse-item {{ request()->url() === route('kertas.store') ? 'active' : '' }}"
                            href="{{ route('kertas.store') }}">
                            Kertas
                        </a>
                        <a class="collapse-item {{ request()->url() === route('berat.store') ? 'active' : '' }}"
                            href="{{ route('berat.store') }}">
                            Berat
                        </a>

                        <hr class="sidebar-divider">

                        <a class="collapse-item {{ request()->url() === route('stok_tinta.store') ? 'active' : '' }}"
                            href="{{ route('stok_tinta.store') }}">
                            Stok Tinta
                        </a>
                        <a class="collapse-item {{ request()->url() === route('warna.store') ? 'active' : '' }}"
                            href="{{ route('warna.store') }}">
                            Warna
                        </a>
                        <a class="collapse-item {{ request()->url() === route('volume.store') ? 'active' : '' }}"
                            href="{{ route('volume.store') }}">
                            Volume
                        </a>

                    </div>
                </div>
            </li>

        @endcan

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Tables
        </div>

        @php
            $tableActive = request()->routeIs('table.show');
            $currentTable = request()->route('link');
        @endphp

        <!-- Tables -->
        <li class="nav-item {{ $tableActive ? 'active' : '' }}">

            <a class="nav-link {{ $tableActive ? '' : 'collapsed' }}"
                href="#"
                data-toggle="collapse"
                data-target="#collapseTable"
                aria-expanded="{{ $tableActive ? 'true' : 'false' }}"
                aria-controls="collapseTable">

                <i class="fas fa-fw fa-table"></i>
                <span>Tables</span>
            </a>

            <div id="collapseTable"
                class="collapse {{ $tableActive ? 'show' : '' }}"
                aria-labelledby="headingTable"
                data-parent="#accordionSidebar">

                <div class="bg-white py-2 collapse-inner rounded">

                    <h6 class="collapse-header">
                        Tables
                    </h6>

                    <a class="collapse-item {{ $currentTable === 'Transaksi' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Transaksi']) }}">
                        Transaksi
                    </a>

                    <a class="collapse-item {{ $currentTable === 'Riwayat' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Riwayat']) }}">
                        Riwayat
                    </a>

                    <hr class="sidebar-divider">

                    <a class="collapse-item {{ $currentTable === 'Stok_Kain' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Stok_Kain']) }}">
                        Stok Kain
                    </a>

                    <a class="collapse-item {{ $currentTable === 'Kain' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Kain']) }}">
                        Kain
                    </a>
                    
                    <a class="collapse-item {{ $currentTable === 'Produksi' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Produksi']) }}">
                        Produksi
                    </a>

                    <a class="collapse-item {{ $currentTable === 'Roll' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Roll']) }}">
                        Roll
                    </a>

                    <hr class="sidebar-divider">

                    <a class="collapse-item {{ $currentTable === 'Stok_Kertas' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Stok_Kertas']) }}">
                        Stok Kertas
                    </a>

                    <a class="collapse-item {{ $currentTable === 'Kertas' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Kertas']) }}">
                        Kertas
                    </a>

                    <a class="collapse-item {{ $currentTable === 'Berat' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Berat']) }}">
                        Berat
                    </a>

                    <hr class="sidebar-divider">

                    <a class="collapse-item {{ $currentTable === 'Tinta' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Tinta']) }}">
                        Tinta
                    </a>

                    <a class="collapse-item {{ $currentTable === 'Warna' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Warna']) }}">
                        Warna
                    </a>

                    <a class="collapse-item {{ $currentTable === 'Volume' ? 'active' : '' }}"
                        href="{{ route('table.show', ['link' => 'Volume']) }}">
                        Volume
                    </a>

                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler -->
        <div class="text-center d-none d-md-inline" id="sidebarToggleWrapper">
            <button class="rounded border-0" id="sidebarToggle"></button>
        </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- TopBar -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                                <form action="{{ route('admin.logout') }}" id="logout-form" method="post">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->
                {{-- BATAS AWAL --}}

                @yield('content')
                
                {{-- BATAS AKHIR --}}
                <!-- Modal Logout -->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to logout?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                                <a href="#" class="btn btn-primary">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!---Container Fluid-->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->

        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../js/ruang-admin.min.js"></script>
    <!-- Select2 -->
    <script src="../../vendor/select2/dist/js/select2.min.js"></script>
    <!-- Bootstrap Touchspin -->
    <script src="../../vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js"></script>
    <!-- Bootstrap Datepicker -->
    <script src="../../vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Page level plugins -->
    <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>
    {{-- CODE JAVASCRIPT PER PAGE  --}}
    @yield('jsCode')
</body>

</html>