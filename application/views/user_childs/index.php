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
                <h3 class="card-title"><?php echo (isset($heading))?$heading:''; ?> Side Members</h3>
              </div>
              <div class="card-body">
                
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Sr No</th>
                    <th>Full Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Upline</th>
                    <th>Joined on</th>
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
                        <td><?php echo $user['gender']; ?></td>
                        <td><?php echo ucwords($user['parent_name']); ?></td>
                        <td>
                           <?php 
                                $datetime = explode(' ', $user['created_at']);
                                $date = $datetime[0];
                                echo $date; 
                            ?>
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

<!-- <div class="modal fade" id="addModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add <?php echo $this->title;?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="addForm">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="first_name">First Name</label>
                  <input type="text" name="first_name" class="form-control first_name" placeholder="First Name">
                  <div class="all_errors first_name_error"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="last_name">Last Name</label>
                  <input type="text" name="last_name" class="form-control last_name" placeholder="Last Name">
                  <div class="all_errors last_name_error"></div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control email" placeholder="First Name">
                  <div class="all_errors email_error"></div>
                </div>
                <div class="form-group col-md-6">
                  <label for="status">Status</label>
                  <select class="form-control status select2" name="status">
                      <option value="1">Active</option>
                      <option value="2">Inactive</option>
                  </select>
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
</div> -->

<script type="text/javascript">
$(document).ready(function(){
    $('#datatable').DataTable({});
});
</script>
