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
        <h1 class="m-0">All Users</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">All Users</li>
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
            <!-- <div>
                <a href="javascript::" id="addButton" class="btn btn-info">Add User</a>
            </div> -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">All Users List</h3>
              </div>
              <div class="card-body">
                
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Password</th>
                    <!-- <th>Joined on</th> -->
                    <th>Status</th>
                    <th>Balance</th>
                    <th>Funds Transfer</th>
                    <th>Detail</th>
                    <th>Histories</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                       if(isset($users) && !empty($users)) { 
                        $index = 1;
                        foreach ($users as $user) {
                    ?>
                    <tr class="table_text_shadow">
                        <td><?php echo $index; ?></td>
                        <td><?php echo ucwords($user['fullname']); ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['password']; ?></td>
                        <!-- <td>
                           <?php 
                                $datetime = explode(' ', $user['created_at']);
                                $date = $datetime[0];
                                echo $date; 
                            ?>
                        </td> -->
                        <td>
                            <?php 
                               if($user['status']==0){
                                   $status = '<span class="label label-sm label-danger label_style"> Inactive </span>';
                               }
                               if($user['status']==1){
                                   $status = '<span class="label label-sm label-success label_style"> Active </span>';
                               }
                               echo $status;
                            ?>
                        </td>
                        <td>$<?php echo $user['wallet_balance']; ?></td>
                        <td>
                            <a style="text-decoration: none;" href="javascript::" rel="<?php echo $user['id'];?>" class="transfer_user_id">
                                <span>Transfer</span>
                            </a> | <a style="text-decoration: none;" href="javascript::" rel="<?php echo $user['id'];?>" class="deduct_user_id">
                                <span>Deduct</span>
                            </a>
                        </td>
                        <td>
                            <a style="text-decoration: none;" href="<?php echo base_url('users/user_detail/'.$user['id'].'/jPh2G6YvqLqU');?>">
                                <span>Detail</span>
                            </a>
                        </td>
                        <td>
                            <a class="histories" style="text-decoration: none;" href="<?php echo base_url('histories/referral/'.createBase64($user['id']));?>">
                                <span>Referral</span>
                            </a></br>
                            <a class="histories" style="text-decoration: none;" href="<?php echo base_url('histories/binary/'.createBase64($user['id']));?>">
                                <span>Binary</span>
                            </a></br>
                            <a class="histories" style="text-decoration: none;" href="<?php echo base_url('histories/roi/'.createBase64($user['id']));?>">
                                <span>ROI</span>
                            </a></br>
                        </td>
                        <td>
                            <?php if($user['status']==0) { ?>
                            <a href="<?php echo base_url("users/activate_user/").$user['id']; ?>" class="btn btn-primary btn-sm border_radius" onclick="delete_record(this, 'users'); return false;">Activate</a>
                            <?php } else { ?>
                            <a href="<?php echo base_url("users/block_user/").$user['id']; ?>" class="btn btn-danger btn-sm border_radius" onclick="delete_record(this, 'users'); return false;">Block</a>
                            <?php } ?>
                            </br><a href="javascript::" class="btn btn-success btn-sm border_radius update_id_btn" style="margin-top: 3px;" rel="<?php echo $user['id']; ?>">Edit</a>
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
          <h4 class="modal-title">Transfer Balance</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="transferBalanceForm">
              <input type="hidden" name="user_id" id="user_id">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="amount">Enter Amount</label>
                  <input type="number" name="amount" class="form-control amount" placeholder="Enter Amount">
                  <div class="all_errors amount_error"></div>
                </div>
              </div>
              <button type="submit" class="btn btn-info">Save Data</button>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="deductBalanceModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Deduct Balance</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="deductBalanceForm">
              <input type="hidden" name="user_id" id="ded_user_id">
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="amount">Enter Amount</label>
                  <input type="number" name="amount" class="form-control amount" placeholder="Enter Amount">
                  <div class="all_errors amount_error"></div>
                </div>
              </div>
              <button type="submit" class="btn btn-info">Save Data</button>
            </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="updateModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Update User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="updateForm">
              <input type="hidden" name="id" id="update_user_id">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="fullname">Full Name</label>
                  <input type="text" name="fullname" class="form-control fullname" placeholder="Enter full name">
                  <div class="all_errors fullname_error"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="text" name="email" class="form-control email" placeholder="Enter full name">
                  <div class="all_errors email_error"></div>
                </div>
              </div>
              <button type="submit" class="btn btn-info">Save Data</button>
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

$(document).on('click', '.update_id_btn', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var id = $(this).attr("rel");
    if(id==''){
      return false;
    }
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "users/update/"+id,
        type: "GET",
        dataType: 'json',
        success: function (data) {
          if(data.response){
            $('#updateForm').trigger("reset");
            $('#update_user_id').val(data.result.id);
            $('.fullname').val(data.result.fullname);
            $('.email').val(data.result.email);
            // $.each(data.deal_products, function( key, value ) {
            //   $('.product_id').val(data.deal_products).change();
            // });
            $('#updateModal').modal("show");
          }
        },
        complete: function(){
          $.LoadingOverlay("hide");
        }
    });
    return false;
});

$(document).on('submit', '#updateForm', function (e) {
    e.preventDefault();
    $.LoadingOverlay("show");
    var obj = $(this);
    $('.all_errors').empty();
    $.ajax({
        url: base_url + "users/process_update",
        type: "POST",
        dataType: 'json',
        data: new FormData(this),
        processData: false, 
        contentType: false,
        success: function (data) {
            if(data.response){
                swal("Data has been updated successfully.")
                .then((value) => {
                  location.reload(); 
                });
            }
            else{
                if(data.image_error!=''){
                  $('.image_error').html(data.image_error);
                }
                else{
                  errors(data.errors);
                }
            }
        },
        complete: function(){
          $.LoadingOverlay("hide");
        }
    });
    return false;
});

$(document).on('click', '.transfer_user_id', function (e){
  var user_id = $(this).attr("rel");
  $('#user_id').val(user_id);
  $('#transferBalanceForm').trigger("reset");
  $('#transferBalanceModal').modal("show");
});

$(document).on('click', '.deduct_user_id', function (e){
  var user_id = $(this).attr("rel");
  $('#ded_user_id').val(user_id);
  $('#deductBalanceForm').trigger("reset");
  $('#deductBalanceModal').modal("show");
});

$(document).on('submit', '#transferBalanceForm', function(e){
  e.preventDefault();
  var obj = $(this);
  $('.all_errors').empty();
  var formData = obj.serializeArray();
  $.ajax({
      url: base_url+'/users/transferAmount',
      type: 'POST',
      data: formData,
      dataType: 'JSON',
      success: function (data) {
        if(data.response){
          obj.trigger("reset");
          $('#transferBalanceModal').modal('hide');
          swal("Amount has been transfered successfully.")
          .then((value) => {
            location.reload();
          });
        }
        else{
          errors(data.errors);
        }
      }
  });
});

$(document).on('submit', '#deductBalanceForm', function(e){
  e.preventDefault();
  var obj = $(this);
  $('.all_errors').empty();
  var formData = obj.serializeArray();
  $.ajax({
      url: base_url+'/users/deductAmount',
      type: 'POST',
      data: formData,
      dataType: 'JSON',
      success: function (data) {
        if(data.response){
          obj.trigger("reset");
          $('#deductBalanceModal').modal('hide');
          swal("Amount has been deducted successfully.")
          .then((value) => {
            location.reload();
          });
        }
        else if(data.less){
          swal({
            title: "Warning",
            text: "The amount you entered is greater than user wallet amount.",
            icon: "error",
            button: "Ok",
          });
        }
        else{
          errors(data.errors);
        }
      }
  });
});

$('#datatable').DataTable({});

function errors(arr = ''){
  $.each(arr, function( key, value ) {
    $('.'+key+'_error').html(value);
  });
  return false;
}

});
</script>
