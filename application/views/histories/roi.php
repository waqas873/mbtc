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
        <h1 class="m-0">Roi History</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">History Details</li>
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
            <!-- <div style="margin-bottom: 10px;">
                <a href="<?php echo base_url("packages/add/"); ?>" id="addButton" class="btn btn-info">Add Package</a>
            </div> -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">History Details</h3>
              </div>
              <div class="card-body">
                <form id="deductForm">
                <div class="row">
                  <div class="col-sm-12">
                    <div style="margin-bottom: 10px;">
                      <button type="submit" class="btn btn-info">Deduct Roi Bonus</button> 
                    </div>
                  </div>
                </div>
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                     <th><input type="checkbox" class="allBoxes"></th>
                    <th>Sr No</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Amount Recieved</th>
                    <th>Date</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      if(!empty($result)){
                        foreach($result as $key=>$value){
                    ?>
                    <tr class="table_text_shadow">
                      <td>
                        <input type="checkbox" name="de_ids[]" class="eachBox" value="<?php echo $value['de_id'];?>">
                      </td>
                      <td class="text_center"><?php echo $key+1; ?></td>
                      <td class="text_center"><?php echo $value['fullname']; ?></td>
                      <td class="text_center"><?php echo $value['username']; ?></td>
                      <td class="text_center">$<?php echo $value['de_earning']; ?></td>
                      <td class="text_center"><?php echo $value['de_date']; ?></td>
                    </tr>
                    <?php } } ?>
                  </tbody>
                </table>
                </form>
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

<script type="text/javascript">
$(document).ready(function(){
    $('#datatable').DataTable({});

    $(document).on('submit', '#deductForm', function (e) {
      e.preventDefault();
      if(!$('.eachBox').is(':checked')){
        swal({
          title: "Warning!",
          text: "Please select amounts which are to be deducted.",
          icon: "error",
          button: "OK",
        });
        return false;
      }
      $.LoadingOverlay("show");
      var formData = $("#deductForm").serializeArray();
      $.ajax({
        url: base_url + "histories/process_deduct",
        type: "POST",
        dataType: 'json',
        data:{'de_ids':formData},
        success: function (data) {
            if(data.response){
              swal("Amount has been deducted successfully.")
                .then((value) => {
                  location.reload(); 
              });
            }
            else{
              swal({
                title: "Warning!",
                text: data.msg,
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
    
});
</script>
