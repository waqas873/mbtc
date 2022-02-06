<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/* Your password Encrypt Hash Form */
if (!function_exists('encrypt')) {

    /**
     * encrypt
     * 
     * @param string $string User new password
     * @return string Returns encrypted password
     */
    function encrypt($string) {
        $keyword = md5("aktechzone");
        $salt = md5("mlm");
        $key = md5($keyword . $salt);
        return $e_string = rtrim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $string, MCRYPT_MODE_ECB)));
    }

}

function activate_sub_menu($controller) {
    $CI = get_instance();
    $class = $CI->router->fetch_class();
    $method = $CI->router->fetch_method();
    $url = "$class/$method";
    return ($url == $controller) ? 'active' : '';
}

function binary_downline_direct($parent,&$downline){
    $CI = get_instance();
    $CI->load->model('User_model' , 'User');
    if ($parent == 0 || $parent == null) {
        return false;
    }else{
        $data = $CI->User->select_downline("parent_id",$parent,2);
        array_push($downline,$data);
    }
}

function get_parent_id($child_id){
    $CI = get_instance();
    $CI->load->model('User_model' , 'User');
    return $CI->User->select_parent("id",$child_id);
}

function GetIP()
{
    if(getenv("HTTP_CLIENT_IP")) {
        $ip = getenv("HTTP_CLIENT_IP");
    } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
        $ip = getenv("HTTP_X_FORWARDED_FOR");
        if (strstr($ip, ',')) {
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    }
    elseif(isset($_SERVER['HTTP_X_FORWARDED']))
    {
        $ip = $_SERVER['HTTP_X_FORWARDED'];     
    }
    else {
        $ip = getenv("REMOTE_ADDR");
    }
    return $ip;
}

function checkout_invoice( $data = array() ) {
    $ci =& get_instance();
    $ci->load->database();
    
                                            
    $user_id =  ( isset($data['user_id']) && strlen($data['user_id']) > 0 ? $data['user_id'] : '' ) ;
    $user_name =  ( isset($data['user_name']) && strlen($data['user_name']) > 0 ? $data['user_name'] : '' ) ;
    $package_id =  ( isset($data['package_id']) && strlen($data['package_id']) > 0 ? $data['package_id'] : '' ) ;
    $refference_number =  ( isset($data['refference_number']) && strlen($data['refference_number']) > 0 ? $data['refference_number'] : '' ) ;
    $transaction_hash =  ( isset($data['transaction_hash']) && strlen($data['transaction_hash']) > 0 ? $data['transaction_hash'] : '' ) ;
    $payment_method =  ( isset($data['payment_method']) && strlen($data['payment_method']) > 0 ? $data['payment_method'] : '' ) ;
    $payment_module_id =  ( isset($data['payment_module_id']) && strlen($data['payment_module_id']) > 0 ? $data['payment_module_id'] : '' ) ;
    $old_balance =  ( isset($data['old_balance']) ? $data['old_balance'] : '' ) ;
    $amount =  ( isset($data['amount']) && strlen($data['amount']) > 0 ? $data['amount'] : '' ) ;
    $checkout_amount =  ( isset($data['checkout_amount']) && strlen($data['checkout_amount']) > 0 ? $data['checkout_amount'] : '' ) ;
    $payment_details =  ( isset($data['payment_details']) && strlen($data['payment_details']) > 0 ? $data['payment_details'] : '' ) ;
    $exchange_rate =  ( isset($data['exchange_rate']) && strlen($data['exchange_rate']) > 0 ? $data['exchange_rate'] : '' ) ;
    $btc_address    = ( isset($data['btc_address']) && strlen($data['btc_address']) > 0 ? $data['btc_address'] : '' ) ;
    
    $current_date = date("Y-m-d");
    $time_created = date("H:i:s");
    
    $status = 0;
    
    //$wc = $db->get ('home_settings', 1);  
    $data = Array (
        'user_id' => $user_id,
        'user_name' => $user_name,
        'package_id' => addslashes(utf8_encode($package_id)),
        'refference_number' => $refference_number,
        'payment_method' => $payment_method,
        'payment_module_id' => $payment_module_id,
        'old_balance' => $old_balance,
        'btc_address' => $btc_address,
        'amount' => $amount,
        'exchange_rate' => $exchange_rate,
        'checkout_amount' => $checkout_amount,
        'payment_details' => $payment_details,
        'transaction_hash' => $transaction_hash,
        'status' => $status,
        'date_created' => $current_date,
        'time_created' => $time_created,
    );
    
    try{
        $ci->db->insert ('paymen_history', $data);
        $status = $ci->db->insert_id();
    }catch( Exception $e ){
        
        //var_dump($e);
        $status = 0;
    }
    
    return $status;
}

function getUserDepositHistory($user_id)
{
    $CI =& get_instance();
    $CI->load->model('paymen_history_model' , 'paymen_history');
    $where = "user_id = '".$user_id."'";
    $result = $CI->paymen_history->get_where('*', $where, true, 'id DESC', '', '');
    return $result;
}

function checkout_invoice_update( $data = array() ) 
{
    $ci =& get_instance();
    $ci->load->database();
    
    $btc_amount = ( isset($data['btc_amount']) && strlen($data['btc_amount']) > 0 ? $data['btc_amount'] : '0' ) ;
    $amount = ( isset($data['amount']) && strlen($data['amount']) > 0 ? $data['amount'] : 0 ) ;
    $deposited_btc = ( isset($data['deposited_btc']) && strlen($data['deposited_btc']) > 0 ? $data['deposited_btc'] : '0' ) ;
    $deposited_usd = ( isset($data['deposited_usd']) && strlen($data['deposited_usd']) > 0 ? $data['deposited_usd'] : '0' ) ;
    $invoice_id =  ( isset($data['invoice_id']) && strlen($data['invoice_id']) > 0 ? $data['invoice_id'] : '' ) ;
    $payment_method =  ( isset($data['payment_method']) && strlen($data['payment_method']) > 0 ? $data['payment_method'] : '' ) ;
    $btc_address =  ( isset($data['btc_address']) && strlen($data['btc_address']) > 0 ? $data['btc_address'] : '' ) ;
    $btc_post_response =  ( isset($data['btc_post_response']) && strlen($data['btc_post_response']) > 0 ? $data['btc_post_response'] : '' ) ;
    $status =  ( isset($data['status'])  ? $data['status'] : '' ) ;
    $processed =  ( isset($data['is_processed'])  ? $data['is_processed'] : '' ) ;
    $secrete_code =  ( isset($data['secrete_code'])  ? $data['secrete_code'] : '' ) ;
    $payment_post_status =  ( isset($data['payment_post_status'])  ? $data['payment_post_status'] : '' ) ;
    $payment_details    = ( isset($data['payment_details'])  ? $data['payment_details'] : '' ) ;
    
    
    $current_date = date("Y-m-d");
    $time_created = date("H:i:s");
    
    //$status = 0;
    
    //var_dump($btc_address);
    //var_dump($invoice_id);
    
    //$wc = $db->get ('home_settings', 1);  
    
    
    try{
        if( strlen($status) > 0 ){
            $ci->db->set('status', $status);
        }
        if( strlen($processed) > 0 ){
            $ci->db->set('is_processed', $processed);
        } 
        if(  floatval($btc_amount) > 0  ){
            $ci->db->set('btc_amount', $btc_amount);
        }
        if(  floatval($amount) > 0  ){
            $ci->db->set('amount', $amount);
        }
        if(  strlen($deposited_usd) > 0  ){
            $ci->db->set('deposited_usd', $deposited_usd);
        }

        if(  strlen($deposited_btc) > 0  ){
            $ci->db->set('deposited_btc', $deposited_btc);
        }
        
        if(  strlen($btc_address) > 0  ){
            $ci->db->set('btc_address', $btc_address);
        }
        
        if( strlen($secrete_code) > 0 ){
            $ci->db->set('secrete_code', $secrete_code);
        }
        
        if(  strlen($btc_post_response) > 0  ){
            $ci->db->set('btc_post_response', $btc_post_response);
        }
        
        if(  strlen($payment_post_status) > 0  ){
            $ci->db->set('payment_post_status', $payment_post_status);
        }
        
        if(  strlen($payment_details) > 0  ){
            $ci->db->set('payment_details', $payment_details);
        }
        
        
        $ci->db->set('date_updated', date("Y-m-d"));
        $ci->db->set('time_updated', date("H:i:s"));
        
        $ci->db->where('id', $invoice_id);
        $ci->db->update('paymen_history');  
        
        $rstatus = 1;
    }catch( Exception $e ){
        $rstatus = 0;
    }
    
    return $rstatus;
}

function getSiteSettings($setting_keyword)
{
    $ci =& get_instance();
    $ci->load->database();
    
    $ci->db->where('name',$setting_keyword);
    $query = $ci->db->get('tbl_settings');
    $response =  $query->result_array();
    
    return ($response && !empty($response) ? $response[0]['value'] : '');
}

function user_info($user_id){
    if(empty($user_id)){
        return false;
    }
    $CI = get_instance();
    $CI->load->model('Users_model' , 'users');
    $where = "users.id = '".$user_id."'";
    $result = $CI->users->get_where('*', $where, true, '' ,'', '');
    if(!empty($result)){
        return $result[0];
    }
}

function user_balance($id){
    $CI = get_instance();
    $CI->load->model('User_balance_model' , 'user_balance');
    $where = "user_balance.user_id = '".$id."' ";
    $balance = $CI->user_balance->get_where('*', $where, true, '' , '', '');
    return $balance[0]['user_balance'];
}

function wallet_balance($user_id){
    $CI = get_instance();
    $CI->load->model('Wallets_model' , 'wallets');
    $where = "wallet_user_id = '".$user_id."' ";
    $balance = $CI->wallets->get_where('*', $where, true, '' , '', '');
    if(!empty($balance[0]['wallet_balance'])){
        return $balance[0]['wallet_balance'];
    }
    return 0;
}

if (!function_exists('update_wallet_balance')) {
    function update_wallet_balance($user_id,$amount,$withdraw){
        if(!empty($user_id)){
            $CI = get_instance();
            $CI->load->model('Wallets_model' , 'wallets');
            $where = "wallet_user_id = '".$user_id."' ";
            $result = $CI->wallets->get_where('*', $where, true, '' , '', '');
            $result = $result[0];
            $previous_balance = $result['wallet_balance'];
            $update_account = array();
            $update_account['wallet_balance'] = ($withdraw)?$previous_balance-$amount:$previous_balance+$amount;
            $CI->wallets->update_by('wallet_user_id', $user_id, $update_account);
        }
        return false;
    }
}

function package_amount($user_id){
    $CI = get_instance();
    $CI->load->model('User_packages_model' , 'user_packages');
    $where = "user_packages.up_user_id = '".$user_id."' AND up_status = '1'";
    $last_record = $CI->user_packages->get_where('*', $where, true, '' ,'', '');
    if(!empty($last_record)){
        return $last_record[0]['up_package_amount'];    
    }
    
}

function update_user_balance($user_id,$amount,$withdraw=false,$roi=false){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('User_balance_model' , 'user_balance');
        $CI->load->model('user_packages_model' , 'user_packages');
        $in_amount = $amount;

        if($withdraw===false){
            total_earnings($user_id,$amount);
            
            if($roi==true){
                $where = "user_packages.up_user_id = '".$user_id."'";
                $result = $CI->user_packages->get_where('*', $where, true, '' , 1, '');
                if(!empty($result)){
                    $result = $result[0];
                    $package_amount = $result['up_package_amount'];
                    $up_3x = $package_amount*3;
                    $up_three_x = $result['up_three_x'];
                    $amount_allowed = $up_3x - $up_three_x;
                    if($amount>$amount_allowed){
                        $amount = $amount_allowed;
                    }
                    $update = array();
                    $update['up_three_x'] = $up_three_x+$amount;
                    $where = "up_user_id = '".$user_id."'";
                    $CI->user_packages->update_by_where($update, $where);
                }
            }
        }
        ($roi===false)?$amount=$in_amount:'';
        $where = "user_balance.user_id = '".$user_id."' ";
        $result = $CI->user_balance->get_where('*', $where, true, '' , 1, '');
        $result = $result[0];
        $previous_balance = $result['user_balance'];
        $update_account = array();
        $update_account['user_balance'] = (!empty($withdraw))?$previous_balance-$amount:$previous_balance+$amount;
        $CI->user_balance->update_by('user_id', $user_id, $update_account);
    }
    return true;
}

function package_amount_if_exists_or_expired($user_id){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('user_packages_model' , 'user_packages');
        $CI->load->model('expired_packages_model' , 'expired_packages');
        $where = "user_packages.up_user_id = '".$user_id."' ";
        $result = $CI->user_packages->get_where('*', $where, true, '' , 1, '');
        if(!empty($result)){
            return $result[0]['up_package_amount'];
        }
        $where = "expired_packages.ep_user_id = '".$user_id."' ";
        $result = $CI->expired_packages->get_where('*', $where, true, '' , 1, '');
        if(!empty($result)){
            return $result[0]['ep_package_amount'];
        }
    }
    return false;
}

function packageDetail($user_id = 0)
{
    $CI = get_instance();
    $CI->load->model('user_packages_model' , 'user_packages');
    $where = "user_packages.up_user_id = '".$user_id."' ";
    $result = $CI->user_packages->get_where('*', $where, true, '' , 1, '');
    if(!empty($result)){
        return $result[0];
    }
    return false;
}

function mining_days($user_id=''){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('mining_recieved_model' , 'mining_recieved');
        $where = "mining_recieved.mr_user_id = '".$user_id."' ";
        $result = $CI->mining_recieved->get_where('*', $where, true, '' , 1, '');
        if(!empty($result)){
            return $result[0]['mr_days'];
        }
    }
    return false;
}

function package_exists_or_expired($user_id=''){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('user_packages_model' , 'user_packages');
        $CI->load->model('expired_packages_model' , 'expired_packages');
        $where = "user_packages.up_user_id = '".$user_id."' ";
        $package_exist = $CI->user_packages->count_rows($where);
        $where = "expired_packages.ep_user_id = '".$user_id."' ";
        $package_expired = $CI->expired_packages->count_rows($where);
        if($package_exist > 0 || $package_expired > 0){
            return true;
        }
    }
    return false;
}

function total_earnings($user_id,$amount){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('Total_earnings_model' , 'total_earnings');
        $arr = array('te_user_id'=>$user_id,'te_amount'=>$amount);
        $CI->total_earnings->save($arr);
    }
    return false;
}

function deliver_mining($user_id,$amount,$mr_days){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('Mining_recieved_model' , 'mining_recieved');
        $data = array();
        $data['mr_amount'] = $amount;
        $data['mr_updated_at'] = date('Y-m-d');
        $data['mr_days'] = $mr_days;
        $CI->mining_recieved->update_by('mr_user_id', $user_id, $data);
    }
}

function daily_earnings($user_id,$amount,$source='',$date='',$referral_from=null){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('Daily_earnings_model' , 'daily_earnings');
        $arr = array('de_user_id'=>$user_id,'de_earning'=>$amount,'de_source'=>$source,'referral_from'=>$referral_from,'de_date'=>$date);
        $CI->daily_earnings->save($arr);
    }
    return false;
}

function add_mining($user_id,$amount,$date=''){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('Mining_model' , 'mining');
        $arr = array('mining_user_id'=>$user_id,'mining_amount'=>$amount,'mining_date'=>$date);
        $CI->mining->save($arr);
    }
}

function points($user_id,$left_points='',$right_points=''){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('Points_model' , 'points');
        $arr = array('point_user_id'=>$user_id,'left_points'=>$left_points,'right_points'=>$right_points,'point_date'=>date('Y-m-d'));
        $CI->points->save($arr);
    }
    return true;
}

function user_earning($user_id,$date){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('Daily_earnings_model' , 'daily_earnings');
        $where = "daily_earnings.de_user_id = '".$user_id."' AND de_date = '".$date."'";
        $result = $CI->daily_earnings->get_where('SUM(de_earning) as user_earning', $where, true, '' ,'', '');
        return $result[0]['user_earning'];
    }
}

function earning_detail($user_id){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('Daily_earnings_model' , 'daily_earnings');
        $where = "daily_earnings.de_user_id = '".$user_id."' AND de_source = 'Roi' ";
        $result = $CI->daily_earnings->get_where('*', $where, true, 'de_id DESC' ,'', '');
        return $result;
    }
}

function binaryRecieved($user_id)
{
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('Daily_earnings_model' , 'daily_earnings');
        $where = "daily_earnings.de_user_id = '".$user_id."' AND de_source = 'Binary Bonus' AND de_date = '".date('Y-m-d')."' ";
        $result = $CI->daily_earnings->get_where('SUM(de_earning) as binary_recieved', $where, true, 'de_id DESC' ,'', '');
        return $result[0]['binary_recieved'];
    }
    return false;
}

function de_time($user_id){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('Daily_earnings_model' , 'daily_earnings');
        $where = "daily_earnings.de_user_id = '".$user_id."' AND de_source = 'Roi' AND de_time > 0";
        $result = $CI->daily_earnings->get_where('*', $where, true, '' ,'', '');
        if(!empty($result)){
            return $result[0]['de_time'];
        }
    }
    return false;
}

function if_package_buy($user_id){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('User_packages_model' , 'user_packages');
        $CI->load->model('Users_model' , 'users');

        $where = "user_packages.up_user_id = '".$user_id."' AND up_status = '1'";
        $last_record = $CI->user_packages->get_where('*', $where, true, '' ,'', '');

        $where = "users.id = '".$user_id."' AND status = '1'";
        $status = $CI->users->get_where('*', $where, true, '' ,'', '');

        if(!empty($last_record) && !empty($status)){
            return true;
        }
        else{
            return false;
        }
    }
}

function if_binary_allowed($user_id = 0)
{
    if(empty($user_id)){
        return false;
    }
    $left_side = false;
    $right_side = false;
    $CI = get_instance();
    $CI->load->model('User_packages_model' , 'user_packages');
    $CI->load->model('Users_model' , 'users');

    $where = "users.referral_id = '".$user_id."' AND position = 'right'";
    $right = $CI->users->get_where('*', $where, true, '' ,'', '');
    if(!empty($right)){
        foreach($right as $key=>$value){
            $where = "user_packages.up_user_id = '".$value['id']."'";
            $result = $CI->user_packages->get_where('*', $where, true, '' ,'', '');
            if(!empty($result)){
                $right_side = true;
                break;
            }
        }
    }
    $where = "users.referral_id = '".$user_id."' AND position = 'left'";
    $left = $CI->users->get_where('*', $where, true, '' ,'', '');
    if(!empty($left)){
        foreach($left as $key=>$value){
            $where = "user_packages.up_user_id = '".$value['id']."'";
            $result = $CI->user_packages->get_where('*', $where, true, '' ,'', '');
            if(!empty($result)){
                $left_side = true;
                break;
            }
        }
    }
    if($left_side==true && $right_side==true){
        return true;
    }
    return false;
}

// function if_binary_allowed($user_id = 0)
// {
//     if(empty($user_id)){
//         return false;
//     }
//     $ids = [];
//     array_push($ids, $user_id);
//     $CI = get_instance();
//     $CI->load->model('User_packages_model' , 'user_packages');
//     $CI->load->model('Users_model' , 'users');

//     $where = "users.parent_id = '".$user_id."' AND (position = 'right' OR position = 'left')";
//     $result = $CI->users->get_where('*', $where, true, '' ,'', '');
//     $usersCount = count($result);
//     if($usersCount < 2){
//         return false;
//     }
//     foreach($result as $key => $value){
//         array_push($ids, $value['id']);
//     }
//     foreach($ids as $id){
//         $where = "user_packages.up_user_id = '".$id."'";
//         $result = $CI->user_packages->get_where('*', $where, true, '' ,'', '');
//         if(empty($result)){
//             return false;
//         }
//     }
//     return true;
// }

function package_detail($user_id){
    if(!empty($user_id)){
        $CI = get_instance();
        $CI->load->model('User_packages_model' , 'user_packages');
        $where = "user_packages.up_user_id = '".$user_id."' AND up_status = '1'";
        $joins = array(
            '0' => array('table_name' => 'packages packages',
                'join_on' => ' packages.package_id = user_packages.up_package_id ',
                'join_type' => 'left'
            )
        );
        $from_table = "user_packages user_packages";
        $select_from_table = 'user_packages.*,packages.*';
        $package_detail = $CI->user_packages->get_by_join($select_from_table, $from_table, $joins, $where, '','', '', '', '', '', '', '',true);
        if(!empty($package_detail)){
            return $package_detail[0];
        }
    }
    return false;
}

function super_package($package_id){
    if(!empty($package_id)){
        $CI = get_instance();
        $CI->load->model('Packages_model' , 'packages');
        $where = "packages.package_id = '".$package_id."' ";
        $super_package = $CI->packages->get_where('*', $where, true, '' ,'', '');
        if(!empty($super_package)){
            return $super_package[0];
        }
    }
}

/* Your password Decrypt String Form */
if (!function_exists('decrypt')) {

    /**
     * decrypt
     * 
     * @param string $string User encrypted password
     * @return string Returns decrypted password
     */
    function decrypt($string) {
        $keyword = md5("aktechzone");
        $salt = md5("mlm");
        $key = md5($keyword . $salt);
        return $d_string = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($string), MCRYPT_MODE_ECB));
    }

}

/** 
* Helper function to print array in pre-formated form
* 
* @param array
* @param bool
* @return print array
*/
if (!function_exists('debug')) {
    function debug($arr, $exit = true)
    {
     print "<pre>";
     print_r($arr);
     print "</pre>";
     if($exit)
      exit;
}
}

/** 
* Helper function to print string in pre-formated form
* 
* @param string
* @param bool
* @return print string
*/
if (!function_exists('echo_str')) {
    function echo_str($str, $exit = false)
    {
     echo $str;
     echo "<br />";
     if($exit)
      exit;
}
}

/** 
* Helper function to send email
* 
* @param str
* @param str
* @param str
* @param str
* @param str
* @return int
*/
if (!function_exists('send_html_email')) {
    function send_html_email ($to_email, $from_email, $from_name, $subject, $msg) {
    //split up to email array, if given
        if (is_array($to_email)) {
            $to_email_string = implode(', ', $to_email);
        }
        else {
            $to_email_string = $to_email;
        }

    //Assemble headers
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= "From: $from_name <$from_email>" . "\r\n";

    //send via PHP's mail() function
        return mail($to_email_string, $subject, $msg, $headers);
    }
}

/* Generate a random password  */

if (!function_exists('random_password')) {

     /**
     * random_password
     * 
     * @param integer $length how long your password.
     * @return string Returns random password
     */

     function random_password( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

}

/**
* Helper Function to get current date and time
*
* @access   public
* @return   Date and Time String
*/
function formated_date($mysql_date_time = '', $format = 'd M Y')
{

    if(!empty($mysql_date_time))
        return date($format, strtotime($mysql_date_time));
    else
        return date('Y-m-d H:i:s');
}

/**
* Helper Function to upload file
*
* @param string
* @param string
* @param array
* @param Int
* @return   array
*/
function sfs_upload_file($file_field_name, $upload_dir, $allowed_types = array(), $max_file_sieze = '10240')
{
    $that =& get_instance();
    $file_name = $_FILES[$file_field_name]['name'];
    $ext  =  get_extension($file_name);
    echo $ext;
    if(!empty($allowed_types) && !in_array($ext, $allowed_types))
    {
        return 'File type you are uploading is not allowed.';
    }

    $config['upload_path']      = $upload_dir;
    $config['allowed_types']    = '*';
    $config['max_size']         = $max_file_sieze;
    $that->load->library('upload', $config);
    if (!$that->upload->do_upload($file_field_name))
    {
        return $that->upload->display_errors();
    }
    else
    {
        return $that->upload->data();
    }
}



