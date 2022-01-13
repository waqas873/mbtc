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
.text_center{
  text-align: center;
}
.user_balance{
  color: #00A3E7;
  font-weight: 600;
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
        <h1 class="m-0">Internal Transfers</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">Internal Transfers</li>
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
        <div class="col-sm-12">
            <div style="margin-bottom: 10px;">
                <a href="javascript::" id="addButton" class="btn btn-info">Add Transfer</a>
            </div>
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Internal Transfers Details</h3>
              </div>
              <div class="card-body">
                
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="text_center">Sr No</th>
                    <th class="text_center">From Wallet</th>
                    <th class="text_center">To Wallet</th>
                    <th class="text_center">Amount Transfered</th>
                    <th class="text_center">Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($result)){
                        foreach($result as $key=>$value){
                    ?>
                    <tr class="table_text_shadow">
                      <td class="text_center"><?php echo $key+1; ?></td>
                      <td class="text_center">$<?php echo $value['de_earning']; ?></td>
                      <td class="text_center"><?php echo $value['de_date']; ?></td>
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
          <h4 class="modal-title">Transfer Amount</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="addForm">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="first_name">You have <span class="user_balance">$<?php echo $user_balance;?></span> in your earned wallet to transfer in your main wallet.</label>
                  <input type="number" name="amount" class="form-control" placeholder="Enter amount" required>
                  <div class="all_errors amount_error"></div>
                </div>
              </div>
              <button type="submit" class="btn btn-info yellow-btns">Transfer</button>
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

  $(document).on("click","#addButton",function(){
    $("#addForm").trigger('reset');
    $("#myModal").modal('show');
  });

  $(document).on('submit', '#addForm', function(e){
    e.preventDefault();
    var obj = $(this);
    $('.all_errors').empty();
    var formData = obj.serializeArray();
    $.LoadingOverlay("show");
    $.ajax({
        url: base_url+'/internal_transfers/process_add',
        type: 'POST',
        data: formData,
        dataType: 'JSON',
        success: function (data) {
          if(data.response){
          }
          else{
            swal({
              title: "Warning!",
              text: "Please enter valid amount for transfer.",
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

    $('#datatable').DataTable({});
});
</script>
