<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


include_once('Abstract_model.php');

//require(APPPATH.'models/abstract_model.php');

class Total_earnings_model extends Abstract_model
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
		$this->table_name = "total_earnings";
		parent::__Construct();
	}

}
