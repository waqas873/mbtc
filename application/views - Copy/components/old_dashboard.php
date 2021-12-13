
<style type="text/css">
    /* ---- reset ---- */ canvas{ display: block; vertical-align: bottom; } /* ---- particles.js container ---- */ #particles-js{ position:absolute; width: 100%; height: 100%; background-color: #000000; background-image: url(""); background-repeat: no-repeat; background-size: cover; background-position: 50% 50%; } /* ---- stats.js ---- */ .count-particles{ background: #000022; position: absolute; top: 48px; left: 0; width: 80px; color: #13E8E9; font-size: .8em; text-align: left; text-indent: 4px; line-height: 14px; padding-bottom: 2px; font-family: Helvetica, Arial, sans-serif; font-weight: bold; } .js-count-particles{ font-size: 1.1em; } #stats, .count-particles{ -webkit-user-select: none; margin-top: 5px; margin-left: 5px; } #stats{ border-radius: 3px 3px 0 0; overflow: hidden; } .count-particles{ border-radius: 0 0 3px 3px; }
</style>
<style type="text/css">
    .error{
        color: red !important;
    }

    .dashboard-stat .visual > i {
        margin-left: -23px !important;
        margin-top: -16px  !important;
    }
 
     .box_style{
        width: 100%; 
        text-align: center;
        font-size: 55px;
        min-height: 20px;
        color: white;
        padding-bottom: 6px;
    }
    .user_user{
        font-size: 18px;
        font-weight: 600;
    }
    .gray_shadow{
        font-size: 16px;
    }
    .well{
      min-height: 20px;
    margin-bottom: 20px;
    background-color: transparent !important;
    border: 0 !important;
    }
    .pltbl{
        border:1px solid #143148 !important;
    }

    @media ( max-width:580px){
        .gray_shadow{
            font-size: 13px;
        }
    }

    @media ( max-width:1200px){
    .desc span{
        font-size: 12px !important;
    }
    }
   
   .tab-custom.tab-custom-three li{
    width: 100% !important;
   }
   .portlet.box>.portlet-body{
        background-color: #0782c742;
   }
   .portlet.box>.portlet-title{
    border: 1px solid grey;
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
    
<h1 class="page-title" style="font-weight: inherit;background: #0782c7;color: white;padding: 15px 10px;"> User Dashboard
    <small>Total Earnings, Available Balance, Withdraws, Team Members, Mining</small>
    <?php if(isset($news) && !empty($news)) { ?>
    <marquee width="40%" direction="left" style="margin-left: 55px;">
        <?php echo $news[0]['news_des'];?>
    </marquee>
    <?php } ?>
    <span id="us_time" style="float: right;padding-right: 12px;"></span>
</h1>


<?php if(isset($admin_wallet_address) && isset($package_purchased)) { ?>
<div class="row">
    <div class="col-md-12">
        <div class="well shadow">
            <strong style="font-size: 20px;">SUCCESS ! </strong>
            <div style="margin-top: 7px;font-size: 16px;">Your request for purchasing <span><?php echo $package_purchased['package_name'];?> package</span> of amount <span><?php echo "$".$package_purchased['up_package_amount'];?></span> has been submitted successfully to admin. You have to transfer Bitcoins of <span>$<?php echo $package_purchased['up_package_amount']+$package_purchased['package_fees'];?></span> with including <span><?php echo "$".$package_purchased['package_fees'];?></span> fee to admin on wallet address given below. So admin should approve your purchase request.</div>
            <strong style="font-size: 17px;">Admin Wallet Address: </strong> 
            <span style="font-size: 16px;"><?php echo $admin_wallet_address;?></span>
        </div>
    </div>
</div>
<?php } ?>
<div class="i_c1">
    <div id="particles-js"></div>
    <div class="row">
         <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 blue shadow" href="javascript::">
                        <div class="visual">
                            <i class="fa fa-comments"></i>
                        </div>
                        <div class="details">
                            <div class="number text_shadow">
                                $<span data-counter="counterup" data-value="<?php echo $total_investment;?>">0</span>
                            </div>
                            <div class="desc text_shadow"> Total Investment </div>
                        </div>
                    </a>
              </div> 
         </div>
         <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green shadow" href="javascript::">
                        <div class="visual">
                            <i class="fa fa-money"></i>
                        </div>
                        <div class="details">
                            <div class="number text_shadow">
                                $<span data-counter="counterup" data-value="<?php echo $user_balance;?>">0</span>
                            </div>
                            <div class="desc text_shadow"> Available Balance </div>
                        </div>
                    </a>
               </div> 
         </div>
         <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
             
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 yellow shadow" href="javascript::">
                    <div class="visual">
                        <i class="fa fa-shekel"></i>
                    </div>
                    <div class="details">
                        <div class="number text_shadow">
                            $<span data-counter="counterup" data-value="<?php echo $total_withdraws;?>"></span>
                        </div>
                        <div class="desc text_shadow"> Total Withdraws </div>
                    </div>
                </a>
             </div>
         </div>
    </div>  


   <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
             <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1>$<?php echo $wallet_balance;?></h1>
                       <p>Wallet Amount</p>
                  </div>
             </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
             <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1>$<?php echo $total_earnings;?></h1>
                       <p> Total Earnings </p>
                  </div>
             </div>
        </div>
        <?php if(isset($remaining_days)) { ?>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
             <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1>$<?php echo $mining_balane;?></h1>
                      <p> Mining <span>(<?php echo $remaining_days;?> Days Remaining)</span></p> 
                  </div>
             </div>
        </div>
        <?php } ?>


        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
             <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1>+<?php echo $left_users;?></h1>
                       <p>Left Side Member</p>
                  </div>
             </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
             <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1>+<?php // echo $right_users;?> 152</h1>
                       <p> Right Side Members </p>
                  </div>
             </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
             <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1>+<?php // echo $total_users;?></h1>
                       <p> Total Team Members 478</p>
                  </div>
             </div>
        </div>
   

  
 
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
             <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1>+<?php echo $direct_members;?></h1>
                       <p> Direct Members </p>
                  </div>
             </div>
        </div>
        <?php if(isset($roi_percentage)) { ?>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
             <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1> <span data-counter="counterup" data-value="<?php echo $roi_percentage;?>"><?php echo $roi_percentage;?></span>
                            <span style="font-size: 24px !important;">%</span>
                            <span style="font-size: 20px !important;">
                              , $<span data-counter="counterup" data-value="<?php echo $roi_amount;?>"><?php echo $roi_amount;?></span>
                       </h1>
                       <p> ROI Percentage,</p>
                  </div>
             </div>
        </div>
        <?php } ?>

        <?php if(isset($package_active)) { ?>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
             <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1>$<?php echo $binary_recieved;?></h1>
                       <p>Binary Recieved</p>
                  </div>
             </div>
        </div>
  
        <div class="col-md-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
            <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1> 
                          $<?php echo $roi_recieved;?>
                       </h1>
                       <p>Roi Recieved</p>
                  </div>
             </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6">
             <div class="wallet_box">
                  <img src="assets/images/dashbox_bg.png">
                  <div class="box_text_box">
                       <h1> 
                          $<?php echo $referal_bonus;?>
                       </h1>
                       <p>Referal Bonus</p>
                  </div>
             </div>
        </div>
        <?php } ?>
       
   </div>







  
        <div class="row" >
            <div class="col-md-12">
                <div class="well shadow">
                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                                $user_info = user_info($this->session->userdata('id'));
                                $parent_id = ($user_info['alpha_parent_id']>0)?$user_info['alpha_parent_id']:$user_info['parent_id'];
                                $parent_info = user_info($parent_id);
                                $package_detail = package_detail($this->session->userdata('id'));
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6" style="padding-right: 0px !important;">
                                            <div class="box_style shadow" style="background-color: #3598dc63;">
                                                <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="user_info" style="margin-top: 10px;">
                                                <span class="user_user">User ID</span>
                                                <br/>
                                                <span class="gray_shadow" style="margin-top: 10px;"><?php echo $user_info['sponsor_code']; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-6" style="padding-right: 0px !important;">
                                            <div class="box_style shadow" style="background-color: #8e44ad7d">
                                                <i class="fa fa-tag"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="user_info" style="margin-top: 10px;">
                                                <span class="user_user">Sponser ID</span>
                                                <br/>
                                                <span class="gray_shadow" style="margin-top: 10px;"><?php echo (!empty($parent_info))?$parent_info['sponsor_code']:"Not Available"; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-6" style="padding-right: 0px !important;">
                                            <div class="box_style shadow" style="background-color: #e7505a85">
                                                <i class="fa fa-mars-double"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="user_info" style="margin-top: 10px;">
                                                <span class="user_user">Gender</span>
                                                <br/>
                                                <span class="gray_shadow" style="margin-top: 10px;"><?php echo ucwords($user_info['gender']); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6" style="padding-right: 0px !important;">
                                            <div class="box_style shadow" style="background-color: #c49f4757">
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="user_info" style="margin-top: 10px;">
                                                <span class="user_user">User Name</span>
                                                <br/>
                                                <span class="gray_shadow" style="margin-top: 10px;"><?php echo ucwords($user_info['fullname']); ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-6" style="padding-right: 0px !important;">
                                            <div class="box_style shadow" style="background-color: #32c5d263">
                                                <i class="fa fa-bookmark"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="user_info" style="margin-top: 10px;">
                                                <span class="user_user">Sponser Name</span>
                                                <br/>
                                                <span class="gray_shadow" style="margin-top: 10px;"><?php echo (!empty($parent_info))?ucwords($parent_info['fullname']):"Not Available"; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="margin-top: 10px;">
                                        <div class="col-md-6" style="padding-right: 0px !important;">
                                            <div class="box_style shadow" style="background-color: #8e44ad75">
                                                <i class="fa fa-quote-right"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="user_info" style="margin-top: 10px;">
                                                <span class="user_user">Position</span>
                                                <br/>
                                                <span class="gray_shadow" style="margin-top: 10px;"><?php echo ($user_info['position']=="left")?"Left":"Right"; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                      

                        <div class="col-md-12">
                            <div class="portlet box pltbl" style="background-color:#012b4d63 !important;margin-top: 30px;">
                                <div class="portlet-title">
                                    <div class="caption text_shadow">User Dashboard</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                            <a href="javascript:;" class="reload"> </a>
                                        </div>
                                </div>
                                <div class="portlet-body">
                                  <div class="row">
                                      <div class="col-md-5">
                                          <span class="user_user"> <span><i class="fa fa-user"></i> </span>Full Name <span style="padding-left: 20px;float: right;">:</span> </span>
                                      </div>
                                      <div class="col-md-7" style="padding-top: 3px;">
                                          <span class="gray_shadow"><?php echo ucwords($user_info['fullname']);?></span>
                                      </div>
                                  </div>
                                  <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-5">
                                          <span class="user_user"> <span><i class="fa fa-envelope"></i> </span>Email Address <span style="padding-left: 20px;float: right;">:</span> </span>
                                      </div>
                                      <div class="col-md-7" style="padding-top: 3px;">
                                          <span class="gray_shadow"><?php echo $user_info['email'];?></span>
                                      </div>
                                  </div>
                                  <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-5">
                                          <span class="user_user"> <span><i class="fa fa-user"></i> </span>Username <span style="padding-left: 20px;float: right;">:</span> </span>
                                      </div>
                                      <div class="col-md-7" style="padding-top: 3px;">
                                          <span class="gray_shadow"><?php echo $user_info['username'];?></span>
                                      </div>
                                  </div>
                                  <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-5">
                                          <span class="user_user"> <span><i class="fa fa-money"></i> </span>Wallet Address <span style="padding-left: 20px;float: right;">:</span> </span>
                                      </div>
                                      <div class="col-md-7" style="padding-top: 3px;" >
                                        <span class="gray_shadow"><?php echo (!empty($user_info['wallet_address']))?$user_info['wallet_address']:"Not Available" ;?></span>
                                      </div>
                                  </div>
                                  <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-5">
                                          <span class="user_user"> <span><i class="fa fa-database"></i> </span>My Current Plan <span style="padding-left: 20px;float: right;">:</span> </span>
                                      </div>
                                      <div class="col-md-7" style="padding-top: 3px;">
                                          <span class="gray_shadow"><?php echo (!empty($package_detail['package_name']))?$package_detail['package_name']:"None" ;?></span>
                                      </div>
                                  </div>
                                  <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-5">
                                          <span class="user_user"> <span><i class="fa fa-check"></i> </span>Status <span style="padding-left: 20px;float: right;">:</span> </span>
                                      </div>
                                      <div class="col-md-7" style="padding-top: 3px;">
                                          <span class="gray_shadow"><?php echo (!empty($package_detail['package_name']))?"Actve":'<span>Inactive</span>' ;?></span>
                                      </div>
                                  </div> 
                                  <?php if(isset($package_detail['up_created_at']) && !empty($package_detail['up_created_at'])) { ?>
                                  <div class="row" style="margin-top: 10px;">
                                      <div class="col-md-5">
                                          <span class="user_user"> <span><i class="fa fa-check"></i> </span>Package Activated At <span style="padding-left: 20px;float: right;">:</span> </span>
                                      </div>
                                      <div class="col-md-7" style="padding-top: 3px;">
                                          <span class="gray_shadow"><?php echo $package_detail['up_created_at'];?></span>
                                      </div>
                                  </div> 
                                  <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      
</div>

<div class="row"  id="buttom_price_box" style="background: #0c1a23 !important;margin: 0px !important;padding-bottom: 10px;box-shadow: -8px 8px 23px #6b6b6b !important;">
    <?php 
        if(isset($packages) && !empty($packages)) {
        foreach ($packages as $key => $package) {
        $tax = round((int)$package['package_min_amount']*(int)$package['package_fees']/100);
        $total = (int)$package['package_min_amount']+$tax;
    ?>
        <div class="col-md-2 col-sm-4 col-xs-6" style="text-align:center;">
            <h3 style="font-weight: inherit;"><?php echo $package['package_name']; ?></h3>
            <div style="background: <?php echo $package['package_color']; ?>;" class="shadow">
                <i class="fa fas fa-signal" style="color:#fff !important;font-size: 85px !important;margin-top:40px;"></i>
                <div class="text_shadow_package" style="color:white;font-size:20px; margin-top: 7px;">MIN - $<?php echo $package['package_min_amount']; ?></div>
                <div class="text_shadow_package" style="color:white;font-size:20px;">MAX - $<?php echo $package['package_max_amount']; ?></div>
                <div class="text_shadow_package" style="color:white;font-size:20px;">ROI - <?php echo $package['package_roi']; ?>%</div>
                <div class="text_shadow_package" style="color:white;font-size:20px;">FEE - $<?php echo $package['package_fees']; ?></div>
            </div>
            <a class="btn green btn-outline sbold buy_package shadow" href="javascript::" rel="<?php echo $package['package_id']; ?>"> Buy Package</a>
        </div>
    <?php } } ?>
</div>

<div class="modal fade shadow" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content shadow" style="border-radius: 30px !important;margin-top: 167px;">
      <div class="modal-header">
        <h4 class="modal-title" style="font-weight: inherit;">Package Amount</h4>
      </div>
      <div class="modal-body">
        <div class="portlet box green" >
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
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="https://threejs.org/examples/js/libs/stats.min.js"></script>
<script type="text/javascript">
    particlesJS("particles-js", {"particles":{"number":{"value":200,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"star","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":0.5,"random":false,"anim":{"enable":false,"speed":1,"opacity_min":0.1,"sync":false}},"size":{"value":2,"random":true,"anim":{"enable":false,"speed":40,"size_min":0.1,"sync":false}},"line_linked":{"enable":true,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":6,"direction":"none","random":false,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":1200}}},"interactivity":{"detect_on":"window","events":{"onhover":{"enable":true,"mode":"repulse"},"onclick":{"enable":true,"mode":"push"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":400,"size":40,"duration":2,"opacity":8,"speed":3},"repulse":{"distance":200,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true});
</script>