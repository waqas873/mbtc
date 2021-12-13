
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
.table_heading{
    text-shadow: none !important;
}
.portlet.box>.portlet-body {
        background-image: linear-gradient(to right, #129a12,#6ebb6b,#129a12,#6ebb6b)!important;
    padding: 15px;
}
.dataTables_length{
    text-transform: capitalize;
}
</style>

<div class="portlet light bordered plb shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer caption_color"></i>
			<span class="caption-subject bold caption_color uppercase"><?php echo (isset($heading))?$heading:''; ?> Side Members</span>
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
                                    	<th class="text_center" style="width: 80px;" >Sr No</th>
                                        <th class="text_center" >Full Name</th>
										<th class="text_center" >Username</th>
										<th class="text_center" >Email</th>
										<th class="text_center" style="width: 89px;" >Gender</th>
                                        <th class="text_center" >Upline</th>
                                        <th class="text_center" >Joined on</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                       if(isset($users) && !empty($users)) { 
                                        $index = 1;
                                        foreach ($users as $user) {

                                    ?>
                                    <tr class="table_text_shadow">
                                    	<td class="text_center" ><?php echo $index; ?></td>
                                        <td class="text_center" ><?php echo ucwords($user['fullname']); ?></td>
										<td class="text_center" ><?php echo $user['username']; ?></td>
										<td class="text_center" ><?php echo $user['email']; ?></td>
										<td class="text_center" ><?php echo $user['gender']; ?></td>
                                        <td class="text_center" ><?php echo ucwords($user['parent_name']); ?></td>
                                        <td class="text_center" >
                                           <?php 
                                                $datetime = explode(' ', $user['created_at']);
                                                $date = $datetime[0];
                                                echo $date; 
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
