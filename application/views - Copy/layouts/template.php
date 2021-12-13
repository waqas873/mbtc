<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <title>Qnet.net</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <base href="<?php echo base_url();?>">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="assets/layouts/layout/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/my.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/dt-1.10.18/datatables.min.css"/>

    <script>
      var base_url = '<?php echo base_url(); ?>';
  </script>

  <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>

  <script src="assets/admin/js/sfs_functions.js" type="text/javascript"></script>
  <script type="text/javascript" src="assets/bootbox/bootbox.min.js"></script>
  <link href="assets/css/icons.css" rel="stylesheet" type="text/css"/>
  <style>
    #overlay{
        position: fixed;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        background:black;
        opacity:0.7;
        pointer-events: none;
        z-index: 99999;
    }
    #centerdiv{
        height:300px;
        width: 400px; 
        padding:20px; 
        background: white;
        color: black;
        font-weight: bold;
        text-align: center;
        margin:15% auto;
        opacity: 1;
        box-shadow:2px 2px 5px white ;
    }
    #centerdiv h2{
        font-weight: bolder;
        line-height: 40px;
        margin-top: 50px;
    }
    .shadow{
     -moz-box-shadow:    inset 0 0 10px #000000 !important;
     -webkit-box-shadow: inset 0 0 10px #000000 !important;
     box-shadow:         inset 0 0 5px #000000 !important;
 }
 .table_text_shadow{
    font-size: 16px;
}
.table_heading{
    font-size: 16px;
}

@media (max-width: 767px){
  .page-content-wrapper .page-content .page-title{
    height: 80px;
}
}



@media (max-width: 580px){
 .page-content-wrapper .page-content .page-title{
    height: 100px;
}
}

.loader{
    height: 100%;
    width: 100%;
    position: absolute;
    background-color: #ffff;
    z-index: 11111111111;
}
.loader_img{
    position: absolute;
    top: 48%;
    left: 48%;
    height: 100px;
}
</style>
</head>

<!-- END HEAD -->

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <div class="loader">
        <img class="loader_img" src="<?php echo base_url().'assets/loader.gif'; ?>">
    </div>
    <noscript>
        <div id="overlay">
            <div id="centerdiv"><h2>You Must Enable Javascript To Run This Website!!</h2></div>
        </div>
    </noscript>
    <div class="page-wrapper">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                <div class="page-logo">
                    <a href="#">
                     <!-- <h2 style="color:white;margin-top: 9px;">QNet</h2> -->
                      <img src="publicsite\images/logo1.png" alt="logo" class="logo-default" /> </a>
                     <div class="menu-toggler sidebar-toggler">
                        <span></span>
                    </div>
                </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                    <span></span>
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN TOP NAVIGATION MENU -->
                <div class="top-menu">
                    <ul class="nav navbar-nav pull-right">
                        <?php if ($this->session->userdata('role') == 'user') {
                            //$btc_rate = get_current_btcusd();
                            ?>
                            <?php if(isset($btc_rate) && !empty($btc_rate)) { ?>
                                <li style="color:white;">
                                    <div class="text_shadow" style="background: #36c6d3;margin: 9px 10px;padding: 5px;font-size: 16px;border-radius: 15px !important;">Bitcoin Rate: 
                                        <?php  
                                        echo $btc_rate." USD"; 
                                        ?>
                                    </div>
                                </li>
                            <?php } ?>
                            <li style="color:white;">
                                <div class="text_shadow" style="margin: 9px 10px;padding: 5px;font-size: 16px;border-radius: 15px !important;"> 
                                    <i class="flag-icon flag-icon-my mr-3" title="my" id="my"></i>  USER ID: <?php  echo $this->session->userdata('sponsor_code'); ?></div>
                            </li>
                        <?php } ?>
                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                        <!-- DOC: Apply "dropdown-dark" class after "dropdown-extended" to change the dropdown styte -->
                        <!-- DOC: Apply "dropdown-hoverable" class after below "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                        <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                <!-- <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="icon-bell"></i>
                        <span class="badge badge-default"> 7 </span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="external">
                            <h3>
                                <span class="bold">12 pending</span> notifications</h3>
                            <a href="page_user_profile_1.html">view all</a>
                        </li>
                        <li>
                            <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">just now</span>
                                        <span class="details">
                                            <span class="label label-sm label-icon label-success">
                                                <i class="fa fa-plus"></i>
                                            </span> New user registered. </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <span class="time">9 days</span>
                                        <span class="details">
                                            <span class="label label-sm label-icon label-danger">
                                                <i class="fa fa-bolt"></i>
                                            </span> Storage server failed. </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <?php 
                        $userinfo = user_info($this->session->userdata('id'));
                        $profilePic = (!empty($userinfo['profile_pic']))?$userinfo['profile_pic']:'user_user.jpg';
                        ?>
                        <img alt="" class="img-circle" src="assets/images/<?php echo $profilePic; ?>" />
                        <span class="username username-hide-on-mobile"> <?php echo ucwords($this->session->userdata("username")); ?> </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                       <!--  <li>
                            <a href="page_user_profile_1.html">
                                <i class="icon-user"></i> My Profile </a>
                            </li> -->
                            <li>
                                <a href="<?php echo base_url('user_childs/update'); ?>">
                                    <i class="icon-user"></i> My Profile
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="<?php echo base_url('user_childs/change_password'); ?>">
                                    <i class="icon-lock"></i> Change Password
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="<?php echo base_url('Login/logout'); ?>">
                                    <i class="icon-power"></i> Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                    <!-- BEGIN QUICK SIDEBAR TOGGLER -->
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
               <!--  <li class="dropdown dropdown-quick-sidebar-toggler">
                    <a href="javascript:;" class="dropdown-toggle">
                        <i class="icon-logout"></i>
                    </a>
                </li> -->
                <!-- END QUICK SIDEBAR TOGGLER -->
            </ul>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"> </div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                <!-- END SIDEBAR TOGGLER BUTTON -->
                <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
                
                <style type="text/css">
                    .fa_icon{
                        font-size: 20px !important;
                        /*margin-top: 5px;*/
                    }
                    .sb_items{
                        width: 100%;
                        text-align: center;
                    }
                    /*.title_1{
                        text-align: center;
                        margin-top: 2px;
                        font-size: 18px;
                        margin-bottom: 3px;
                        }*/
                        .title_size{
                            text-align: center;
                            font-size: 18px;
                        }
                        .sub_title_size{
                            font-size: 16px;
                        }
                        .plb{
                            background-color: gray !important;
                        }
                        .login_user{
                            width: 100%;
                            text-align: center;
                            margin-top: 50px;
                            margin-bottom: 30px !important;
                        }
                        .user_icon{
                            color: white;
                            font-size: 100px !important;
                        }
                        .active_status{
                            width: 10px;
                            height: 10px;
                            background-color: red;
                            float: right;
                        }
                        .abcdef{
                            background: #9D9D9D9D !important;
                        }

                        .page-sidebar{
                            background-color: #012b4d !important;
                        }

                        .page-header.navbar,.page-sidebar,.page-content-white .page-title,.page-bars{
                            background-color: #055205 !important;
                        }

                        .i_c1{
                           background: #000000 !important;
                           padding: 0px;
                           /*box-shadow: -8px 8px 23px #6b6b6b !important;*/
                           width: 100% !important;
                           margin: 0 auto !important;
                           border: 0 !important;
                           margin-bottom: 20px !important;
                           position: relative;
                           padding: 20px 0px;
                       }

                       .dashboard-stat.green{
                        background-color: #34a51f78 !important;
                        box-shadow: 0 34px 20px -22px rgb(0, 0, 0) !important;
                        border: 10px solid #ffffff69;
                    }

                    .dashboard-stat.red {
                        background-color: #e7313d !important;
                        box-shadow: 0 34px 20px -22px rgb(0, 0, 0) !important;
                        border: 10px solid #8a0f18;
                    }

                    .dashboard-stat.blue {
                      background-color: #0586df54 !important;
                      box-shadow: 0 34px 20px -22px rgb(0, 0, 0) !important;
                      border: 10px solid #ffffff69;
                  }

                  .dashboard-stat.yellow {
                    background-color: #d697008f !important;
                    box-shadow: 0 34px 20px -22px rgb(0, 0, 0) !important;
                    border: 10px solid #ffffff69;
                }

                .dashboard-stat.purple {
                 background-color: #7f17ab !important;;
                 box-shadow: 0 34px 20px -22px rgb(0, 0, 0) !important;
                 border: 10px solid #520872;
             }

             .well{
              background-color: #0c1a24 !important;
          }

          .page-title{
            background: #012b4d !important;
            text-shadow: 0px 5px 7px black !important;
            box-shadow: 0px 6px 15px #7e7e7e !important;
        }

        .page-content-white .page-title small{
            color: #fff !important;
        }

        .page-container{
            background-color: #f5f5f5 !important;

        }

        .page-sidebar .page-sidebar-menu>li.active.open>a, .page-sidebar .page-sidebar-menu>li.active>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.active.open>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.active>a{
            background: #078cd6 !important;
            box-shadow: 0px 6px 12px black;
        }

        .user_info .user_user{
           color: #078cd6 !important;
       }

       .user_info .gray_shadow{
           color: #fff;
       }

       .box_style{
        box-shadow: 0 27px 20px -22px rgb(0, 0, 0) !important;
    }

    #buttom_price_box .col-md-2:nth-child(2) div{
     background-color: #126161 !important;
     box-shadow: 0 27px 20px -26px rgb(0, 0, 0) !important;
 }

 #buttom_price_box .col-md-2:nth-child(1) div{
     background-color: #e7313d !important;
     box-shadow: 0 27px 20px -26px rgb(0, 0, 0) !important;
 }

 #buttom_price_box .col-md-2:nth-child(1) div{
     background-color: #e7313d !important;
     box-shadow: 0 27px 20px -26px rgb(0, 0, 0) !important;
 }

 #buttom_price_box .col-md-2:nth-child(3) div{
     background-color: #e7313d !important;
     box-shadow: 0 27px 20px -26px rgb(0, 0, 0) !important;
 }

 #buttom_price_box .col-md-2:nth-child(4) div{
     background-color: #5757d4 !important;
     box-shadow: 0 27px 20px -26px rgb(0, 0, 0) !important;
 }

 #buttom_price_box .col-md-2:nth-child(5) div{
     background-color: #126161 !important;
     box-shadow: 0 27px 20px -26px rgb(0, 0, 0) !important;
 }

 #buttom_price_box .col-md-2:nth-child(6) div{
     background-color: #ce6700 !important;
     box-shadow: 0 27px 20px -26px rgb(0, 0, 0) !important;
 }

 .page-footer{
    background-color: #0c1a21 !important;
}

.page-sidebar .page-sidebar-menu>li.open>a, .page-sidebar .page-sidebar-menu>li:hover>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.open>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li:hover>a{
    background-color: #0c1a25 !important;
}

.page-sidebar .page-sidebar-menu .sub-menu>li>a:hover{
 background-color: #078cd65c !important;
}

#buttom_price_box h3{
    color: #078cd6;
}

.portlet.light{
        background-image: linear-gradient(to right, #129a12,#6ebb6b,#129a12,#6ebb6b)!important;
    /*background-color: #012b4d !important;*/
    box-shadow: -8px 8px 23px #6b6b6b !important;

}

.portlet.light.bordered{
    border: 0 !important;
}

.portlet-body .form-body .form-group label{
    color: #feffff !important;
}

.font-red-sunglo {
 color: #feffff!important;
}

#sample_3 thead .table_text_shadow td{
    background-color: red !important;
}
.page-bar {
        background-color: #008000!important;
      /*background-image: linear-gradient(to right, #129a12,#6ebb6b,#129a12,#6ebb6b)!important;*/
}

.tab-custom.tab-custom-three li{
    width: 100% !important;
}

#buttom_price_box{
    overflow: hidden;
}

#buttom_price_box .col-md-2>div{
    height: 280px !important;

}  

.page-sidebar .page-sidebar-menu>li.active.open>a, .page-sidebar .page-sidebar-menu>li.active>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.active.open>a, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li.active>a{
 background-color:#008000 !important;
}

.page-container{
    background-color:#f5f5f5 !important;
}


.desc{
  font-size: 22px !important;
}
@media (max-width: 1350px) {
    .desc{
       font-size: 17px !important;
   }   
}

@media (max-width: 1200px) {
    .desc{
       font-size: 13px !important;
   }

   #buttom_price_box .col-md-2 div{
       min-width:110%;
       overflow: hidden;
       padding: 0;

   }  

} 

@media (max-width: 992px) {
   #buttom_price_box {
    padding-right: 25px !important;
}

.btn.btn-outline.green{
    margin-top: 10px !important;
}
}

@media (max-width: 500px) {
   .page-bar{
    height: 100px !important;
}
}

.page-header-fixed .page-container{
    background: #055205 !important;
}

.page-header.navbar .page-logo .logo-default {
    margin: 18px 0 0;
    width: 140px;
    position: relative;
    top: -14px;
}

.page-sidebar .page-sidebar-menu>li, .page-sidebar-closed.page-sidebar-fixed .page-sidebar:hover .page-sidebar-menu>li{
    border-top: 1px solid #ffffff !important;
   
</style>

<div class="login_user _vdsdvdfg" style="overflow: hidden!important; text-align: center!important;">
    <?php if ($this->session->userdata('role') == "user") {
        $user_info = user_info($this->session->userdata('id'));
        $profile_pic = (!empty($user_info['profile_pic']))?$user_info['profile_pic']:'user_user.jpg';
        ?>
        <img src="assets/images/<?php echo $profile_pic;?>" width="100" height="100" style="border-radius: 50px !important;">
        <span class="badge" style="position: relative;top: 30px; background-color: <?php echo (if_package_buy($this->session->userdata('id')))?"#ff0000":"red"; ?>"> &nbsp;&nbsp;</span>
    <?php } else { ?>
        <i class="fa fa-user user_icon"></i> &nbsp;
    <?php } ?>
    <br/>
    <div style="color:white;font-size: 12px;margin-top: 10px; text-align: center;"> <span style="font-size:20px;font-weight: 600;">Welcome</span><br> <?php echo ucwords($this->session->userdata('fullname')); ?></div>
</div>

                <!-- <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="dashboard")?"active":""; ?>">
                    <a href="<?php echo base_url("User/Userdashboard"); ?>" class="nav-link nav-toggle">
                        <div class="sb_items">
                            <i class="icon-home fa_icon"></i>
                        </div>
                        <div class="title_1">
                            <span class="title">Dashboard</span>
                            <span class="selected"></span>
                        </div>
                    </a>
                </li> -->

                <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="dashboard")?"active":""; ?>">
                    <a href="<?php echo base_url("User/Userdashboard"); ?>" class="nav-link nav-toggle">
                        <i class="icon-home fa_icon"></i>
                        <span class="title title_size text_shadow_2">Dashboard</span>
                        <span class="selected"></span>
                        <!-- <span class="arrow open"></span> -->
                    </a>
                </li>

                <?php if ($this->session->userdata('role') == "admin") { ?>

                    <li class="nav-item start <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="packages" || $this->selected_tab=="all_packages" || $this->selected_tab=="rejected_packages" || $this->selected_tab=="pending_packages" || $this->selected_tab=="purchased_packages" || $this->selected_tab=="upu") )?"active":""; ?>">
                        <a href="javascript::" class="nav-link nav-toggle">
                            <i class="fa fa-database fa_icon"></i>
                            <span class="title text_shadow_2 title_size">Packages</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="packages")?"active":""; ?>">
                                <a href="<?php echo base_url('packages/index'); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-database fa_icon"></i>
                                    <span class="title sub_title_size text_shadow_2">Manage Packages</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="all_packages")?"active":""; ?>">
                                <a href="<?php echo base_url('user_packages/index/3/'); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-database fa_icon"></i>
                                    <span class="title sub_title_size text_shadow_2">Purchased Packages</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <!-- <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="purchased_packages")?"active":""; ?>">
                                <a href="<?php echo base_url('user_packages/index/1/'); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-shopping-cart fa_icon"></i>
                                    <span class="title sub_title_size text_shadow_2">Purchased Packages</span>
                                        <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="rejected_packages")?"active":""; ?>">
                                <a href="<?php echo base_url('user_packages/index/2/'); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-trash fa_icon"></i>
                                    <span class="title sub_title_size text_shadow_2">Rejected Packages</span>
                                        <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="pending_packages")?"active":""; ?>">
                                <a href="<?php echo base_url('user_packages/index/0/'); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-shopping-cart fa_icon"></i>
                                    <span class="title sub_title_size text_shadow_2">Purchase Requests</span>
                                        <span class="selected"></span>
                                </a>
                            </li> -->
                            <!-- <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="upu")?"active":""; ?>">
                                <a href="<?php echo base_url('user_packages_upgrade/index/'); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-level-up fa_icon"></i>
                                    <span class="title sub_title_size text_shadow_2">Upgrade Requests</span>
                                        <span class="selected"></span>
                                    
                                </a>
                            </li> -->
                        </ul>
                    </li>

                    <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="users")?"active":""; ?>">
                        <a href="<?php echo base_url("Users/index/"); ?>" class="nav-link nav-toggle">
                            <i class="fa fa-users fa_icon"></i>
                            <span class="title text_shadow_2 title_size">Users Management</span>
                            <span class="selected"></span>
                            
                        </a>
                    </li>

                    <!-- <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="withdraws")?"active":""; ?>">
                        <a href="<?php echo base_url("withdraws/index/"); ?>" class="nav-link nav-toggle">
                            <i class="fa fa-shekel fa_icon"></i>
                            <span class="title text_shadow_2 title_size">Withdraws</span>
                                <span class="selected"></span>
                            
                        </a>
                    </li> -->

                    <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="payment_history")?"active  abcdef":""; ?>">
                        <a href="<?php echo base_url('payment/admin_history'); ?>" class="nav-link ">
                            <i class="fa fa-money"></i>
                            <span class="title sub_title_size text_shadow_2">Payment History</span>
                            <span class="selected"></span>
                        </a>
                    </li>

                    <li class="nav-item start <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="withdraw_limits" || $this->selected_tab=="rejected_withdraws" || $this->selected_tab=="pending_withdraws" || $this->selected_tab=="approved_withdraws" ) )?"active":""; ?>">
                        <a href="javascript::" class="nav-link nav-toggle">
                            <i class="fa fa-shekel fa_icon"></i>
                            <span class="title text_shadow_2 title_size">Withdraws</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="withdraw_limits")?"active":""; ?>">
                                <a href="<?php echo base_url('withdraws/withdraw_limits'); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-shekel "></i>
                                    <span class="title sub_title_size text_shadow_2">Manage Limits</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="pending_withdraws")?"active":""; ?>">
                                <a href="<?php echo base_url("withdraws/index/user/0/"); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-shekel "></i>
                                    <span class="title sub_title_size text_shadow_2">Pending Withdraws</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="approved_withdraws")?"active":""; ?>">
                                <a href="<?php echo base_url("withdraws/index/user/1/"); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-shekel "></i>
                                    <span class="title sub_title_size text_shadow_2">Approved Withdraws</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="rejected_withdraws")?"active":""; ?>">
                                <a href="<?php echo base_url("withdraws/index/user/2/"); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-trash "></i>
                                    <span class="title sub_title_size text_shadow_2">Rejected Withdraws</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="user_rewards")?"active":""; ?>">
                        <a href="<?php echo base_url("user_rewards/index/"); ?>" class="nav-link nav-toggle">
                            <i class="fa fa-trophy"></i>
                            <span class="title text_shadow_2 title_size">Users Rewards</span>
                                <span class="selected"></span>
                        </a>
                    </li> -->

                    <li class="nav-item start <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="rewards" || $this->selected_tab=="awarded_rewards" || $this->selected_tab=="pending_rewards") )?"active":""; ?>">
                        <a href="javascript::" class="nav-link nav-toggle">
                            <i class="fa fa-trophy"></i>
                            <span class="title text_shadow_2 title_size">Rewards</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="rewards")?"active abcdef":""; ?>">
                                <a href="<?php echo base_url("rewards/index/"); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-trophy"></i>
                                    <span class="title sub_title_size text_shadow_2">Manage Rewards</span>
                                    <span class="selected"></span>
                                    <!-- <span class="arrow open"></span> -->
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="awarded_rewards")?"active  abcdef":""; ?>">
                                <a href="<?php echo base_url('user_rewards/admin_index/Bc4hJqTL'); ?>" class="nav-link ">
                                    <i class="fa fa-trophy"></i>
                                    <span class="title sub_title_size text_shadow_2">Awarded Rewards</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="pending_rewards")?"active  abcdef":""; ?>">
                                <a href="<?php echo base_url('user_rewards/admin_index/j6YgflOvD'); ?>" class="nav-link ">
                                    <i class="fa fa-trophy"></i>
                                    <span class="title sub_title_size text_shadow_2">Pending Rewards</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="news")?"active":""; ?>">
                        <a href="<?php echo base_url("news/index/"); ?>" class="nav-link nav-toggle">
                            <i class="fa fa-newspaper-o fa_icon"></i>
                            <span class="title text_shadow_2 title_size">News</span>
                            <span class="selected"></span>
                            
                        </a>
                    </li>

                <?php } ?>
                
                <?php if ($this->session->userdata('role') == "user") { ?>

                    <li class="nav-item start  <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="all_users" || $this->selected_tab=="right_users" || $this->selected_tab=="left_users" || $this->selected_tab=="add_user" || $this->selected_tab=="tree_view") )?"active":""; ?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="fa fa-group fa_icon"></i>
                            <span class="title title_size text_shadow_2">Team Detail</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="add_user")?"active abcdef":""; ?>">
                                <a href="<?php echo base_url("user_childs/add"); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-user"></i>
                                    <span class="title sub_title_size text_shadow_2">Register</span>
                                    <span class="selected"></span>
                                    <!-- <span class="arrow open"></span> -->
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="all_users")?"active  abcdef":""; ?>">
                                <a href="<?php echo base_url('user_childs/index'); ?>" class="nav-link ">
                                    <i class="fa fa-users"></i>
                                    <span class="title sub_title_size text_shadow_2">All Team</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="right_users")?"active  abcdef":""; ?>">
                                <a href="<?php echo base_url('user_childs/index/right'); ?>" class="nav-link ">
                                    <i class="fa fa-user"></i>
                                    <span class="title sub_title_size text_shadow_2">Right Members</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="left_users")?"active abcdef":""; ?>">
                                <a href="<?php echo base_url('user_childs/index/left'); ?>" class="nav-link ">
                                    <i class="fa fa-user"></i>
                                    <span class="title sub_title_size text_shadow_2">Left Members</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="tree_view")?"active abcdef":""; ?>">
                                <a href="<?php echo base_url("User/tree_view"); ?>" class="nav-link ">
                                    <i class="fa fa-tree"></i>
                                    <span class="title sub_title_size text_shadow_2">Tree View</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item start  <?php echo ( isset($this->selected_tab) && ($this->selected_tab=="bitcoin_payment" || $this->selected_tab=="payment_history") )?"active":""; ?>">
                        <a href="javascript:;" class="nav-link nav-toggle">
                            <i class="fa fa-money fa_icon"></i>
                            <span class="title title_size text_shadow_2">Bitcoin Payments</span>
                            <span class="selected"></span>
                            <span class="arrow open"></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="bitcoin_payment")?"active abcdef":""; ?>">
                                <a href="<?php echo base_url("Payment/bitcoin"); ?>" class="nav-link nav-toggle">
                                    <i class="fa fa-money"></i>
                                    <span class="title sub_title_size text_shadow_2">Send Payment</span>
                                    <span class="selected"></span>
                                    <!-- <span class="arrow open"></span> -->
                                </a>
                            </li>
                            <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="payment_history")?"active  abcdef":""; ?>">
                                <a href="<?php echo base_url('payment/history'); ?>" class="nav-link ">
                                    <i class="fa fa-money"></i>
                                    <span class="title sub_title_size text_shadow_2">Payment History</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php if(if_package_buy($this->session->userdata('id'))) { ?>
                        <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="upu")?"active":""; ?>">
                            <a href="<?php echo base_url("user_packages_upgrade/add/"); ?>" class="nav-link nav-toggle">
                                <i class="fa fa-level-up fa_icon"></i>
                                <span class="title title_size text_shadow_2">Upgrade Package</span>
                                <span class="selected"></span>
                                <!-- <span class="arrow open"></span> -->
                            </a>
                        </li>
                    <?php } ?>

                    <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="withdraws")?"active":""; ?>">
                        <a href="<?php echo base_url("withdraws/index/"); ?>" class="nav-link nav-toggle">
                            <i class="fa fa-shekel fa_icon"></i>
                            <span class="title title_size text_shadow_2">Withdraws</span>
                            <span class="selected"></span>
                            <!-- <span class="arrow open"></span> -->
                        </a>
                    </li>

                    <li class="nav-item start <?php echo activate_sub_menu('User/Rewards'); ?>">
                        <a href="<?php echo base_url("user_rewards/user_index"); ?>" class="nav-link nav-toggle">
                            <i class="fa fa-trophy fa_icon"></i>
                            <span class="title title_size text_shadow_2">Rewards</span>
                            <span class="selected"></span>
                        </a>
                    </li>

                    <li class="nav-item start <?php echo (isset($this->selected_tab) && $this->selected_tab=="news")?"active":""; ?>">
                        <a href="<?php echo base_url("news/user_index/"); ?>" class="nav-link nav-toggle">
                            <i class="fa fa-newspaper-o fa_icon"></i>
                            <span class="title text_shadow_2 title_size">News</span>
                            <span class="selected"></span>
                            
                        </a>
                    </li>

                    <li class="nav-item start <?php echo activate_sub_menu('User/Rewards'); ?>">
                        <a href="<?php echo base_url("support/index/"); ?>" class="nav-link nav-toggle">
                            <i class="fa fa-question fa_icon"></i>
                            <span class="title title_size text_shadow_2">Support</span>
                            <span class="selected"></span>
                        </a>
                    </li>

                <!-- <li class="nav-item start  <?php echo (activate_sub_menu('User/withdrawReq') != '' || activate_sub_menu('User/withdrawHis') != '' )?'active':'';?>">
                    <a href="javascript:;" class="nav-link nav-toggle">
                        <i class="icon-home"></i>
                        <span class="title">Withdraw</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start <?php echo activate_sub_menu('User/withdrawReq'); ?>">
                            <a href="<?php echo base_url('User/withdrawReq'); ?>" class="nav-link ">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Request Withdraw</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item start <?php echo activate_sub_menu('User/withdrawHis'); ?>">
                            <a href="<?php echo base_url('User/withdrawHis'); ?>" class="nav-link ">
                                <i class="icon-bar-chart"></i>
                                <span class="title">Withdraw History</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                    </ul>
                </li> -->

            <?php } ?>



        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN THEME PANEL -->

        <!-- END THEME PANEL -->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar shadow" style="background-color:#0782c6; ">
            <ul class="page-breadcrumb" style="float: left;">
                <li>
                    <a href="<?php echo base_url("User/Userdashboard"); ?>" style="color: #fff;">Home</a>
                    <i class="fa fa-circle" style="color:#fff;"></i>
                </li>
                <li>
                    <span style="color: #fff;">Dashboard</span>
                </li>
            </ul>
            <?php if ($this->session->userdata('role') == "user") { ?>
                <style type="text/css">
                    .marquee {
                      width: 500px;
margin: 0 auto;
white-space: nowrap;
overflow: hidden;
box-sizing: border-box;
float: left;
margin-left: 10px;
position: relative;
top: 11px;
                    }

                    .marquee span {
                      display: inline-block;
                      padding-left: 100%;
                      /* show the marquee just outside the paragraph */
                      animation: marquee 15s linear infinite;
                    }

                    .marquee span:hover {
                      animation-play-state: paused
                    }


                    /* Make it move */

                    @keyframes marquee {
                      0% {
                        transform: translate(0, 0);
                      }
                      100% {
                        transform: translate(-100%, 0);
                      }
                    }
                </style>

                <!-- <span class="marquee" style="position: relative;top: 11px;font-size: 15px;color: #fff;left: 20px;"><p></p></span> -->
                <li style="display: inline;">
                <p class="marquee">
                   <span>
                       Update old package and get 1% ROI daily based.start new package and get 1% ROI daily based.
                   </span>
                </p>
                </li>

                <span id="copy_link" style="float: right;position: relative;top: 11px;font-size: 15px;color: #fff;">
                    <?php echo base_url('login/signup/'.$this->session->userdata('sponsor_code'));?>
                    <a href="javascript::" onclick="CopyToClipboard('copy_link')" class="btn btn-warning btn-xs" style="position: relative;top: -1px;left: 5px;">Copy Link
                    </a>
                </span>
            <?php } ?>
            <script type="text/javascript">
                function CopyToClipboard(containerid) {
                    if (document.selection) { 
                        var range = document.body.createTextRange();
                        range.moveToElementText(document.getElementById(containerid));
                        range.select().createTextRange();
                        document.execCommand("copy"); 

                    } else if (window.getSelection) {
                        var range = document.createRange();
                        range.selectNode(document.getElementById(containerid));
                        window.getSelection().addRange(range);
                        document.execCommand("copy");
                        alert("Link copied");
                    }}
                </script>
               <!--  <div class="page-toolbar">
                    <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                        <i class="icon-calendar"></i>&nbsp;
                        <span class="thin uppercase hidden-xs"></span>&nbsp;
                        <i class="fa fa-angle-down"></i>
                    </div>
                </div> -->
            </div>
            <!-- END PAGE BAR -->
            <!-- BEGIN PAGE TITLE-->
            <br>
            {_yield}
            <!-- END PAGE TITLE-->
            <!-- END PAGE HEADER-->
            <!-- BEGIN DASHBOARD STATS 1-->

        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->

    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 2018 &copy; QNet
       <!--  <a target="_blank" href="http://keenthemes.com">Keenthemes</a> &nbsp;|&nbsp;
        <a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" title="Purchase Metronic just for 27$ and get lifetime updates for free" target="_blank">Purchase Metronic!</a> -->
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->
</div>
<!-- BEGIN QUICK NAV -->
<!--  -->
<!-- END QUICK NAV -->
<!--[if lt IE 9]>
<script src="assets/global/plugins/respond.min.js"></script>
<script src="assets/global/plugins/excanvas.min.js"></script> 
<script src="assets/global/plugins/ie8.fix.min.js"></script> 
<![endif]-->
<!-- BEGIN CORE PLUGINS -->


<script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
<script src="assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/ammap/ammap.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/ammap/maps/js/worldLow.js" type="text/javascript"></script>
<script src="assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
<script src="assets/global/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/horizontal-timeline/horizontal-timeline.js" type="text/javascript"></script>
<script src="assets/global/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/flot/jquery.flot.categories.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js" type="text/javascript"></script>
<script src="assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
<script src="assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
<script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>

<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/ju/dt-1.10.18/datatables.min.js"></script> -->

<script src="assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="assets/pages/scripts/table-datatables-responsive.js" type="text/javascript"></script>

<script src="assets/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>

<!-- END THEME LAYOUT SCRIPTS -->
<script>
    $(document).ready(function()
    {
        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });
    })
</script>
<!-- <script>
    $(document).ready(function(){
        $("#table").DataTable();
        $("#table2").DataTable();

    });
</script>
-->
<script>
    //withdraw validation
    $(document).ready(function(){
     $("#withdraw_alert").hide();
     $("#withdraw_btn").attr("disabled","disabled");
     $("[name='withdraw_amount']").on("keyup",function(){
        var amount = $("[name='withdraw_amount']").val();
        var min = parseInt($("#min").val());
        var max = parseInt($("#max").val());
        var user_balance = parseInt($("#user_bal").val());


        if (amount == "" || amount == NaN || amount == null) {
            $("p#error").html("");
            $("#withdraw_btn").attr("disabled","disabled");
        }
        else if (amount <= min) {
            $("p#error").html(`Please enter a amount greater than ${min}`);
            $("#withdraw_btn").attr("disabled","disabled");
        }else if (amount >= user_balance) {
            $("p#error").html(`Please enter a amount smaller than ${amount}. You don't have this much balance`);
            $("#withdraw_btn").attr("disabled","disabled");
        }
        else if (amount >= max) {
            $("p#error").html(`Please enter a amount less than ${max}`);
            $("#withdraw_btn").attr("disabled","disabled");
        }else{
            $("p#error").html("");
            $("#withdraw_btn").removeAttr("disabled","disabled");
        }
    });

     $("#withdraw_btn").on("click",function(){
        var attr = $("#withdraw_btn").attr("disabled");
        var amount = $("[name='withdraw_amount']").val();
        if (attr == "disabled") {
            return false;
        }else{
            $.ajax({
                method: "post",
                url : "<?php echo base_url('User/send_withdraw_req'); ?>",
                dataType : "json",
                data : {amount: amount},
                success :function(data){
                   $("[name='withdraw_amount']").val("");
                   $('#dataload').html("");
                   $('#dataload').load(document.URL +' #dataReload');
                   $("#withdraw_alert").slideDown("slow");       
               }   
           });
        }

    });




 });
</script>
<script src="assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script type="text/javascript">
  $('#dash3-chart-1').sparkline([5,8,7,10,9,10,8,6,4,6,8,7,6,8], {
    type: 'bar',
    height: '35',
    barWidth: '3',
    resize: true,
    barSpacing: '3',
    barColor: '#fd22ff'
});
  // chart 2
  $("#dash3-chart-2").sparkline([0,5,3,7,5,10,3,6,5,10], {
    type: 'line',
    width: '80',
    height: '40',
    lineWidth: '2',
    lineColor: '#fd3550',
    fillColor: 'transparent',
    spotColor: '#fff',
})

// chart 3
$("#dash3-chart-3").sparkline([2,3,4,5,4,3,2,3,4,5,6,5,4,3,4,5], {
    type: 'discrete',
    width: '75',
    height: '40',
    lineColor: '#0dceec',
    lineHeight: 22
});
$(window).on('load',function(){
    $('.loader').fadeOut('slow');
});
$('.menu-toggler.sidebar-toggler').click(function(){
    if($('body').hasClass('page-sidebar-closed') == false){
        $('._vdsdvdfg').css({'opacity':'0','pointer-events':'none'});
    }else{
        $('._vdsdvdfg').css({'opacity':'1','pointer-events':'default'});
    }
});
</script>
</body>
</html>