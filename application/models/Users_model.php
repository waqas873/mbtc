<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


include_once('Abstract_model.php');

//require(APPPATH.'models/abstract_model.php');

class Users_model extends Abstract_model
{
	/**
	* @var stirng
	* @access protected
	*/
    protected $table_name = "";
	
	/** 
	*  Model constructor
	* 
	* @access public 
	*/

    public function __Construct()
	{
		$this->table_name = "users";
		parent::__Construct();
	}

	public function uniqueLogin($loginEmail='',$id,$userName='')
    {
        if(isset($loginEmail) && !empty($loginEmail) && empty($userName))
        {
            $loginId=$loginEmail;
            $this->db->where('email', $loginId);
        }
        else if(isset($userName) && !empty($userName) && empty($loginEmail))
        {
            $loginId=$userName;
            $this->db->where('username',$loginId);
        }
        if ($id != "ci_validation")
            $this->db->where('id !=', $id);

        if($result=$this->db->get($this->table_name, 1)->result('array'))
        {
           if(!empty($result))
                return true;
        }
        return false;
    }

    public function sponsor_code($sponsor_code='')
    {
        if(isset($sponsor_code) && !empty($sponsor_code))
        {
            $loginId=$sponsor_code;
            $this->db->where('sponsor_code',$loginId);
        }
        if($result=$this->db->get($this->table_name, 1)->result('array'))
        {
           if(!empty($result))
                return true;
        }
        return false;
    }

}
