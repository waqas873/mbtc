<style type="text/css">
  .box{
    width: 100%;
    height: 130px;
    border: 1px solid #cec6c6;
    position: relative;
    margin-top: 10px;
  }
  .box2{
    width: 100%;

    background-color: #525252;
    border:1px solid #cec6c6;
    padding: 10px;

    position: relative;
    margin-bottom: 20px;
    line-height: 0.5;



  }
  .box2:hover{
    width: 360px;
   
    background-color: #525252;
    border:2px solid #cec6c6;
    padding: 5px;
  }
  .box2 h4{
    font-weight: bold;
  }
  .box2 p{

    font-size: 20px;
    font-weight: bold;

  }
  .box:hover{
    background-color: #f3f0f0;
    box-shadow: 0px 10px #f3f0f0;
    

  }
  .box h4{
    color: black!important;
    font-weight: bold;
  }
  .box p{
    color: black!important;
    font-size: 20px;
    font-weight: bold;
    color: green!important;
  }
  
  .box12{

    border-right: 51px solid green;
    border-bottom: 45px solid transparent;
    opacity: 0.7;
    position: absolute;
    right: 0px;
  }
  .purple-light{
    color: #fd22ff!important;
  }
  .text-danger{
    color: #fd3550!important;
  }
  .text-info{
    color: #0dceec!important;
  }
  .align-self-center{
    margin-top: 20px;
  }
  .box3{
    width: 300px;
    height: 110px;
    margin: 0 auto;

    background-color: #f5f5f5;
    border-bottom: 5px solid green;
    border-radius: 14px!important;
  }
  .box3:hover{
    background-color: #d0cfcf;
  }
  .box3:hover a{
    
     background-color: #076107;
    color: #fefefe;
  }
  .box3 input{
    border:0;
    background-color:#fefefe;
  }
  .box3 label{
    
    font-weight: bold!important;
    color: 

  }
  .box3 .fa-user{
    font-size: 70px;
    color: green;
    position: relative;
    left: 120px;

  }
  .fa-mars-double{
    font-size: 70px;
    color: green;
    position: relative;
    left: 120px;

  }
  .fa-star{
    font-size: 70px;
    color: green;
    position: relative;
    left: 120px;
  }
  .fa-bookmark{
    font-size: 70px;
    color: green;
    position: relative;
    left: 120px;

  }
  .fa-quote-right{
    font-size: 70px;
    color: green;
    position: relative;
    left: 120px;

  }
  .fa-tag{
    font-size: 70px;
    color: green;
    position: relative;
    left: 120px;

  }
  .bt .btn-light{
    margin-top: 20px;
    background-color: green;
    color: #fefefe;
    border: 1px solid green;
    border-radius: 14px!important;
  }
 /* .bt :hover{
    
   
    border: 1px solid #d2cfcf;
    border-radius: 14px!important;
  }*/
  .box4{
        background-image: linear-gradient(to right, #129a12,#6ebb6b,#129a12,#6ebb6b)!important;
    background: 
    width: 100%!important;
    height: 700px;
    margin-top: 40px;
    border:1px solid green;
    padding: 10px;
  }
  .box4 label{
    color: black!important;
    font-size: 14px;
    font-weight: bold;
    margin-top: 10px;
  }
  .box4 input{
    border:0!important;
    border-bottom: 1px solid grey!important;
  }
  .header{
    background: green;
    height: 40px;
    font-weight:bold!important;
  }
  .header h3{
    height: 30px;
    line-height: 37px;
    font-weight:550!important;
  }


  .error{
    color: red !important;
  }
  .desc{
    font-size: 22px !important;
  }
    .dashboard-stat .visual > i {
        margin-left: -23px !important;
        
       margin-top: -16px  !important;
    }
    .i_c2{
          background: white;
    padding: 17px;
    box-shadow: 0px 3px 9px 3px #b3b3b3 !important;
    width: 100%;
    margin: 0 auto;
        border-left: 6px solid #055205;
    border-bottom: 6px solid #055205;
    border-right: 6px solid #ffffff;
    border-top: 6px solid #ffffff;
    margin-bottom: 20px;
    }
    .page-title{
    font-weight: inherit;
    background: #0782c6;
    color: white !important;
    padding: 15px 10px;
    }

    #packages_box_shap{
   padding: 10px;
    height: 200px;
    width: 200px;
    margin: 0 auto;
    margin-bottom: 10px;
    border-radius: 100px;
    padding: 20px 20px;
    background: linear-gradient(-90deg, #c7c3c3, #055205);
    border-radius: 200px !important;
    border-top: 5px solid #a0a0a0c2;
    border-right: 5px solid #b1adadc2;
    box-shadow: 0px 7px 12px #cacaca;
    }

    .btn.btn-outline.green{
      border: #008000;
    color: #ffffff;
    background: #008000;
    }

    .btn-warning {
    color: #060606;
    background-color: #ffffff;
    border-color: #ffffff;
   }

   .btn-warning.active, .btn-warning:active, .btn-warning:hover, .open>.btn-warning.dropdown-toggle{
    color: #000;
    background-color: #ffffff;
    border-color: #ffffff;
}

.btn-warning.focus, .btn-warning:focus {
    color: #000;
    background-color: #d6d6d6;
    border-color: #d6d6d6;
}
.packages_modal{
  width: 100% !important;
  height: 163px !important;
}
.timer{
  margin: auto;
  width: 100%;
}
</style>

<style type="text/css">
  .box2 {
    min-height: 115px !important;
  }
  .extra_bonus{
    font-size: 16px !important;
    position: relative;
    top: 9px;
  }
  body{
    overflow-x: hidden;
  }
</style>

<?php if($this->session->flashdata("success_message")){ ?>
<div class="alert alert-success shadow">
        <button class="close" data-close="alert"></button>
        <strong>Success! </strong><span><?php echo $this->session->flashdata("success_message"); ?></span>
</div>
<?php } ?>
<?php if($this->session->flashdata("error_message")){ ?>
<div class="alert alert-danger shadow">
    <button class="close" data-close="alert"></button>
    <strong>Warning! </strong><span><?php echo $this->session->flashdata("error_message"); ?></span>
</div>
<?php } ?>
<script type="text/javascript">
  $(document).ready(function(){
      setInterval(()=>{
        var us_time = new Date().toLocaleTimeString("en-US", {timeZone: "America/New_York"});
        $('#us_time').html(us_time);
      },1000);
  });
</script>

<div class="row">
  <div class="col-md-12">
    <div class="timer">
    <h1 class="page-title" style="font-weight: inherit;background: #0782c7;color: white;padding: 15px 10px;"> User Dashboard
        <small>Total Earnings, Available Balance, Withdraws, Team Members, Mining</small>
        <span id="us_time" style="float: right;padding-right: 12px;"></span>
    </h1>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
      <div class="box2">
        <div class="row">
          <div class="col-sm-7">
            <div class="inerbox">
              <p class="purple-light" >
                $<?php echo $total_investment;?><br />
                <!-- <?php if(isset($extra_bonus)) { ?>
                  <span class="extra_bonus">1.5x Completed</span>
                <?php } ?> -->
              </p>
              <h4>Total Invesment</h4>
            </div>
            <div>
           </div>
         </div>
         <div class="col-sm-5">
          <div class="align-self-center" ><span id="dash3-chart-1"></span></div>
         </div>
       </div>
     </div>
   </div>

   <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box2">
      <div class="row">
        <div class="col-sm-7">
          <div class="inerbox">
            <p class="text-danger">
              $<?php echo $user_balance;?><br />
              <!-- <?php if(isset($extra_bonus)) { ?>
                <span class="extra_bonus">Extra Bonus Started</span>
              <?php } ?> -->
            </p>
            <h4> $USD Bank</h4>
          </div>
        </div>
        <div class="col-sm-5">
          <div class="align-self-center"><span id="dash3-chart-2"></span></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box2">
      <div class="row">
        <div class="col-sm-7">
          <div class="inerbox">
            <p class="text-info">$<?php echo $total_withdraws;?></p>
            <h4>Total Withdraw</h4>
          </div>
        </div>
        <div class="col-sm-5">
          <div class="align-self-center"><span id="dash3-chart-3"></span></div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box">
      <div class="box12">
        <!-- <img src="publicsite\images/logo1.png" width="30px;"> -->
      </div>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8">
          <div class="inerbox">
            <p>$<?php echo $wallet_balance;?></p>
            <h4>Wallet Amount</h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box">
      <div class="box12"></div>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8">
          <div class="inerbox">
            <p>$<?php echo $total_earnings;?></p>
            <h4>Total Earning</h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php if(isset($remaining_days)) { ?>
  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box">
      <div class="box12" ></div>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8">
          <div class="inerbox">
            <p>$<?php echo $mining_balane;?></p>
            <h4>ROIIM (<?php echo $remaining_days;?> days Remaining) </h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box">
      <div class="box12" ></div>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8">
          <div class="inerbox">
            <p><?php echo $total_users;?></p>
            <h4>Total Team Members</h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box">
      <div class="box12" ></div>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8">
          <div class="inerbox">
            <p><?php echo $direct_members;?></p>
            <h4>Direct Members</h4>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php if(isset($roi_percentage)) { ?>
  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box">
      <div class="box12" ></div>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8">
          <div class="inerbox">
            <p>$<?php echo $roi_amount;?></p>
            <h4>ROI Percentage</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

  <?php if(isset($package_active)) { ?>
  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box">
      <div class="box12" ></div>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8">
          <div class="inerbox">
            <p>$<?php echo $binary_recieved;?></p>
            <h4>Binary Recieved</h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box">
      <div class="box12" ></div>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8">
          <div class="inerbox">
            <p>$<?php echo $roi_recieved;?></p>
            <h4>ROI Recieved</h4>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
    <div class="box">
      <div class="box12" ></div>
      <div class="row">
        <div class="col-sm-4">
        </div>
        <div class="col-sm-8">
          <div class="inerbox">
            <p>$<?php echo $referal_bonus;?></p>
            <h4>Referal Bonus</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
<br>
<br>
<?php 
  $user_info = user_info($this->session->userdata('id'));
  $parent_id = ($user_info['alpha_parent_id']>0)?$user_info['alpha_parent_id']:$user_info['parent_id'];
  $parent_info = user_info($parent_id);
  $package_detail = package_detail($this->session->userdata('id'));
  if(!empty($package_detail)){
     $pdate = $package_detail['up_created_at'];
  }
?>
<div class="row">
  <div class="col-md-6">
    <div class="box3">
      <i class="fa fa-user"></i>
      <div class="row">
        <div class="col-sm-12 text-center">
          <div class="bt">
            <a href="#" class="btn btn-light "> USER ID: <?php echo $user_info['sponsor_code']; ?></a>
          </div>
        </div>
      </div>
    </div>
    <br><br>
     <div class="box3">
      <i class="fa fa-tag"></i>
      <div class="row">
        <div class="col-sm-12 text-center">
          
          <div class="bt">
            <a href="#" class="btn btn-light "> SPonser ID: <?php echo (!empty($parent_info))?$parent_info['sponsor_code']:"Not Available"; ?></a>
          </div>
        
        </div>
        
        
      </div>

    </div>
     <br><br>
     <div class="box3">
      <i class="fa fa-mars-double"></i>
      <div class="row">
        <div class="col-sm-12 text-center">
          
          <div class="bt">
            <a href="#" class="btn btn-light "> Gender: <?php echo ucwords($user_info['gender']); ?></a>
          </div>
        
        </div>
        
        
      </div>

    </div>
  </div>


  
  <div class="col-md-6">
    <div class="box3">
      <i class="fa fa-star"></i>
      <div class="row">
        <div class="col-sm-12 text-center">
          
          <div class="bt">
            <a href="#" class="btn btn-light "> User Name: <?php echo ucwords($user_info['fullname']); ?></a>
          </div>
        
        </div>

        
      </div>

    </div>
    <br><br>
     <div class="box3">
      <i class="fa fa-bookmark"></i>
      <div class="row">
        <div class="col-sm-12 text-center">
          
          <div class="bt">
            <a href="#" class="btn btn-light "> SPonser Name: <?php echo (!empty($parent_info))?ucwords($parent_info['fullname']):"Not Available"; ?></a>
          </div>
        
        </div>
        
        
      </div>

    </div>
     <br><br>
     <div class="box3">
      <i class="fa fa-quote-right"></i>
      <div class="row">
        <div class="col-sm-12 text-center">
          
          <div class="bt">
            <a href="#" class="btn btn-light "> Position: <?php echo ($user_info['position']=="left")?"Left":"Right"; ?></a>
          </div>
        
        </div>
        
        
      </div>

    </div>
  </div>
  
</div>

  <div class="row">
    
  <div class="col-md-12">
   
    <div class="box4">
       <div class="header">
      <h3>User Dashboard:</h3>
    </div>
<div class="" id="11" >
      <div  style="margin-top: 30px;">
        <div class="input-group-apenend">
          <label> <span><i class="fa fa-user"></i></span> Full Name:</label>
          <input type="text" value="<?php echo ucwords($user_info['fullname']);?>" class="form-control" placeholder="name goes here">
        </div>
        <div class="input-group-apenend">
          <label><span><i  class="fa fa-envelope-open-o"></i></span> Email Address:</label>
          <input type="text" value="<?php echo $user_info['email'];?>" class="form-control" placeholder="email goes here">
        </div>
      </div>
      
        <div class="input-group-apenend">
          <label> <span><i class="fa fa-user"></i> User Name:</label>
          <input type="text" value="<?php echo $user_info['username'];?>" class="form-control" placeholder="User name goes here">
        </div>
        <div class="input-group-apenend">
          <label> <span><i class="fa fa-money fa_icon"></i></span> Wallet Address:</label>
          <input type="text" value="<?php echo (!empty($user_info['wallet_address']))?$user_info['wallet_address']:"Not Available" ;?>" class="form-control" placeholder="Wallet Address goes here">
        </div>
        <div class="input-group-apenend">
          <label> <span><i class="fa fa-database"></i> My Current Plan:</label>
          <input type="text" value="<?php echo (!empty($package_detail['package_name']))?$package_detail['package_name']:"None" ;?>" class="form-control" placeholder="Plan goes here">
        </div>
        <div class="input-group-apenend">
          <label> <span><i class="fa fa-check"></i> Status:</label>
          <input type="text" value="<?php echo (!empty($package_detail['package_name']))?"Active":'<span>Inactive</span>' ;?>" class="form-control" placeholder="Status goes here">
        </div>
        <div class="input-group-apenend ">
          <label class="mt-5"> <span><i class="fa fa-check"></i> Joining Date:</label>
          <input type="text" value="<?php echo (isset($pdate))?$pdate:'Not Available';?>" class="form-control" placeholder="Package goes here">
        </div>
      
    </div>
    </div>
  </div>
</div>

<br>  

<?php if(isset($packages) && !empty($packages)) { ?>
<div class="i_c2">
<h1 class="page-title"> Buy Package </h1>
<div class="row">
      <?php 
        foreach ($packages as $key => $package) {
          $tax = round((int)$package['package_min_amount']*(int)$package['package_fees']/100);
          $total = (int)$package['package_min_amount']+$tax;
      ?>
      <div class="col-md-4" style="text-align:center;">
        <h3 style="font-weight: inherit;">Starter</h3>
        <div id="packages_box_shap">
          <h4 style="font-weight: bold;"><?php echo $package['package_name']; ?> Package</h4>
          <div class="text_shadow_package" style="color:white;font-size:17px; margin-top: 7px;">MIN - $<?php echo $package['package_min_amount']; ?></div>
          <div class="text_shadow_package" style="color:white;font-size:15px;">MAX - $<?php echo $package['package_max_amount']; ?></div>
          <div class="text_shadow_package" style="color:white;font-size:14px;">ROI - <?php echo $package['package_roi']; ?>%</div>
          <div class="text_shadow_package" style="color:white;font-size:13px;">FEE - $<?php echo $package['package_fees']; ?></div>
        </div>
        <a class="btn green btn-outline sbold buy_package shadow" href="javascript::" rel="<?php echo $package['package_id']; ?>"> Buy Package</a>
      </div>
      <?php } ?>
  </div>
</div>
<?php } ?>
<div class="modal fade shadow" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content shadow" style="border-radius: 30px !important;margin-top: 167px;">
      <div class="modal-header">
        <h4 class="modal-title" style="font-weight: inherit;">Package Amount</h4>
      </div>
      <div class="modal-body">
        <div class="portlet box green packages_modal" >
          <div class="portlet-title">
            <div class="caption text_shadow">
               Enter Amount
            </div>
          </div>
          <div class="portlet-body">
              <span style="font-size: 16px; color: green;">
                Please enter your desire amount for activating package. Minimum amount is <span id="minimum_amount"> </span> and maximum amount is <span id="maximum_amount"> </span>.
              </span>
              <div class="row">
                <form method="post" action="<?php echo base_url('user_packages/process_add'); ?>" id="amount_form" novalidate>

                 <div class="row">
                  <div class="col-lg-9" style="margin-top: 11px;margin-left: 13px;">
                    <div class="form-group">
                      <input type="number" class="form-control" name="up_package_amount" id="up_package_amount" required >
                      <input type="hidden" class="form-control" name="package_id" id="package_id">
                      <span id="package_error" style="color: red;"></span>
                    </div>
                  </div>
                  <div class="col-lg-2">
                   <div class="form-group">
                    <a href="javascript::" class="btn btn-info text_shadow" style="height: 36px !important;margin-top: 11px;padding: px 27px 0px 23px !important;" id="amount_btn">Submit</a>
                   </div>
                 </div>

               </div>
             </form>
           </div>
       </div>
     </div>

   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<!-- Sparkline JS -->
