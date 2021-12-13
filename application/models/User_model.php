<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->table = "users";
	}

	public function user_details($all="*"){
		return $this->db->query("SELECT e.*,s.username as 'parent_name' FROM Users e JOIN Users s ON s.id = e.parent_id ORDER BY e.ID Desc")->result_array();
	}

	public function get_package_by_id($id=''){
		return $this->db->get_where("packages",array("package_id"=>$id))->row();
	}

	public function user_balance($id=''){
		return $this->db->get_where("User_balance",array("user_id"=>$id))->row();
	}

	public function select_downline($col="",$val="",$limit=""){

		return $this->db->select("*")->from($this->table)->where($col,$val)->limit($limit)->get()->result_array();

	} 

	public function select_parent($col="",$val=""){
		return $this->db->query("SELECT s.parent_id FROM Users s JOIN Users e ON s.parent_id = e.id where s.id = 8")->result_array();
	} 

	public function parent_id($code){
		return $this->db->select("id")->from($this->table)->where("sponsor_code",$code)->get()->result_array();
	}

	public function save($arr){
		$this->db->insert($this->table,$arr);
		return true;
	}
	public function save_table($table,$arr){
		$this->db->insert($table,$arr);
		return true;
	}

	public function login_data($email='',$password=''){
		$arr = array("email"=>$email,"password" => $password);
		return $this->db->select("*")->from($this->table)->where($arr)->get()->result_array();

	}

	public function withdraw_controls(){
		return $this->db->get("withdraw_controls")->result_array();
	}

	public function user_withdraws($user){
		return $this->db->select('Withdraws.*')
		->from('Users')
		->join('Withdraws','Withdraws.user_id = Users.id')->where("Withdraws.user_id",$user)->limit(5)->get()->result_array();
	}

	public function user_withdraws_all($user){
		return $this->db->select('Withdraws.*')
		->from('Users')
		->join('Withdraws','Withdraws.user_id = Users.id')->where("Withdraws.user_id",$user)->get()->result_array();
	}

	public function user_withdraws_admin($status=0){
		return $this->db->select('Users.*,Withdraws.*')
		->from('Users')
		->join('Withdraws','Withdraws.user_id = Users.id')->where("Withdraws.withdraw_status",$status)->get()->result_array();
	}

	public function get_user_packages($user){
		return $this->db->select('packages.*')
		->from('packages')
		->join('user_packages','user_packages.package_id = packages.package_id')->where("user_packages.user_id",$user)->where("user_packages.status",1)->get()->result_array();
	}

	public function UserPackagesDetails(){
		return $this->db->select("Users.*,packages.*")->from("Users")->join("user_packages","user_packages.user_id = Users.id")->join("packages","user_packages.package_id = packages.package_id")->where("user_packages.status",1)->get()->result_array();
	}

	public function UserPackagesDetailsAdmin(){
		return $this->db->select("Users.*,packages.*,user_packages.status As 'user_package_status',user_packages.up_id")->from("Users")->join("user_packages","user_packages.user_id = Users.id")->join("packages","user_packages.package_id = packages.package_id")->where("user_packages.status !=",1)->get()->result_array();
	}

	public function send_withdraw_req($data){
		return $this->db->insert("Withdraws",$data);
	}

	public function update($table,$column="",$val="",$data=""){
		$this->db->where($column,$val);
		return $this->db->update($table,$data);
	}

	public function delete($table,$column="",$val=""){
		$this->db->where($column,$val);
		return $this->db->delete($table);
	}

	public function select_withdraw_controls(){
		return $this->db->get("withdraw_controls")->result_array();
	}

	public function select_all($table,$all="*",$limit){
		$this->db->limit($limit);
		return $this->db->get($table)->result_array();
	}

}