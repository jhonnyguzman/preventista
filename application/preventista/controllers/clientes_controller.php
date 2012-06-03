<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('clientes_model');
		$this->load->model('clientescategoria_model');
		$this->load->model('cuentacorriente_model');
		$this->config->load('clientes_settings');
		$data['flags'] = $this->basicauth->getPermissions('clientes');
		$this->flagR = $data['flags']['flag-read'];
		$this->flagI = $data['flags']['flag-insert'];
		$this->flagU = $data['flags']['flag-update'];
		$this->flagD = $data['flags']['flag-delete'];
		$this->flags = array('r'=>$this->flagR, 'i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = $this->config->item('recordListTitle');
			//$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->clientes_model->getFieldsTable_m());
			$this->load->view('clientes_view/home_clientes', $data);
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
		$data['clientescategoria'] = $this->clientescategoria_model->get_m(array('clientescategoria_estado' => 1));
		$this->form_validation->set_rules('clientes_nombre', 'clientes_nombre', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_apellido', 'clientes_apellido', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_direccion', 'clientes_direccion', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_telefono', 'clientes_telefono', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientescategoria_id', 'clientescategoria_id', 'trim|required|integer|xss_clean');
		if($this->form_validation->run())
		{	
			$data_clientes  = array();
			
			$data_clientes['clientes_nombre'] = $this->input->post('clientes_nombre');
			$data_clientes['clientes_apellido'] = $this->input->post('clientes_apellido');
			if($this->input->post('clientes_direccion'))
				$data_clientes['clientes_direccion'] = $this->input->post('clientes_direccion');
			if($this->input->post('clientes_telefono'))
				$data_clientes['clientes_telefono'] = $this->input->post('clientes_telefono');
			$data_clientes['clientescategoria_id'] = $this->input->post('clientescategoria_id');
			$data_clientes['clientes_created_at'] = $this->basicrud->formatDateToBD();
			$data_clientes['clientes_updated_at'] = $this->basicrud->formatDateToBD();

			$id_clientes = $this->clientes_model->add_m($data_clientes);
			if($id_clientes){
				$cuentacorriente = $this->cuentacorriente_model->add_m(array('clientes_id' => $id_clientes, 'cuentacorriente_updated_at' => $this->basicrud->formatDateToBD())); 
				$this->session->set_flashdata('flashConfirm', $this->config->item('clientes_flash_add_message')); 
				redirect('clientes_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('clientes_flash_error_message')); 
				redirect('clientes_controller','location');
			}
		}
		$this->load->view('clientes_view/form_add_clientes',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($clientes_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['clientescategoria'] = $this->clientescategoria_model->get_m(array('clientescategoria_estado' => 1));
		$data['clientes'] = $this->clientes_model->get_m(array('clientes_id' => $clientes_id),$flag=1);

		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('clientes_nombre', 'clientes_nombre', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_apellido', 'clientes_apellido', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_direccion', 'clientes_direccion', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_telefono', 'clientes_telefono', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientescategoria_id', 'clientescategoria_id', 'trim|required|integer|xss_clean');

		if($this->form_validation->run()){
			$data_clientes  = array();
			$data_clientes['clientes_id'] = $this->input->post('clientes_id');
			$data_clientes['clientes_nombre'] = $this->input->post('clientes_nombre');
			$data_clientes['clientes_apellido'] = $this->input->post('clientes_apellido');
			if($this->input->post('clientes_direccion'))
				$data_clientes['clientes_direccion'] = $this->input->post('clientes_direccion');
			if($this->input->post('clientes_telefono'))
				$data_clientes['clientes_telefono'] = $this->input->post('clientes_telefono');
			$data_clientes['clientescategoria_id'] = $this->input->post('clientescategoria_id');
			$data_clientes['clientes_updated_at'] =$this->basicrud->formatDateToBD();

			if($this->clientes_model->edit_m($data_clientes)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('clientes_flash_edit_message')); 
				redirect('clientes_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('clientes_flash_error_message')); 
				redirect('clientes_controller','location');
			}
		}
		$this->load->view('clientes_view/form_edit_clientes',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $clientes_id id of record
	 * @return void
	 */
	function delete_c($clientes_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->clientes_model->delete_m($clientes_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('clientes_flash_delete_message')); 
			redirect('clientes_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('clientes_flash_error_delete_message')); 
			redirect('clientes_controller','location');
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
		$data_search_clientes = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_clientes  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->clientes_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_clientes[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_clientes['limit'] = $this->config->item('pag_perpage');
			$data_search_clientes['offset'] = $offset;
			$data_search_clientes['sortBy'] = 'clientes_id';
			$data_search_clientes['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'clientes_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['clientes'] = $this->clientes_model->get_m($data_search_clientes);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'clientes_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['clientes'] = $this->clientes_model->get_m($data_search_clientes);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->clientes_model->getFieldsTable_m());
			$this->load->view('clientes_view/record_list_clientes',$data);
		}

	}


	function showFormCC_c($clientes_id)
	{
		$data['clientes_id'] = $clientes_id;
		$this->load->view('cuentacorriente_view/_show_cuentacorriente',$data);
	}

}