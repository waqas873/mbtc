<style>
   .well {
    background: white;
    padding: 17px;
    box-shadow: 0px 3px 9px 3px #b3b3b3 !important;
    width: 100%;
    margin: 0 auto;
    border-left: 6px solid #055205;
    border-bottom: 6px solid #055205;
    border-right: 6px solid #ffffff;
    border-top: 6px solid #ffffff;
    margin-bottom: 20px;
}
    .i_c3 {
    background: #055205;
    color: white;
    padding: 10px 10px;
}
.well {
    background-color: #ffffff !important;
    color: black!important;
}
</style>

<?php 
  if(isset($news) && !empty($news)) {
     foreach ($news as $key => $news) {   
 ?>
<div class="row">
    <div class="col-md-12">
        <div class="well shadow">
            <div class="i_c3">
                <strong style="font-size: 20px;"><?php echo $news['news_title'];?></strong>
                <br>
            </div>
            <p>
                <?php echo $news['news_des'];?> 
                <span>
                    <?php if(!empty($news['news_pic'])) { ?>
                      &nbsp;&nbsp;<a target="_blank" style="text-decoration: none;" href="<?php echo base_url('assets/news_images/'.$news['news_pic']);?>">View Image</a>
                    <?php } ?>
                </span> 
            </p>
            <p><?php echo $news['news_created_date'];?></p>
        </div>
    </div>
</div>
<?php } } ?>