<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deudas_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') == true) { 
			$this->load->model('deudas_model');
			$this->load->model('clientes_model');
			$this->load->model('deudas_model');
			$this->load->model('pedidos_model');
			$this->load->model('cuentacorriente_model');
			$this->load->model('usuarios_model');
			$this->config->load('deudas_settings');
			$data['flags'] = $this->basicauth->getPermissions('deudas');
			$this->flagR = $data['flags']['flag-read'];
			$this->flagI = $data['flags']['flag-insert'];
			$this->flagU = $data['flags']['flag-update'];
			$this->flagD = $data['flags']['flag-delete'];
			$this->flags = array('r'=>$this->flagR,'i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
		}
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = $this->config->item('recordListTitle');
			$data['clientes'] = $this->clientes_model->get_m();
			$data['usuarios'] = $this->usuarios_model->get_m(array('usuarios_estado' => 1));
			$this->load->view('deudas_view/home_deudas', $data);
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

		$this->form_validation->set_rules('deudas_montototal', 'deudas_montototal', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('deudas_fecha', 'deudas_fecha', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|required|integer|xss_clean');
	
		if($this->form_validation->run())
		{	
			$data_deudas  = array();
			$data_deudas['deudas_montototal'] = $this->input->post('deudas_montototal');
			$data_deudas['deudas_fecha'] = $this->basicrud->getFormatDateToBDWithTime($this->input->post('deudas_fecha'));
			$data_deudas['clientes_id'] = $this->input->post('clientes_id');
			$data_deudas['deudas_created_at'] = $this->basicrud->formatDateToBD();
			$data_deudas['deudas_updated_at'] = $this->basicrud->formatDateToBD();
			$data_deudas['usuarios_id'] = $this->session->userdata("usuarios_id");
			$data_deudas['deudas_estado'] = 26;  //estado por defecto 'sin pagar'
			$data_deudas['deudas_montoadeudado'] = $data_deudas['deudas_montototal'];

			$id_deudas = $this->deudas_model->add_m($data_deudas);
			if($id_deudas){ 
				$data['status'] = true;
				//actualzimos cuenta corriente
				$cc = $this->cuentacorriente_model->get_m(array('clientes_id' => $this->input->post('clientes_id')));
				$haber = $this->pedidos_model->getSumPedidos1($this->input->post('clientes_id')) + $this->deudas_model->getSumDeudas1($this->input->post('clientes_id'));
				$debe = $this->pedidos_model->getSumPedidos2($this->input->post('clientes_id')) + $this->deudas_model->getSumDeudas2($this->input->post('clientes_id'));
				$this->basicrud->updateEstadoContable($this->input->post('clientes_id'), $haber, $debe);

				$this->load->view('deudas_view/result_in_deudas',$data);
			}else{
				$data['status'] = false;
				$this->load->view('deudas_view/result_in_deudas',$data);
			}
		}else{
			$data['clientes'] = $this->clientes_model->get_m();
			$this->load->view('deudas_view/form_add_deudas',$data);
		}
	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($deudas_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['deudas'] = $this->deudas_model->get_m(array('deudas_id' => $deudas_id),$flag=1);
		
		$this->form_validation->set_rules('deudas_id', 'deudas_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('deudas_montototal', 'deudas_montototal', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('deudas_fecha', 'deudas_fecha', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|required|integer|xss_clean');

		if($this->form_validation->run()){
			$data_deudas  = array();
			$data_deudas['deudas_id'] = $this->input->post('deudas_id');
			$data_deudas['deudas_montototal'] = $this->input->post('deudas_montototal');
			$data_deudas['deudas_fecha'] = $this->basicrud->getFormatDateToBD($this->input->post('deudas_fecha'));
			$data_deudas['clientes_id'] = $this->input->post('clientes_id');
			$data_deudas['deudas_updated_at'] = $this->basicrud->formatDateToBD();
			$data_deudas['usuarios_id'] = $this->session->userdata("usuarios_id");
			$data_deudas['deudas_estado'] = $this->input->post('deudas_estado');
			$data_deudas['deudas_montoadeudado'] = $this->input->post('deudas_montoadeudado');

			if($this->deudas_model->edit_m($data_deudas)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('deudas_flash_edit_message')); 
				redirect('deudas_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('deudas_flash_error_message')); 
				redirect('deudas_controller','location');
			}
		}
		$this->load->view('deudas_view/form_edit_deudas',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $deudas_id id of record
	 * @return void
	 */
	function delete_c($deudas_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->deudas_model->delete_m($deudas_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('deudas_flash_delete_message')); 
			redirect('deudas_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('deudas_flash_error_delete_message')); 
			redirect('deudas_controller','location');
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
		$data_search_deudas = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->deudas_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_deudas[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_deudas['limit'] = $this->config->item('pag_perpage');
			$data_search_deudas['offset'] = $offset;
			$data_search_deudas['sortBy'] = 'deudas_fecha';
			$data_search_deudas['sortDirection'] = 'desc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'deudas_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['deudas'] = $this->deudas_model->get_m($data_search_deudas);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'deudas_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['deudas'] = $this->deudas_model->get_m($data_search_deudas);
			}
			$data['flag'] = $this->flags;
			$this->load->view('deudas_view/record_list_deudas',$data);
		}

	}

}