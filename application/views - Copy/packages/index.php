
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
    .plb {
    background-color: white !important;
}
</style>

<div class="portlet light bordered plb shadow">
	<div class="portlet-title">
		<div class="caption">
			<i class="icon-equalizer caption_color"></i>
			<span class="caption-subject bold caption_color uppercase">All Packages</span>
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

                    	<div class="row" style="margin-bottom: 15px;margin-top: 10px;">
                        	<div class="col-md-5">
                        		<a href="<?php echo base_url("packages/add/"); ?>" class="btn btn-success border_radius">Add Package</a>
                        	</div>
                        </div>

                        <div class="table-responsive" style="overflow-x: hidden !important;">
                            <table class="table table-striped dt-responsive" style="border-bottom: none !important;" id="sample_3" >
                                <thead>
                                    <tr class="table_heading">
                                    	<th class="text_center">Sr No</th>
                                        <th class="text_center">Package Name</th>
										<th class="text_center">Package Amount</th>
										<th class="text_center">Package Roi</th>
										<th class="text_center">Package Fees</th>
										<th class="text_center">Package Color</th>
										<th class="text_center">Actions</th>
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
                                        <td class="text_center"><?php echo $package['package_name']; ?></td>
										<td class="text_center"><?php echo "$".$package['package_min_amount']." - $".$package['package_max_amount'] ; ?></td>
										<td class="text_center"><?php echo $package['package_roi']."%"; ?></td>
										<td class="text_center"><?php echo "$".$package['package_fees']; ?></td>
										<td class="text_center"><div style="margin:auto;height:25px;width:25px;border-radius:200px !important;background:<?php echo $package['package_color']; ?>;"></div></td>
										<td class="text_center">
											<a href="<?php echo base_url("packages/update/").$package['package_id']; ?>" class="btn btn-success btn-sm border_radius">Update</a>
											<a href="<?php echo base_url("packages/delete/").$package['package_id']; ?>" class="btn btn-danger btn-sm border_radius" onclick="delete_record(this, 'packages'); return false;">Delete</a>
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
