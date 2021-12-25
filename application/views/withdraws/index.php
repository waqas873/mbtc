<style type="text/css">
.all_errors{
  color: #FF934A;
}
.all_inputs{
  width: 100%;
}
.modal-dialog {
    max-width: 60% !important;
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
        <h1 class="m-0"><?php echo (isset($heading))?$heading:"All Withdraws"; ?></h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active"><?php echo (isset($heading))?$heading:"All Withdraws"; ?></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row mb-2 currency_images">
      <div class="col-sm-3">
        <img src="assets/images/currencies/perfect_money.png" class="perfect_money-------">
      </div>
      <div class="col-sm-3">
        <img src="assets/images/currencies/tether.jpg">
      </div>
      <div class="col-sm-3">
        <img src="assets/images/currencies/payoneer.png">
      </div>
      <div class="col-sm-3">
        <img src="assets/images/currencies/bitcoin.jpg">
      </div>
    </div><!-- /.row -->

  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
        <!-- /.col (left) -->
        <div class="col-sm-12" style="margin-bottom: 10px;">
            <?php if($this->session->userdata('role')=="user") { ?>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-5">
                        <a href="javascript::" id="request_withdraw" class="btn btn-success border_radius yellow-btns">Request For Withdraw</a>
                    </div>
                </div>
            <?php } ?>
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?php echo (isset($heading))?$heading:"All Withdraws"; ?> List</h3>
              </div>
              <div class="card-body">
                
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No</th>
                    <?php if($this->session->userdata('role')=="admin") { ?>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>Wallet Address</th>
                    <?php } ?>
                    <th>Withdraw Amount</th>
                    <th>Fees</th>
                  <th>Final Amount</th>
                  <?php if(isset($this->selected_tab) && $this->selected_tab == "pending_withdraws") { ?>
                    <th>User Balance</th>
                  <?php } ?>
                  <th>Request Date</th>
                    <th>Status</th>
                    <?php if($this->session->userdata('role')=="admin") { ?>
                    <th>Action</th>

                    <?php } ?>
                    <!-- <th></th> -->
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                     if(isset($withdraws) && !empty($withdraws)) { 
                      $index = 1;
                      foreach ($withdraws as $Withdraw) {
                  ?>
                  <tr class="table_text_shadow">
                    <td><?php echo $index; ?></td>
                      <?php if($this->session->userdata('role')=="admin") { ?>
                          <td><?php echo ucwords($Withdraw['fullname']); ?></td>
                          <td><?php echo $Withdraw['email']; ?></td>
                          <td><?php echo $Withdraw['wallet_address']; ?></td>
                      <?php } ?>
                  <td><?php echo "$".$Withdraw['withdraw_amount']; ?></td>
                  <td><?php echo "$".$Withdraw['withdraw_fees']; ?></td>
                  <td><?php echo "$".($Withdraw['withdraw_amount']-$Withdraw['withdraw_fees']); ?></td>
                    <?php if(isset($this->selected_tab) && $this->selected_tab == "pending_withdraws") { ?>
                      <td><?php echo "$".$Withdraw['user_balance']; ?></td>
                    <?php } ?>
                      <td>
                          <?php 
                              $datetime = explode(' ', $Withdraw['requested_on']);
                              $date = $datetime[0];
                              echo $date; 
                          ?>
                      </td>
                      <td>
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
                      <?php if($this->session->userdata('role')=="admin") { ?>
                      <td>
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
  </td>
  <?php } ?>
                  </tr>
                  <?php 
                        $index++; 
                      } 
                     } 
                  ?>

              </tbody>
                </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col (right) -->
    </div>
  </div><!--/. container-fluid -->
</section>
<!-- /.content -->

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Withdraw Request</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo base_url('withdraws/process_add'); ?>" method="post" id="withdraw_form">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="first_name">Please enter your desire amount for withdraw here.</label>
                  <input type="number" name="withdraw_amount" class="form-control" placeholder="Enter amount" required>
                  <div class="all_errors first_name_error"></div>
                </div>
              </div>
              <button type="submit" class="btn btn-info yellow-btns">Send Request</button>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="otpModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">OTP For Withdraw Request</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="otpForm">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="first_name">An OTP is sent to your email address.Please check your mail and enter otp for withdraw request.</label>
                  <input type="text" name="otp" class="form-control" placeholder="Enter otp" required>
                  <div class="all_errors otp_error"></div>
                </div>
              </div>
              <button type="submit" class="btn btn-info yellow-btns">Send</button>
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
    $('#datatable').DataTable({});
});
</script>
<script type="text/javascript">
$(document).ready(function(){

$(document).on("click","#request_withdraw",function(){
  $.LoadingOverlay("show");
  $.ajax({
      url: base_url+'/otp/send_otp/withdraw',
      type: 'GET',
      dataType: 'JSON',
      success: function (data) {
        if(data.proceed){
          $("#myModal").modal();
        }
        else if(data.otp){
          $("#otpModal").modal();
        }
      },
      complete: function(){
        $.LoadingOverlay("hide");
      }
  });
});

$(document).on('submit', '#otpForm', function(e){
  e.preventDefault();
  var obj = $(this);
  $('.all_errors').empty();
  var formData = obj.serializeArray();
  $.LoadingOverlay("show");
  $.ajax({
      url: base_url+'/otp/verify_otp',
      type: 'POST',
      data: formData,
      dataType: 'JSON',
      success: function (data) {
        if(data.response){
          $("#otpModal").modal("hide");
          $("#myModal").modal("show");
        }
        else{
          swal({
            title: "Warning!",
            text: "Please enter valid OTP.",
            icon: "error",
            button: "OK",
          });
        }
      },
      complete: function(){
        $.LoadingOverlay("hide");
      }
  });
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