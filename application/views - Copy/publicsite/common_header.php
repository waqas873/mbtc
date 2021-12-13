
<div class="topbar">
	<div class="container">
		<div class="row">
			<div class="col-xs-6 col-sm-6">
				<ul class="social">
					<li><a href="#"><em class="fa fa-facebook"></em></a></li>
					<li><a href="#"><em class="fa fa-twitter"></em></a></li>
					<li><a href="#"><em class="fa fa-linkedin"></em></a></li>
					<li><a href="#"><em class="fa fa-google-plus"></em></a></li>
				</ul>
			</div>
			<div class="col-xs-6 col-sm-6 al-right">
				<ul class="top-nav">
					<li><a href="#">Help</a></li>
					<li><a href="#">Support</a></li>
					<li><a href="<?php echo base_url('publicsite/signup');?>">Login</a></li>
					<li><a href="<?php echo base_url('publicsite/signup');?>">Register</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<!-- End Topbar -->
<!-- Navbar -->
<div class="navbar navbar-primary">
	<div class="container relative">
		<!-- Logo -->
		<a class="navbar-brand" href="">
			<img class="logo logo-dark" alt="logo" src="publicsite/images/logo1.png">
			<img class="logo logo-light" alt="logo" src="publicsite/images/images _3.png">
		</a>
		<!-- #end Logo -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mainnav" aria-expanded="false">
				<span class="sr-only">Menu</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="quote-btn"><a class="btn" href="<?php echo base_url('publicsite/signup');?>"><img src="publicsite/images/sign_in_icon.png"></a>
                  
			 </div>
		</div>
		<!-- MainNav -->
		<nav class="navbar-collapse collapse" id="mainnav">
			<ul class="nav navbar-nav">
				<li>
					<a href="javascript::" class="dropdown-toggle">QNet <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url('publicsite/teams');?>">CEO & Team</a></li>
						<li><a href="<?php echo base_url('publicsite/advantages');?>">Advantages</a></li>
						<li><a href="<?php echo base_url('publicsite/road_map');?>">Road Map</a></li>
					</ul>
				</li>
				<li>
					<a href="<?php echo base_url('publicsite/about');?>" class="dropdown-toggle">About</a>
				</li>
				<li><a href="<?php echo base_url('publicsite/service');?>">Service</a></li>
				<li><a href="<?php echo base_url('publicsite/contact');?>">Contact</a></li>
				<li class="quote-btn hidden-xs hidden-sm"><a class="btn" href="<?php echo base_url('publicsite/signup');?>">Registration</a></li>
			</ul>
		</nav>
		<!-- #end MainNav -->
	</div>
</div>