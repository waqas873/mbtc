
<style type="text/css">
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
<div class="i_c2">
    
<h1 class="page-title"> Upgrade Your Package </h1>

<?php if(isset($admin_wallet_address) && isset($package_upgrade)) { ?>
<div class="row">
    <div class="col-md-12">
        <div class="well shadow">
            <strong style="font-size: 20px;">SUCCESS ! </strong>
            <div style="margin-top: 7px;font-size: 16px;">Your request for upgrading <span style=""><?php echo $package_upgrade['package_name'];?> package</span> of amount <span><?php echo "$".$package_upgrade['upu_package_amount'];?></span> has been submitted successfully to admin. You have to transfer Bitcoins of <span>$<?php echo $package_upgrade['upu_package_amount'];?></span> to admin.</div>
            <strong style="font-size: 17px;">Admin Wallet Address: </strong> 
            <span style="font-size: 16px;"><?php echo $admin_wallet_address;?></span>
        </div>
    </div>
</div>
<?php } ?>

<div class="row">

	<?php 
        if(isset($packages) && !empty($packages)) {
        foreach ($packages as $key => $package) {
    	$tax = round((int)$package['package_min_amount']*(int)$package['package_fees']/100);
    	$total = (int)$package['package_min_amount']+$tax;
	?>
		<div class="col-md-4" style="text-align:center;">
			<h3 style="font-weight: inherit;"><?php echo $package['package_name']; ?></h3>
			<div id="packages_box_shap">
				<!-- <i class="fa fas fa-user" style="color:#fff !important;font-size: 85px !important;margin-top:40px;"></i> -->
        <?php if ($key <= 2) { ?>
          <span id="dash3-chart-<?php echo $key+1; ?>"></span>
        <?php } ?>
				<div class="text_shadow_package" style="color:white;font-size:20px; margin-top: 7px;">MIN - $<?php echo $package['package_min_amount']; ?></div>
				<div class="text_shadow_package" style="color:white;font-size:20px;">MAX - $<?php echo $package['package_max_amount']; ?></div>
				<div class="text_shadow_package" style="color:white;font-size:20px;">ROI - <?php echo $package['package_roi']; ?>%</div>
				<div class="text_shadow_package" style="color:white;font-size:20px;">FEE - $<?php echo $package['package_fees']; ?></div>
        </span>
			</div>
			<a class="btn green btn-outline sbold buy_package shadow" href="javascript::" rel="<?php echo $package['package_id']; ?>"> Upgrade Package</a>
		</div>
	<?php } } ?>
</div>
</div>


<div class="modal fade" id="myModal" role="dialog">
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
                Please enter your desire amount to upgrade your package. Minimum amount is <span id="minimum_amount"> </span> and maximum amount is <span id="maximum_amount"> </span>.
              </span>
              <div class="row">
                <form method="post" action="<?php echo base_url('user_packages_upgrade/process_add'); ?>" id="amount_form" novalidate>

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
    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
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
