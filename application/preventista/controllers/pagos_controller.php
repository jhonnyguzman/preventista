<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagos_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('pagos_model');
		$this->load->model('clientes_model');
		$this->load->model('usuarios_model');
		$this->load->model('tabgral_model');
		$this->load->model('cuentacorriente_model');
		$this->load->model('pagospedidos_model');
		$this->load->model('deudas_model');
		$this->load->model('pedidos_model');
		$this->load->model('pagosdeudas_model');
		$this->config->load('pagos_settings');
		$data['flags'] = $this->basicauth->getPermissions('pagos');
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
			$data['clientes'] = $this->clientes_model->get_m();
			$data['usuarios'] = $this->usuarios_model->get_m(array('usuarios_estado' => 1));
			$data['estados'] = $this->tabgral_model->get_m(array('grupos_tabgral_id' => 6));
			$this->load->view('pagos_view/home_pagos', $data);
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

		$data = array(); $checkResult = array();
		$data['subtitle'] = $this->config->item('recordAddTitle');

		$this->form_validation->set_rules('pagos_cantidad', 'pagos_cantidad', 'trim|required|integer|xss_clean');
		if($this->form_validation->run())
		{	
			$flag = $this->input->post("pagos_flag");
			for($i=0; $i<$this->input->post('pagos_cantidad'); $i++)
			{
				$data_pagos  = array();
				$data_pagos['pagos_estado'] = 17; // estado 'Generado';
				$data_pagos['pagos_created_at'] = $this->basicrud->formatDateToBD();
				$data_pagos['pagos_updated_at'] = $this->basicrud->formatDateToBD();

				$id_pagos = $this->pagos_model->add_m($data_pagos);
				if(!$id_pagos) $checkResult[] = 1;
			}
			if(count($checkResult)>0){ 
				$this->session->set_flashdata('flashError', $this->config->item('pagos_flash_error_message')); 
				redirect('pagos_controller','location');
			}else{
				if($flag == "sologenerar"){
					$this->session->set_flashdata('flashConfirm', $this->config->item('pagos_flash_add_message')); 
					redirect('pagos_controller','location');
				}elseif($flag == "generarimprimir"){
					
					
					$this->session->set_flashdata('flashConfirm', $this->config->item('pagos_flash_add_message')); 
					redirect('pagos_controller','location');
				}
			}
		}
		$this->load->view('pagos_view/form_add_pagos',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($pagos_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['pagos'] = $this->pagos_model->get_m(array('pagos_id' => $pagos_id),$flag=1);
		$this->form_validation->set_rules('pagos_id', 'pagos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pagos_monto', 'pagos_monto', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('usuarios_id', 'usuarios_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pagos_estado', 'pagos_estado', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('pagos_fechaingreso', 'pagos_fechaingreso', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pagos_created_at', 'pagos_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('pagos_updated_at', 'pagos_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_pagos  = array();
			if($this->input->post('pagos_id'))
				$data_pagos['pagos_id'] = $this->input->post('pagos_id');
			if($this->input->post('pagos_monto'))
				$data_pagos['pagos_monto'] = $this->input->post('pagos_monto');
			if($this->input->post('clientes_id'))
				$data_pagos['clientes_id'] = $this->input->post('clientes_id');
			if($this->input->post('usuarios_id'))
				$data_pagos['usuarios_id'] = $this->input->post('usuarios_id');
			if($this->input->post('pagos_estado'))
				$data_pagos['pagos_estado'] = $this->input->post('pagos_estado');
			if($this->input->post('pagos_fechaingreso'))
				$data_pagos['pagos_fechaingreso'] = $this->basicrud->getFormatDateToBD($this->input->post('pagos_fechaingreso'));
			if($this->input->post('pagos_created_at'))
				$data_pagos['pagos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pagos_created_at'));
			if($this->input->post('pagos_updated_at'))
				$data_pagos['pagos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('pagos_updated_at'));

			if($this->pagos_model->edit_m($data_pagos)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('pagos_flash_edit_message')); 
				redirect('pagos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('pagos_flash_error_message')); 
				redirect('pagos_controller','location');
			}
		}
		$this->load->view('pagos_view/form_edit_pagos',$data);

	}



	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function in_c()
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['clientes'] = $this->clientes_model->get_m();

		$this->form_validation->set_rules('pagos_monto', 'pagos_monto', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|required|integer|xss_clean');
		
		if($this->form_validation->run()){
			$data_pagos  = array();
			$data_pagos['pagos_id'] = $this->preferences->data['pagos_next_id'];
			$data_pagos['pagos_monto'] = $this->input->post('pagos_monto');
			$data_pagos['clientes_id'] = $this->input->post('clientes_id');
			$data_pagos['usuarios_id'] = $this->session->userdata("usuarios_id");
			$data_pagos['pagos_fechaingreso'] = $this->basicrud->formatDateToBD();
			$data_pagos['pagos_created_at'] = $this->basicrud->formatDateToBD();
			$data_pagos['pagos_updated_at'] = $this->basicrud->formatDateToBD();

			if($id_pago = $this->pagos_model->add_m($data_pagos)){
				$data_pagos['pagos_id'] = $id_pago;
				$this->preferences->editNextId('pagos_next_id',$id_pago);				
				if($this->basicrud->calcDeudaCliente($data_pagos)){
					$data['pago'] = $data_pagos;
					$data['status'] = true; 
					$this->session->set_flashdata('flashConfirm', $this->config->item('pagos_flash_edit_message')); 
					$this->load->view('pagos_view/result_in_pagos',$data);
				}
			}else{
				$data['pago'] = $data_pagos;
				$data['status'] = false;  
				$this->session->set_flashdata('flashError', $this->config->item('pagos_flash_error_message')); 
				$this->load->view('pagos_view/result_in_pagos',$data);
			}
		}else{
			$this->load->view('pagos_view/form_in_pagos',$data);
		}
	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $pagos_id id of record
	 * @return void
	 */
	function delete_c($pagos_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		$this->checkPagosPedidos($pagos_id);
		$this->checkPagosDeudas($pagos_id);

		if($this->pagos_model->delete_m($pagos_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('pagos_flash_delete_message')); 
			redirect('pagos_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('pagos_flash_error_delete_message')); 
			redirect('pagos_controller','location');
		}

	}


	/**
	 * Esta funcion verifica si para un pago dado existen lienas en la tabla
	 * pagospedidos. Si es asi hace la operación contraria a insertar un pago.
	 * Es decir que suma la deuda del cliente basado en el pago a eliminar 
	 * y a cuentos pedidos a efectado dicho pago.
	 *
	 * @access public
	 * @param integer $pagos_id id of record
	 * @return void
	 */
	function checkPagosPedidos($pagos_id)
	{

		$pagospedidos = $this->pagospedidos_model->get_m(array('pagos_id' => $pagos_id));
		if(count($pagospedidos) > 0)
		{
			foreach ($pagospedidos as $f) 
			{
				$pedido = $this->pedidos_model->get_m(array('pedidos_id' => $f->pedidos_id));
				if(($pedido[0]->pedidos_montoadeudado + $f->pagospedidos_montocubierto) < $pedido[0]->peididos_montototal)
				{
					$this->pedidos_model->edit_m(
						array(
							'pedidos_id' => $pedido[0]->pedidos_id, 
							'pedidos_montoadeudado' => ($pedido[0]->pedidos_montoadeudado + $f->pagospedidos_montocubierto),
							'pedidos_estado' => 15)); //estado de pedido igual a 'Entregado y parcialmente pagado'

				}else{
					$this->pedidos_model->edit_m(
						array(
							'pedidos_id' => $pedido[0]->pedidos_id, 
							'pedidos_montoadeudado' => ($pedido[0]->pedidos_montoadeudado + $f->pagospedidos_montocubierto),
							'pedidos_estado' => 8)); //estado de pedido igual a 'entregado'	
				}

				$this->pagospedidos_model->delete_m($f->pagospedidos_id);

				//actualzimos cuenta corriente
				$cc = $this->cuentacorriente_model->get_m(array('clientes_id' => $pedido[0]->clientes_id));
				$haber = $this->pedidos_model->getSumPedidos1($pedido[0]->clientes_id) + $this->deudas_model->getSumDeudas1($pedido[0]->clientes_id);
				$debe = $this->pedidos_model->getSumPedidos2($pedido[0]->clientes_id) + $this->deudas_model->getSumDeudas2($pedido[0]->clientes_id);
				$this->basicrud->updateEstadoContable($pedido[0]->clientes_id, $haber, $debe);

			}

		}

	}


	/**
	 * Esta funcion verifica si para un pago dado existen lienas en la tabla
	 * pagosdeudas. Si es asi hace la operación contraria a insertar un pago.
	 * Es decir que suma la deuda del cliente basado en el pago y a cuantas deudas
	 * afecto dicho pago.
	 *
	 * @access public
	 * @param integer $pagos_id id of record
	 * @return void
	 */
	function checkPagosDeudas($pagos_id)
	{

		$pagosdeudas = $this->pagosdeudas_model->get_m(array('pagos_id' => $pagos_id));
		if(count($pagosdeudas) > 0)
		{
			foreach ($pagosdeudas as $f) 
			{
				$deuda = $this->deudas_model->get_m(array('deudas_id' => $f->deudas_id));
				if(($deuda[0]->deudas_montoadeudado + $f->pagosdeudas_montocubierto) < $deuda[0]->deudas_montototal)
				{
					$this->deudas_model->edit_m(
						array(
							'deudas_id' => $deuda[0]->deudas_id, 
							'deudas_montoadeudado' => ($deuda[0]->deudas_montoadeudado + $f->pagosdeudas_montocubierto),
							'deudas_estado' => 27)); //estado de pedido igual a 'Parcialmente pagada'
				}else{
					$this->deudas_model->edit_m(
						array(
							'deudas_id' => $deuda[0]->deudas_id, 
							'deudas_montoadeudado' =>($deuda[0]->deudas_montoadeudado + $f->pagosdeudas_montocubierto),
							'deudas_estado' => 26)); //estado de pedido igual a 'Sin pagar'
				}

				$this->pagosdeudas_model->delete_m($f->pagosdeudas_id);

				//actualzimos cuenta corriente
				$cc = $this->cuentacorriente_model->get_m(array('clientes_id' => $deuda[0]->clientes_id));
				$haber = $this->pedidos_model->getSumPedidos1($deuda[0]->clientes_id) + $this->deudas_model->getSumDeudas1($deuda[0]->clientes_id);
				$debe = $this->pedidos_model->getSumPedidos2($deuda[0]->clientes_id) + $this->deudas_model->getSumDeudas2($deuda[0]->clientes_id);
				$this->basicrud->updateEstadoContable($deuda[0]->clientes_id, $haber, $debe);

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
		$data_search_pagos = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_pagos  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->pagos_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_pagos[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_pagos['limit'] = $this->config->item('pag_perpage');
			$data_search_pagos['offset'] = $offset;
			$data_search_pagos['sortBy'] = 'pagos_created_at';
			$data_search_pagos['sortDirection'] = 'desc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pagos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['pagos'] = $this->pagos_model->get_m($data_search_pagos);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pagos_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['pagos'] = $this->pagos_model->get_m($data_search_pagos);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->pagos_model->getFieldsTable_m());
			$this->load->view('pagos_view/record_list_pagos',$data);
		}

	}


	/**
	 * This function check if the entered pagos_id exists in the db 
	 *
	 * @param integer $pagos_id
	 * @return boolean true 	if Not exists the pagos_id	 
	 */
	 
	function checkExistspagosId($pagos_id) 
	{
		$data = array();
		$this->form_validation->set_message('checkExistspagosId','El Id de pago ingresado no existe en el sistema!');
		$pago = $this->pagos_model->get_m(array('pagos_id' => $pagos_id));	    
	   
	  if($pago) return true; else return false;	
	}


	function showPagosRealizados_c($clientes_id)
	{

		$data['pagosrealizados'] = $this->pagos_model->get_m(array('clientes_id' => $clientes_id,'sortBy' => 'pagos_created_at', 'sortDirection' => 'desc'));
		$this->load->view("pagos_view/form_show_pagos_realizados",$data);
	}

}