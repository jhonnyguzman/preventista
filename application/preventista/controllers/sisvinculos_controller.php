<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sisvinculos_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('sisvinculos_model');
		$this->config->load('sisvinculos_settings');
		$data['flags'] = $this->basicauth->getPermissions('sisvinculos');
		$this->flagR = $data['flags']['flag-read'];
		$this->flagI = $data['flags']['flag-insert'];
		$this->flagU = $data['flags']['flag-update'];
		$this->flagD = $data['flags']['flag-delete'];
		$this->flags = array('i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = $this->config->item('recordListTitle');
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->sisvinculos_model->getFieldsTable_m());
			$this->load->view('sisvinculos_view/home_sisvinculos', $data);
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
		$this->form_validation->set_rules('sisvinculos_id', 'sisvinculos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('sismenu_id', 'sismenu_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('sisvinculos_link', 'sisvinculos_link', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('sisvinculos_created_at', 'sisvinculos_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('sisvinculos_updated_at', 'sisvinculos_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_sisvinculos  = array();
			if($this->input->post('sismenu_id'))
				$data_sisvinculos['sismenu_id'] = $this->input->post('sismenu_id');
			if($this->input->post('sisvinculos_link'))
				$data_sisvinculos['sisvinculos_link'] = $this->input->post('sisvinculos_link');
			if($this->input->post('sisvinculos_created_at'))
				$data_sisvinculos['sisvinculos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('sisvinculos_created_at'));
			if($this->input->post('sisvinculos_updated_at'))
				$data_sisvinculos['sisvinculos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('sisvinculos_updated_at'));

			$id_sisvinculos = $this->sisvinculos_model->add_m($data_sisvinculos);
			if($id_sisvinculos){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('sisvinculos_flash_add_message')); 
				redirect('sisvinculos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('sisvinculos_flash_error_message')); 
				redirect('sisvinculos_controller','location');
			}
		}
		$this->load->view('sisvinculos_view/form_add_sisvinculos',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($sisvinculos_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['sisvinculos'] = $this->sisvinculos_model->get_m(array('sisvinculos_id' => $sisvinculos_id),$flag=1);
		$this->form_validation->set_rules('sisvinculos_id', 'sisvinculos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('sismenu_id', 'sismenu_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('sisvinculos_link', 'sisvinculos_link', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('sisvinculos_created_at', 'sisvinculos_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('sisvinculos_updated_at', 'sisvinculos_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_sisvinculos  = array();
			if($this->input->post('sisvinculos_id'))
				$data_sisvinculos['sisvinculos_id'] = $this->input->post('sisvinculos_id');
			if($this->input->post('sismenu_id'))
				$data_sisvinculos['sismenu_id'] = $this->input->post('sismenu_id');
			if($this->input->post('sisvinculos_link'))
				$data_sisvinculos['sisvinculos_link'] = $this->input->post('sisvinculos_link');
			if($this->input->post('sisvinculos_created_at'))
				$data_sisvinculos['sisvinculos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('sisvinculos_created_at'));
			if($this->input->post('sisvinculos_updated_at'))
				$data_sisvinculos['sisvinculos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('sisvinculos_updated_at'));

			if($this->sisvinculos_model->edit_m($data_sisvinculos)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('sisvinculos_flash_edit_message')); 
				redirect('sisvinculos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('sisvinculos_flash_error_message')); 
				redirect('sisvinculos_controller','location');
			}
		}
		$this->load->view('sisvinculos_view/form_edit_sisvinculos',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $sisvinculos_id id of record
	 * @return void
	 */
	function delete_c($sisvinculos_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->sisvinculos_model->delete_m($sisvinculos_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('sisvinculos_flash_delete_message')); 
			redirect('sisvinculos_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('sisvinculos_flash_error_delete_message')); 
			redirect('sisvinculos_controller','location');
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
		$data_search_sisvinculos = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_sisvinculos  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->sisvinculos_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_sisvinculos[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_sisvinculos['limit'] = $this->config->item('pag_perpage');
			$data_search_sisvinculos['offset'] = $offset;
			$data_search_sisvinculos['sortBy'] = 'sisvinculos_id';
			$data_search_sisvinculos['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'sisvinculos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['sisvinculos'] = $this->sisvinculos_model->get_m($data_search_sisvinculos);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'sisvinculos_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['sisvinculos'] = $this->sisvinculos_model->get_m($data_search_sisvinculos);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->sisvinculos_model->getFieldsTable_m());
			$this->load->view('sisvinculos_view/record_list_sisvinculos',$data);
		}

	}

}