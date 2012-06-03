<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sispermisos_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('sispermisos_model');
		$this->load->model('perfiles_model');
		$this->config->load('sispermisos_settings');
		if($this->session->userdata('logged_in') == true) { 
			$data['flags'] = $this->basicauth->getPermissions('sispermisos');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->sispermisos_model->getFieldsTable_m());
			$this->load->view('sispermisos_view/home_sispermisos', $data);
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
		$data = array();
		$data['subtitle'] = $this->config->item('recordAddTitle');
		$data['perfiles'] = $this->perfiles_model->get_m(array('perfiles_estado' => 1));

		$this->form_validation->set_rules('sispermisos_tabla', 'sispermisos_tabla', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('sispermisos_flag_read', 'sispermisos_flag_read', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('sispermisos_flag_insert', 'sispermisos_flag_insert', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('sispermisos_flag_update', 'sispermisos_flag_update', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('sispermisos_flag_delete', 'sispermisos_flag_delete', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('perfiles_id', 'perfiles_id', 'trim|required|integer|xss_clean');
		if($this->form_validation->run())
		{	
			$data_sispermisos  = array();
			$data_sispermisos['sispermisos_tabla'] = $this->input->post('sispermisos_tabla');
			$data_sispermisos['sispermisos_flag_read'] = $this->input->post('sispermisos_flag_read');
			$data_sispermisos['sispermisos_flag_insert'] = $this->input->post('sispermisos_flag_insert');
			$data_sispermisos['sispermisos_flag_update'] = $this->input->post('sispermisos_flag_update');
			$data_sispermisos['sispermisos_flag_delete'] = $this->input->post('sispermisos_flag_delete');
			$data_sispermisos['perfiles_id'] = $this->input->post('perfiles_id');
			$data_sispermisos['sispermisos_updated_at'] =$this->basicrud->formatDateToBD();

			$id_sispermisos = $this->sispermisos_model->add_m($data_sispermisos);
			if($id_sispermisos){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('sispermisos_flash_add_message')); 
				redirect('sispermisos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('sispermisos_flash_error_message')); 
				redirect('sispermisos_controller','location');
			}
		}
		$this->load->view('sispermisos_view/form_add_sispermisos',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($sispermisos_id)
	{
		//code here
		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['sispermisos'] = $this->sispermisos_model->get_m(array('sispermisos_id' => $sispermisos_id),$flag=1);
		$data['perfiles'] = $this->perfiles_model->get_m(array('perfiles_estado' => 1));
		
		$this->form_validation->set_rules('sispermisos_id', 'sispermisos_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('sispermisos_tabla', 'sispermisos_tabla', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('sispermisos_flag_read', 'sispermisos_flag_read', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('sispermisos_flag_insert', 'sispermisos_flag_insert', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('sispermisos_flag_update', 'sispermisos_flag_update', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('sispermisos_flag_delete', 'sispermisos_flag_delete', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('perfiles_id', 'perfiles_id', 'trim|required|integer|xss_clean');
		
		if($this->form_validation->run()){
			$data_sispermisos  = array();
				$data_sispermisos['sispermisos_id'] = $this->input->post('sispermisos_id');
				$data_sispermisos['sispermisos_tabla'] = $this->input->post('sispermisos_tabla');
				$data_sispermisos['sispermisos_flag_read'] = $this->input->post('sispermisos_flag_read');
				$data_sispermisos['sispermisos_flag_insert'] = $this->input->post('sispermisos_flag_insert');
				$data_sispermisos['sispermisos_flag_update'] = $this->input->post('sispermisos_flag_update');
				$data_sispermisos['sispermisos_flag_delete'] = $this->input->post('sispermisos_flag_delete');
				$data_sispermisos['perfiles_id'] = $this->input->post('perfiles_id');
				$data_sispermisos['sispermisos_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->sispermisos_model->edit_m($data_sispermisos)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('sispermisos_flash_edit_message')); 
				redirect('sispermisos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('sispermisos_flash_error_message')); 
				redirect('sispermisos_controller','location');
			}
		}
		$this->load->view('sispermisos_view/form_edit_sispermisos',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $sispermisos_id id of record
	 * @return void
	 */
	function delete_c($sispermisos_id)
	{
		//code here
		if($this->sispermisos_model->delete_m($sispermisos_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('sispermisos_flash_delete_message')); 
			redirect('sispermisos_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('sispermisos_flash_error_delete_message')); 
			redirect('sispermisos_controller','location');
		}

	}

	function search_c($offset = 0)
	{
		//code here
		$data = array(); 
		$fieldSearch = array(); 
		$data_search_sispermisos  = array();
		$data_search_pagination  = array();
		$flag = 0;
		
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->sispermisos_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '')
				{ 
					$data_search_sispermisos[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}
			
			$data_search_pagination['count'] = true;
			$data_search_sispermisos['limit'] = $this->config->item('pag_perpage');
			$data_search_sispermisos['offset'] = $offset;
			$data_search_sispermisos['sortBy'] = 'sispermisos_id';
			$data_search_sispermisos['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'sispermisos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['sispermisos'] = $this->sispermisos_model->get_m($data_search_sispermisos);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'sispermisos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['sispermisos'] = $this->sispermisos_model->get_m($data_search_sispermisos);
			}
					
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->sispermisos_model->getFieldsTable_m());
			$data['flag'] = $this->flags;
			$this->load->view('sispermisos_view/record_list_sispermisos',$data);
		}

	}

}