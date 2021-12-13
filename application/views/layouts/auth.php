<!DOCTYPE html>
<html lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Crypto ICO is a responsive modern &amp; clean cryptocurrency website landing page html with admin dashboard template , specially created for ICO Startup agencies and digital crypto currency investment website.">
    <meta name="keywords" content="crypto, ico, cryptocurrency, bitcoin, landing, admin, dashboard, template, modern, clean, responsive">
    <meta name="author" content="PIXINVENT">
    <base href="<?php echo base_url();?>">
    <title>Crypto ICO - Cryptocurrency Website Landing Page HTML Template</title>
    <link rel="apple-touch-icon" href="assets/public/theme-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/public/theme-assets/images/ico/favicon.ico">
    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,500,700" rel="stylesheet">
    <!--Font icons-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="assets/public/theme-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/public/theme-assets/fonts/themify/style.min.css">
    <link rel="stylesheet" type="text/css" href="assets/public/theme-assets/fonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" type="text/css" href="assets/public/theme-assets/vendors/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="assets/public/theme-assets/vendors/flipclock/flipclock.css">
    <link rel="stylesheet" type="text/css" href="assets/public/theme-assets/vendors/swiper/css/swiper.min.css">
    <!-- END VENDOR CSS-->
    <!-- END CRYPTO CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="assets/public/theme-assets/css/template-3d-graphics.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/public/assets/css/style.css">
    <!-- END Custom CSS-->

    <link href="assets/new/admin/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/new/admin/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript">
      var base_url = '<?php echo base_url();?>';
    </script>
    <script src="assets/new/admin/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<style type="text/css">
  .alert-minimalist{
    display: none !important;
  }
</style>
  </head>
  <body class=" 1-column   page-animated template-3g-graphics" data-menu-open="hover" data-menu="">
    <!-- Preloader | Comment below code if you don't want preloader-->
<div id="loader-wrapper">
    <svg viewbox=" 0 0 512 512" id="loader">
        <linearGradient id="loaderLinearColors" x1="0" y1="0" x2="1" y2="1">
            <stop offset="5%" stop-color="#28bcfd"></stop>
            <stop offset="100%" stop-color="#1d78ff"></stop>
        </linearGradient>        
        <g>
            <circle cx="256" cy="256" r="150" fill="none" stroke="url(#loaderLinearColors)" />
        </g>
        <g>
            <circle cx="256" cy="256" r="125" fill="none" stroke="url(#loaderLinearColors)" />
        </g>
        <g>
            <circle cx="256" cy="256" r="100" fill="none" stroke="url(#loaderLinearColors)" />
        </g>
        <g>
            <circle cx="256" cy="256" r="75" fill="none" stroke="url(#loaderLinearColors)" />
        </g>
        <circle cx="256" cy="256" r="60" fill="url(#loaderImage)" stroke="none" stroke-width="0" />

        <!-- Change the preloader logo here -->
        <defs>
            <pattern id="loaderImage" height="100%" width="100%" patternContentUnits="objectBoundingBox">
                <image href="assets/public/theme-assets/images/loader-logo.png" preserveAspectRatio="none" width="1" height="1"></image>
            </pattern>
        </defs>
    </svg>

    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!--/ Preloader --><nav class="vertical-social">
    <ul>
        <li><a href="#"><i class="fa fa-telegram" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-medium" aria-hidden="true"></i></a></li>
        <li><a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i></a></li>
        <li><a href="#"><i class="fa fa-github" aria-hidden="true"></i></a></li>
    </ul>
</nav>
    <!-- /////////////////////////////////// HEADER /////////////////////////////////////-->

    <!-- Header Start-->
    <header class="page-header">
      <!-- Horizontal Menu Start-->
      <nav class="main-menu static-top navbar-dark navbar navbar-expand-lg fixed-top mb-1"><div class="container">
    <a class="navbar-brand animated" data-animation="fadeInDown" data-animation-delay="1s" href="#head-area"><img src="assets/public/theme-assets/images/logo.png" alt="Crypto Logo"/><span class="brand-text"><span class="font-weight-bold">Crypto</span> ICO</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div id="navigation" class="navbar-nav ml-auto">
            <ul class="navbar-nav mt-1">
                <li class="nav-item animated" data-animation="fadeInDown" data-animation-delay="1.1s">
                    <a class="nav-link" href="<?php echo base_url();?>">Home</a>
                </li>
                <li class="nav-item animated" data-animation="fadeInDown" data-animation-delay="1.2s">
                    <a class="nav-link" href="<?php echo base_url('publicsite/about');?>">About</a>
                </li>
                <li class="nav-item animated" data-animation="fadeInDown" data-animation-delay="1.3s">
                    <a class="nav-link" href="<?php echo base_url('publicsite/service');?>">Service</a>
                </li>
                <li class="nav-item animated" data-animation="fadeInDown" data-animation-delay="1.4s">
                    <a class="nav-link" href="<?php echo base_url('publicsite/contact');?>">Contact</a>
                </li>
                <!-- <li class="dropdown show mr-2 px-2 animated" data-animation="fadeInDown" data-animation-delay="1.6s">
                    <a class="dropdown-toggle white" href="#" role="button" id="more" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                    <div class="dropdown-menu" aria-labelledby="more">
                        <a class="dropdown-item" href="index.html#mobile-app">App</a>
                        <a class="dropdown-item" href="index.html#team">Team</a>
                        <a class="dropdown-item" href="index.html#faq">FAQ</a>
                        <a class="dropdown-item" href="index.html#contact">Contact</a>
                        <a class="dropdown-item" href="template-404.html">404</a>
                        <a class="dropdown-item" href="template-inner-page-with-sidebar.html">Sample Page</a>
                    </div>
                </li> -->
            </ul>
            <span id="slide-line"></span>
            <form class="form-inline mt-2 mt-md-0">
                <a class="btn btn-sm btn-gradient-purple btn-glow my-2 my-sm-0 animated" data-animation="fadeInDown" data-animation-delay="1.8s" href="<?php echo base_url('sign-in');?>">Sign in</a>
            </form>&nbsp;&nbsp;&nbsp;
            <span id="slide-line"></span>
            <form class="form-inline mt-2 mt-md-0">
                <a class="btn btn-sm btn-gradient-purple btn-glow my-2 my-sm-0 animated" data-animation="fadeInDown" data-animation-delay="1.8s" href="<?php echo base_url('publicsite/signup');?>">Register</a>
            </form>
        </div>
    </div>
</div>
      </nav>
      <!-- /Horizontal Menu End-->
    </header>
    <!-- /Header End-->

    <!-- //////////////////////////////////// CONTAINER ////////////////////////////////////-->
    <div class="content-wrapper">
      <div class="content-body">
        <main><!-- Header: 3D Graphics -->
<section class="head-area" id="head-area" data-midnight="white">
    <div id="particles-js"></div>
    <div class="head-content container-fluid bg-gradient d-flex align-items-center">
        <div class="container">
            <div class="banner-wrapper">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12">
                        <div class="banner-content pt-5">
                            <h1 class="best-template animated" data-animation="fadeInUpShorter" data-animation-delay="1.5s">Crypto ICO is modern, clean and <br class="d-none d-xl-block">gradient ui ico most trending <br class="d-none d-xl-block">template of 2019</h1>
                            <h3 class="mb-4 d-block white animated" data-animation="fadeInUpShorter" data-animation-delay="1.6s">First decentralized marketing platform that allows <br class="d-none d-xl-block">merchants and affiliates.</h3>
                            <!-- <div class="mt-5">
                                <a href="#token-sale-mobile-app" class="btn btn-lg btn-gradient-purple btn-glow mr-2 animated" data-animation="fadeInUpShorter" data-animation-delay="1.7s">Purchase Token</a>
                                <a href="#whitepaper" class="btn btn-lg btn-gradient-purple btn-glow animated" data-animation="fadeInUpShorter" data-animation-delay="1.8s">Whitepaper</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 move-first">
                        <div class="crypto-3d-graphic animated" data-animation="fadeInUpShorter" data-animation-delay="1.7s">
                            <img src="assets/public/theme-assets/images/banner-graphic.png" class="graphic-3d-img mx-auto d-block" alt="CICO">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ Header: 3D Graphics -->

{_yield}

        </main>
      </div>
    </div>
    <!-- //////////////////////////////////// FOOTER ////////////////////////////////////-->


<!-- <footer class="footer static-bottom  footer-custom-class" data-midnight="white"><div class="container">
  <div class="footer-wrapper">
    <div class="row">
      <div class="col-md-4">
        <div class="about">
          <div class="title animated" data-animation="fadeInUpShorter" data-animation-delay="0.2s">
            <img src="assets/public/theme-assets/images/logo.png" alt="Logo">
            <span class="logo-text">Crypto ICO</span>
          </div>
          <div class="about-text animated" data-animation="fadeInUpShorter" data-animation-delay="0.3s">
            <p class="grey-accent2">Crypto Ico is a blockchain platform that allows users to make payments, create and request loans and crowdfund projects.</p>
          </div>
          <ul class="social-buttons list-unstyled mb-5">
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="0.4s"><a href="#" title="Facebook" class="btn font-medium"><i class="ti-facebook"></i></a></li>
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="0.5s"><a href="#" title="Twitter" class="btn font-medium"><i class="ti-twitter-alt"></i></a></li>
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="0.6s"><a href="#" title="LinkedIn" class="btn font-medium"><i class="ti-linkedin"></i></a></li>
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="0.7s"><a href="#" title="GitHub" class="btn font-medium"><i class="ti-github"></i></a></li>
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="0.8s"><a href="#" title="Pintrest" class="btn font-medium"><i class="ti-pinterest"></i></a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="links">
          <h5 class="title animated" data-animation="fadeInUpShorter" data-animation-delay="0.5s">Useful Links</h5>
          <ul class="useful-links float-left mr-5">
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="0.6s"><a href="#">What is ICO</a></li>
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="0.7s"><a href="#">Solutions</a></li>
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="0.8s"><a href="#">Whitepaper </a></li>
          </ul>
          <ul class="useful-links">
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="0.9s"><a href="#">Roadmap</a></li>
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="1.0s"><a href="#">Team</a></li>
            <li class="animated" data-animation="fadeInUpShorter" data-animation-delay="1.1s"><a href="#">Sign in</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4">
        <div class="feed">
          <h5 class="title animated" data-animation="fadeInUpShorter" data-animation-delay="0.8s">Twitter Feed</h5>
          <div class="tweets">
            <span class="animated" data-animation="fadeInUpShorter" data-animation-delay="1.0s">More about our most powerful theme Crypto ICO : https://t.co/JHBAS345</span>
            <span class="animated" data-animation="fadeInUpShorter" data-animation-delay="1.2s">More infotamation about CIC Coin : https://t.co/JHSD34JHB</span>
          </div>
        </div>
      </div>
    </div>
    <div class="copy-right mx-auto text-center">
      <span class="copyright">Copyright &copy; 2019, Crypto ICO. Template Designed by <a href="http://pixinvent.com" title="pixinvent" class="white">Pixinvent</a></span>
    </div>
  </div>
</div>
</footer> -->



    <!-- BEGIN VENDOR JS-->
    <script src="assets/public/theme-assets/vendors/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="assets/public/theme-assets/vendors/flipclock/flipclock.min.js"></script>
    <script src="assets/public/theme-assets/vendors/swiper/js/swiper.min.js"></script>
    <script src="assets/public/theme-assets/vendors/particles.min.js"></script>
    <script src="assets/public/theme-assets/vendors/waypoints/jquery.waypoints.min.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME JS-->
    <script src="assets/public/theme-assets/js/theme.js"></script>
    <script src="assets/public/theme-assets/js/sales-notification.js"></script>
    <!-- END CRYPTO JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="assets/public/theme-assets/js/scripts/particles-type1.js"></script>
    <script src="assets/public/theme-assets/js/scripts/particles-type12.js"></script>
    <!-- END PAGE LEVEL JS-->

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/new/admin/select2/js/select2.full.min.js" type="text/javascript"></script>
    <!-- <script src="assets/new/admin/developer_js/components-select2.js" type="text/javascript"></script> -->
    <script type="text/javascript">
    $(document).ready(function(){
      $('.select2').select2();
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