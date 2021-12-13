<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_copy extends CI_Controller {

    public $selected_tab = '';

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata("username") == "") {
            redirect("Login/");
        }

        $this->load->library('form_validation');
        $this->load->model("User_model","User");
        $this->load->model("Users_model","users");
        $this->load->model("News_model","news");
        $this->load->model("Packages_model","packages");
        $this->load->model("Expired_packages_model","expired_packages");
        $this->load->model("User_packages_model","user_packages");
        $this->load->model('Points_model','points');
        $this->load->model('Points_recieved_model','points_recieved');
        $this->load->model('Mining_model','mining');
        $this->load->model('Mining_recieved_model','mining_recieved');
        $this->load->model('Total_earnings_model','total_earnings');
        $this->load->model('Withdraws_model','withdraws');
        $this->load->model('User_balance_model','user_balance');
        $this->load->model('Daily_earnings_model','daily_earnings');
        date_default_timezone_set('Europe/London');
    }

    public function user_dashboard($package_id='',$pack_purchase='')
    {
        if($this->session->userdata("role") == "admin"){
            redirect('user/UserDashboard'); exit;
        }
        
        $this->layout = "template";
        if($this->session->userdata('role') == "admin"){
            $this->layout = "admin";
        }
        $this->selected_tab = "dashboard";

        $user_id = $this->session->userdata("id");
        $this->db->trans_start();

        if(if_binary_allowed($user_id))
        {
            $packageDetail = package_detail($user_id);
            $binary_recieved = 0;
            $binaryAllowed = 0;
            $binaryRecieved = binaryRecieved($user_id);
            if(!empty($binaryRecieved) && $binaryRecieved > 0)
            {
                $binary_recieved = $binaryRecieved;
            }
            if($packageDetail['capping'] > $binary_recieved){
                $binaryAllowed = $packageDetail['capping'] - $binary_recieved;
            }

            $where = "point_user_id = '".$user_id."'";
            $result = $this->points->get_where('SUM(left_points) as left_points,SUM(right_points) as right_points', $where, true, '', '', '');
            $left_points = $result[0]['left_points'];
            $right_points = $result[0]['right_points'];

            if($left_points>0 && $right_points>0){
                $where = "pr_user_id = '".$user_id."'";
                $result = $this->points_recieved->get_where('', $where, true, '', '', '');
                if(!empty($result)){
                    //echo $left_points."<br/>";
                    //echo $right_points; exit;
                    $points_recieved = $result[0]['pr_points'];
                    $left_points = $left_points - $points_recieved;
                    $right_points = $right_points - $points_recieved;
                    if($left_points>0 && $right_points>0){
                        $add_points = ($left_points>$right_points)?$right_points:$left_points;
                        $arr = array();
                        $arr['pr_points'] = $result[0]['pr_points']+$add_points;
                        $arr['pr_updated_at'] = date('Y-m-d');
                        $this->points_recieved->update_by('pr_user_id',$user_id,$arr);

                        $binary_bonus = ((7/100)*$add_points);
                        if($binaryAllowed > 0){
                            $binary_bonus = ($binary_bonus>$binaryAllowed)?$binaryAllowed:$binary_bonus;
                            $this->binary_bonus($user_id,$binary_bonus);
                        }
                    }
                }
                else{
                    $add_points = ($left_points>$right_points)?$right_points:$left_points;
                    $arr = array();
                    $arr['pr_user_id'] = $user_id;
                    $arr['pr_points'] = $add_points;
                    $arr['pr_date'] = date('Y-m-d');
                    $this->points_recieved->save($arr);
                    $binary_bonus = ((7/100)*$add_points);
                    if($binaryAllowed > 0){
                        $binary_bonus = ($binary_bonus>$binaryAllowed)?$binaryAllowed:$binary_bonus;
                        $this->binary_bonus($user_id,$binary_bonus);
                    }
                }
            }
        }

        $user_package = package_amount($user_id);
        $data['total_investment'] = (!empty($user_package))?number_format($user_package,2):0;

        $where = "te_user_id = '".$user_id."'";
        $result = $this->total_earnings->get_where('SUM(te_amount) as te_amount', $where, true, '', '', '');
        $data['total_earnings'] = ($result[0]['te_amount']>0)?number_format($result[0]['te_amount'],2):0;

        $data['user_balance'] = number_format(user_balance($user_id),2);
        $data['wallet_balance'] = wallet_balance($user_id);
        
        $where = "withdraws.user_id = '".$user_id."' AND withdraw_status = '1'";
        $result = $this->withdraws->get_where('SUM(withdraw_amount) as withdraw_amount', $where, true, '', '', '');
        $data['total_withdraws'] = ($result[0]['withdraw_amount']>0)?number_format($result[0]['withdraw_amount'],2):0;

        $data['left_users'] = $this->left_right_users($user_id,"left");
        $data['right_users'] = $this->left_right_users($user_id,"right");
        $data['total_users'] = $data['left_users']+$data['right_users'];

        $where = "referral_id = '".$user_id."'";
        $data['direct_members'] = $this->users->count_rows($where);

        $package_detail = package_detail($user_id);
        if(!empty($package_detail)){
            $data['roi_percentage'] = $package_detail['package_roi'];
            $data['roi_amount'] = (($package_detail['package_roi']/100)*$package_detail['up_package_amount']);
        }

        if(if_package_buy($user_id)){
            $data['package_active'] = "success";
            $where = "de_user_id = '".$user_id."' AND de_source = 'Binary Bonus'";
            $result = $this->daily_earnings->get_where('SUM(de_earning) as binary_recieved', $where, true, '', '', '');
            $data['binary_recieved'] = ($result[0]['binary_recieved']>0)?number_format($result[0]['binary_recieved'],2):0;
            $where = "de_user_id = '".$user_id."' AND de_source = 'Referal Bonus'";
            $result = $this->daily_earnings->get_where('SUM(de_earning) as referal_bonus', $where, true, '', '', '');
            $data['referal_bonus'] = ($result[0]['referal_bonus']>0)?number_format($result[0]['referal_bonus'],2):0;
            $where = "de_user_id = '".$user_id."' AND de_source = 'Roi'";
            $result = $this->daily_earnings->get_where('SUM(de_earning) as roi_recieved', $where, true, '', '', '');
            $data['roi_recieved'] = ($result[0]['roi_recieved']>0)?number_format($result[0]['roi_recieved'],2):0;
        }
        
        $this->db->trans_complete();
        if(!if_package_buy($user_id)){
            $data['packages'] = $this->packages->get_all();
        }

        if(!empty($package_id) && $pack_purchase=="up12NQyUXa1MnP"){
            $where = "role = 'admin'";
            $result = $this->users->get_where('*', $where, true, '', '', '');
            if(!empty($result)){
                $result = $result[0];
                $data['admin_wallet_address'] = $result['wallet_address'];

                $where = "up_id = '".$package_id."'";
                $joins = array(
                        '0' => array('table_name' => 'packages packages',
                            'join_on' => ' packages.package_id = user_packages.up_package_id ',
                            'join_type' => 'left'
                        )
                );
                $from_table = "user_packages user_packages";
                $select_from_table = 'user_packages.*,packages.*';
                $package = $this->user_packages->get_by_join($select_from_table, $from_table, $joins, $where, '','', '', '', '', '', '', '',true);
                if(!empty($package)){
                    $data['package_purchased'] = $package[0];
                }
            }
        }

        $where = "news.news_id > 0";
        $data['news'] = $this->news->get_where('*', $where, true, 'news_id DESC', 1, '');

        $where = "id = '".$user_id."'";
        $user_dl = $this->users->get_where('*', $where, true, '', 1, '');
        $data['user_dl'] = $user_dl[0];

        $this->load->view("components/dashboard",$data);
    }

    public function left_right_users($parent_id='',$position='')
    {
        $total_users = 0;
        if(!empty($parent_id) && !empty($position)){

            $where = "parent_id = '".$parent_id."' AND position = '".$position."'";
            ($position=="right")?$where .= " OR (position = 'beta_position' AND alpha_parent_id = '".$parent_id."') ":" ";
            ($position=="left")?$where .= " OR (position = 'alpha_position' AND alpha_parent_id = '".$parent_id."') ":" ";
            $users_ids = $this->users->get_where('id', $where, true, '' , '', '');
            
            $all_data = array();
            $condition = (!empty($users_ids))?true:false;
            $ii = 0;
            while($condition===true){
                $arr_push = array();
                foreach($users_ids as $user_id){
                    $user_id = ($ii==0)?$user_id['id']:$user_id;
                    $total_users++;
                    $where = "parent_id = '".$user_id."' OR alpha_parent_id = '".$user_id."'";
                    $child_users = $this->users->get_where('id', $where, true, '' , '', '');
                    foreach($child_users as $user){
                        array_push($arr_push,$user['id']);
                    }
                }
                $users_ids = $arr_push ;
                (empty($users_ids))?$condition=false:'';
            $ii++;  
            }
        }
        return $total_users;
    }

    public function admin_dashboard()
    {
        if($this->session->userdata("role") == "user"){
            redirect('user/UserDashboard'); exit;
        }

        $this->layout = "template";
        if($this->session->userdata('role') == "admin"){
            $this->layout = "admin";
        }
        $this->selected_tab = "dashboard";
        $data = array();

        $where = "users.role = 'user'";
        $data['total_users'] = $this->users->count_rows($where);

        $where = "user_id > 0";
        $balance = $this->user_balance->get_where('SUM(user_balance) as user_balance', $where, true, '', '', '');
        $data['users_balance'] = ($balance[0]['user_balance']>0)?number_format($balance[0]['user_balance'],2):0;

        $where = "withdraw_status = '1'";
        $result = $this->withdraws->get_where('SUM(withdraw_amount) as withdraw_amount', $where, true, '', '', '');
        $data['total_withdraws'] = ($result[0]['withdraw_amount']>0)?number_format($result[0]['withdraw_amount'],2):0;

        $where = "up_status = '1'";
        $result = $this->user_packages->get_where('SUM(up_package_amount) as total_investments', $where, true, '', '', '');
        $data['total_investments'] = ($result[0]['total_investments']>0)?number_format($result[0]['total_investments'],2):0;
        
        $this->load->view("components_admin/dashboard",$data);

    }

    public function UserDashboard()
    {
        if($this->session->userdata("role") == "user"){
            redirect('user/user_dashboard');
        }
        else{
            redirect('user/admin_dashboard');
        }
    }

    public function binary_bonus($user_id='',$binary_bonus='')
    {
        if(!empty($user_id) && !empty($binary_bonus)){
            $bonus_allowed = $binary_bonus;
            update_user_balance($user_id,$bonus_allowed,false);
            daily_earnings($user_id,$bonus_allowed,"Binary Bonus",date('Y-m-d'));
        }
        return true;
    }

    // public function binary_bonus_old($user_id='',$binary_bonus='')
    // {
    //     if(!empty($user_id) && !empty($binary_bonus)){
    //         $package_amount = package_amount($user_id);
    //         $limit_3x = $package_amount*3;
    //         $binary_bonus = $binary_bonus;
    //         $user_balance = user_balance($user_id);
    //         if($user_balance < $limit_3x){
    //            $bonus_allowed = $limit_3x - $user_balance;
    //            $bonus_allowed = ($binary_bonus > $bonus_allowed)?$bonus_allowed:$binary_bonus;
               
    //            $user_earning = user_earning($user_id,date('Y-m-d'));
    //            $user_earning = ($user_earning > 0)?$user_earning:0;

    //            $half_amount = $package_amount/2;

    //            if($user_earning < $half_amount){
    //                $earning_allowed = $half_amount - $user_earning;
    //                $bonus_allowed = ($bonus_allowed > $earning_allowed)?$earning_allowed:$bonus_allowed;
    //                //echo $bonus_allowed ; exit;
    //                update_user_balance($user_id,$bonus_allowed,false);
    //                daily_earnings($user_id,$bonus_allowed,"Binary Bonus",date('Y-m-d'));
    //            }
    //         }
    //     }
    // }

    public function tree_view(){
        $this->layout = "template";
        if($this->session->userdata('role') == "admin"){
            $this->layout = "admin";
        }
        $this->selected_tab = "tree_view";
        $parent_id = $this->session->userdata("id");
        $data = [];
        $data['left_users'] = $this->left_right_users($parent_id,"left");
        $data['right_users'] = $this->left_right_users($parent_id,"right");
        $this->load->view("users/tree_view_copy",$data);
    }

    public function get_tree_view(){
        $data = array();
        $parent_id = $this->session->userdata("id");

        $where = "users.parent_id = '".$parent_id."' ";
        $users_ids = $this->users->get_where('id,position', $where, true, '' , '', '');

        if(isset($users_ids[0]['position']) && $users_ids[0]['position']=='right')
        $users_ids= array_reverse($users_ids);
        
        //debug($users_ids,true);
        $all_data = array();
        
        $index2 = 0;
        foreach ($users_ids as $index=>$user_id){
            
            ($index2>4)?$index2=0:'';

            $user_id = $user_id['id'];
            $where_pre = "users.id='".$user_id."' ";
            $user_detail = $this->users->get_where('*', $where_pre, true, '' , '', '');
            $user_detail = $user_detail[0];
            
            $where = "point_user_id = '".$user_id."' ";
            $points = $this->points->get_where('SUM(left_points) as left_points,SUM(right_points) as right_points', $where, true, '' , '', '');
            $points = $points[0];
            $left_points = ($points['left_points']>0)?$points['left_points']:0;
            $right_points = ($points['right_points']>0)?$points['right_points']:0;

            $obj_local = new stdClass;
            //$obj_local->text = new stdClass;
            $img = (!empty($user_detail['profile_pic']))?$user_detail['profile_pic']:'user_user.jpg';

            $obj_local->image = base_url("assets/images/".$img);
            //$obj_local->text->name = ucwords($user_detail['fullname']);
            $obj_local->collapsed = true;
            $obj_local->HTMLclass = $user_detail['id'];
            
            //$obj_local->text->title = "$".$left_points."-"."$".$right_points;
            //$obj_local->HTMLclass = "blue";
            $this->get_children($user_id,$obj_local);
            $all_data[$index] = $obj_local;
            $index2++;
        }
        //debug($all_data,true);

        $where = "point_user_id = '".$parent_id."' ";
        $points = $this->points->get_where('SUM(left_points) as left_points,SUM(right_points) as right_points', $where, true, '' , '', '');
        $points = $points[0];
        $left_points = ($points['left_points']>0)?$points['left_points']:0;
        $right_points = ($points['right_points']>0)?$points['right_points']:0;
        $arr = array();
        $arr['left_right_investment'] = "$".$left_points."-"."$".$right_points;
        $arr['all_data'] = $all_data;

        //debug($all_data,true);

        echo json_encode($arr);
        
    }

    public function get_children($user_id,&$obj_is){

        $where = "users.parent_id='".$user_id."' ";
        $users_ids = $this->users->get_where('*', $where, true, '' , '', '');

        if(isset($users_ids[0]['position']) && $users_ids[0]['position']=='right')
        $users_ids= array_reverse($users_ids);

        $index2 = (isset($index2))?$index2:0;
        foreach($users_ids as $user_id){

            ($index2==4)?$index2=0:'';

            $user_id = $user_id['id'];
            $where_pre = "users.id='".$user_id."' ";
            $user_detail = $this->users->get_where('*', $where_pre, true, '' , '', '');
            $user_detail = $user_detail[0];

            $where = "point_user_id = '".$user_id."' ";
            $points = $this->points->get_where('SUM(left_points) as left_points,SUM(right_points) as right_points', $where, true, '' , '', '');
            $points = $points[0];
            $left_points = ($points['left_points']>0)?$points['left_points']:0;
            $right_points = ($points['right_points']>0)?$points['right_points']:0;

            $obj_local = new stdClass;
            //$obj_local->text = new stdClass;
            //$obj_local->text->name = ucwords($user_detail['fullname']);
            //$obj_local->text->title = "$".$left_points."-"."$".$right_points;
            $img = (!empty($user_detail['profile_pic']))?$user_detail['profile_pic']:'user_user.jpg';
            $obj_local->image = base_url("assets/images/".$img);
            $obj_local->collapsed = true;
            $obj_local->HTMLclass = $user_detail['id'];
            $obj_is->children[] = $obj_local;
            
            $this->get_children($user_id,$obj_local);
            $index2++;
        }
    }

    public function left_right_investment()
    {   
        $this->layout = " ";
        $data = array(); 
        $data['response'] = false;
        if($this->input->post()){
            $cls_str = $this->input->post('cls_str');
            $user_id = preg_replace("/[^0-9]/","",$cls_str);
            $fullname = '';
            $where = "id = '".$user_id."' ";
            $result = $this->users->get_where('*', $where, true, '' , '', '');
            if(!empty($result)){
                $fullname = $result[0]['fullname'];
                //$fullname = '<div class="fullname">'.$result[0]['fullname'].'</div>';
                $where = "point_user_id = '".$user_id."' ";
                $points = $this->points->get_where('SUM(left_points) as left_points,SUM(right_points) as right_points', $where, true, '' , '', '');
                $points = $points[0];
                $left_points = ($points['left_points']>0)?$points['left_points']:0;
                $right_points = ($points['right_points']>0)?$points['right_points']:0;
                $data['result'] = "<div class='left_right_investment'>'".$fullname."'<div class='left_right_amount'>'".$left_points."' - '".$right_points."'</div></div>";
                //$data['result'] = ucwords($fullname).' ($'.$left_points.' - $'.$right_points.')';
                $data['response'] = true;
            }
        }
        echo json_encode($data);
    }

    public function Buy_package($pkgid='')
    {
        if(!empty($pkgid)){
            $user_id = $this->session->userdata('id');
            $where = "package_id = '".$pkgid."' ";
            $package = $this->packages->get_where('*', $where, true, '' , '', '');
            $package = $package[0];
            $package_fees = intval(($package['package_fees']/100)*$package['package_amount']);
            $total_amount = $package['package_amount']+$package_fees;
            $user_balance  = user_balance($this->session->userdata('id'));
            if($total_amount>$user_balance){
                $this->session->set_flashdata('error_message',"You have low balance to buy this package.");
            }
            else{
                $data = array("user_id" => $user_id,"package_id"=> $pkgid);
                $this->user_packages->save($data);
                $this->session->set_flashdata('success_message',"Package Request has been sent to admin. Kindly wait for approval from admin side.");
            }
            redirect("User/Userdashboard");
        }
    }

    public function get_package()
    {   
        $this->layout = " ";
        $data = array();
        if( $this->input->post() ){
            $where = 'package_id = "' . $this->input->post('package_id') . '"';
            $result = $this->packages->get_where('*', $where, true, '', '', '');
            //debug($result,true);
            if( count($result) >= 1 ){
                $data = $result[0];
            }
        }
        echo json_encode($data);
    }

    public function userBalance(){
        if ($this->session->userdata("id") != "") {
            $id = $this->session->userdata("id");
            $package = $this->db->get_where("User_balance",array("user_id"=>$id))->row();
            echo json_encode($package);exit();
        }
    }

    public function Rewards(){
        $this->layout = "template";
        if($this->session->userdata('role') == "admin"){
            $this->layout = "admin";
        }
        $this->load->view("components/Rewards");

    }

    public function UserDetails(){
        $this->layout = "template";
        if($this->session->userdata('role') == "admin"){
            $this->layout = "admin";
        }
        $id = $this->session->userdata("id");
        $data['user_details'] = $this->User->user_details();
        $this->load->view("components/UserDetails",$data);
    }

    public function UserPackages(){
        $this->layout = "template";
        if($this->session->userdata('role') == "admin"){
            $this->layout = "admin";
        }
        $id = $this->session->userdata("id");
        $data['package']=$this->User->get_user_packages($id);
        $this->load->view("components/UserPackages",$data);
    }

    public function send_withdraw_req(){
        $response = array();
        $id = $this->session->userdata("id");
        $amount = $this->input->post("amount");
        $requested_on = date("Y-m-d H:i:s");
        $data = array(
            "user_id" => $id,
            "withdraw_amount" => $amount,
            "withdraw_status" => 0,
            "requested_on" => $requested_on
        );

        if ($this->User->send_withdraw_req($data)) {
            $response['status'] = true;
        }else{
            $response['status'] = false;
        }

        echo json_encode($response);
        exit();

    }

    public function delete($id=""){
        if ($this->User->delete("Users","id",$id)) {
            $this->session->set_flashdata("success","User Deleted successfully!");
            redirect("User/UserDetails");
        }
    }

    public function block($id=""){
        $data = array("status"=>0);
        if ($this->User->update("Users","id",$id,$data)) {
            $this->session->set_flashdata("success","User blocked successfully!");
            redirect("User/UserDetails");
        }
    }

    public function delete_package($id=''){
        if ($this->User->delete("packages","package_id",$id)) {
            $this->session->set_flashdata("success","Package Deleted successfully!");
            redirect("User/viewpackages");
        }
    }

    public function approve_withdraw($id=""){
        $data = array("withdraw_status"=>1);
        if ($this->User->update("Withdraws","withdraw_id",$id,$data)) {
            $this->session->set_flashdata("success","Withdraw Request Approved!");
            redirect("User/withdrawReqAdmin");
        }
    }

    public function reject_withdraw($id=""){
        $data = array("withdraw_status"=>2);
        if ($this->User->update("Withdraws","withdraw_id",$id,$data)) {
            $this->session->set_flashdata("success","Withdraw Request Rejected!");
            redirect("User/withdrawReqAdmin");
        }
    }

    public function unblock($id=""){
        $data = array("status"=>1);
        if ($this->User->update("Users","id",$id,$data)) {
            $this->session->set_flashdata("success","User unblocked successfully!");
            redirect("User/UserDetails");
        }
    }

    public function withdraw_limits(){
        $this->layout = "template";
        if($this->session->userdata('role') == "admin"){
            $this->layout = "admin";
        }
        $data['withdraw_controls'] = $this->User->select_withdraw_controls();
        $this->load->view("components_admin/withdraw_limits",$data);
    }

    public function withdraw_lim_update(){
        $data = array(
            "max_withdraw"=>$this->input->post("max"),
            "min_withdraw"=>$this->input->post("min"),
            "withdraw_open"=>$this->input->post("opening"),
            "withdraw_close"=>$this->input->post("closing")
        );
        if ($this->User->update("withdraw_controls","control_id",1,$data)) {
            $this->session->set_flashdata("success","Withdraw limits updated!");
            redirect("User/withdraw_limits");
        }
    }

    public function withdrawDetailsAdmin(){
        if ($this->session->userdata("role") == "admin") {
            $this->layout = "template";
            if($this->session->userdata('role') == "admin"){
                $this->layout = "admin";
            }
            $data['approved'] = $this->User->user_withdraws_admin(1);
            $data['rejected'] = $this->User->user_withdraws_admin(2);
            $this->load->view("components_admin/WithdrawDetails",$data);
        }
    }

    public function UserPackagesDetails(){
        if ($this->session->userdata("role") == "admin") {
            $this->layout = "admin";
            $data['packages'] = $this->User->UserPackagesDetails();
        // print_r($data);exit();
            $this->load->view("components_admin/UserPackagesDetails",$data);
        }
    }

    public function approvePackage($up_id,$user='',$package_id=''){
        if ($this->session->userdata("role") == "admin") {
            $data = array("status"=>1);
            if ($this->User->update("User_Packages","up_id",$up_id,$data)) {
                $package = $this->User->get_package_by_id($package_id);
                $user_balance = $this->User->user_balance($user);
                $fees = (int)$package->package_amount*(int)$package->package_fees/100;
                $amount = (int)$package->package_amount+$fees;
                $total_user_balance = (int)$user_balance->user_balance-$amount;
                $balance_arr = array("user_balance"=>$total_user_balance);
                $this->User->update("User_balance","user_id",$user,$balance_arr);
                $this->session->set_flashdata("success","User Package approved successfully!");
                redirect("User/packagerequests");
            }
        }
    }


    public function rejectPackage($up_id,$user='',$package_id=''){
        if ($this->session->userdata("role") == "admin") {
            $data = array("status"=>2);
            if ($this->User->update("User_Packages","up_id",$up_id,$data)) {
                $this->session->set_flashdata("success","User Package Rejected successfully!");
                redirect("User/packagerequests");
            }
        }
    }



}
