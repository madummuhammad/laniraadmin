<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>DND</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('assets')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{url('assets')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{url('assets')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{url('assets')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('assets')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('assets')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('assets')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{url('assets')}}/plugins/summernote/summernote-bs4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('assets')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('assets')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{url('assets')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item" id="collapse-sidebar">
          <a class="nav-link" data-widget="pushmenu" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{url('/')}}" class="brand-link">
        <img src="{{url('assets')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">DND System</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{url('assets')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"><?php echo  Auth::user()->role ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="{{url('dashboard')}}" class="nav-link">
                <i class="fas fa-tachometer-alt nav-icon fa-image"></i>
                <!-- <i class="nav-icon far fa-image"></i> -->
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            @if(Auth::user()->role=='supervisor')
            <li class="nav-item">
              <a href="{{url('cart')}}" class="nav-link">
                <i class="fas fa-shopping-cart nav-icon fa-image"></i>
                <p>
                  Keranjang
                </p>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a href="{{url('member')}}" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>
                  Member
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('product')}}" class="nav-link">
                <i class="fas fa-boxes nav-icon"></i>
                <p>
                  Data Produk
                </p>
              </a>
            </li> 
            @if(Auth::user()->role=='supervisor')
            <li class="nav-item">
              <a href="{{url('order/ready_stock')}}" class="nav-link">
                <i class="fas fa-sort-amount-up-alt nav-icon"></i>
                <p>
                  Data Order
                </p>
              </a>
            </li> 
            <li class="nav-item">
              <a href="{{url('order/po')}}" class="nav-link">
                <i class="fas fa-sort-amount-up-alt nav-icon"></i>
                <p>
                  Data Order PO
                </p>
              </a>
            </li>  
            <li class="nav-item">
              <a href="{{url('product/sold')}}" class="nav-link">
                <i class="fab fa-sellsy nav-icon"></i>
                <p>
                  Produk Terjual
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('product/sold_po')}}" class="nav-link">
                <i class="fab fa-sellsy nav-icon"></i>
                <p>
                  Produk PO Terjual
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('expedisi')}}" class="nav-link">
                <i class="fas fa-truck nav-icon"></i>
                <p>
                  Expedisi
                </p>
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a href="{{url('slider')}}" class="nav-link">
                <i class="nav-icon far fa-image nav-icon"></i>
                <p>
                  Slider
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('footer')}}" class="nav-link">
                <i class="fas fa-shoe-prints nav-icon"></i>
                <p>
                  Footer Edit
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{url('logout')}}" class="nav-link">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    @yield('content')

