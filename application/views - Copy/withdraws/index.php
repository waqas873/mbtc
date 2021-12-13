
<style type="text/css">
	.caption_color{
		color: #fff !important;
	}
	.text_center{
		text-align: center;
	}
	.border_radius{
		border-radius: 8px !important;
	}
    .label_style{
       border-radius: 5px !important;   
    }
    .error{
        color: red;
    }
    .plb {
    background-color: white !important;
}
.table_heading{
  text-shadow: none !important;
}

table.dataTable thead td, table.dataTable thead th{
  color: #000;
}

table.dataTable tbody th, table.dataTable tbody td{
  color: #000;
}

.btn-success {
    color: #000;
    background-color: #fff;
    border-color: #f8fbfd;
}

.btn-success:hover{
  background-color: #fff;
  color: #000;
}
.btn-success.active, .btn-success:active, .btn-success:hover, .open>.btn-success.dropdown-toggle{
  color: #1b1b1b !important;
    background-color: #e2e2e2 !important;
    border-color: #e4e4e4 !important;
}

.btn-success.focus, .btn-success:focus {
    color: #000;
    background-color: #ececec;
    border-color: #e8e8e8;
}
.dataTables_length{
  text-transform: capitalize;
}
</style>

<div class="portlet light bordered plb shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer caption_color"></i>
			<span class="caption-subject bold caption_color uppercase"><?php echo (isset($heading))?$heading:"All Withdraws"; ?></span>
		</div>

	</div>
	<div class="portlet-body form">

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


    <div class="row">
    <div class="col-md-12">
        <div class="point_status_tbl2">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption text_shadow">All Withdraws</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            
                            <a href="javascript:;" class="reload"> </a>
                            
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php if($this->session->userdata('role')=="user") { ?>
                            <div class="row" style="margin-bottom: 15px;margin-top: 10px;">
                                <div class="col-md-5">
                                    <a href="javascript::" id="request_withdraw" class="btn btn-success border_radius">Request For Withdraw</a>
                                </div>
                            </div>
                        <?php } ?>

                    	<div class="table-responsive">
                            <table class="table table-striped dt-responsive" id="sample_3" style="border-bottom: none !important;">
                                <thead>
                                    <tr class="table_heading" style="background-color: #cacaca">
                                    	<th class="text_center">Sr No</th>
                                        <?php if($this->session->userdata('role')=="admin") { ?>
                                            <th class="text_center">User Name</th>
    										                    <th class="text_center">Email</th>
                                            <th class="text_center">Wallet Address</th>
                                        <?php } ?>
										                    <th class="text_center">Withdraw Amount</th>
                                        <th class="text_center">Fees</th>
										                  <th class="text_center">Final Amount</th>
                                      <?php if(isset($this->selected_tab) && $this->selected_tab == "pending_withdraws") { ?>
                                        <th class="text_center">User Balance</th>
                                      <?php } ?>
                                      <th class="text_center">Request Date</th>
                                        <th class="text_center">Status</th>
                                        <?php if($this->session->userdata('role')=="admin") { ?>
                                        <th class="text_center">Action</th>

                                        <?php } ?>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                       if(isset($withdraws) && !empty($withdraws)) { 
                                        $index = 1;
                                        foreach ($withdraws as $Withdraw) {
                                    ?>
                                    <tr class="table_text_shadow">
                                    	<td class="text_center"><?php echo $index; ?></td>
                                        <?php if($this->session->userdata('role')=="admin") { ?>
                                            <td class="text_center"><?php echo ucwords($Withdraw['fullname']); ?></td>
    										                    <td class="text_center"><?php echo $Withdraw['email']; ?></td>
                                            <td class="text_center"><?php echo $Withdraw['wallet_address']; ?></td>
                                        <?php } ?>
                										<td class="text_center"><?php echo "$".$Withdraw['withdraw_amount']; ?></td>
                										<td class="text_center"><?php echo "$".$Withdraw['withdraw_fees']; ?></td>
                										<td class="text_center"><?php echo "$".($Withdraw['withdraw_amount']-$Withdraw['withdraw_fees']); ?></td>
                                      <?php if(isset($this->selected_tab) && $this->selected_tab == "pending_withdraws") { ?>
                                        <td class="text_center"><?php echo "$".$Withdraw['user_balance']; ?></td>
                                      <?php } ?>
                                        <td class="text_center">
                                            <?php 
                                                $datetime = explode(' ', $Withdraw['requested_on']);
                                                $date = $datetime[0];
                                                echo $date; 
                                            ?>
                                        </td>
                                        <td class="text_center">
                                            <?php 
                                               if($Withdraw['withdraw_status']==0){
                                                   $status = '<span class="label label-sm label-warning label_style"> Pending </span>';
                                               }
                                               if($Withdraw['withdraw_status']==1){
                                                   $status = '<span class="label label-sm label-success label_style"> Approved </span>';
                                               }
                                               if($Withdraw['withdraw_status']==2){
                                                   $status = '<span class="label label-sm label-danger label_style"> Rejected </span>';
                                               }
                                               echo $status;
                                            ?>
                                        </td>
                                        <td class="text_center">

                                            <?php if($this->session->userdata('role')=="admin") { ?>
                                                <div style="width: 145px;">
                                                <?php if($Withdraw['withdraw_status']==0 || $Withdraw['withdraw_status']==2) { ?>
    											<a href="<?php echo base_url("withdraws/approve_withdraw/").$Withdraw['withdraw_id']; ?>" class="btn btn-success btn-sm border_radius" onclick="delete_record(this, 'withdraws'); return false;">Approve</a>&nbsp;
                                                <?php } else { ?>
                                                    <span class="label label-sm label-success label_style"> Completed </span>
                                                <?php } ?>
                                                <?php if($Withdraw['withdraw_status']==0) { ?>
    											<a href="<?php echo base_url("withdraws/reject_withdraw/").$Withdraw['withdraw_id']; ?>" class="btn btn-danger btn-sm border_radius" onclick="delete_record(this, 'withdraws'); return false;">Reject</a>
                                                <?php } ?>
                                                </div>
                                            <?php } ?>
										</td>
                                    </tr>
                                    <?php 
                                          $index++; 
                                        } 
                                       } 
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	</div>
</div>


<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content shadow" style="border-radius: 30px !important;margin-top: 167px;">
      <div class="modal-header">
        <h4 class="modal-title" style="font-weight: inherit;">Withdraw Request</h4>
      </div>
      <div class="modal-body">
        <div class="portlet box green" >
          <div class="portlet-title">
            <div class="caption text_shadow">
               Enter Amount
            </div>
          </div>
          <div class="portlet-body">
              <span style="font-size: 16px; color:#fff;">
                Please enter your desire amount for withdraw here. 
              </span>
              <div class="row">
                <form method="post" action="<?php echo base_url('withdraws/process_add'); ?>" id="withdraw_form" novalidate>
                 <div class="row">
                  <div class="col-lg-9" style="margin-top: 11px;margin-left: 13px;">
                    <div class="form-group">
                      <input type="number" class="form-control" name="withdraw_amount" id="withdraw_amount" required >
                      <span id="package_error" style="color: red;"></span>
                    </div>
                  </div>
                  <div class="col-lg-2">
                   <div class="form-group">
                    <input type="submit" class="btn btn-info text_shadow" style="height: 36px !important;margin-top: 11px;padding: px 27px 0px 23px !important;" value="Submit">
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

    $(document).on("click","#request_withdraw",function(){
        $("#myModal").modal();
    });

    $('#withdraw_form').validate();

    $(document).on("submit","#withdraw_form",function(){
        if($('#withdraw_form').valid()){
            $("#myModal").modal('hide');
        }
    });
    
    // $(document).on("click","#amount_btn",function(e){
    //     var package_id = $('#package_id').val();
    //     var up_package_amount = parseInt($('#up_package_amount').val());
        
    //     $('#package_error').empty();
    //     if (up_package_amount != '' && package_id != '') {
    //         $url = base_url + "user_packages/check_package_amount";
    //         $data = { "package_id":package_id, "up_package_amount":up_package_amount };
    //         $.ajax({
    //             url: $url,
    //             type: "POST",
    //             dataType: 'json',
    //             data: $data,
    //             success: function (data) {
    //                 if(data.response){
    //                     $("#myModal").modal('hide');
    //                     $('#amount_form').submit();
    //                 }
    //                 else{
    //                     $('#package_error').html('Please enter amount in the range of package amount.');
    //                     return false;
    //                 }
    //             }
    //         });
    //     }
    //     else{
    //         $('#package_error').html('Please enter amount first to purchase package.');
    //         return false;
    //     }
    // });

});
</script>
