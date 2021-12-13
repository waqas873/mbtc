<style>
  .well{
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
    overflow: hidden;
  }
  .well {
    background-color: #fff !important;
}
</style>

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
    <div class="well shadow">
      <strong style="font-size: 20px;">BitCoin</strong>
      <br>
      <p>$<?php echo $btcusd;?></p>


      <div class="row">

        <div class="col-md-12" style="padding: 30px;">
          <div class="transfer_internal">
            <h1 style="text-align: center;"> Trade Bitcoin </h1>
          </div>

          <div class="row" style="background-color:#055205;">
            <div class="col-md-2 col-xs-4 mr_top">
              <h3>USD </h3>
            </div>
            <div class="col-md-4 col-xs-8 mr_top" style="border-left: 1px solid #143148; border-right: 1px solid #143148;">
              <h3 id="btcusd"> $<?php echo $btcusd;?></h3>
            </div>
            <div class="col-md-2 col-xs-4 mr_top mr_bottom" style="border-right: 1px solid #143148;">
              <h3> BTC </h3>
            </div>
            <div class="col-md-4 col-xs-8 mr_top mr_bottom">
              <h3 id="btc"> <?php echo '1'; ?> </h3>
            </div>
          </div>

          <div class="col-md-3"> </div>

          <div class="col-md-6">
           <h2 style="text-align: center;"> Amount to Deposit (USD) </h2>
         </div>
         <div class="row">
          <div class="col-md-8 col-md-offset-4">
            <form onsubmit="return check_amount();" action="<?php echo base_url('payment/bitcoin_confirm_pay');?>" enctype="multipart/form-data" role="form" class="form-horizontal" method="post" >
              <div class="col-md-3">
                <input type="hidden" name="btc_rate" value="<?php echo $btcusd;?>">
                <input type="number" min="0" step="any" value="<?php echo $btcusd;?>" name="btcusd" id="btc_usd" class="form-control goal" placeholder="Enter amount" required >
              </div>
              <div class="col-md-2" style="padding-left: 0px !important;">
                <input type="submit" value="Submit" class="btn btn blue goal bitcoin_btn_sb">
              </div>
            </form>
          </div>

        </div>

      </div>
    </div>

  </div>
</div>
</div>


<script src="assets/jquery-validation/dist/jquery.validate.js" type="text/javascript"></script>

<script>
  var btcusd = <?php echo $btcusd;?>;
  $("#btc_usd").on("change paste keyup", function() {
   var cal_btcusd  = $(this).val() || 0;
   var btc_amount = cal_btcusd*1/btcusd || 0;
        //btc_amount = Math.ceil(btc_amount*100);
        $('#btcusd').html(round(cal_btcusd,8) || 0);
        $('#btc').html(round(btc_amount,8) || 0);
      });

  function check_amount(){
   var btc_usd= $("#btc_usd").val();
   if(btc_usd>0){
    return true;
  }else{
    alert("USD must be greater then 0");
    return false;
  }
}

function round(value, decimals) {
  return Number(Math.round(value+'e'+decimals)+'e-'+decimals);
}
</script>