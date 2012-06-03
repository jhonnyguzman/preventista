<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sisperfil_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('sisperfil_model');
		$this->config->load('sisperfil_settings');
		if($this->session->userdata('logged_in') == true) { 
			$data['flags'] = $this->basicauth->getPermissions('sisperfil');
			$this->flagR = $data['flags']['flag-read'];
			$this->flagI = $data['flags']['flag-insert'];
			$this->flagU = $data['flags']['flag-update'];
			$this->flagD = $data['flags']['flag-delete'];
			$this->flags = array('i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
		}
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = $this->config->item('recordListTitle');
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->sisperfil_model->getFieldsTable_m());
			$this->load->view('sisperfil_view/home_sisperfil', $data);
			$this->search_c();
		}

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for saving 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function add_c()
	{
		//code here
		if(!$this->flagI){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordAddTitle');
		$this->form_validation->set_rules('sisperfil_id', 'sisperfil_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('sismenu_id', 'sismenu_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('perfiles_id', 'perfiles_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('sisperfil_estado', 'sisperfil_estado', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('sisperfil_created_at', 'sisperfil_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('sisperfil_updated_at', 'sisperfil_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_sisperfil  = array();
			if($this->input->post('sismenu_id'))
				$data_sisperfil['sismenu_id'] = $this->input->post('sismenu_id');
			if($this->input->post('perfiles_id'))
				$data_sisperfil['perfiles_id'] = $this->input->post('perfiles_id');
			if($this->input->post('sisperfil_estado'))
				$data_sisperfil['sisperfil_estado'] = $this->input->post('sisperfil_estado');
			if($this->input->post('sisperfil_created_at'))
				$data_sisperfil['sisperfil_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('sisperfil_created_at'));
			if($this->input->post('sisperfil_updated_at'))
				$data_sisperfil['sisperfil_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('sisperfil_updated_at'));

			$id_sisperfil = $this->sisperfil_model->add_m($data_sisperfil);
			if($id_sisperfil){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('sisperfil_flash_add_message')); 
				redirect('sisperfil_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('sisperfil_flash_error_message')); 
				redirect('sisperfil_controller','location');
			}
		}
		$this->load->view('sisperfil_view/form_add_sisperfil',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($sisperfil_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['sisperfil'] = $this->sisperfil_model->get_m(array('sisperfil_id' => $sisperfil_id),$flag=1);
		$this->form_validation->set_rules('sisperfil_id', 'sisperfil_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('sismenu_id', 'sismenu_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('perfiles_id', 'perfiles_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('sisperfil_estado', 'sisperfil_estado', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('sisperfil_created_at', 'sisperfil_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('sisperfil_updated_at', 'sisperfil_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_sisperfil  = array();
			if($this->input->post('sisperfil_id'))
				$data_sisperfil['sisperfil_id'] = $this->input->post('sisperfil_id');
			if($this->input->post('sismenu_id'))
				$data_sisperfil['sismenu_id'] = $this->input->post('sismenu_id');
			if($this->input->post('perfiles_id'))
				$data_sisperfil['perfiles_id'] = $this->input->post('perfiles_id');
			if($this->input->post('sisperfil_estado'))
				$data_sisperfil['sisperfil_estado'] = $this->input->post('sisperfil_estado');
			if($this->input->post('sisperfil_created_at'))
				$data_sisperfil['sisperfil_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('sisperfil_created_at'));
			if($this->input->post('sisperfil_updated_at'))
				$data_sisperfil['sisperfil_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('sisperfil_updated_at'));

			if($this->sisperfil_model->edit_m($data_sisperfil)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('sisperfil_flash_edit_message')); 
				redirect('sisperfil_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('sisperfil_flash_error_message')); 
				redirect('sisperfil_controller','location');
			}
		}
		$this->load->view('sisperfil_view/form_edit_sisperfil',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $sisperfil_id id of record
	 * @return void
	 */
	function delete_c($sisperfil_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->sisperfil_model->delete_m($sisperfil_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('sisperfil_flash_delete_message')); 
			redirect('sisperfil_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('sisperfil_flash_error_delete_message')); 
			redirect('sisperfil_controller','location');
		}

	}


	/**
	 * This function filter and sends the data to the view
	 * to shows the found result
	 *
	 * @access public
	 * @return void
	 */
	function search_c($offset = 0)
	{
		//code here
		$data = array(); 
		$fieldSearch = array(); 
		$data_search_sisperfil = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_sisperfil  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->sisperfil_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_sisperfil[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_sisperfil['limit'] = $this->config->item('pag_perpage');
			$data_search_sisperfil['offset'] = $offset;
			$data_search_sisperfil['sortBy'] = 'sisperfil_id';
			$data_search_sisperfil['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'sisperfil_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['sisperfil'] = $this->sisperfil_model->get_m($data_search_sisperfil);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'sisperfil_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['sisperfil'] = $this->sisperfil_model->get_m($data_search_sisperfil);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->sisperfil_model->getFieldsTable_m());
			$this->load->view('sisperfil_view/record_list_sisperfil',$data);
		}

	}

}