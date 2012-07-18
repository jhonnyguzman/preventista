<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuentacorriente_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('cuentacorriente_model');
		$this->load->model('pedidos_model');
		$this->config->load('cuentacorriente_settings');
		$data['flags'] = $this->basicauth->getPermissions('cuentacorriente');
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
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->cuentacorriente_model->getFieldsTable_m());
			$this->load->view('cuentacorriente_view/home_cuentacorriente', $data);
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
		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('cuentacorriente_haber', 'cuentacorriente_haber', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('cuentacorriente_debe', 'cuentacorriente_debe', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('cuentacorriente_saldo', 'cuentacorriente_saldo', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run())
		{	
			$data_cuentacorriente  = array();
			$data_cuentacorriente['clientes_id'] = $this->input->post('clientes_id');
			$data_cuentacorriente['cuentacorriente_haber'] = $this->input->post('cuentacorriente_haber');
			$data_cuentacorriente['cuentacorriente_debe'] = $this->input->post('cuentacorriente_debe');
			$data_cuentacorriente['cuentacorriente_saldo'] = $this->input->post('cuentacorriente_saldo');
			$data_cuentacorriente['cuentacorriente_updated_at'] = $this->basicrud->formatDateToBD();

			$id_cuentacorriente = $this->cuentacorriente_model->add_m($data_cuentacorriente);
			if($id_cuentacorriente){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('cuentacorriente_flash_add_message')); 
				redirect('cuentacorriente_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('cuentacorriente_flash_error_message')); 
				redirect('cuentacorriente_controller','location');
			}
		}
		$this->load->view('cuentacorriente_view/form_add_cuentacorriente',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($cuentacorriente_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['cuentacorriente'] = $this->cuentacorriente_model->get_m(array('cuentacorriente_id' => $cuentacorriente_id),$flag=1);
		$this->form_validation->set_rules('cuentacorriente_id', 'cuentacorriente_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('cuentacorriente_haber', 'cuentacorriente_haber', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('cuentacorriente_debe', 'cuentacorriente_debe', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('cuentacorriente_saldo', 'cuentacorriente_saldo', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_cuentacorriente  = array();
			$data_cuentacorriente['cuentacorriente_id'] = $this->input->post('cuentacorriente_id');
			$data_cuentacorriente['clientes_id'] = $this->input->post('clientes_id');
			$data_cuentacorriente['cuentacorriente_haber'] = $this->input->post('cuentacorriente_haber');
			$data_cuentacorriente['cuentacorriente_debe'] = $this->input->post('cuentacorriente_debe');
			$data_cuentacorriente['cuentacorriente_saldo'] = $this->input->post('cuentacorriente_saldo');
			$data_cuentacorriente['cuentacorriente_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->cuentacorriente_model->edit_m($data_cuentacorriente)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('cuentacorriente_flash_edit_message')); 
				redirect('cuentacorriente_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('cuentacorriente_flash_error_message')); 
				redirect('cuentacorriente_controller','location');
			}
		}
		$this->load->view('cuentacorriente_view/form_edit_cuentacorriente',$data);

	}




	function show_c($clientes_id)
	{
		$data["cc"] = $this->cuentacorriente_model->get_m(array('clientes_id' => $clientes_id));
		$this->load->view('cuentacorriente_view/form_show_cuentacorriente',$data);
	}


	function showPedidosPagados_c($clientes_id)
	{	
		$data["pedidospagados"] = $this->pedidos_model->getPedidosPagadosToShow_m(array('clientes_id' => $clientes_id));
		$this->load->view('cuentacorriente_view/form_show_pedidospagados',$data);
	}

	function showPedidosAdeudados_c($clientes_id)
	{
		$data["pedidosadeudados"] = $this->pedidos_model->getPedidosAdeudadosToShow_m(array('clientes_id' => $clientes_id));
		$this->load->view('cuentacorriente_view/form_show_pedidosadeudados',$data);
	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $cuentacorriente_id id of record
	 * @return void
	 */
	function delete_c($cuentacorriente_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->cuentacorriente_model->delete_m($cuentacorriente_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('cuentacorriente_flash_delete_message')); 
			redirect('cuentacorriente_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('cuentacorriente_flash_error_delete_message')); 
			redirect('cuentacorriente_controller','location');
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
		$data_search_cuentacorriente = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_cuentacorriente  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->cuentacorriente_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_cuentacorriente[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_cuentacorriente['limit'] = $this->config->item('pag_perpage');
			$data_search_cuentacorriente['offset'] = $offset;
			$data_search_cuentacorriente['sortBy'] = 'cuentacorriente_id';
			$data_search_cuentacorriente['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'cuentacorriente_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['cuentacorriente'] = $this->cuentacorriente_model->get_m($data_search_cuentacorriente);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'cuentacorriente_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['cuentacorriente'] = $this->cuentacorriente_model->get_m($data_search_cuentacorriente);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->cuentacorriente_model->getFieldsTable_m());
			$this->load->view('cuentacorriente_view/record_list_cuentacorriente',$data);
		}

	}

}