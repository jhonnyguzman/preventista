<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientescategoria_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('clientescategoria_model');
		$this->config->load('clientescategoria_settings');
		$data['flags'] = $this->basicauth->getPermissions('clientescategoria');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->clientescategoria_model->getFieldsTable_m());
			$this->load->view('clientescategoria_view/home_clientescategoria', $data);
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
		
		$this->form_validation->set_rules('clientescategoria_descripcion', 'clientescategoria_descripcion', 'trim|required|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_clientescategoria  = array();
			$data_clientescategoria['clientescategoria_descripcion'] = $this->input->post('clientescategoria_descripcion');
			$data_clientescategoria['clientescategoria_estado'] = 1;
			$data_clientescategoria['clientescategoria_updated_at'] = $this->basicrud->formatDateToBD();

			$id_clientescategoria = $this->clientescategoria_model->add_m($data_clientescategoria);
			if($id_clientescategoria){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('clientescategoria_flash_add_message')); 
				redirect('clientescategoria_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('clientescategoria_flash_error_message')); 
				redirect('clientescategoria_controller','location');
			}
		}
		$this->load->view('clientescategoria_view/form_add_clientescategoria',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($clientescategoria_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['clientescategoria'] = $this->clientescategoria_model->get_m(array('clientescategoria_id' => $clientescategoria_id),$flag=1);
		$this->form_validation->set_rules('clientescategoria_id', 'clientescategoria_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('clientescategoria_descripcion', 'clientescategoria_descripcion', 'trim|required|alpha_numeric|xss_clean');
		
		if($this->form_validation->run()){
			$data_clientescategoria  = array();
			$data_clientescategoria['clientescategoria_id'] = $this->input->post('clientescategoria_id');
			$data_clientescategoria['clientescategoria_descripcion'] = $this->input->post('clientescategoria_descripcion');
			$data_clientescategoria['clientescategoria_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->clientescategoria_model->edit_m($data_clientescategoria)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('clientescategoria_flash_edit_message')); 
				redirect('clientescategoria_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('clientescategoria_flash_error_message')); 
				redirect('clientescategoria_controller','location');
			}
		}
		$this->load->view('clientescategoria_view/form_edit_clientescategoria',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $clientescategoria_id id of record
	 * @return void
	 */
	function delete_c($clientescategoria_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->clientescategoria_model->delete_m($clientescategoria_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('clientescategoria_flash_delete_message')); 
			redirect('clientescategoria_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('clientescategoria_flash_error_delete_message')); 
			redirect('clientescategoria_controller','location');
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
		$data_search_clientescategoria = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_clientescategoria  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->clientescategoria_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_clientescategoria[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_clientescategoria['limit'] = $this->config->item('pag_perpage');
			$data_search_clientescategoria['offset'] = $offset;
			$data_search_clientescategoria['sortBy'] = 'clientescategoria_id';
			$data_search_clientescategoria['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'clientescategoria_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['clientescategoria'] = $this->clientescategoria_model->get_m($data_search_clientescategoria);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'clientescategoria_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['clientescategoria'] = $this->clientescategoria_model->get_m($data_search_clientescategoria);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->clientescategoria_model->getFieldsTable_m());
			$this->load->view('clientescategoria_view/record_list_clientescategoria',$data);
		}

	}

}