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
<style>
   .well {
    background: white;
    padding: 17px;
    box-shadow: 0px 3px 9px 3px #b3b3b3 !important;
    width: 100%;
    margin: 0 auto;
    border-left: 6px solid #B569DB;
    border-bottom: 6px solid #B569DB;
    border-right: 6px solid #ffffff;
    border-top: 6px solid #ffffff;
    margin-bottom: 20px;
}
    .i_c3 {
    background: linear-gradient(32deg, #FF4137, #FDC800);
    color: white;
    padding: 10px 10px;
}
.well {
    background-color: #ffffff !important;
    color: black!important;
}
.card-header{
  background: linear-gradient(32deg, #9E48CD, #CB87E9);
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
        <h1 class="m-0">News Section</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">News Section</li>
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
                <h3 class="card-title">News Display</h3>
              </div>
              <div class="card-body">
                
                <?php 
                  if(isset($news) && !empty($news)) {
                     foreach ($news as $key => $news) {   
                 ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="well shadow">
                            <div class="i_c3">
                                <strong style="font-size: 20px;"><?php echo $news['news_title'];?></strong>
                                <br>
                            </div>
                            <p style="margin-top: 10px;">
                                <?php echo $news['news_des'];?>
                                <span>
                                    <?php if(!empty($news['news_pic'])) { ?>
                                      &nbsp;&nbsp;<a target="_blank" style="text-decoration: none;" href="<?php echo base_url('assets/news_images/'.$news['news_pic']);?>">View Image</a>
                                    <?php } ?>
                                </span> 
                            </p>
                            <p style="color: #FE841C;"><?php echo $news['news_created_date'];?></p>
                        </div>
                    </div>
                </div>
                <?php } } ?>

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
