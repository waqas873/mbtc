
<style type="text/css">
.caption_color{
  color: #36C6D3 !important;
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
</style>

<div class="portlet light bordered plb shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer caption_color"></i>
			<span class="caption-subject bold caption_color uppercase">User Rewards</span>
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
      <div class="point_status_tbl2">
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
                   <?php if($this->session->userdata("role")=="admin") { ?>
                     <th class="text_center">User Name</th>
                     <th class="text_center">Email</th>
                   <?php } ?>

                   <th class="text_center">Reward</th>
                   <th class="text_center">Date</th>
                   <?php if($this->session->userdata("role")=="admin") { ?>
                   <th class="text_center">Actions</th>
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
                       <?php if($this->session->userdata("role")=="admin") { ?>
                         <td class="text_center"><?php echo $reward['fullname']; ?></td>
                         <td class="text_center"><?php echo $reward['email']; ?></td>
                       <?php } ?>
                       <td class="text_center"><?php echo $reward['reward_title']; ?></td>
                       <td class="text_center">
                        <?php 
                        $datetime = explode(' ', $reward['ur_date']);
                        $date = $datetime[0];
                        echo $date; 
                        ?>                              
                      </td>
                      <?php if($this->session->userdata("role")=="admin") { ?>
                      <td class="text_center">
                        <a href="<?php echo base_url('user_rewards/delete/'.$reward['ur_id']);?>" class="btn btn-danger btn-sm border_radius" onclick="delete_record(this, 'user_rewards'); return false;">Cancel</a>
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

