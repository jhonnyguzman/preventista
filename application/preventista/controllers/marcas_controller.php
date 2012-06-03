<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marcas_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('marcas_model');
		$this->load->model('tabgral_model');
		$this->config->load('marcas_settings');
		$data['flags'] = $this->basicauth->getPermissions('marcas');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->marcas_model->getFieldsTable_m());
			$this->load->view('marcas_view/home_marcas', $data);
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
		$data['marcaspadres'] = $this->marcas_model->get_m();
		$data['estados'] = $this->tabgral_model->get_m(array('grupos_tabgral_id' => 1));

		$this->form_validation->set_rules('marcas_parent', 'marcas_parent', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('marcas_descripcion', 'marcas_descripcion', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('marcas_estado', 'marcas_estado', 'trim|required|integer|xss_clean');
		if($this->form_validation->run())
		{	
			$data_marcas  = array();
			$data_marcas['marcas_parent'] = $this->input->post('marcas_parent');
			$data_marcas['marcas_descripcion'] = $this->input->post('marcas_descripcion');
			$data_marcas['marcas_estado'] = $this->input->post('marcas_estado');
			$data_marcas['marcas_updated_at'] = $this->basicrud->formatDateToBD();

			$id_marcas = $this->marcas_model->add_m($data_marcas);
			if($id_marcas){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('marcas_flash_add_message')); 
				redirect('marcas_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('marcas_flash_error_message')); 
				redirect('marcas_controller','location');
			}
		}
		$this->load->view('marcas_view/form_add_marcas',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($marcas_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['marcas'] = $this->marcas_model->get_m(array('marcas_id' => $marcas_id),$flag=1);
		$data['marcaspadres'] = $this->marcas_model->get_m();
		$data['estados'] = $this->tabgral_model->get_m(array('grupos_tabgral_id' => 1));
		
		$this->form_validation->set_rules('marcas_id', 'marcas_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('marcas_parent', 'marcas_parent', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('marcas_descripcion', 'marcas_descripcion', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('marcas_estado', 'marcas_estado', 'trim|integer|xss_clean');
		if($this->form_validation->run()){
			$data_marcas  = array();
			$data_marcas['marcas_id'] = $this->input->post('marcas_id');
			$data_marcas['marcas_parent'] = $this->input->post('marcas_parent');
			$data_marcas['marcas_descripcion'] = $this->input->post('marcas_descripcion');
			$data_marcas['marcas_estado'] = $this->input->post('marcas_estado');
			$data_marcas['marcas_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->marcas_model->edit_m($data_marcas)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('marcas_flash_edit_message')); 
				redirect('marcas_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('marcas_flash_error_message')); 
				redirect('marcas_controller','location');
			}
		}
		$this->load->view('marcas_view/form_edit_marcas',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $marcas_id id of record
	 * @return void
	 */
	function delete_c($marcas_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->marcas_model->delete_m($marcas_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('marcas_flash_delete_message')); 
			redirect('marcas_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('marcas_flash_error_delete_message')); 
			redirect('marcas_controller','location');
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
		$data_search_marcas = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_marcas  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->marcas_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_marcas[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_marcas['limit'] = $this->config->item('pag_perpage');
			$data_search_marcas['offset'] = $offset;
			$data_search_marcas['sortBy'] = 'marcas_id';
			$data_search_marcas['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'marcas_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['marcas'] = $this->marcas_model->get_m($data_search_marcas);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'marcas_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['marcas'] = $this->marcas_model->get_m($data_search_marcas);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->marcas_model->getFieldsTable_m());
			$this->load->view('marcas_view/record_list_marcas',$data);
		}

	}

	function get_c($marcas_parent)
	{
		$data = '';	
		$marcas = $this->marcas_model->get_m(array('marcas_parent' => $marcas_parent, 'marcas_estado' => 1));

		if(count($marcas) > 0){
			
			$data = "<select name='marcas_id[]' id='marcas_id' onClick=\"getR(this,'".base_url()."marcas_controller/get_c/','rubros')\">";
			$data.= "<option value=''>Seleccione</option>";
			foreach ($marcas as $f) {
				$data.= "<option value='".$f->marcas_id."'>".$f->marcas_descripcion."</option>";
			}
			$data.= "</select>";
		}

		echo $data;
	}


	function getchildren_c($marcas_parent)
	{
		$marcas = $this->marcas_model->get_m(array('marcas_parent' => $marcas_parent, 'marcas_estado' => 1));
		echo "<pre>";
		print_r($marcas);
		echo "</pre>";		
	}
}