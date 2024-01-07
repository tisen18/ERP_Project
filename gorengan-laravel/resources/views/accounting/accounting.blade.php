<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>ERP GORENGAN</title>
    <!-- theme meta -->
    <meta name="theme-name" content="mono" />
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Karla:400,700|Roboto" rel="stylesheet">
    <link href="{{ asset('template/theme/plugins/material/css/materialdesignicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/theme/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />
    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('template/theme/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/theme/plugins/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('template/theme/plugins/jvectormap/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet" />
    <link href="{{ asset('template/theme/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="{{ asset('template/theme/plugins/toaster/toastr.min.css') }}" rel="stylesheet" />
    <!-- MONO CSS -->
    <link id="main-css-href" rel="stylesheet" href="{{ asset('template/theme/css/style.css') }}" />
    <!-- FAVICON -->
    <link href="{{ asset('template/theme/images/favicon.png') }}" rel="shortcut icon" />
    <link href="{{ asset('template/theme/css/style.css') }}" rel="stylesheet" />
    <script src="{{ asset('template/theme/plugins/nprogress/nprogress.js') }}"></script>
</head>

<body class="navbar-fixed sidebar-fixed" id="body">
    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();
    </script>
    <div id="toaster"></div>
    <div class="wrapper">
        <aside class="left-sidebar sidebar-dark" id="left-sidebar">
            <div id="sidebar" class="sidebar sidebar-with-footer">
                <!-- Aplication Brand -->
                <div class="app-brand">
                    <a href="/index.html">
                        <img src="{{ asset('template/theme/images/logo.png') }}" alt="Mono">
                        <span class="brand-name">INI GORENGAN</span>
                    </a>
                </div>
                <!-- begin sidebar scrollbar -->
                <div class="sidebar-left" data-simplebar style="height: 100%;">
                    <!-- sidebar menu -->
                    <ul class="nav sidebar-inner" id="sidebar-menu">
                        <li class="active">
                            <a class="sidenav-item-link" href="index.html">
                                <i class="mdi mdi-briefcase-account-outline"></i>
                                <span class="nav-text">DASHBOARD</span>
                            </a>
                        </li>
                        
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#manufacturing" aria-expanded="false" aria-controls="manufacturing">
                            <i class="mdi mdi-manufacturing"></i>
                            <li class="section-title" font-size:14px>Manufacturing</li> 
                        </a>
                        
                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#produk" aria-expanded="false" aria-controls="produk">
                                <i class="mdi mdi-produk"></i>
                                <span class="nav-text">Produk</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="produk" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/Manufacture/produk">
                                            <span class="nav-text">Tabel Produk</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href=/Manufacture/input-produk>
                                            <span class="nav-text">Tambah Produk</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(1)" data-toggle="collapse" data-target="#bahan" aria-expanded="false" aria-controls="bahan">
                                <i class="mdi mdi-bahan"></i>
                                <span class="nav-text">Bahan Baku</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="bahan" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/Manufacture/bahan">
                                            <span class="nav-text">Tabel Bahan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href=/Manufacture/input-bahan>
                                            <span class="nav-text">Tambah Bahan</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(1)" data-toggle="collapse" data-target="#bom" aria-expanded="false" aria-controls="bom">
                                <i class="mdi mdi-bom"></i>
                                <span class="nav-text">Bill Of Material</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="bom" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/bom/bom">
                                            <span class="nav-text">Tabel BOM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href=/bom/input-bom>
                                            <span class="nav-text">Tambah BOM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href="/bom/bom_tambah">
                                            <span class="nav-text">Cetak BOM</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(1)" data-toggle="collapse" data-target="#mo" aria-expanded="false" aria-controls="mo">
                                <i class="mdi mdi-mo"></i>
                                <span class="nav-text">Manufacture Order</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="mo" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/Manufacture/mo">
                                            <span class="nav-text">Tabel MO</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href=/Manufacture/mo-input>
                                            <span class="nav-text">Tambah MO</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#purchasing" aria-expanded="false" aria-controls="purchasing">
                            <i class="mdi mdi-purchasing"></i>
                            <li class="section-title" font-size:14px>Purchasing</li> 
                        </a>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#vendor" aria-expanded="false" aria-controls="vendor">
                                <i class="mdi mdi-vendor"></i>
                                <span class="nav-text">Vendor</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="vendor" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/vendor">
                                            <span class="nav-text">Tabel Vendor</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href=/vendor/tambah>
                                            <span class="nav-text">Tambah Vendor</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#rfq" aria-expanded="false" aria-controls="rfq">
                                <i class="mdi mdi-rfq"></i>
                                <span class="nav-text">Request for Quotation</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="rfq" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/rfq">
                                            <span class="nav-text">Tabel RFQ</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href=/rfq-input>
                                            <span class="nav-text">Tambah RFQ</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#po" aria-expanded="false" aria-controls="po">
                                <i class="mdi mdi-po"></i>
                                <span class="nav-text">Purchase Order</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="po" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/po">
                                            <span class="nav-text">Tabel PO</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#sales" aria-expanded="false" aria-controls="sales">
                            <i class="mdi mdi-sales"></i>
                            <li class="section-title" font-size:14px>Sales</li> 
                        </a>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#customer" aria-expanded="false" aria-controls="customer">
                                <i class="mdi mdi-customer"></i>
                                <span class="nav-text">Customer</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="customer" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/customer">
                                            <span class="nav-text">Tabel Customer</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href=/vendor/tambah>
                                            <span class="nav-text">Tambah Customer</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#sq" aria-expanded="false" aria-controls="sq">
                                <i class="mdi mdi-sq"></i>
                                <span class="nav-text">Sales Quotation</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="sq" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/sq">
                                            <span class="nav-text">Tabel Sales Quotation</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href=/vendor/tambah>
                                            <span class="nav-text">Tambah Sales Quotation</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#so" aria-expanded="false" aria-controls="so">
                                <i class="mdi mdi-so"></i>
                                <span class="nav-text">Sales Order</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="so" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/so">
                                            <span class="nav-text">Tabel Sales Order</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#sales" aria-expanded="false" aria-controls="accounting">
                            <i class="mdi mdi-sales"></i>
                            <li class="section-title" font-size:14px>Accounting</li> 
                        </a>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="/accounting-invoicing">
                                <i class="mdi mdi-ai" ></i>
                                <span class="nav-text">Accounting Invoicing</span> 
                            </a>
                            <a class="sidenav-item-link" href="/accounting-bill">
                                <i class="mdi mdi-ai"></i>
                                <span class="nav-text">Accounting Vendor</span> 
                            </a>
                        </li>
                        <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse" data-target="#sales" aria-expanded="false" aria-controls="accounting">
                            <i class="mdi mdi-sales"></i>
                            <li class="section-title" font-size:14px>Employe</li> 
                        </a>

                        <li class="has-sub">
                            <a class="sidenav-item-link" href="javascript:void(0)" data-toggle="collapse"
                                data-target="#employe" aria-expanded="false" aria-controls="employe">
                                <i class="mdi mdi-employe"></i>
                                <span class="nav-text">Employe</span> <b class="caret"></b>
                            </a>
                            <ul class="collapse" id="employe" data-parent="#sidebar-menu">
                                <div class="sub-menu">
                                    <li>
                                        <a class="sidenav-item-link" href="/employe">
                                            <span class="nav-text">Tabel Employe</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="sidenav-item-link" href=/employe/tambah>
                                            <span class="nav-text">Tambah Employe</span>
                                        </a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                    </ul>
                </div>
                <div class="sidebar-footer">
                    <div class="sidebar-footer-content">
                        <ul class="d-flex">
                            <li>
                                <a href="user-account-settings.html" data-toggle="tooltip" title="Profile settings"><i
                                        class="mdi mdi-settings"></i></a>
                            </li>
                            <li>
                                <a href="#" data-toggle="tooltip" title="No chat messages"><i
                                        class="mdi mdi-chat-processing"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <div class="page-wrapper">
            <!-- Header -->
            <header class="main-header" id="header">
                <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
                    <!-- Sidebar toggle button -->
                    <button id="sidebar-toggler" class="sidebar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                    </button>

                    <span class="page-title">dashboard</span>

                    <div class="navbar-right ">

                        <!-- search form -->
                        <div class="search-form">
                            <form action="index.html" method="get">
                                <div class="input-group input-group-sm" id="input-group-search">
                                    <input type="text" autocomplete="off" name="query" id="search-input"
                                        class="form-control" placeholder="Search..." />
                                    <div class="input-group-append">
                                        <button class="btn" type="button">/</button>
                                    </div>
                                </div>
                            </form>
                            <ul class="dropdown-menu dropdown-menu-search">

                                <li class="nav-item">
                                    <a class="nav-link" href="index.html">Morbi leo risus</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.html">Dapibus ac facilisis in</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.html">Porta ac consectetur ac</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.html">Vestibulum at eros</a>
                                </li>
                            </ul>
                        </div>

                        <ul class="nav navbar-nav">
                            <li class="custom-dropdown">
                                <button class="notify-toggler custom-dropdown-toggler">
                                    <i class="mdi mdi-bell-outline icon"></i>
                                    <span class="badge badge-xs rounded-circle">21</span>
                                </button>

                            </li>
                            <!-- User Account -->
                            <li class="dropdown user-menu">
                                <button class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <img src="{{ asset('template/theme/images/user/u7.jpg') }}"
                                        class="user-image rounded-circle" alt="User Image" />
                                    <span class="d-none d-lg-inline-block">John Doe</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a class="dropdown-link-item" href="user-profile.html">
                                            <i class="mdi mdi-account-outline"></i>
                                            <span class="nav-text">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-link-item" href="email-inbox.html">
                                            <i class="mdi mdi-email-outline"></i>
                                            <span class="nav-text">Message</span>
                                            <span class="badge badge-pill badge-primary">24</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-link-item" href="user-activities.html">
                                            <i class="mdi mdi-diamond-stone"></i>
                                            <span class="nav-text">Activitise</span></a>
                                    </li>
                                    <li>
                                        <a class="dropdown-link-item" href="user-account-settings.html">
                                            <i class="mdi mdi-settings"></i>
                                            <span class="nav-text">Account Setting</span>
                                        </a>
                                    </li>

                                    <li class="dropdown-footer">
                                        <a class="dropdown-link-item" href="sign-in.html"> <i
                                                class="mdi mdi-logout"></i> Log Out </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <div class="content-wrapper mt-n5">
                <div class="content"><!-- For Components documentaion -->
                    <div class="row">
                        <div class="col-lg-12">
                
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Data Penjualan Produk</h5>
                                        <!-- Table with stripped rows -->
                                        <table class="table datatable" id="myTable">
                                            <div class="card-body">
                                                <a href="/accounting-invoicing"><button type="button" class="btn btn-success">Tampilkan Semua Data</button></a>
                                                <a href="/accounting-invoicing/cetak/" target="_blank"><button type="button" class="btn btn-primary">Cetak Laporan</button></a>
                                                {{-- <a href="" onclick="this.href='/accounting-invoicing/cetak-pertanggal/'+ document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value" target="_blank" class="btn btn-secondary">Cetak Laporan Per Tanggal</a> --}}
                                                <h5 class="card-title">Filter Berdasarkan Tanggal</h5>
                                                <div class="row mb-3">
                                                    <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Awal</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" name="tglawal" id="tglawal">
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Akhir</label>
                                                    <div class="col-sm-10">
                                                        <input type="date" class="form-control" name="tglakhir" id="tglakhir">
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <a href="" onclick="this.href='/accounting-invoicing/tampil-pertanggal/'+ document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value" class="btn btn-secondary">Tampilkan Data Per Tanggal</a>
                                                </div>
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Kode Sales</th>
                                                        <th scope="col">Nama Customer</th>
                                                        <th scope="col">Tanggal Order</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Total Harga</th>
                                                        <th scope="col">Metode Pembayaran</th>
                                                        <th scope="col">Aaction</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($sqs->count())
                                                        @foreach($sqs as $item)
                                                            @if($item->status > 4)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td>{{$item->kode_sq}}</td>
                                                                    <td>{{$item->nama}}</td>
                                                                    <td>{{$item->tanggal_order}}</td>
                                                                    <td>
                                                                        @if($item->status == 1 )
                                                                        <span class="badge bg-primary text-white">Quotation</span>
                                                                        @elseif($item->status == 2)
                                                                        <span class="badge bg-secondary text-white">To Invoice</span>
                                                                        @elseif($item->status == 3)
                                                                        <span class="badge bg-warning text-white">Draft Invoice</span>
                                                                        @elseif($item->status == 4)
                                                                        <span class="badge bg-info text-white">Fully Invoiced</span>
                                                                        @elseif($item->status == 5)
                                                                        <span class="badge bg-success text-white">Delivered</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{$item->total_harga}}</td>
                                                                    <td> 
                                                                        @if($item->metode_pembayaran == 0 )
                                                                        <span class="badge bg-secondary text-white">Belum Dibuat</span>
                                                                        @elseif($item->metode_pembayaran == 1)
                                                                        <span class="badge bg-primary text-white">Cash</span>
                                                                        @elseif($item->metode_pembayaran == 2)
                                                                        <span class="badge bg-primary text-white">Transfer</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if($item->status >= 3 )
                                                                        <a href="{{ url('so-invoice/'.$item->kode_sq) }}" target="_blank"><span class="badge bg-info text-white">Cek Invoice</span></a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                                <td colspan="7"> No record found </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                  <h5 class="card-title">Total Penjualan Produk</h5>
                                  <label for="text_harga"> Total Penjualan : </label>
                                  <label for="total_harga" id="val"> 0</label>
                                </div>
                            </div>



                            
                        </div>
                    </div>
                </div>

            </div>



            




            <!-- Footer -->
            <footer class="footer mt-auto">
                <div class="copyright bg-white">
                    <p>
                        &copy; <span id="copy-year"></span>
                </div>
                <script>
                    var d = new Date();
                    var year = d.getFullYear();
                    document.getElementById("copy-year").innerHTML = year;
                </script>
            </footer>

        </div>
    </div>


    <script src="{{ asset('template/theme/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/theme/plugins/simplebar/simplebar.min.js') }}"></script>
    <script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>
    <script src="{{ asset('template/theme/plugins/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('template/theme/plugins/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/theme/plugins/jvectormap/jquery-jvectormap-2.0.3.min.js') }}"></script>
    <script src="{{ asset('template/theme/plugins/jvectormap/jquery-jvectormap-world-mill.js') }}"></script>
    <script src="{{ asset('template/theme/plugins/jvectormap/jquery-jvectormap-us-aea.js') }}"></script>
    <script src="{{ asset('template/theme/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('template/theme/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('input[name="dateRange"]').daterangepicker({
                autoUpdateInput: false,
                singleDatePicker: true,
                locale: {
                    cancelLabel: 'Clear'
                }
            });
            jQuery('input[name="dateRange"]').on('apply.daterangepicker', function(ev, picker) {
                jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
            });
            jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function(ev, picker) {
                jQuery(this).val('');
            });
        });
    </script>



    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ asset('template/theme/plugins/toaster/toastr.min.js') }}"></script>
    <script src="{{ asset('template/theme/js/mono.js') }}"></script>
    <script src="{{ asset('template/theme/js/chart.js') }}"></script>
    <script src="{{ asset('template/theme/js/map.js') }}"></script>
    <script src="{{ asset('template/theme/js/custom.js') }}"></script>
    <script>
        updateSubTotal(); // Initial call
    
        function updateSubTotal() {
            var table = document.getElementById("myTable");
            let subTotal = Array.from(table.rows).slice(1).reduce((total, row) => {
                return total + parseFloat(row.cells[5].innerHTML);
            }, 0);
            document.getElementById("val").innerHTML = "Rp." + subTotal;
        }
        </script>
</body>

</html>

