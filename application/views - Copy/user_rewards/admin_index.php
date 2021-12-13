
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
.label_style{
       border-radius: 5px !important;   
    }
     .plb {
    background-color: white !important;
}

</style>

<div class="portlet light bordered plb shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer caption_color"></i>
			<span class="caption-subject bold caption_color uppercase"><?php echo (isset($heading))?$heading:''; ?></span>
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
          <div class="portlet-body">
            <div class="table-responsive" style="overflow-x: hidden !important;">
              <table class="table table-striped dt-responsive" id="sample_3" style="border-bottom: none !important;">
                <thead>
                  <tr class="table_heading">
                   <th class="text_center">Sr No</th>
                   <th class="text_center">Reward Title</th>
                   <th class="text_center">Right Investment</th>
                   <th class="text_center">Left Investment</th>
                   <th class="text_center">Status</th>
                   <?php if(isset($action)) { ?>
                   <th class="text_center">Action</th>
                   <?php } ?>
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
                       <td class="text_center">
                        <?php 
                          $status = '';
                          if($reward['ur_status']==1){
                            $status = '<span class="label label-sm label-warning label_style"> Pending </span>';
                          }
                          if($reward['ur_status']==2){
                            $status = '<span class="label label-sm label-success label_style"> Completed </span>';
                          }
                          echo $status;
                        ?>
                       </td>
                       <?php if(isset($action)) { ?>
                       <td class="text_center">
                         <a href="<?php echo base_url('user_rewards/approve_reward/'.$reward['ur_id'].'/j2T7hgDwqHYH');?>" class="btn btn-success btn-sm border_radius" onclick="delete_record(this, 'user_rewards'); return false;">Approve</a>
                       </td>
                       <?php } ?>
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
