<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fleteros_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('fleteros_model');
		$this->config->load('fleteros_settings');
		$data['flags'] = $this->basicauth->getPermissions('fleteros');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->fleteros_model->getFieldsTable_m());
			$this->load->view('fleteros_view/home_fleteros', $data);
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
		$this->form_validation->set_rules('fleteros_nombre', 'fleteros_nombre', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('fleteros_apellido', 'fleteros_apellido', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('fleteros_telefono', 'fleteros_telefono', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('fleteros_direccion', 'fleteros_direccion', 'trim|alpha_numeric|xss_clean');

		if($this->form_validation->run())
		{	
			$data_fleteros  = array();
			$data_fleteros['fleteros_nombre'] = $this->input->post('fleteros_nombre');
			$data_fleteros['fleteros_apellido'] = $this->input->post('fleteros_apellido');
			if($this->input->post('fleteros_telefono'))
				$data_fleteros['fleteros_telefono'] = $this->input->post('fleteros_telefono');
			if($this->input->post('fleteros_direccion'))
				$data_fleteros['fleteros_direccion'] = $this->input->post('fleteros_direccion');
		
			$data_fleteros['fleteros_updated_at'] = $this->basicrud->formatDateToBD();

			$id_fleteros = $this->fleteros_model->add_m($data_fleteros);
			if($id_fleteros){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('fleteros_flash_add_message')); 
				redirect('fleteros_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('fleteros_flash_error_message')); 
				redirect('fleteros_controller','location');
			}
		}
		$this->load->view('fleteros_view/form_add_fleteros',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($fleteros_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['fleteros'] = $this->fleteros_model->get_m(array('fleteros_id' => $fleteros_id),$flag=1);
		$this->form_validation->set_rules('fleteros_id', 'fleteros_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('fleteros_nombre', 'fleteros_nombre', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('fleteros_apellido', 'fleteros_apellido', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('fleteros_telefono', 'fleteros_telefono', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('fleteros_direccion', 'fleteros_direccion', 'trim|alpha_numeric|xss_clean');
	
		if($this->form_validation->run()){
			$data_fleteros  = array();
			$data_fleteros['fleteros_id'] = $this->input->post('fleteros_id');
			$data_fleteros['fleteros_nombre'] = $this->input->post('fleteros_nombre');
			$data_fleteros['fleteros_apellido'] = $this->input->post('fleteros_apellido');
			$data_fleteros['fleteros_telefono'] = $this->input->post('fleteros_telefono');
			$data_fleteros['fleteros_direccion'] = $this->input->post('fleteros_direccion');
			$data_fleteros['fleteros_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->fleteros_model->edit_m($data_fleteros)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('fleteros_flash_edit_message')); 
				redirect('fleteros_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('fleteros_flash_error_message')); 
				redirect('fleteros_controller','location');
			}
		}
		$this->load->view('fleteros_view/form_edit_fleteros',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $fleteros_id id of record
	 * @return void
	 */
	function delete_c($fleteros_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->fleteros_model->delete_m($fleteros_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('fleteros_flash_delete_message')); 
			redirect('fleteros_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('fleteros_flash_error_delete_message')); 
			redirect('fleteros_controller','location');
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
		$data_search_fleteros = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_fleteros  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->fleteros_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_fleteros[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_fleteros['limit'] = $this->config->item('pag_perpage');
			$data_search_fleteros['offset'] = $offset;
			$data_search_fleteros['sortBy'] = 'fleteros_id';
			$data_search_fleteros['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'fleteros_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['fleteros'] = $this->fleteros_model->get_m($data_search_fleteros);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'fleteros_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['fleteros'] = $this->fleteros_model->get_m($data_search_fleteros);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->fleteros_model->getFieldsTable_m());
			$this->load->view('fleteros_view/record_list_fleteros',$data);
		}

	}

}