<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tramites_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('tramites_model');
		$this->config->load('tramites_settings');
		$data['flags'] = $this->basicauth->getPermissions('tramites');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->tramites_model->getFieldsTable_m());
			$this->load->view('tramites_view/home_tramites', $data);
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
		$this->form_validation->set_rules('tramites_descripcion', 'tramites_descripcion', 'trim|required|alpha_numeric|xss_clean');

		if($this->form_validation->run())
		{	
			$data_tramites  = array();
			$data_tramites['tramites_descripcion'] = $this->input->post('tramites_descripcion');
			$data_tramites['tramites_updated_at'] = $this->basicrud->formatDateToBD();

			$id_tramites = $this->tramites_model->add_m($data_tramites);
			if($id_tramites){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('tramites_flash_add_message')); 
				redirect('tramites_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('tramites_flash_error_message')); 
				redirect('tramites_controller','location');
			}
		}
		$this->load->view('tramites_view/form_add_tramites',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($tramites_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['tramites'] = $this->tramites_model->get_m(array('tramites_id' => $tramites_id),$flag=1);
		$this->form_validation->set_rules('tramites_id', 'tramites_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('tramites_descripcion', 'tramites_descripcion', 'trim|required|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_tramites  = array();
			$data_tramites['tramites_id'] = $this->input->post('tramites_id');
			$data_tramites['tramites_descripcion'] = $this->input->post('tramites_descripcion');
			$data_tramites['tramites_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->tramites_model->edit_m($data_tramites)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('tramites_flash_edit_message')); 
				redirect('tramites_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('tramites_flash_error_message')); 
				redirect('tramites_controller','location');
			}
		}
		$this->load->view('tramites_view/form_edit_tramites',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $tramites_id id of record
	 * @return void
	 */
	function delete_c($tramites_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->tramites_model->delete_m($tramites_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('tramites_flash_delete_message')); 
			redirect('tramites_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('tramites_flash_error_delete_message')); 
			redirect('tramites_controller','location');
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
		$data_search_tramites = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_tramites  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->tramites_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_tramites[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_tramites['limit'] = $this->config->item('pag_perpage');
			$data_search_tramites['offset'] = $offset;
			$data_search_tramites['sortBy'] = 'tramites_id';
			$data_search_tramites['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'tramites_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['tramites'] = $this->tramites_model->get_m($data_search_tramites);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'tramites_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['tramites'] = $this->tramites_model->get_m($data_search_tramites);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->tramites_model->getFieldsTable_m());
			$this->load->view('tramites_view/record_list_tramites',$data);
		}

	}

}