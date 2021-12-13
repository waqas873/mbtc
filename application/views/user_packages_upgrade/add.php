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
<style type="text/css">
.news-block {
    padding-bottom: 50px !important;
}
.hexa_design {
    margin: auto;
    width: 75%;
    margin-bottom: 45px;
}
.in-client-grid {
    display: inline-block;
    padding: 20px;
    width: 100%;
    vertical-align: middle;
    position: relative;
    top: -71px;
}
.icon-box {
    margin: 50px 0;
}
.client-big {
    position: relative;
    width: 200px;
    height: auto;
    background-color: #26718F !important;
    box-shadow: 0 0 20px rgba(0,0,0,.25);
    border-radius: 7px;
    top: 103px;
    left: -15px;
    text-align: center;
    padding-bottom: 35px;
}
.client-big, .client-small {
    transition: transform .3s ease;
}
.client-big::before {
    content: "";
    position: absolute;
    width: 105.36px;
    height: 61.36px;
    -webkit-transform: scaleY(.5774) rotate(-46deg);
    -ms-transform: scaleY(.5774) rotate(-46deg);
    transform: scaleY(.5774) rotate(-45.5deg);
    background: inherit;
    left: 56.8205px;
    border-radius: 8px;
    top: -49.6795px;
}
.client-big::after{
    content: "";
    position: absolute;
    width: 105.36px;
    height: 61.36px;
    -webkit-transform: scaleY(.5774) rotate(-46deg);
    -ms-transform: scaleY(.5774) rotate(-46deg);
    transform: scaleY(.5774) rotate(-45.5deg);
    background: inherit;
    left: 41.8205px;
    border-radius: 8px;
    bottom: -51.6795px;
}

.hexa_text {
    text-align: center;
    position: relative;
    font-size: 27px;
    top: 25px;
    color: #838382;
    font-weight: 600;
    margin-bottom: 45px;
}
.client-big h3 {
    color: white;
font-size: 19px;
}

.buy_now{
  /*background: linear-gradient(32deg, #FF4137, #FDC800);*/
  background-color: #FBAD19 !important;
  width: 130px;
  margin-top: 10px;
  color: white;
}
.client-big:hover {
  transform: scale(1.1);
  transition: transform 1s;
  box-shadow: 1px 2px 8px rgb(251, 173, 25);
  background-color: #FBAD19 !important;
}
.client-big:hover > .client-big::before{
  background-color: #FBAD19 !important;
}
.client-big:hover > .buy_now {
  background-color: #26718F !important;
  transform: scale(1.1);
  transition: transform 1s;
  box-shadow: 1px 2px 8px rgb(251, 173, 25);
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
        <h1 class="m-0">Upgrade Your Package</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">Upgrade Your Package</li>
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
                <h3 class="card-title">Upgrade Your Package</h3>
              </div>
              <div class="card-body">
                <div class="row">
                <?php 
                      if(isset($packages) && !empty($packages)) {
                      foreach ($packages as $key => $package) {
                    $tax = round((int)$package['package_min_amount']*(int)$package['package_fees']/100);
                    $total = (int)$package['package_min_amount']+$tax;
                ?>
                <div class="col-sm-4">
                  <div class="hexa_design">
                      <div class="in-client-grid">
                          <div class="icon-box client-big">
                              <h2 class="hexa_text"><?php echo $package['package_name']; ?></h2>
                              <h3>MIN - $<?php echo $package['package_min_amount']; ?></h3>
                              <h3>MAX - $<?php echo $package['package_max_amount']; ?></h3>
                              <h3>ROI - <?php echo $package['package_roi']; ?>%</h3>
                              <h3>FEE - $<?php echo $package['package_fees']; ?></h3>
                              <a href="javascript::" rel="<?php echo $package['package_id']; ?>" class="btn btn-warning buy_now buy_package">Upgrade </a>
                          </div>
                      </div>
                  </div>
                </div>
                <?php } } ?>
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

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Desired Package Amount</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="post" action="<?php echo base_url('user_packages_upgrade/process_add'); ?>" id="amount_form" novalidate>
              <div class="form-row">
                <div class="form-group col-md-12">
                  <label for="first_name">
                    <span style="font-size: 16px;">
                      Please enter your desire amount to upgrade your package. Minimum amount is <span id="minimum_amount"> </span> and maximum amount is <span id="maximum_amount"> </span>.
                    </span>
                  </label>
                  <input type="number" class="form-control" name="up_package_amount" id="up_package_amount" required >
                  <input type="hidden" class="form-control" name="package_id" id="package_id">
                  <div id="package_error" style="color: red;"></div>
                </div>
              </div>
              <a href="javascript::" class="btn btn-info text_shadow yellow-btns" id="amount_btn">Upgrade Package</a>
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
    
    $(document).on("click",".buy_package",function(){
      var package_id = $(this).attr('rel');
      if (package_id != '') {
        $url = base_url + "user_packages/get_package";
        $data = 'package_id=' + package_id;
        $.ajax({
          url: $url,
          type: "POST",
          dataType: 'json',
          data: $data,
          success: function (data) {
              if(data!=''){
                $('#minimum_amount').empty();
                $('#maximum_amount').empty();
                $('#package_id').val('');
                $('#minimum_amount').append("$" + data.package_min_amount);
                $('#maximum_amount').append("$" + data.package_max_amount);
                $('#package_id').val(data.package_id);
                $("#myModal").modal();
              }
          }
        });
      }
  });

  $(document).on("click","#amount_btn",function(e){
    var package_id = $('#package_id').val();
      var up_package_amount = parseInt($('#up_package_amount').val());
      
      $('#package_error').empty();
      if (up_package_amount != '' && package_id != '') {
          $url = base_url + "user_packages/check_package_amount";
          $data = { "package_id":package_id, "up_package_amount":up_package_amount };
          $.ajax({
            url: $url,
            type: "POST",
            dataType: 'json',
            data: $data,
            success: function (data) {
                if(data.response){
                        $("#myModal").modal('hide');
                  $('#amount_form').submit();
                }
                else{
                  $('#package_error').html('Please enter amount in the range of package amount.');
                  return false;
                }
            }
        });
      }
      else{
        $('#package_error').html('Please enter amount first to purchase package.');
        return false;
      }
  });

  $(document).on("keyup","#up_package_amount",function(){
    $('#package_error').empty();
    var up_package_amount = $('#up_package_amount').val();
    if(!parseInt(up_package_amount)){
      $('#package_error').html('Please enter only digits as package amount.');
    }
  });

});
</script>

