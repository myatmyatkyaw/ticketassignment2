<!DOCTYPE html>
<html lang="en">
<head>
@include('dashboard.header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src={{  asset("dist/img/AdminLTELogo.png")}} alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">



      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src={{  asset("dist/img/AdminLTELogo.png")}} alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GIC-Shopping</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src={{  asset("dist/img/user2-160x160.jpg")}} class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @if(auth()->user()->role == '0')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="{{ route('user.create') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
               Create User

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
              User List
              </p>
            </a>
          </li>




          <li class="nav-item">
            <a href="{{ route('label.create') }}" class="nav-link">
              <i class="nav-icon fas fa-tag"></i>
              <p>
               Create Label

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('label.index') }}" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
              Label List

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('category.create') }}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
              Create Category

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('category.index') }}" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
              Category List

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('ticket.create') }}" class="nav-link">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
              Create Ticket

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('ticket.index') }}" class="nav-link">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
              Ticket List

              </p>
            </a>
          </li>


        </ul>
        @endif

        @if(auth()->user()->role == '1')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="{{ route('ticket.create') }}" class="nav-link">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                Create Ticket

                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('ticket.index') }}" class="nav-link">
                <i class="nav-icon fas fa-id-card"></i>
                <p>
                Ticket List

                </p>
              </a>
            </li>


          </ul>
        @endif

        @if(auth()->user()->role == '2')
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

            <li class="nav-item">
              <a href="{{ route('ticket.create') }}" class="nav-link">
                <i class="nav-icon fas fa-credit-card"></i>
                <p>
                Create Ticket

                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('ticket.index') }}" class="nav-link">
                <i class="nav-icon fas fa-id-card"></i>
                <p>
                Ticket List

                </p>
              </a>
            </li>


          </ul>
        @endif
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @yield('content')

        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@extends('dashboard.footer')
</body>
</html>
