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
        <h1 class="m-0">We Support Perfect Money Payments</h1>
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
        <img src="assets/images/currencies/perfect_money.png" class="perfect_money">
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
                        <a href="javascript::" id="pay_now" class="btn btn-success border_radius yellow-btns">Make a Payment</a>
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
                    <th>Date</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <!-- <th>Exchange Rate</th> -->
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $payments_data = getUserDepositHistory($this->session->userdata('id'));
                     if(isset($payments_data) && !empty($payments_data)) { 
                      foreach ($payments_data as $key => $value) {

                        $exchange_rate = "1:1";
                        $deposited_amount = ( intval($value['status']) == 1 ? "$".round($value['amount'],2) : 'N/A');

                  ?>
                  <tr>
                    <td ><?=$key+1?></td>
                    <td><?=$value['refference_number']?></td>
                    <td><?=$value['date_created']?></td>
                    <td><?=$value['payment_method']?></td>
                    <td >$ <?=$value['amount']?></td>
                    <!-- <td><?=$exchange_rate?></td> -->

                    <?php 
                      // $strStart = $value['date_created']." ".$value['time_created'];
                      // $arr = json_decode($value['payment_post_status'],true);
                      // if(strlen( $arr["transaction_hash"] ) > 0){$st = true;}else{$st = false;}
                      // $dteStart = new DateTime($strStart);
                      // $dteEnd   = new DateTime('now');
                      // $dteDiff  = $dteStart->diff($dteEnd);
                      // $minutes = (time() - strtotime($strStart)) / 60;
                      // $exp;
                      // //echo $minutes .'|'. (intval(getSiteSettings('btc_timer')*60));
                      // if( $minutes > (intval(getSiteSettings('btc_timer')))) {$exp = true;}else{$exp = false;}
                    ?>
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

<script type="text/javascript">
$(document).ready(function(){
    $('#datatable').DataTable({});
});
</script>

<script type="text/javascript">
$(document).ready(function(){

    $(document).on("click","#pay_now",function(){
        $("#myModal").modal();
    });

    $('#withdraw_form').validate();

    $(document).on("submit","#withdraw_form",function(){
        if($('#withdraw_form').valid()){
            $("#myModal").modal('hide');
        }
    });
  
});
</script>

