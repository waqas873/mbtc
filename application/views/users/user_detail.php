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
        <h1 class="m-0">User All Detail</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">User All Detail</li>
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
                <h3 class="card-title">User All Detail</h3>
              </div>
              <div class="card-body">
              
                <strong class="main_heading">PERSONAL INFORMATION ! </strong>
            
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4">
                        <strong class="personal_heading">User Full Name : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user))?ucwords($user['fullname']):''; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="personal_heading">Email Address : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user))?$user['email']:''; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="personal_heading">Username : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user))?$user['username']:''; ?></span>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4">
                        <strong class="personal_heading">Gender : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user))?$user['gender']:''; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="personal_heading">Sponsor ID : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user))?$user['sponsor_code']:''; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="personal_heading">Parent Name : </strong>
                        <?php 
                           $parent_id = 0;
                           if(isset($user)){
                              $parent_id = $user['referral_id'];
                           }
                           $parent = user_info($parent_id);
                        ?>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (!empty($parent))?ucwords($parent['fullname']):'Unavailable'; ?></span>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4">
                        <strong class="personal_heading">Position : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user) && ($user['position']=="right" || $user['position']=="left") )?ucwords($user['position']):'Beta Position'; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="personal_heading">Joined On : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user))?$user['user_created_at']:''; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="personal_heading">Status : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user) && $user['status']=='1')?'<span style="color:#0782c6 !important;">Active</span>':'<span style="color:red !important;">Blocked</span>'; ?></span>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4">
                        <strong class="personal_heading">Total Team Members : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($total_users))?$total_users:'0'; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="personal_heading">Right Team Members : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($right_users))?$right_users:'0'; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="personal_heading">Left Team Members : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($left_users))?$left_users:'0'; ?></span>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12">
                        <strong class="personal_heading">Wallet Address : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user) && !empty($user['wallet_address']) )?$user['wallet_address']:'Not Available'; ?></span>
                    </div>
                </div>

                <div style="margin-top: 20px !important;">
                <strong class="main_heading">Package Detail ! </strong>
                
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4">
                        <strong class="package_heading">Current Package : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user) && !empty($user['package_name']))?$user['package_name']:'None'; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="package_heading">Package Amount : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user) && !empty($user['up_package_amount']))?"$".$user['up_package_amount']:'None'; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="package_heading">ROI : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user) && !empty($user['package_roi']))?$user['package_roi']."%":'None'; ?></span>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4">
                        <strong class="package_heading">ROI Amount : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user) && !empty($user['package_roi']) && !empty($user['up_package_amount']) )?"$".(($user['package_roi']/100)*$user['up_package_amount']):'None'; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="package_heading">Activated At : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user) && !empty($user['up_created_at']))?$user['up_created_at']:'0000-00-00'; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="package_heading">Package Status : </strong>
                            <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; 
                            <?php 
                                $package_status = 'None';
                                if(isset($user)){
                                  if($user['up_status']=='0'){
                                        $package_status = '<span style="color:#F27421 !important;">Pending</span>';
                                  }
                                  if($user['up_status']=='1'){
                                        $package_status = '<span style="color:#37C6D3 !important;">Approved</span>';
                                  }
                                  if($user['up_status']=='2'){
                                        $package_status = '<span style="color:red !important;">Rejected</span>';
                                  }
                                }
                                echo $package_status;
                            ?>
                            </span>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4">
                        <strong class="package_heading">User Status : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; <?php echo (isset($user) && $user['up_status']==1)?'Active':'<span style="color:red !important;">Inactive</span>'; ?></span>
                    </div>
                </div>

                </div>

                <div style="margin-top: 20px !important;">
                <strong class="main_heading">Account Detail ! </strong>
                
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-4">
                        <strong class="account_heading">Total Balance : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; $<?php echo (isset($user))?$user['user_balance']:'0'; ?></span>
                    </div>
                      <div class="col-md-4">
                            <strong class="account_heading">Wallet Amount : </strong>
                            <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; $<?php echo (isset($user))?$user['wallet_balance']:'0'; ?></span>
                      </div>
                    <div class="col-md-4">
                        <strong class="account_heading">Total ROI Amount : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; $<?php echo (isset($roi_bonus))?$roi_bonus:'0'; ?></span>
                    </div>
                </div>

                <div class="row" style="margin-top: 20px;">
                      <div class="col-md-4">
                            <strong class="account_heading">Total Binary : </strong>
                            <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; $<?php echo (isset($binary_bonus))?$binary_bonus:'0'; ?></span>
                      </div>
                    <div class="col-md-4">
                        <strong class="account_heading">Total Referal Bonus : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; $<?php echo (isset($referal_bonus))?$referal_bonus:'0'; ?></span>
                    </div>
                    <div class="col-md-4">
                        <strong class="account_heading">Total Withdraws : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; $<?php echo (isset($total_withdraws))?$total_withdraws:'0'; ?></span>
                    </div>
                    
                </div>

                <div class="row" style="margin-top: 20px;">
                      <div class="col-md-4">
                            <strong class="account_heading">Right Team Investment : </strong>
                            <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; $<?php echo (isset($right_points))?$right_points:'0'; ?></span>
                      </div>
                    <div class="col-md-4">
                        <strong class="account_heading">Left Team Investment : </strong>
                        <span class="gray_shadow"> &nbsp;&nbsp;&nbsp; $<?php echo (isset($left_points))?$left_points:'0'; ?></span>
                    </div>
                </div>

                </div>

                <div style="margin-top: 20px !important;">
                <strong class="main_heading">Rewards ! </strong>
                
                
                <div class="row" style="margin-top: 20px;">
                    <div class="col-md-12">
                        <table class="table table-striped table-hover dt-responsive" id="datatable">
                            <thead>
                              <tr class="table_heading">
                               <th class="text_center">Sr No</th>
                               <th class="text_center">Title</th>
                               <th class="text_center">Right Investment</th>
                               <th class="text_center">Left Investment</th>
                               <th class="text_center">Status</th>
                              </tr>
                           </thead>
                           <tbody>
                            <?php 
                            if(isset($rewards) && !empty($rewards)) { 
                              $index = 1;
                              foreach ($rewards as $reward) {
                                ?>
                                <tr>
                                   <td class="gray_shadow"><?php echo $index; ?></td>
                                   <td class="gray_shadow"><?php echo $reward['reward_title']; ?></td>
                                   <td class="gray_shadow">$<?php echo $reward['reward_right_investment']; ?></td>
                                   <td class="gray_shadow">$<?php echo $reward['reward_left_investment']; ?></td>
                                   <td class="text_center">
                                    <?php 
                                      if($reward['ur_status']==1){
                                        $status = '<i class="fa fa-check icon_style" data-toggle="tooltip" title="You are qualified for this reward!" aria-hidden="true"></i>';
                                      }
                                      if($reward['ur_status']==2){
                                        $status = '<span data-toggle="tooltip" title="Congrats! You have been awarded with this reward."><i class="fa fa-check icon_style" aria-hidden="true"></i><i class="fa fa-check icon_style" aria-hidden="true"></i></span>';
                                      }
                                      echo $status;
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
                </div>

                </div>

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
