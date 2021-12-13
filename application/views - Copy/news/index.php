

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
            <span class="caption-subject bold caption_color uppercase">All News</span>
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
                    <div class="caption text_shadow">News</div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse"> </a>
                            
                            <a href="javascript:;" class="reload"> </a>
                            
                        </div>
                    </div>
                    <div class="portlet-body">

                        <div class="row" style="margin-bottom: 15px;margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="<?php echo base_url("news/add/"); ?>" class="btn btn-success border_radius">Add News</a>
                            </div>
                        </div>

                        <div class="table-responsive" style="overflow-x: hidden !important;">
                            <table class="table table-striped dt-responsive" id="sample_3" style="border-bottom: none !important;">
                                <thead>
                                  <tr class="table_heading">
                                    <th class="text_center">Sr No</th>
                                    <th class="text_center">Title</th>
                                    <th class="text_center">Description</th>
                                    <th class="text_center">Image Detail</th>
                                    <th class="text_center">Created Date</th>
                                    <th class="text_center">Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                    if(isset($news) && !empty($news)){
                                        $index = 1 ;
                                        foreach ($news as $news) {
                                  ?>
                                        <tr class="table_text_shadow">
                                        <td class="text_center"><?php echo $index;?></td>
                                        <td class="text_center"><?php echo $news['news_title'];?></td>
                                        <td class="text_center"><?php echo $news['news_des'];?></td>
                                        <td class="text_center">
                                          <?php if(!empty($news['news_pic'])) { ?>
                                          <a target="_blank" style="text-decoration: none;" href="<?php echo base_url('assets/news_images/'.$news['news_pic']);?>">Image</a>
                                          <?php } else { ?>
                                          <a href="javascript::" style="text-decoration: none;">Not Availble</a>
                                          <?php } ?>
                                        </td>
                                        <td class="text_center">
                                            <?php 
                                               $date = date_create($news['news_created_date']);
                                               echo date_format($date,'d-M-Y');
                                            ?>
                                        </td>
                                        <td class="text_center">
                                            <div style="width: 145px;margin: auto;">
                                                <a href="<?php echo base_url('News/update/'.$news['news_id']);?>" class="btn btn-success btn-sm border_radius">Edit</a>
                                                <a href="<?php echo base_url('News/delete/'.$news['news_id']);?>" class="btn btn-danger btn-sm border_radius" onclick="delete_record(this, 'rewards'); return false;">Delete</a>
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

