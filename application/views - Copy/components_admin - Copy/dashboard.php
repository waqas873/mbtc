<style type="text/css">
	.desc{
		font-size: 22px !important;
	}
    .dashboard-stat .visual > i {
        margin-left: -23px !important;
        margin-top: -16px  !important;
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

<h1 class="page-title" style="font-weight: inherit;background: #0782c7;color: white;padding: 15px 10px;"> Admin Dashboard
    <small style="color: #143148;">Dashboard Stats</small>
</h1>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue shadow" href="javascript::">
            <div class="visual">
                <i class="fa fa-comments"></i>
            </div>
            <div class="details">
                <div class="number">
                    +<span data-counter="counterup" data-value="<?php echo $total_users;?>">0</span>
                </div>
                <div class="desc text_shadow"> Total Users </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 purple shadow" href="javascript::">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                    $<span data-counter="counterup" data-value="<?php echo $total_investments;?>"></span>
                </div>
                <div class="desc text_shadow">Total Investments</div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red shadow" href="javascript::">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    $<span data-counter="counterup" data-value="<?php echo $users_balance;?>">0</span>
                </div>
                <div class="desc text_shadow"> All Users Balance </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 yellow shadow" href="javascript::">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                    $<span data-counter="counterup" data-value="<?php echo $total_withdraws;?>"></span>
                </div>
                <div class="desc text_shadow"> Total Withdraws </div>
            </div>
        </a>
    </div>
    <!-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="javascript::">
            <div class="visual">
                <i class="fa fa-shopping-cart"></i>
            </div>
            <div class="details">
                <div class="number">
                    $<span data-counter="counterup" data-value="<?php echo $user_balance;?>">0</span>
                </div>
                <div class="desc"> Available Balance </div>
            </div>
        </a>
    </div> -->
    <!-- <?php if(isset($remaining_days)) { ?>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 purple" href="javascript::">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                    $<span data-counter="counterup" data-value="<?php echo $mining_balane;?>"></span>
                </div>
                <div class="desc"> Mining <span style="font-size: 15px !important;">(<?php echo $remaining_days;?> Days Remaining)</span> </div>
            </div>
        </a>
    </div>
    <?php } ?> -->
    
</div>