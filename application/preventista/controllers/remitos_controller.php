<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remitos_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('remitos_model');
		$this->load->model('hojarutadetalle_model');
		$this->load->model('hojaruta_model');
		$this->load->model('tabgral_model');
		$this->config->load('remitos_settings');
		$data['flags'] = $this->basicauth->getPermissions('remitos');
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
			$data['remitosestados'] = $this->tabgral_model->get_m(array('grupos_tabgral_id' => 5));
			//$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->remitos_model->getFieldsTable_m());
			$this->load->view('remitos_view/home_remitos', $data);
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
		if($this->form_validation->run())
		{	
			$data_remitos  = array();
			if($this->input->post('hojarutadetalle_id'))
				$data_remitos['hojarutadetalle_id'] = $this->input->post('hojarutadetalle_id');
			if($this->input->post('remitos_estado'))
				$data_remitos['remitos_estado'] = $this->input->post('remitos_estado');
			if($this->input->post('remitos_created_at'))
				$data_remitos['remitos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('remitos_created_at'));
			if($this->input->post('remitos_updated_at'))
				$data_remitos['remitos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('remitos_updated_at'));

			$id_remitos = $this->remitos_model->add_m($data_remitos);
			if($id_remitos){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('remitos_flash_add_message')); 
				redirect('remitos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('remitos_flash_error_message')); 
				redirect('remitos_controller','location');
			}
		}
		$this->load->view('remitos_view/form_add_remitos',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($remitos_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['remitos'] = $this->remitos_model->get_m(array('remitos_id' => $remitos_id),$flag=1);
		$this->form_validation->set_rules('remitos_id', 'remitos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('hojarutadetalle_id', 'hojarutadetalle_id', 'trim|integer|xss_clean');
		if($this->form_validation->run()){
			$data_remitos  = array();
			if($this->input->post('remitos_id'))
				$data_remitos['remitos_id'] = $this->input->post('remitos_id');
			if($this->input->post('hojarutadetalle_id'))
				$data_remitos['hojarutadetalle_id'] = $this->input->post('hojarutadetalle_id');
			if($this->input->post('remitos_estado'))
				$data_remitos['remitos_estado'] = $this->input->post('remitos_estado');
			if($this->input->post('remitos_created_at'))
				$data_remitos['remitos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('remitos_created_at'));
			if($this->input->post('remitos_updated_at'))
				$data_remitos['remitos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('remitos_updated_at'));

			if($this->remitos_model->edit_m($data_remitos)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('remitos_flash_edit_message')); 
				redirect('remitos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('remitos_flash_error_message')); 
				redirect('remitos_controller','location');
			}
		}
		$this->load->view('remitos_view/form_edit_remitos',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $remitos_id id of record
	 * @return void
	 */
	function delete_c($remitos_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->remitos_model->delete_m($remitos_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('remitos_flash_delete_message')); 
			redirect('remitos_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('remitos_flash_error_delete_message')); 
			redirect('remitos_controller','location');
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
		$data_search_remitos = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_remitos  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->remitos_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_remitos[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_remitos['limit'] = $this->config->item('pag_perpage');
			$data_search_remitos['offset'] = $offset;
			$data_search_remitos['sortBy'] = 'remitos_id';
			$data_search_remitos['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'remitos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['remitos'] = $this->remitos_model->get_m($data_search_remitos);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'remitos_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['remitos'] = $this->remitos_model->get_m($data_search_remitos);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->remitos_model->getFieldsTable_m());
			$this->load->view('remitos_view/record_list_remitos',$data);
		}

	}



	function showPrintSeleccion_c()
	{
		if($this->uri->segment(3)) {
			$data['arrKeys'] = explode(",", $this->uri->segment(3)); //ids de hojarutadetalle
			if($this->checkEstadoHojaRuta($data['arrKeys']))
				$data['error_message'] = $this->config->item("remitos_flash_errorX1_message");
		}
		$this->load->view('remitos_view/form_print_remitos',$data);
	}


	function checkEstadoHojaRuta($data = array())
	{
		$hojarutadetalle = $this->hojarutadetalle_model->get_m(array('hojarutadetalle_id' => $data[0]));
		$hojaruta = $this->hojaruta_model->get_m(array('hojaruta_id' => $hojarutadetalle[0]->hojaruta_id));
		if($hojaruta){
			if($hojaruta[0]->hojaruta_estado <> 11) return true;
			else return false;
		}
	}

	function showPrintComprobanteSeleccion_c()
	{
		echo "en construccion";

	}
}