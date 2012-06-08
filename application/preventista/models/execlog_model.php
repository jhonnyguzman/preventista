<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Execlog_Model extends CI_Model {

	private $website;

	function __construct()
	{
		parent::__construct();
		$this->website = "http://".base_url();
	}

	function execquery_m($query_str)
	{
		if($this->db->simple_query($query_str)){
			log_message("info", "Row insert successfull: ".$this->website."\n".$query_str);
			return true;
		}else{

			$errNo       = $this->db->_error_number();
			$errMess     = $this->db->_error_message();//chang log.php
			log_message("error", "Problem DB insert log sql ".$this->website." \n".$errMess." (".$errNo.")");

			return false;
		}
	}

}