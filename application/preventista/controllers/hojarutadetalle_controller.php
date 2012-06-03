<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hojarutadetalle_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('hojarutadetalle_model');
		$this->load->model('pedidos_model');
		$this->config->load('hojarutadetalle_settings');
		$data['flags'] = $this->basicauth->getPermissions('hojarutadetalle');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->hojarutadetalle_model->getFieldsTable_m());
			$this->load->view('hojarutadetalle_view/home_hojarutadetalle', $data);
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
		$this->form_validation->set_rules('hojarutadetalle_id', 'hojarutadetalle_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('hojaruta_id', 'hojaruta_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidos_id', 'pedidos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('hojarutadetalle_created_at', 'hojarutadetalle_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('hojarutadetalle_updated_at', 'hojarutadetalle_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_hojarutadetalle  = array();
			if($this->input->post('hojaruta_id'))
				$data_hojarutadetalle['hojaruta_id'] = $this->input->post('hojaruta_id');
			if($this->input->post('pedidos_id'))
				$data_hojarutadetalle['pedidos_id'] = $this->input->post('pedidos_id');
			if($this->input->post('hojarutadetalle_created_at'))
				$data_hojarutadetalle['hojarutadetalle_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('hojarutadetalle_created_at'));
			if($this->input->post('hojarutadetalle_updated_at'))
				$data_hojarutadetalle['hojarutadetalle_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('hojarutadetalle_updated_at'));

			$id_hojarutadetalle = $this->hojarutadetalle_model->add_m($data_hojarutadetalle);
			if($id_hojarutadetalle){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('hojarutadetalle_flash_add_message')); 
				redirect('hojarutadetalle_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('hojarutadetalle_flash_error_message')); 
				redirect('hojarutadetalle_controller','location');
			}
		}
		$this->load->view('hojarutadetalle_view/form_add_hojarutadetalle',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($hojarutadetalle_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m(array('hojarutadetalle_id' => $hojarutadetalle_id),$flag=1);
		$this->form_validation->set_rules('hojarutadetalle_id', 'hojarutadetalle_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('hojaruta_id', 'hojaruta_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pedidos_id', 'pedidos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('hojarutadetalle_created_at', 'hojarutadetalle_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('hojarutadetalle_updated_at', 'hojarutadetalle_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_hojarutadetalle  = array();
			if($this->input->post('hojarutadetalle_id'))
				$data_hojarutadetalle['hojarutadetalle_id'] = $this->input->post('hojarutadetalle_id');
			if($this->input->post('hojaruta_id'))
				$data_hojarutadetalle['hojaruta_id'] = $this->input->post('hojaruta_id');
			if($this->input->post('pedidos_id'))
				$data_hojarutadetalle['pedidos_id'] = $this->input->post('pedidos_id');
			if($this->input->post('hojarutadetalle_created_at'))
				$data_hojarutadetalle['hojarutadetalle_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('hojarutadetalle_created_at'));
			if($this->input->post('hojarutadetalle_updated_at'))
				$data_hojarutadetalle['hojarutadetalle_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('hojarutadetalle_updated_at'));

			if($this->hojarutadetalle_model->edit_m($data_hojarutadetalle)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('hojarutadetalle_flash_edit_message')); 
				redirect('hojarutadetalle_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('hojarutadetalle_flash_error_message')); 
				redirect('hojarutadetalle_controller','location');
			}
		}
		$this->load->view('hojarutadetalle_view/form_edit_hojarutadetalle',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $hojarutadetalle_id id of record
	 * @return void
	 */
	function delete_c($hojarutadetalle_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		$hojarutadetalle = $this->hojarutadetalle_model->get_m(array('hojarutadetalle_id' => $hojarutadetalle_id));
		
		if($hojarutadetalle)
		{
			//cambiamos estado de pedido a 'Solicitado'
			$state = $this->pedidos_model->edit_m(array('pedidos_id' => $hojarutadetalle[0]->pedidos_id, 'pedidos_estado' => 6));
			if($state){
				if($this->hojarutadetalle_model->delete_m($hojarutadetalle_id)){ 
					$this->session->set_flashdata('flashConfirm', $this->config->item('hojarutadetalle_flash_delete_message')); 
					redirect('hojaruta_controller/edit_c/'.$hojarutadetalle[0]->hojaruta_id,'location');
				}else{
					$this->session->set_flashdata('flashError', $this->config->item('hojarutadetalle_flash_error_delete_message')); 
					redirect('hojarutadetalle_controller','location');
				}
			}
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
		$data_search_hojarutadetalle = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_hojarutadetalle  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->hojarutadetalle_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_hojarutadetalle[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_hojarutadetalle['limit'] = $this->config->item('pag_perpage');
			$data_search_hojarutadetalle['offset'] = $offset;
			$data_search_hojarutadetalle['sortBy'] = 'hojarutadetalle_id';
			$data_search_hojarutadetalle['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'hojarutadetalle_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m($data_search_hojarutadetalle);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'hojarutadetalle_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['hojarutadetalle'] = $this->hojarutadetalle_model->get_m($data_search_hojarutadetalle);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->hojarutadetalle_model->getFieldsTable_m());
			$this->load->view('hojarutadetalle_view/record_list_hojarutadetalle',$data);
		}

	}

}