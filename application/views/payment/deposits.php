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
          <li class="breadcrumb-item active">Deposit Histories</li>
        </ol>
      </div><!-- /.col -->
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
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">All Payments List</h3>
              </div>
              <div class="card-body">
                
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.NO</th>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Proof</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php 
                     if(!empty($payments)){ 
                      foreach ($payments as $key => $value) {
                        $exchange_rate = "1:1";
                        $deposited_amount = ( intval($value['status']) == 1 ? "$".round($value['amount'],2) : 'N/A');
                        if($value['status']==0 && $value['payment_method']=="perfect-money"){
                          continue;
                        }
                  ?>
                  <tr>
                    <td><?=$key+1?></td>
                    <td><?=$value['refference_number'];?></td>
                    <td><?=$value['fullname'];?></td>
                    <td><?=$value['payment_method'];?></td>
                    <td >$ <?=$value['amount'];?></td>
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
                    <td><?=$value['created_at'];?></td>
                    <td>
                      <?php
                      $action = '----';
                      if($value['payment_method']=="USDT" && $value['status']==0){
                        $action = '<a href="javascript::" rel="'.$value['id'].'" class="ph_id">Transfer Amount</a>';
                      }
                      echo $action;
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

<div class="modal fade" id="transferBalanceModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Transfer Balance to User Wallet</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="transferBalanceForm">
              <input type="hidden" name="id" id="ph_id">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="amount">Enter Amount</label>
                  <input type="number" name="amount" class="form-control amount" placeholder="Enter Amount" required="">
                  <div class="all_errors amount_error"></div>
                </div>
              </div>
              <button type="submit" class="btn btn-info transfer_amount_btn">Transfer Amount</button>
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

  $(document).on('click', '.ph_id', function (e){
    var ph_id = $(this).attr("rel");
    $('#transferBalanceForm').trigger("reset");
    $('#ph_id').val(ph_id);
    $('#transferBalanceModal').modal("show");
  });

  $(document).on('click', '.transfer_amount_btn', function (e) {
    $('.all_errors').empty();
    swal({
      title: "Are you sure?",
      text: "Once you have transfered this amount this action cannot be revert.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var formData = $("#transferBalanceForm").serializeArray();
        $.LoadingOverlay("show");
        $.ajax({
            url: base_url+'/payment/transferAmount',
            type: "POST",
            dataType: 'json',
            data: formData,
            success: function (data) {
              if(data.response){
                swal("Amount has been transfered successfully.")
                .then((value) => {
                  location.reload();
                });
              }
              else{
                errors(data.errors);
              }
            },
            complete: function(){
              $.LoadingOverlay("hide");
            }
        });
      }
    });
    return false;
  });

  $('#datatable').DataTable({});
});

function errors(arr = ''){
  $.each(arr, function( key, value ) {
    $('.'+key+'_error').html(value);
  });
  return false;
}

</script>

