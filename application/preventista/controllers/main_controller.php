<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main_Controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		//code here
		$data['subtitle'] = 'Test';
		$this->load->view('main/main_view', $data);
	}

}