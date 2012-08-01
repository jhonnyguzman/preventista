<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userguide_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		//code here
			$this->load->view('articulos_view/home_articulos', $data);
			$this->search_c();
		}

	}