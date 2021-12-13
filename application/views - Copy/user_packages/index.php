
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
        <div class="point_status_tbl2">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption text_shadow">All Packages</div>
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
                                        <th class="text_center">User Name</th>
										<th class="text_center">Email</th>
										<th class="text_center">Package Name</th>
                                        <th class="text_center">Amount</th>
										<th class="text_center">Fees</th>
                                        <th class="text_center">ROI</th>
                                        <th class="text_center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                       if(isset($packages) && !empty($packages)) { 
                                        $index = 1;
                                        foreach ($packages as $package) {
                                    ?>
                                    <tr class="table_text_shadow">
                                    	<td class="text_center"><?php echo $index; ?></td>
                                        <td class="text_center"><?php echo ucwords($package['fullname']); ?></td>
										<td class="text_center"><?php echo $package['email']; ?></td>
										<td class="text_center"><?php echo $package['package_name']; ?></td>
										<td class="text_center"><?php echo "$".$package['up_package_amount']; ?></td>
										<td class="text_center"><?php echo "$".$package['package_fees']; ?></td>
                                        <td class="text_center"><?php echo $package['package_roi']."%"; ?></td>
                                        <td class="text_center">
                                            <?php 
                                               if($package['up_status']==0){
                                                   $status = '<span class="label label-sm label-warning label_style"> Pending </span>';
                                               }
                                               if($package['up_status']==1){
                                                   $status = '<span class="label label-sm label-success label_style"> Completed </span>';
                                               }
                                               if($package['up_status']==2){
                                                   $status = '<span class="label label-sm label-danger label_style"> Rejected </span>';
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
