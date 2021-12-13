<?php
echo "<h1>Processing........</h1>";
ini_set('max_execution_time', 0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Europe/London');

$servername = "localhost";
$username = "mbtcruys_mlm";
$password = "uG[LZh_.qnO@";
$dbname = "mbtcruys_mlm";

// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "mbtc";

############# Create connection #############
$conn = new mysqli($servername, $username, $password, $dbname);

############# Check connection #############
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_day = date("l");
if($current_day=='Sunday' || $current_day=='Saturday'){
	exit('Its Sunday or Saturday.');
}

$sql = "select up.*,pkg.package_roi from user_packages as up LEFT JOIN packages as pkg ON up.up_package_id = pkg.package_id";
$query = mysqli_query($conn, $sql);

while($userPackage = mysqli_fetch_array($query)){
	$user_id = $userPackage['up_user_id']; 
    $package_amount = $userPackage['up_package_amount']; 
    $limit_3x = $package_amount*3;
    $up_three_x = $userPackage['up_three_x'];
    $up_created_at = strtotime($userPackage['up_created_at']);

    if($up_three_x >= $limit_3x){
        continue;
    }
    // if(strtotime("-23 hours") < $up_created_at){
    // 	continue;
    // }
    $roi_amount = (($userPackage['package_roi']/100)*$userPackage['up_package_amount']);
    $roi_allowed = $limit_3x - $up_three_x;
    if($roi_amount > $roi_allowed){
    	$roi_amount = $roi_allowed;
    }
    $up_3x = $up_three_x+$roi_amount;
    $sql2 = "UPDATE user_packages SET up_three_x = '".$up_3x."' WHERE up_id='".$userPackage['up_id']."'";
    if($conn->query($sql2) === TRUE){
    }
    $sql3 = "INSERT INTO daily_earnings (de_user_id,de_earning,de_source,de_date) VALUES ('".$user_id."','".$roi_amount."','Roi','".date('Y-m-d')."')";
    if($conn->query($sql3) === TRUE){

        $sql4 = "INSERT INTO total_earnings (te_user_id,te_amount) VALUES ('".$user_id."','".$roi_amount."')";
        $conn->query($sql4);

        $sql5 = "select * from user_balance where user_id = '".$user_id."'";
        $query5 = mysqli_query($conn, $sql5);
        $result = mysqli_fetch_array($query5);
        if(!empty($result)){
            $balance = $result['user_balance']+$roi_amount;
            $sql6 = "UPDATE user_balance SET user_balance = '".$balance."' WHERE user_id = '".$user_id."'";
            $conn->query($sql6);
        }
    }
}

function debug($arr, $exit = true)
{
     print "<pre>";
     print_r($arr);
     print "</pre>";
     if($exit)
      exit;
}

echo "DONE............";

?>