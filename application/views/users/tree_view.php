<link rel="stylesheet" href="assets/treant-js-master/Treant.css">
<link rel="stylesheet" href="assets/treant-js-master/examples/collapsable/collapsable.css">
<link rel="stylesheet" href="assets/treant-js-master/vendor/perfect-scrollbar/perfect-scrollbar.css">
<style type="text/css">
  .node-name {
    font-size: 15px;
  }
  .node-title{
    font-size: 20px;
    text-align: center;
  }
  .node-contact{
    font-size: 20px;
  }
  .chart {
    min-height: 500px;
    width: 100%;
    margin: auto;
    height: 500px !important;
  }
</style>

<style type="text/css">
  .caption_color{
    color: #fff !important;
  }
  .text_center{
    text-align: center;
  }
  .border_radius{
    border-radius: 8px !important;
  }
  .label_style{
       border-radius: 5px !important;   
    }
    .plb {
    background-color: white !important;
}
.portlet.light {
  background-image: linear-gradient(to right, #129a12,#6ebb6b,#129a12,#6ebb6b)!important;
    /*background: linear-gradient( to left,#c0d4bd66 , #129a12 )!important;*/
    box-shadow: -8px 8px 23px #6b6b6b !important;
}

</style>

<style type="text/css">
    .fa-group{
      color: green;
      font-size: 60px;
    }
    .box_text_box{
      margin-top: 30px;
    }
    .box_text_box h4{
      color: green;
      font-weight: 600;

    }
    .portlet.box.green>.portlet-title, .portlet.green, .portlet>.portlet-body.green {
          background: linear-gradient(to bottom, #ece7e7 , #129a12 )!important;
 
}
.portlet.box>.portlet-body {
   background-color: #fefefe!important;

    padding: 15px;
}
 .box_text_box{
  position: relative;
  left: 10px;
  top: 141px;
 }

.box_m{
  width: 100%;
  height: 130px;
  border:1px solid #cec6c6;
  position: relative;
  padding-left: 20px;
}
.box_m:hover{
  background-color: #f3f0f0;
  box-shadow: 0px 10px #f3f0f0;
}
.box_m p{
  color: black!important;
  font-size: 20px;
  font-weight: bold;
  color: green!important;
}
.box12{
  border-right: 51px solid green;
  border-bottom: 45px solid transparent;
  opacity: 0.7;
  position: absolute;
  right: 0px;
}
.fa-group{
  color: green;
  font-size: 60px;
}
.abcd{
  margin-top:55px;
}
.members{
  color: green;
  position: relative;
  top: -13px;
  left: 11px;
}
.chart {
  position: relative;
  top: 33px;
  left: -45px;
}
.members h4{
  font-weight:600;
}

#collapsable-example{
  margin-right: 0px !important;
  margin-left: 46px !important;
}
.portlet-body{
  min-height: 550px !important;
}
@media(max-width: 580px){
    .portlet-body{
      min-height: 650px !important;
    }
}

@media only screen 
and (min-device-width : 320px) 
and (max-device-width : 740px) 
and (orientation : landscape) { 
    .chart {min-height:300px !important; height: 300px !important;}
	#collapsable-example {top: 20px !important;}
	.portlet-body{ min-height: 650px !important;}
}

@media (min-width :1366px) and (max-width :1400px){
  .chart {left: -45px;}
}
.tree_data{
  padding-bottom: 42px;
}
</style>

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
.strong_text {
    font-weight: 600;
}
.bottom_border{
  border-bottom: 1px solid #ABB1BA;
margin: auto;
width: 85%;
margin-top: 5px;
margin-bottom: 6px;
}

@media only screen and (min-width: 320px) and (max-width: 520px){
  .col-sm-4{
    width: 33% !important;
  }
  .col-sm-6{
    width: 50% !important;
  }
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
      <div class="col-md-6">
        <h1 class="m-0">Team Members</h1>
      </div><!-- /.col -->
      <div class="col-md-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?php echo base_url('User/Userdashboard');?>">Home</a></li>
          <li class="breadcrumb-item active">Team Members</li>
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
                <h3 class="card-title">All Team Members View in Tree Structure</h3>
              </div>
              <div class="card-body">
                
                <div class="row">
                  <div class="col-md-12">
                    <div class="tree_data">
                      <div class="chart" id="collapsable-example"></div>
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

<style type="text/css">
  [data-title]:hover:after {
    opacity: 1;
    transition: all 0.1s ease 0.5s;
    visibility: visible;
}
[data-title]:after {
    content: attr(data-title);
    position: absolute;
    bottom: -1.2em;
    left: 70%;
    padding: 4px 4px 4px 8px;
    color: white;
    white-space: nowrap; 
    -moz-border-radius: 5px; 
    -webkit-border-radius: 5px;  
    border-radius: 5px;  
    -moz-box-shadow: 0px 0px 4px #222;  
    -webkit-box-shadow: 0px 0px 4px #222;  
    box-shadow: 0px 0px 4px #222;  
    /*background-color: #055205 !important;*/
    background-image: linear-gradient(40deg, #BF68E6 20%, #9E48CD 51%, #BF68E6 90%);
    opacity: 0;
    z-index: 99999;
    visibility: hidden;
}
[data-title] {
    position: relative;
}
.node img{
  width: 75px !important;
  border-radius: 50%  !important;
}
.node{
  border-radius: 50% !important;
}
</style>

<script src="assets/treant-js-master/vendor/raphael.js"></script>
<script src="assets/treant-js-master/Treant.js"></script>
<script src="assets/treant-js-master/vendor/jquery.easing.js"></script>

<?php 
$packageDe = package_detail($this->session->userdata('id'));
$img = (!empty($packageDe['package_image']))?$packageDe['package_image']:'user_user.jpg';
?>

<script>
  $url = base_url + "user/get_tree_view";
  $.ajax({
      url: $url,
      type: "POST",
      dataType: 'json',
      success: function (data) {
          var chart_config = {
          chart: {
              container: "#collapsable-example",
              animateOnInit: true,
              node: {
                  collapsable: true
              },
              animation: {
                  nodeAnimation: "easeOutBounce",
                  nodeSpeed: 700,
                  connectorsAnimation: "bounce",
                  connectorsSpeed: 700
              }
          },
          nodeStructure: {
              image: "assets/images/<?php echo $img;?>",
              HTMLclass: '<?php echo $this->session->userdata('id');?>',
              children: data.all_data
          }
        };
        tree = new Treant( chart_config );
      }
  });

$(document).ready(function(){

    // $(document).on("mouseenter", ".node", function(e) {
    //   var obj = $(this);
    //   var cls_str = obj.attr('class');
    //   $url = base_url + "user/left_right_investment";
    //   $.ajax({
    //       url: $url,
    //       type: "POST",
    //       data: {'cls_str':cls_str},
    //       dataType: 'json',
    //       success: function (data) {
    //         if(data.response){
    //           //obj.attr('title', data.result);
    //           //obj.tooltip({html: true}); 
    //           obj.attr('data-toggle', 'tooltip');
    //           obj.attr('data-html', true);
    //           obj.attr('data-title', data.result);
    //         }
    //       }
    //   });
    // });

    $(document).on("click", ".node", function(e) {
      var obj = $(this);
      var cls_str = obj.attr('class');
      $url = base_url + "user/bussinessDetails";
      $.ajax({
          url: $url,
          type: "POST",
          data: {'cls_str':cls_str},
          dataType: 'json',
          success: function (data) {
            if(data.response){
              var span = document.createElement("span");
              span.innerHTML = data.result;
              swal({
                content: span,
              });
            }
          }
      });
    });

    // $(document).on("mouseenter", ".node", function(e) {
    // });
    // $(document).on("mouseleave", ".node", function(e) {
    // });

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

});

</script>

<script type="text/javascript">
$(document).ready(function(){
    $('#datatable').DataTable({});
});
</script>



