
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
.error{
  color: red;
}
.icon_style{
  color: green;
  font-size: 24px;
}
.plb {
    background-color: white !important;
}
.table_heading{
  text-shadow: none !important;
}
.table_text_shadow{
  text-shadow: none !important;
}
.table-scrollable>.table {
    width: 100%!important;
    margin: 0!important;
    background-color: #f8fbfd !important;
    color: #000;
}
table.dataTable tbody tr {
    background-color: #fff;
}
.table-scrollable>.table {
    width: 100%!important;
    margin: 0!important;
    background-color:#fff ;
    color: #000;
}
table.dataTable td.sorting_1, table.dataTable td.sorting_2, table.dataTable td.sorting_3, table.dataTable th.sorting_1, table.dataTable th.sorting_2, table.dataTable th.sorting_3 {
    background:#f8fbfd !important;
}
.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857;
    vertical-align: top;
    border-top: 3px solid #grey;
    background: #f8fbfd !important;
}
a {
    text-shadow: none;
    color: #000;
}
.dataTables_length{
  text-transform: capitalize;
}
</style>

<div class="portlet light bordered plb shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer caption_color"></i>
			<span class="caption-subject bold caption_color uppercase">Rewards</span>
		</div>

	</div>
	<div class="portlet-body form">

   <?php if($this->session->flashdata("success_message")){ ?>
    <div class="alert alert-success shadow">
      <button class="close" data-close="alert"></button>
      <strong>Success! </strong><span><?php echo $this->session->flashdata("success_message"); ?></span>
    </div>
  <?php } ?>
  <?php if($this->session->flashdata("error_message")){ ?>
    <div class="alert alert-danger shadow">
      <button class="close" data-close="alert"></button>
      <strong>Warning! </strong><span><?php echo $this->session->flashdata("error_message"); ?></span>
    </div>
  <?php } ?>


  <div class="row">
    <div class="col-md-12">
      <div class="point_status_tbl2 shadow">
        <div class="portlet box green">
          <div class="portlet-title">
            <div class="caption text_shadow">All Rewards</div>
            <div class="tools">
              <a href="javascript:;" class="collapse"> </a>

              <a href="javascript:;" class="reload"> </a>

            </div>
          </div>
         <!--  style="background: url(assets/images/award_bg1.jpg); background-size: cover; " -->
          <div class="portlet-body" >
            <div class="table-responsive" style="overflow-x: hidden !important;">
              <table class="table dt-responsive" id="sample_3" style="border-bottom: none !important;">
                <thead>
                  <tr class="table_heading">
                   <th class="text_center">Sr No</th>
                   <th class="text_center">Title</th>
                   <th class="text_center">Right Investment</th>
                   <th class="text_center">Left Investment</th>
                   <th class="text_center">My Right Investment</th>
                   <th class="text_center">My Left Investment</th>
                   <th class="text_center">Image</th>
                   <th class="text_center">Status</th>
                  </tr>
               </thead>
               <tbody>
                <?php 
                if(isset($rewards) && !empty($rewards)) { 
                  $index = 1;
                  foreach ($rewards as $reward) {
                    ?>
                    <tr class="table_text_shadow">
                       <td class="text_center"><?php echo $index; ?></td>
                       <td class="text_center"><?php echo $reward['reward_title']; ?></td>
                       <td class="text_center">$<?php echo $reward['reward_right_investment']; ?></td>
                       <td class="text_center">$<?php echo $reward['reward_left_investment']; ?></td>
                       <td class="text_center">$<?php echo $reward['user_right_investment']; ?></td>
                       <td class="text_center">$<?php echo $reward['user_left_investment']; ?></td>
                       <td class="text_center">
                          <?php if(!empty($reward['reward_pic'])) { ?>
                          <img src="<?php echo base_url('assets/reward_images/'.$reward['reward_pic']);?>" width="50" height="50" style="border-radius: 50% !important;">
                          <?php } else { ?>
                          <a href="javascript::" style="text-decoration: none;">Not Availble</a>
                          <?php } ?>
                        </td>
                       <td class="text_center">
                        <?php 
                          $status = $reward['status'];
                          if($reward['status']==1){
                            $status = '<i class="fa fa-check icon_style" data-toggle="tooltip" title="You are qualified for this reward!" aria-hidden="true"></i>';
                          }
                          if($reward['status']==2){
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
</div>
</div>

</div>
</div>

 <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
