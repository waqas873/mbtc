
<style type="text/css">
    #news_update_form p{
        color: red;
    }
    .form-body{
        width: 80%;
        margin:0 auto;
    }
</style>

<div class="portlet light bordered shadow">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-equalizer font-red-sunglo"></i>
            <span class="caption-subject font-red-sunglo bold uppercase">Update News</span>
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
        <!-- BEGIN FORM-->
        <form enctype="multipart/form-data" action="<?php echo base_url('news/process_update'); ?>" class="form-horizontal" id="news_update_form" method="post">
            <div class="form-body">

                <input type="hidden" name="news_id" value="<?php echo (set_value('news_id')) ? set_value('news_id') : (isset($data['news_id']) ? $data['news_id'] : ''); ?>">


                <div class="form-group">
                    <div class="col-md-6">
                         <label class="control-label">News Title:</label>
                        <input type="text" name="news_title" value="<?php echo (set_value('news_title')) ? set_value('news_title') : (isset($data['news_title']) ? $data['news_title'] : ''); ?>" class="form-control" placeholder="Enter News Title">
                        <?php echo form_error('news_title'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                         <label class="control-label">News Description:</label>
                        <textarea class="form-control" name="news_des" value="<?php echo $data['news_des'];?>" required rows="3" style="border: 2px solid #143148;"><?php echo $data['news_des'];?></textarea>
                        <?php echo form_error('news_des'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6">
                          <label class="control-label">News File:</label>
                        <input type="file" class="form-control" name="news_pic">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-4">
                        <input type="submit" value="Update News" class="btn btn-primary">
                    </div>

                </div>

            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
