
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
    .plb {
    background-color: white !important;
}
</style>

<div class="portlet light bordered plb shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer caption_color"></i>
			<span class="caption-subject bold caption_color uppercase">All Rewards</span>
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

                    	<div class="row" style="margin-bottom: 15px;margin-top: 10px;">
                        	<div class="col-md-5">
                        		<a href="<?php echo base_url("rewards/add/"); ?>" class="btn btn-success border_radius">Add Reward</a>
                        	</div>
                        </div>

                        <div class="table-responsive" style="overflow-x: hidden !important;">
                            <table class="table table-striped dt-responsive" id="sample_3" style="border-bottom: none !important;">
                                <thead>
                                    <tr class="table_heading">
                                    	<th class="text_center">Sr No</th>
                                        <th class="text_center">Reward Title</th>
										<th class="text_center">Right Investment</th>
										<th class="text_center">Left Investment</th>
                    <th class="text_center">Image</th>
										<th class="text_center">Date</th>
                                        <!-- <th class="text_center">Reward To</th> -->
										<th class="text_center">Actions</th>
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
										<td class="text_center"><?php echo "$".$reward['reward_right_investment']; ?></td>
										<td class="text_center"><?php echo "$".$reward['reward_left_investment']; ?></td>
                    <td class="text_center">
                      <?php if(!empty($reward['reward_pic'])) { ?>
                      <a target="_blank" style="text-decoration: none;" href="<?php echo base_url('assets/reward_images/'.$reward['reward_pic']);?>">Image</a>
                      <?php } else { ?>
                      <a href="javascript::" style="text-decoration: none;">Not Availble</a>
                      <?php } ?>
                    </td>
										<td class="text_center">
                                            <?php 
                                                $datetime = explode(' ', $reward['reward_date']);
                                                $date = $datetime[0];
                                                echo $date; 
                                            ?>                              
                                        <!-- </td>
										<td class="text_center">
											<a href="javascript::" rel="<?php echo $reward['reward_id']; ?>" id="reward_to" class="btn btn-success btn-sm border_radius">Reward To</a>
										</td> -->
                                        <td class="text_center">
                                            <div style="width: 145px;margin: auto;">
                                                <a href="<?php echo base_url('rewards/update/'.$reward['reward_id']);?>" class="btn btn-success btn-sm border_radius">Edit</a>
                                                <a href="<?php echo base_url('rewards/delete/'.$reward['reward_id']);?>" class="btn btn-danger btn-sm border_radius" onclick="delete_record(this, 'rewards'); return false;">Delete</a>
                                            </div>
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


<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" style="border-radius: 30px !important;margin-top: 167px;">
      <div class="modal-header">
        <h4 class="modal-title">Reward To</h4>
      </div>
      <div class="modal-body">
        <div class="portlet box green" >
          <div class="portlet-title">
            <div class="caption">
               Provide Email
            </div>
          </div>
          <div class="portlet-body">
              <span style="font-size: 16px; color: green;">
                Please enter user email for this reward. 
              </span>
              <div class="row">
                <form method="post" action="<?php echo base_url('user_rewards/process_add'); ?>" id="reward_form" novalidate>
                 <div class="row">
                  <div class="col-lg-9" style="margin-top: 11px;margin-left: 13px;">
                    <div class="form-group">
                      <input type="hidden" name="reward_id" id="reward_id">
                      <input type="email" class="form-control" name="user_email" id="user_email" placeholder="Enter user email here" required >
                      <span id="package_error" style="color: red;"></span>
                    </div>
                  </div>
                  <div class="col-lg-2">
                   <div class="form-group">
                    <input type="submit" class="btn btn-info" style="height: 36px !important;margin-top: 11px;padding: px 27px 0px 23px !important;" value="Submit">
                   </div>
                 </div>

               </div>
             </form>
           </div>
       </div>
     </div>

   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

    $(document).on("click","#reward_to",function(){
        var reward_id = $(this).attr('rel');
        $('#reward_id').val('');
        if(reward_id != ''){
            $('#reward_id').val(reward_id);
            $("#myModal").modal();
        }
    });

    $('#reward_form').validate();

    $(document).on("submit","#reward_form",function(){
        if($('#reward_form').valid()){
            $("#myModal").modal('hide');
        }
    });

});
</script>