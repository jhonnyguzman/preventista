<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cambiodirectostock_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('cambiodirectostock_model');
		$this->config->load('cambiodirectostock_settings');
		$data['flags'] = $this->basicauth->getPermissions('cambiodirectostock');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->cambiodirectostock_model->getFieldsTable_m());
			$this->load->view('cambiodirectostock_view/home_cambiodirectostock', $data);
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
		$this->form_validation->set_rules('cambiodirectostock_id', 'cambiodirectostock_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_tipo', 'cambiodirectostock_tipo', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('articulos_id', 'articulos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_stockantiguo', 'cambiodirectostock_stockantiguo', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_stocknuevo', 'cambiodirectostock_stocknuevo', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('usuarios_id', 'usuarios_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_comentario', 'cambiodirectostock_comentario', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_created_at', 'cambiodirectostock_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_updated_at', 'cambiodirectostock_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_cambiodirectostock  = array();
			if($this->input->post('cambiodirectostock_tipo'))
				$data_cambiodirectostock['cambiodirectostock_tipo'] = $this->input->post('cambiodirectostock_tipo');
			if($this->input->post('articulos_id'))
				$data_cambiodirectostock['articulos_id'] = $this->input->post('articulos_id');
			if($this->input->post('cambiodirectostock_stockantiguo'))
				$data_cambiodirectostock['cambiodirectostock_stockantiguo'] = $this->input->post('cambiodirectostock_stockantiguo');
			if($this->input->post('cambiodirectostock_stocknuevo'))
				$data_cambiodirectostock['cambiodirectostock_stocknuevo'] = $this->input->post('cambiodirectostock_stocknuevo');
			if($this->input->post('usuarios_id'))
				$data_cambiodirectostock['usuarios_id'] = $this->input->post('usuarios_id');
			if($this->input->post('cambiodirectostock_comentario'))
				$data_cambiodirectostock['cambiodirectostock_comentario'] = $this->input->post('cambiodirectostock_comentario');
			if($this->input->post('cambiodirectostock_created_at'))
				$data_cambiodirectostock['cambiodirectostock_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('cambiodirectostock_created_at'));
			if($this->input->post('cambiodirectostock_updated_at'))
				$data_cambiodirectostock['cambiodirectostock_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('cambiodirectostock_updated_at'));

			$id_cambiodirectostock = $this->cambiodirectostock_model->add_m($data_cambiodirectostock);
			if($id_cambiodirectostock){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('cambiodirectostock_flash_add_message')); 
				redirect('cambiodirectostock_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('cambiodirectostock_flash_error_message')); 
				redirect('cambiodirectostock_controller','location');
			}
		}
		$this->load->view('cambiodirectostock_view/form_add_cambiodirectostock',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($cambiodirectostock_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['cambiodirectostock'] = $this->cambiodirectostock_model->get_m(array('cambiodirectostock_id' => $cambiodirectostock_id),$flag=1);
		$this->form_validation->set_rules('cambiodirectostock_id', 'cambiodirectostock_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_tipo', 'cambiodirectostock_tipo', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('articulos_id', 'articulos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_stockantiguo', 'cambiodirectostock_stockantiguo', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_stocknuevo', 'cambiodirectostock_stocknuevo', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('usuarios_id', 'usuarios_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_comentario', 'cambiodirectostock_comentario', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_created_at', 'cambiodirectostock_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('cambiodirectostock_updated_at', 'cambiodirectostock_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_cambiodirectostock  = array();
			if($this->input->post('cambiodirectostock_id'))
				$data_cambiodirectostock['cambiodirectostock_id'] = $this->input->post('cambiodirectostock_id');
			if($this->input->post('cambiodirectostock_tipo'))
				$data_cambiodirectostock['cambiodirectostock_tipo'] = $this->input->post('cambiodirectostock_tipo');
			if($this->input->post('articulos_id'))
				$data_cambiodirectostock['articulos_id'] = $this->input->post('articulos_id');
			if($this->input->post('cambiodirectostock_stockantiguo'))
				$data_cambiodirectostock['cambiodirectostock_stockantiguo'] = $this->input->post('cambiodirectostock_stockantiguo');
			if($this->input->post('cambiodirectostock_stocknuevo'))
				$data_cambiodirectostock['cambiodirectostock_stocknuevo'] = $this->input->post('cambiodirectostock_stocknuevo');
			if($this->input->post('usuarios_id'))
				$data_cambiodirectostock['usuarios_id'] = $this->input->post('usuarios_id');
			if($this->input->post('cambiodirectostock_comentario'))
				$data_cambiodirectostock['cambiodirectostock_comentario'] = $this->input->post('cambiodirectostock_comentario');
			if($this->input->post('cambiodirectostock_created_at'))
				$data_cambiodirectostock['cambiodirectostock_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('cambiodirectostock_created_at'));
			if($this->input->post('cambiodirectostock_updated_at'))
				$data_cambiodirectostock['cambiodirectostock_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('cambiodirectostock_updated_at'));

			if($this->cambiodirectostock_model->edit_m($data_cambiodirectostock)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('cambiodirectostock_flash_edit_message')); 
				redirect('cambiodirectostock_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('cambiodirectostock_flash_error_message')); 
				redirect('cambiodirectostock_controller','location');
			}
		}
		$this->load->view('cambiodirectostock_view/form_edit_cambiodirectostock',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $cambiodirectostock_id id of record
	 * @return void
	 */
	function delete_c($cambiodirectostock_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->cambiodirectostock_model->delete_m($cambiodirectostock_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('cambiodirectostock_flash_delete_message')); 
			redirect('cambiodirectostock_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('cambiodirectostock_flash_error_delete_message')); 
			redirect('cambiodirectostock_controller','location');
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
		$data_search_cambiodirectostock = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_cambiodirectostock  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->cambiodirectostock_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_cambiodirectostock[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_cambiodirectostock['limit'] = $this->config->item('pag_perpage');
			$data_search_cambiodirectostock['offset'] = $offset;
			$data_search_cambiodirectostock['sortBy'] = 'cambiodirectostock_id';
			$data_search_cambiodirectostock['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'cambiodirectostock_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['cambiodirectostock'] = $this->cambiodirectostock_model->get_m($data_search_cambiodirectostock);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'cambiodirectostock_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['cambiodirectostock'] = $this->cambiodirectostock_model->get_m($data_search_cambiodirectostock);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->cambiodirectostock_model->getFieldsTable_m());
			$this->load->view('cambiodirectostock_view/record_list_cambiodirectostock',$data);
		}

	}


	function getHistoricalChg_c($articulos_id)
	{
		$data = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			//$data_search_pagination['count'] = true;
			//$data_search_pagination['articulos_id'] = $articulos_id;
			$data_search_cambiodirectostock['articulos_id'] = $articulos_id;
			//$data_search_cambiodirectostock['limit'] = $this->config->item('pag_perpage');
			//$data_search_cambiodirectostock['offset'] = $offset;
			$data_search_cambiodirectostock['sortBy'] = 'cambiodirectostock_created_at';
			$data_search_cambiodirectostock['sortDirection'] = 'desc';

			//$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'cambiodirectostock_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
			$data['cambiodirectostock'] = $this->cambiodirectostock_model->get_m($data_search_cambiodirectostock);
			//$data['articulos_id'] = $articulos_id;
			$this->load->view('cambiodirectostock_view/record_list_historical_cambiodirectostock',$data);
		}
	}
}