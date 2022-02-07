<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>
  <base href="<?php echo base_url(); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/new/admin/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/new/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/new/admin/dist/css/adminlte.min.css">
  <link href="assets/new/admin/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/new/admin/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="assets/new/admin/datatables/css/jquery.dataTables.min.css"/>

  <script type="text/javascript">
    var base_url = '<?php echo base_url();?>';
  </script>
  <script src="assets/new/admin/plugins/jquery/jquery.min.js"></script>
  
  <script src="assets/new/admin/developer_js/sig_pad.js"></script>
  <script src="assets/new/admin/developer_js/signtaure.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>

<style type="text/css">
.content-wrapper{
  margin-top: 30px !important;
}
.select2.select2-container{
    width: 100% !important;
}
.select2-container--default .select2-selection--single{
    height: 38px;
    border-color: #ced4da;
}
.logo-img img{
  width: 100% !important;
  height: 42px !important;
}
.card-body{
  overflow-x: auto;
}

/*.select2-container--default .select2-selection--single{
    background-color: #343A40 !important;
    border-radius: 4px !important;
    border-color: #6c757d  !important;
}
.select2-selection__rendered{
    color:white !important;
}
.dataTables_length,.dataTables_filter,.dataTables_info{
  color: white !important;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled{
  color: white !important;
}
.paginate_button.next{
  color: white !important;
}
.even{
  background-color: #343A40 !important;
}*/
</style>
</head>

 <!-- <body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed"> -->

  <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
 
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="assets/new/admin/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url('admin/dashboard');?>" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> -->

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="assets/new/admin/dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="assets/new/admin/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="assets/new/admin/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-th-large"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?php echo base_url('user_childs/update'); ?>" class="dropdown-item">
            <i class="fas fa-user mr-2"></i>My Profile
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('user_childs/change_password'); ?>" class="dropdown-item">
            <i class="fas fa-lock mr-2"></i>Change Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('Login/logout'); ?>" class="dropdown-item">
            <i class="fas fa-sign-out-alt mr-2"></i></i>Logout
          </a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('user/admin_dashboard');?>" class="brand-link logo-img">
      <!-- <img src="assets/new/admin/images/logo-hr.png" > -->
      <h3 style="text-align: center;margin-bottom: 0px !important;">Binary MLM</h3>
      <!-- <img src="assets/new/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span> -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/new/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo base_url("User/Userdashboard"); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="dashboard")?"active":""; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>

          <?php if ($this->session->userdata('role') == "admin") { ?>
          <li class="nav-item <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="packages" || $this->selected_tab=="all_packages" || $this->selected_tab=="rejected_packages" || $this->selected_tab=="pending_packages" || $this->selected_tab=="purchased_packages" || $this->selected_tab=="upu") )?"menu-open":""; ?>">
            <a href="#" class="nav-link <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="packages" || $this->selected_tab=="all_packages" || $this->selected_tab=="rejected_packages" || $this->selected_tab=="pending_packages" || $this->selected_tab=="purchased_packages" || $this->selected_tab=="upu") )?"active":""; ?>">
              <!-- <i class="nav-icon fas fa-copy"></i> -->
              <i class="nav-icon fas fa-th"></i>
              <p>
                Packages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('packages/index'); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="packages")?"active":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Packages</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('user_packages/index/3/'); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="all_packages")?"active":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchased Packages</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url("Users/index/"); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="users")?"active":""; ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>Users Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url("payment/deposits"); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="deposits")?"active":""; ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>Payments</p>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a href="<?php echo base_url('payment/admin_history'); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="payment_history")?"active  abcdef":""; ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>Payment History</p>
            </a>
          </li> -->
          <li class="nav-item <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="withdraw_limits" || $this->selected_tab=="rejected_withdraws" || $this->selected_tab=="pending_withdraws" || $this->selected_tab=="approved_withdraws" ) )?"menu-open":""; ?>">
            <a href="#" class="nav-link <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="withdraw_limits" || $this->selected_tab=="rejected_withdraws" || $this->selected_tab=="pending_withdraws" || $this->selected_tab=="approved_withdraws" ) )?"active":""; ?>">
              <!-- <i class="nav-icon fas fa-copy"></i> -->
              <i class="nav-icon fas fa-th"></i>
              <p>
                Withdraws
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('withdraws/withdraw_limits'); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="withdraw_limits")?"active":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Limits</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("withdraws/index/user/0/"); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="pending_withdraws")?"active":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Withdraws</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("withdraws/index/user/1/"); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="approved_withdraws")?"active":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Approved Withdraws</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url("withdraws/index/user/2/"); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="rejected_withdraws")?"active":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Rejected Withdraws</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="rewards" || $this->selected_tab=="awarded_rewards" || $this->selected_tab=="pending_rewards") )?"menu-open":""; ?>">
            <a href="#" class="nav-link <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="rewards" || $this->selected_tab=="awarded_rewards" || $this->selected_tab=="pending_rewards") )?"active":""; ?>">
              <!-- <i class="nav-icon fas fa-copy"></i> -->
              <i class="nav-icon fas fa-th"></i>
              <p>
                Rewards
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url("rewards/index/"); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="rewards")?"active abcdef":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Rewards</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('user_rewards/admin_index/Bc4hJqTL'); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="awarded_rewards")?"active  abcdef":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Awarded Rewards</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('user_rewards/admin_index/j6YgflOvD'); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="pending_rewards")?"active  abcdef":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pending Rewards</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="roi" || $this->selected_tab=="binary" || $this->selected_tab=="referral") )?"menu-open":""; ?>">
            <a href="#" class="nav-link <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="roi" || $this->selected_tab=="binary" || $this->selected_tab=="referral") )?"active":""; ?>">
              <!-- <i class="nav-icon fas fa-copy"></i> -->
              <i class="nav-icon fas fa-th"></i>
              <p>
                Histories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url('histories/roi'); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="roi")?"active":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('histories/binary'); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="binary")?"active":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Binary</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url('histories/referral'); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="referral")?"active":""; ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Referral</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url("news/index/"); ?>" class="nav-link <?php echo (isset($this->selected_tab) && $this->selected_tab=="news")?"active":""; ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>News</p>
            </a>
          </li>

          <?php } ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

   {_yield}

  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.0-rc
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!-- Bootstrap -->
<script src="assets/new/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets/new/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/new/admin/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="assets/new/admin/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="assets/new/admin/plugins/raphael/raphael.min.js"></script>
<script src="assets/new/admin/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/new/admin/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="assets/new/admin/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="assets/new/admin/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets/new/admin/dist/js/pages/dashboard2.js"></script>

<script type="text/javascript" src="assets/new/admin/datatables/js/jquery.dataTables.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="assets/new/admin/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- <script src="assets/new/admin/developer_js/components-select2.js" type="text/javascript"></script> -->
<script type="text/javascript">
$(document).ready(function(){
  $('.select2').select2();

  $(document).on('click', '.allBoxes', function (e) {
    if($('.allBoxes').is(':checked')){
      $('.eachBox').prop('checked', true);
    }
    else{
      $('.eachBox').prop('checked', false);
    }
  });

});

function delete_record(obj, controller) {
  var url = $(obj).attr('href');
  swal({
    title: "Are you sure?",
    text: "Are you sure to perform this action",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if(willDelete){
      window.location.replace(url);
    }
  });
}

function delete_record_dt(obj) {
  var url = $(obj).attr('href');
  swal({
    title: "Are you sure?",
    text: "Are you sure to perform this action",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if(willDelete){
      window.location.replace(url);
    }
  });
}

</script>

</body>
</html>
