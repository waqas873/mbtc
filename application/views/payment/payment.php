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
.well_usdt {
  height: auto;
  background: linear-gradient(180deg, #1A4C8B,#26718F);
  color: white;
  padding: 15px 5px 1px 15px;
  margin: 0px 0px 15px 0px;
  border-radius: 6px;
}
#usdt_upload {
  float: right;
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
        <h1 class="m-0">Deposit Histories</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">Perfect Money</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->

    <div class="row mb-2 currency_images">
      <div class="col-sm-3">
        <img src="assets/images/currencies/perfect_money.png" class="currency_icons" rel="pm">
      </div>
      <div class="col-sm-3">
        <img src="assets/images/currencies/tether.jpg" class="currency_icons" rel="usdt">
      </div>
      <div class="col-sm-3">
        <img src="assets/images/currencies/payoneer.png" class="currency_icons" rel="payoneer">
      </div>
      <div class="col-sm-3">
        <img src="assets/images/currencies/bitcoin.jpg" class="currency_icons" rel="btc">
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
                        <a href="javascript::" id="pay_now" class="btn btn-success border_radius yellow-btns">Perfect Money Payment</a>
                    </div>
                </div>
                <div class="well well_usdt">
                  <div class="row" style="margin-bottom: 15px;">
                    <div class="col-md-12">
                        <p style="margin-bottom: 0px;">Copy below USDT wallet address,pay desired amount and upload proof.</p>
                    </div>
                  </div>
                  <div class="row" style="margin-bottom: 15px;">
                      <div class="col-md-10">
                          <div><strong>Transfer to: </strong><span id="walletAddress">TM6EpWbQwBcMR9fWWthXs79qKf87decsjW</span> &nbsp;&nbsp;&nbsp;<a href="javascript::" class="btn btn-success btn-sm border_radius yellow-btns" onclick="copyToClipboard('#walletAddress')">Copy Wallet Address</a></div>
                      </div>
                      <div class="col-md-2">
                          <a href="javascript::" id="usdt_upload" class="btn btn-success border_radius yellow-btns">Upload Proof</a>
                      </div>
                  </div>
                </div>
            <?php } ?>
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><?php echo (isset($heading))?$heading:"All Payments"; ?> List</h3>
              </div>
              <div class="card-body">
                
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.NO</th>
                    <th>ID</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $payments_data = getUserDepositHistory($this->session->userdata('id'));
                     if(isset($payments_data) && !empty($payments_data)) { 
                      foreach ($payments_data as $key => $value) {
                        $exchange_rate = "1:1";
                        $deposited_amount = ( intval($value['status']) == 1 ? "$".round($value['amount'],2) : 'N/A');
                        if($value['status']==0 && $value['payment_method']=="perfect-money"){
                          continue;
                        }
                  ?>
                  <tr>
                    <td><?=$key+1?></td>
                    <td><?=$value['refference_number']?></td>
                    <td><?=$value['payment_method']?></td>
                    <td >$ <?=$value['amount']?></td>
                    <td><?php
                    $proof = "N/A";
                    if(!empty($value['transfer_proof'])){
                      $proof = '<a href="'.site_url("assets/payments/".$value['transfer_proof']).'" target="_blank">Click Here</a>';
                    }
                    echo $proof;
                    ?></td>
                    <td>
                    <?php
                      if(intval($value['status']) == 1){
                        echo 'Completed';
                      }
                      else{
                        echo("Pending");
                      }
                    ?>
                    </td>
                    <td><?=$value['created_at']?></td>
                  </tr>
                  <?php } } ?>

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
          <h4 class="modal-title">Add Amount to Deposit</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo base_url('payment/confirm_pay'); ?>" method="post">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="first_name">Please enter your desire amount for deposit here.</label>
                  <input type="text" name="usd_amount" class="form-control" placeholder="Enter amount" required>
                  <div class="all_errors usd_amount_error"></div>
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

<div class="modal fade" id="usdtModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">After Transfer upload proof</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="<?php echo base_url('payment/processUsdt'); ?>" enctype="multipart/form-data" method="post">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="first_name">please upload proof of your transfer.</label>
                  <input type="file" name="transfer_proof" class="form-control" required>
                  <div class="all_errors transfer_proof_error"></div>
                </div>
              </div>
              <button type="submit" class="btn btn-info yellow-btns">Upload Proof</button>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<script type="text/javascript">

function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  alert("Copied successfully");
}

$(document).ready(function(){

    $(".well_usdt").hide();

    $(document).on("click","#pay_now",function(){
        $("#myModal").modal();
    });
    // $(document).on("submit","#withdraw_form",function(){
    //     if($('#withdraw_form').valid()){
    //       $("#myModal").modal('hide');
    //     }
    // });

    $(document).on("click",".currency_icons",function(e){
      $(".currency_icons").removeClass("active");
      var ci = $(this).attr("rel");
      $(this).toggleClass('active');
      if(ci=="usdt"){
        $(".well_usdt").fadeIn();
      }
      else{
        $(".well_usdt").hide();
      }
    });

    $(document).on("click","#usdt_upload",function(){
        $("#usdtModal").modal();
    });

    // $('#withdraw_form').validate();
    // $('#datatable').DataTable({});
  
});

</script>

