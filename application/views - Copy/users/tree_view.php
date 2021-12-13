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

<div class="portlet light bordered plb">
  <div class="portlet-title">
    <div class="caption">
      <i class="icon-equalizer caption_color"></i>
      <span class="caption-subject bold caption_color uppercase">Team Members</span>
    </div>
  </div>

  <div class="portlet-body form">
  <div class="row">
    <div class="col-md-12">
      <div class="point_status_tbl2">
        <div class="portlet box green">
          <div class="portlet-title">
            <div class="caption text_shadow">All Team Members View in Tree Structure</div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"> </a>
                    <a href="javascript:;" class="reload"> </a>
                </div>
            </div>
            <div class="portlet-body">
              <div class="row" style="margin-top: 0px;">
                <div class="col-md-5">
                  <div class="box_m">
                    <div class="box12"></div>
                    <div class="row abcd">
                      <div class="col-sm-3">
                        <span><i aria-hidden="true" class="fa fa-group"></i></span>
                      </div>
                      <div class="col-sm-9 members">
                        <h4>Left Side Members</h4>
                        <h4 style="text-align: center; center; margin-top: 10px;">+<?php echo (isset($left_users))?$left_users:0;?></h4>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 col-md-offset-2">
                  <div class="box_m">
                    <div class="box12"></div>
                    <div class="row abcd">
                      <div class="col-sm-3">
                        <span><i aria-hidden="true" class="fa fa-group"></i></span>
                      </div>
                      <div class="col-sm-9 members">
                        <h4>Right Side Members</h4>
                        <h4 style="text-align: center; margin-top: 10px;">+<?php echo (isset($right_users))?$right_users:0;?></h4>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

  <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
  
              <div class="row">
                <div class="col-md-12">
                  <div class="tree_data">
                    <div class="chart" id="collapsable-example"></div>
                  </div>
                </div>
              </div>

            </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>


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
    background-color: #055205 !important;
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
              image: "assets/images/<?php echo $this->session->userdata('profile_pic');?>",
              HTMLclass: '<?php echo $this->session->userdata('id');?>',
              children: data.all_data
          }
        };
        tree = new Treant( chart_config );
      }
  });

$(document).ready(function(){

    $(document).on("mouseenter", ".node", function(e) {
      var obj = $(this);
      var cls_str = obj.attr('class');
      $url = base_url + "user/left_right_investment";
      $.ajax({
          url: $url,
          type: "POST",
          data: {'cls_str':cls_str},
          dataType: 'json',
          success: function (data) {
            if(data.response){
              //obj.attr('title', data.result);
              //obj.tooltip({html: true}); 
              obj.attr('data-toggle', 'tooltip');
              obj.attr('data-html', true);
              obj.attr('data-title', data.result);
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


