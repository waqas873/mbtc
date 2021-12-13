
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
    
    
</style>

<div class="portlet light bordered plb shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer caption_color"></i>
			<span class="caption-subject bold caption_color uppercase">All Users</span>
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
                    <div class="caption text_shadow">Users List</div>
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
                                        <th class="text_center">Full Name</th>
										<th class="text_center">Username</th>
										<th class="text_center">Email</th>
										<th class="text_center">Gender</th>
                                        <th class="text_center">Joined on</th>
                                        <th class="text_center">Status</th>
                                        <th class="text_center">Detail</th>
										<th class="text_center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                       if(isset($users) && !empty($users)) { 
                                        $index = 1;
                                        foreach ($users as $user) {

                                    ?>
                                    <tr class="table_text_shadow">
                                    	<td class="text_center"><?php echo $index; ?></td>
                                        <td class="text_center"><?php echo ucwords($user['fullname']); ?></td>
										<td class="text_center"><?php echo $user['username']; ?></td>
										<td class="text_center"><?php echo $user['email']; ?></td>
										<td class="text_center"><?php echo $user['gender']; ?></td>
                                        <td class="text_center">
                                           <?php 
                                                $datetime = explode(' ', $user['created_at']);
                                                $date = $datetime[0];
                                                echo $date; 
                                            ?>
                                        </td>
                                        <td class="text_center">
                                            <?php 
                                               if($user['status']==0){
                                                   $status = '<span class="label label-sm label-danger label_style"> Inactive </span>';
                                               }
                                               if($user['status']==1){
                                                   $status = '<span class="label label-sm label-success label_style"> Active </span>';
                                               }
                                               echo $status;
                                            ?>
                                        </td>
                                        <td class="text_center">
                                            <a style="text-decoration: none;" href="<?php echo base_url('users/user_detail/'.$user['id'].'/jPh2G6YvqLqU');?>">
                                                <span>Detail</span>
                                            </a>
                                        </td>
										<td class="text_center">
                                            <?php if($user['status']==0) { ?>
											<a href="<?php echo base_url("users/activate_user/").$user['id']; ?>" class="btn btn-primary btn-sm border_radius" onclick="delete_record(this, 'users'); return false;">Activate</a>
                                            <?php } else { ?>
											<a href="<?php echo base_url("users/block_user/").$user['id']; ?>" class="btn btn-danger btn-sm border_radius" onclick="delete_record(this, 'users'); return false;">Block</a>
                                            <?php } ?>
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
