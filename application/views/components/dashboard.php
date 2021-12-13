<style type="text/css">
.content-wrapper{
  margin-top: 0px !important;
}
.small-box-footer{
  background: linear-gradient(32deg, #FF4137, #FDC800);
}
.small-box {
    border-radius: 0px !important;
    box-shadow: 1px 2px 8px rgb(20, 49, 72);
}
.section.sm {
    background-image: url('<?php echo base_url();?>/assets/public/theme-assets/images/banner-graphic.png');
}
.small-box.bg-info{
  background: linear-gradient(180deg, #1A4C8B,#6F9FD7);
}
.small-box.bg-warning{
  background: linear-gradient(180deg, #FF4137, #FDC800);
}
.small-box.bg-success{
  background: linear-gradient(180deg, #B94BA1, #F04BA1);
}
.small-box.bg-danger{
  background: linear-gradient(180deg, #dc3545, #EC929A);
}
.small-box:hover {
    /*background: #838382;*/
    color: white;
    transform: scale(1.05);
    transition: transform 1s;
}
.timer{
  margin-bottom: 24px;
  box-shadow: 1px 2px 8px rgb(20, 49, 72);
  background: linear-gradient(180deg, #dc3545, #EC929A);
}
.my_link{
  margin-bottom: 24px;
box-shadow: 1px 2px 8px rgb(20, 49, 72);
background: linear-gradient(180deg, #1A4C8B,#6F9FD7);
height: auto;
min-height: 88px;
padding-top: 10px;
}
.my_link p{
  margin-left: 12px;
margin-bottom: 10px !important;
}
.lsl{
  font-size: 19px;
color: white;
}
</style>

<?php if($this->session->flashdata('success_message')) { ?>
  <script type="text/javascript">
    $(document).ready(function(){
      swal({
        title: "Success!",
        text: "<?php echo $this->session->flashdata('success_message'); ?>",
        icon: "success",
        button: "OK",
      });
    });
  </script>
<?php } ?>
<?php if($this->session->flashdata('error_message')) { ?>
  <script type="text/javascript">
    $(document).ready(function(){
      swal({
        title: "Warning!",
        text: "<?php echo $this->session->flashdata('error_message'); ?>",
        icon: "error",
        button: "OK",
      });
    });
  </script>
<?php } ?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">My Dashboard Stats</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('user/user_dashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<script type="text/javascript">
  $(document).ready(function(){
      setInterval(()=>{
        var us_time = new Date().toLocaleTimeString("en-US", {timeZone: "Europe/London"});
        $('#us_time').html(us_time);
      },1000);
  });
</script>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Info boxes -->

    <div class="row">
      <div class="col-md-12">
        <div class="my_link">
        <!-- <h1 class="page-title" style="font-weight: inherit;color: white;padding: 15px 10px;font-size: 20px;">
          My Referral Link</h1> -->
          
          <p><span class="lsl">Left Side Link: </span>
            <?php echo base_url('publicsite/signup/'.$user_dl['sponsor_code'].'/left');?>
            <a href="javascript::" onclick="CopyToClipboard('copy_link')" class="btn btn-warning btn-xs" style="position: relative;top: -1px;left: 5px;">Copy Link
            </a>
          </p>

          <p><span class="lsl">Right Side Link: </span>
            <?php echo base_url('publicsite/signup/'.$user_dl['sponsor_code'].'/right');?>
            <a href="javascript::" onclick="CopyToClipboard('copy_link')" class="btn btn-warning btn-xs" style="position: relative;top: -1px;left: 5px;">Copy Link
            </a>
          </p>
        
        </div>
      </div>
    </div>
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
          }
      }
    </script>

    <div class="row">
      <div class="col-md-12">
        <div class="timer">
        <h1 class="page-title" style="font-weight: inherit;color: white;padding: 15px 10px;font-size: 20px;"> User Dashboard
            <small>Total Earnings, Available Balance, Withdraws, Team Members</small>
            <span id="us_time" style="float: right;padding-right: 12px;"></span>
        </h1>
        </div>
      </div>
    </div>

    <?php 
      $user_info = user_info($this->session->userdata('id'));
      $parent_id = ($user_info['alpha_parent_id']>0)?$user_info['alpha_parent_id']:$user_info['parent_id'];
      $parent_info = user_info($parent_id);
      $package_detail = package_detail($this->session->userdata('id'));
      if(!empty($package_detail)){
         $pdate = $package_detail['up_created_at'];
      }
    ?>
<style type="text/css">
.box-icons{
    width: 45px;
    position: absolute;
    right: 14px;
    top: 23px;
}
.inner{
  color: black !important;
}
.inner h3{
  font-size: 25px !important;
}
@media only screen and (min-width: 320px) and (max-width: 768px){
  .inner{
    text-align: left;
  }
}
</style>
    
    <div class="row">
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <section class="section sm">
        <div class="small-box bg-info">
          <img src="assets/icons/trading_results.svg" class="box-icons">
            <div class="inner">
              <h3><?php  echo $user_dl['sponsor_code']; ?></h3>
              <p>My ID</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-bag"></i>
              <!-- <i class="ion ion-bag"></i> -->
            </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>

          </section>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-success">
          <img src="assets/icons/active_investment.svg" class="box-icons">
          <div class="inner">
            <h3>$<?php echo $total_investment;?><!-- <sup style="font-size: 20px">%</sup> --></h3>

            <p>Total Investment</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-warning">
          <img src="assets/icons/commission.svg" class="box-icons">
          <div class="inner">
            <h3>$<?php echo $user_balance;?></h3>
            <p>$USD Bank</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-danger">
          <img src="assets/icons/amount_withdrawn.svg" class="box-icons">
          <div class="inner">
            <h3>$<?php echo $total_withdraws;?></h3>
            <p>Total Withdraws</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-success">
          <img src="assets/icons/commission_recieved as_coin_purchase.svg" class="box-icons">
          <div class="inner">
            <h3>$<?php echo $total_earnings;?></h3>
            <p>Total Earning</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-info">
          <img src="assets/icons/main_wallet.svg" class="box-icons">
          <div class="inner">
            <h3>$<?php echo $wallet_balance;?></h3>
            <p>Wallet Amount</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <!-- <?php if(isset($remaining_days)) { ?>
      <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>$<?php echo $mining_balane;?></h3>
            <p>ROIIM (<?php echo $remaining_days;?> days Remaining) </p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <?php } ?> -->
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-info">
          <img src="assets/icons/my_team.svg" class="box-icons">
          <div class="inner">
            <h3>+<?php echo $total_users;?></h3>
            <p>Total Team Members</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-info">
          <img src="assets/icons/direct_partners.svg" class="box-icons">
          <div class="inner">
            <h3>+<?php echo $direct_members;?></h3>
            <p>Direct Members</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <?php if(isset($roi_percentage)) { ?>
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-success">
          <img src="assets/icons/roi.svg" class="box-icons">
          <div class="inner">
            <h3>$<?php echo $roi_amount;?><!-- <sup style="font-size: 20px">%</sup> --></h3>
            <p>ROI Percentage</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <?php } ?>
      <?php if(isset($package_active)) { ?>
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-warning">
          <img src="assets/icons/personal_sale.svg" class="box-icons">
          <div class="inner">
            <h3>$<?php echo $binary_recieved;?></h3>
            <p>Binary Recieved</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-danger">
          <img src="assets/icons/amount_in.svg" class="box-icons">
          <div class="inner">
            <h3>$<?php echo $roi_recieved;?></h3>
            <p>ROI Recieved</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-success">
          <img src="assets/icons/structure_sale.svg" class="box-icons">
          <div class="inner">
            <h3>$<?php echo $referal_bonus;?><!-- <sup style="font-size: 20px">%</sup> --></h3>
            <p>Referal Bonus</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->

      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-info">
          <img src="assets/icons/lifetime_roi.svg" class="box-icons">
          <div class="inner">
            <h3>
              <?php 
              $ppdate = '';
              if(!empty($pdate)){
                $pdate = explode(' ', $pdate);
                $ppdate = $pdate[0];
              }
              echo $ppdate;
              ?>
            </h3>
            <p>Joining Date</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-sm-12">
        <!-- small box -->
        <div class="small-box bg-danger">
          <img src="assets/images/<?php echo $package_detail['package_image'];?>" class="box-icons">
          <div class="inner">
            <h3><?php echo (!empty($package_detail['package_name']))?$package_detail['package_name']:"None" ;?></h3>
            <p>My Current Plan</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="javascript::" class="small-box-footer"></a>
        </div>
      </div>
      <!-- ./col -->

      <?php } ?>
    </div>

<?php if(isset($packages) && !empty($packages)) { ?>
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Available Packages</h5>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <div class="row news-block">
              <?php 
                foreach ($packages as $key => $package) {
                  $tax = round((int)$package['package_min_amount']*(int)$package['package_fees']/100);
                  $total = (int)$package['package_min_amount']+$tax;
              ?>
              <div class="col-sm-4">
                <div class="hexa_design">
                    <div class="in-client-grid">
                        <div class="icon-box client-big">
                            <h2 class="hexa_text"><?php echo $package['package_name']; ?></h2>
                            <h3>MIN - $<?php echo $package['package_min_amount']; ?></h3>
                            <h3>MAX - $<?php echo $package['package_max_amount']; ?></h3>
                            <h3>ROI - <?php echo $package['package_roi']; ?>%</h3>
                            <h3>FEE - $<?php echo $package['package_fees']; ?></h3>
                            <a href="javascript::" rel="<?php echo $package['package_id']; ?>" class="btn btn-warning buy_now buy_package">Buy Now</a>
                        </div>
                    </div>
                </div>
              </div>
              <?php } ?>
            </div>
            

<style type="text/css">
.news-block {
    padding-bottom: 50px !important;
}
.hexa_design {
    margin: auto;
    width: 75%;
    margin-bottom: 45px;
}
.in-client-grid {
    display: inline-block;
    padding: 20px;
    width: 100%;
    vertical-align: middle;
    position: relative;
    top: -71px;
}
.icon-box {
    margin: 50px 0;
}
.client-big {
    position: relative;
    width: 200px;
    height: auto;
    background-color: #26718F !important;
    box-shadow: 0 0 20px rgba(0,0,0,.25);
    border-radius: 7px;
    top: 103px;
    left: -15px;
    text-align: center;
    padding-bottom: 35px;
}
.client-big, .client-small {
    transition: transform .3s ease;
}
.client-big::before {
    content: "";
    position: absolute;
    width: 105.36px;
    height: 61.36px;
    -webkit-transform: scaleY(.5774) rotate(-46deg);
    -ms-transform: scaleY(.5774) rotate(-46deg);
    transform: scaleY(.5774) rotate(-45.5deg);
    background: inherit;
    left: 56.8205px;
    border-radius: 8px;
    top: -49.6795px;
}
.client-big::after{
    content: "";
    position: absolute;
    width: 105.36px;
    height: 61.36px;
    -webkit-transform: scaleY(.5774) rotate(-46deg);
    -ms-transform: scaleY(.5774) rotate(-46deg);
    transform: scaleY(.5774) rotate(-45.5deg);
    background: inherit;
    left: 41.8205px;
    border-radius: 8px;
    bottom: -51.6795px;
}

.hexa_text {
    text-align: center;
    position: relative;
    font-size: 27px;
    top: 25px;
    color: #838382;
    font-weight: 600;
    margin-bottom: 45px;
}
.client-big h3 {
    color: white;
font-size: 19px;
}

.buy_now{
  /*background: linear-gradient(32deg, #FF4137, #FDC800);*/
  background-color: #FBAD19 !important;
  width: 130px;
  margin-top: 10px;
  color: white;
}
.client-big:hover {
  transform: scale(1.1);
  transition: transform 1s;
  box-shadow: 1px 2px 8px rgb(251, 173, 25);
  background-color: #FBAD19 !important;
}
.client-big:hover > .client-big::before{
  background-color: #FBAD19 !important;
}
.client-big:hover > .buy_now {
  background-color: #26718F !important;
  transform: scale(1.1);
  transition: transform 1s;
  box-shadow: 1px 2px 8px rgb(251, 173, 25);
}
</style>            
          </div>
          <!-- ./card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <?php } ?>
  </div><!--/. container-fluid -->
</section>

<!-- /.content -->

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Desired Package Amount</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="<?php echo base_url('user_packages/process_add'); ?>" id="amount_form" novalidate>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="first_name">
                    <span style="font-size: 16px;">
                      Please enter your desire amount for activating package. Minimum amount is <span id="minimum_amount"> </span> and maximum amount is <span id="maximum_amount"> </span>.
                    </span>
                  </label>
                  <input type="number" class="form-control" name="up_package_amount" id="up_package_amount" required >
                  <input type="hidden" class="form-control" name="package_id" id="package_id">
                  <div id="package_error" style="color: red;"></div>
                </div>
              </div>
              <a href="javascript::" class="btn btn-info text_shadow yellow-btns" id="amount_btn">Purchase Package</a>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function(){
    
    $(document).on("click",".buy_package",function(){
      var package_id = $(this).attr('rel');
      if (package_id != '') {
        $url = base_url + "user_packages/get_package";
        $data = 'package_id=' + package_id;
        $.ajax({
          url: $url,
          type: "POST",
          dataType: 'json',
          data: $data,
          success: function (data) {
              if(data!=''){
                $('#minimum_amount').empty();
                $('#maximum_amount').empty();
                $('#package_id').val('');
                $('#minimum_amount').append("$" + data.package_min_amount);
                $('#maximum_amount').append("$" + data.package_max_amount);
                $('#package_id').val(data.package_id);
                $("#myModal").modal();
              }
          }
        });
      }
  });

  $(document).on("click","#amount_btn",function(e){
    var package_id = $('#package_id').val();
      var up_package_amount = parseInt($('#up_package_amount').val());
      
      $('#package_error').empty();
      if (up_package_amount != '' && package_id != '') {
          $url = base_url + "user_packages/check_package_amount";
          $data = { "package_id":package_id, "up_package_amount":up_package_amount };
          $.ajax({
            url: $url,
            type: "POST",
            dataType: 'json',
            data: $data,
            success: function (data) {
                if(data.response){
                        $("#myModal").modal('hide');
                  $('#amount_form').submit();
                }
                else{
                  $('#package_error').html('Please enter amount in the range of package amount.');
                  return false;
                }
            }
        });
      }
      else{
        $('#package_error').html('Please enter amount first to purchase package.');
        return false;
      }
  });

  $(document).on("keyup","#up_package_amount",function(){
    $('#package_error').empty();
    var up_package_amount = $('#up_package_amount').val();
    if(!parseInt(up_package_amount)){
      $('#package_error').html('Please enter only digits as package amount.');
    }
  });

});
</script>