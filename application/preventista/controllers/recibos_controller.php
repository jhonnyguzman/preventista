<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recibos_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('recibos_model');
		$this->load->model('clientes_model');
		$this->load->model('usuarios_model');
		$this->load->model('tabgral_model');
		$this->load->model('pedidos_model');
		$this->load->model('cuentacorriente_model');
		$this->load->model('pedidosrecibos_model');
		$this->config->load('recibos_settings');
		$data['flags'] = $this->basicauth->getPermissions('recibos');
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
			$this->load->view('recibos_view/home_recibos', $data);
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

		$this->form_validation->set_rules('recibos_cantidad', 'recibos_cantidad', 'trim|required|integer|xss_clean');
		if($this->form_validation->run())
		{	
			$flag = $this->input->post("recibos_flag");
			for($i=0; $i<$this->input->post('recibos_cantidad'); $i++)
			{
				$data_recibos  = array();
				$data_recibos['recibos_estado'] = 17; // estado 'Generado';
				$data_recibos['recibos_created_at'] = $this->basicrud->formatDateToBD();
				$data_recibos['recibos_updated_at'] = $this->basicrud->formatDateToBD();

				$id_recibos = $this->recibos_model->add_m($data_recibos);
				if(!$id_recibos) $checkResult[] = 1;
			}
			if(count($checkResult)>0){ 
				$this->session->set_flashdata('flashError', $this->config->item('recibos_flash_error_message')); 
				redirect('recibos_controller','location');
			}else{
				if($flag == "sologenerar"){
					$this->session->set_flashdata('flashConfirm', $this->config->item('recibos_flash_add_message')); 
					redirect('recibos_controller','location');
				}elseif($flag == "generarimprimir"){
					
					
					$this->session->set_flashdata('flashConfirm', $this->config->item('recibos_flash_add_message')); 
					redirect('recibos_controller','location');
				}
			}
		}
		$this->load->view('recibos_view/form_add_recibos',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($recibos_id)
	{
		//code here
		if(!$this->flagU){
			echo $this->config->item('accessTitle');
			exit();
		}

		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['recibos'] = $this->recibos_model->get_m(array('recibos_id' => $recibos_id),$flag=1);
		$this->form_validation->set_rules('recibos_id', 'recibos_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('recibos_monto', 'recibos_monto', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('usuarios_id', 'usuarios_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('recibos_estado', 'recibos_estado', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('recibos_fechaingreso', 'recibos_fechaingreso', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('recibos_created_at', 'recibos_created_at', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('recibos_updated_at', 'recibos_updated_at', 'trim|alpha_numeric|xss_clean');
		if($this->form_validation->run()){
			$data_recibos  = array();
			if($this->input->post('recibos_id'))
				$data_recibos['recibos_id'] = $this->input->post('recibos_id');
			if($this->input->post('recibos_monto'))
				$data_recibos['recibos_monto'] = $this->input->post('recibos_monto');
			if($this->input->post('clientes_id'))
				$data_recibos['clientes_id'] = $this->input->post('clientes_id');
			if($this->input->post('usuarios_id'))
				$data_recibos['usuarios_id'] = $this->input->post('usuarios_id');
			if($this->input->post('recibos_estado'))
				$data_recibos['recibos_estado'] = $this->input->post('recibos_estado');
			if($this->input->post('recibos_fechaingreso'))
				$data_recibos['recibos_fechaingreso'] = $this->basicrud->getFormatDateToBD($this->input->post('recibos_fechaingreso'));
			if($this->input->post('recibos_created_at'))
				$data_recibos['recibos_created_at'] = $this->basicrud->getFormatDateToBD($this->input->post('recibos_created_at'));
			if($this->input->post('recibos_updated_at'))
				$data_recibos['recibos_updated_at'] = $this->basicrud->getFormatDateToBD($this->input->post('recibos_updated_at'));

			if($this->recibos_model->edit_m($data_recibos)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('recibos_flash_edit_message')); 
				redirect('recibos_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('recibos_flash_error_message')); 
				redirect('recibos_controller','location');
			}
		}
		$this->load->view('recibos_view/form_edit_recibos',$data);

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
		$data['recibos'] = $this->recibos_model->get_m(array('recibos_id' => $recibos_id),$flag=1);

		$this->form_validation->set_rules('recibos_id', 'recibos_id', 'trim|required|integer|callback_checkExistsRecibosId|xss_clean');
		$this->form_validation->set_rules('recibos_monto', 'recibos_monto', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('clientes_id', 'clientes_id', 'trim|required|integer|xss_clean');
		
		if($this->form_validation->run()){
			$data_recibos  = array();
		
			$data_recibos['recibos_id'] = $this->input->post('recibos_id');
			$data_recibos['recibos_monto'] = $this->input->post('recibos_monto');
			$data_recibos['clientes_id'] = $this->input->post('clientes_id');
			$data_recibos['usuarios_id'] = $this->session->userdata("usuarios_id");
			$data_recibos['recibos_estado'] = 18; // estado de recibo = ingresado
			$data_recibos['recibos_fechaingreso'] = $this->basicrud->formatDateToBD();
			$data_recibos['recibos_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->recibos_model->edit_m($data_recibos)){
				if($this->basicrud->calcDeudaCliente($data_recibos)){
					$data['recibo'] = $data_recibos;
					$data['status'] = true; 
					$this->session->set_flashdata('flashConfirm', $this->config->item('recibos_flash_edit_message')); 
					$this->load->view('recibos_view/result_in_recibos',$data);
				}
			}else{
				$data['recibo'] = $data_recibos;
				$data['status'] = false;  
				$this->session->set_flashdata('flashError', $this->config->item('recibos_flash_error_message')); 
				$this->load->view('recibos_view/result_in_recibos',$data);
			}
		}else{
			$this->load->view('recibos_view/form_in_recibos',$data);
		}
	}


	function calcDeuda($recibo = array())
	{
		//consultar todos los pedidos del cliente con estado entregado o parcialmente pagado
		$pedidos = $this->pedidos_model->get2_m(array('clientes_id' => $recibo['clientes_id'], 'pedidos_estado1' => 8,'pedidos_estado2' => 15));
		$cc = $this->cuentacorriente_model->get_m(array('clientes_id' => $recibo['clientes_id']));
		if($cc)
		{
			$saldo = $recibo['recibos_monto'];
			$flag = true;

			if(isset($pedidos) && is_array($pedidos) && count($pedidos) > 0 )
			{
				//comprobamos si existe saldo negativo en la cuenta corriente del cliente
				// si existe lo sumamos al monto del recibo ingresado
				if($cc[0]->cuentacorriente_debe < 0)
					$saldo = $saldo + ($cc[0]->cuentacorriente_debe * (-1));

				foreach ($pedidos as $f) 
				{
					if($flag)
					{
						//verifico si existe montoadeudado
						if($f->pedidos_montoadeudado > 0) $saldo = $saldo - $f->pedidos_montoadeudado;
						else $saldo = $saldo - $f->peididos_montototal;

						if($saldo >= 0){
							$pr['pedidos_id'] = $f->pedidos_id;
							$pr['recibos_id'] = $recibo['recibos_id'];
							$pr['pedidosrecibos_montocubierto'] =$f->peididos_montototal;
							$pedidosrecibos = $this->pedidosrecibos_model->add_m($pr);
							$pedido = $this->pedidos_model->edit_m(array('pedidos_id' => $f->pedidos_id, 'pedidos_estado' => 16, 'pedidos_montoadeudado' => 0)); // estado de pedido = pagado y entregado
							if($saldo == 0) $flag = false;
						}else{	
							$porcobrar = $saldo * (-1);
							$pagoparcial = $f->peididos_montototal - $porcobrar;
							$pr['pedidos_id'] = $f->pedidos_id;
							$pr['recibos_id'] = $recibo['recibos_id'];
							$pr['pedidosrecibos_montocubierto'] = $pagoparcial;
							$pedidosrecibos = $this->pedidosrecibos_model->add_m($pr);
							$pedido = $this->pedidos_model->edit_m(array('pedidos_id' => $f->pedidos_id, 'pedidos_estado' => 15, 'pedidos_montoadeudado' => $porcobrar)); // estado de pedido = entregado y parcialmente pagado
							$flag = false;
						}
					}	
				}
				if($saldo > 0){
					$haber = $this->pedidos_model->getSumPedidos1($recibo['clientes_id']);
					$debe = $this->pedidos_model->getSumPedidos2($recibo['clientes_id']) - $saldo;
					$this->basicrud->updateEstadoContable($recibo['clientes_id'], $haber, $debe);
				}else{
					$haber = $this->pedidos_model->getSumPedidos1($recibo['clientes_id']);
					$debe = $this->pedidos_model->getSumPedidos2($recibo['clientes_id']);
					$this->basicrud->updateEstadoContable($recibo['clientes_id'], $haber, $debe);
				}
			}else{
				$haber = $this->pedidos_model->getSumPedidos1($recibo['clientes_id']);
				if($cc[0]->cuentacorriente_debe < 0) $debe = $cc[0]->cuentacorriente_debe - $saldo;
				else $debe = $this->pedidos_model->getSumPedidos2($recibo['clientes_id']) - $saldo;
				$this->basicrud->updateEstadoContable($recibo['clientes_id'], $haber, $debe);
			}
			return true;
		}

		return true;
	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $recibos_id id of record
	 * @return void
	 */
	function delete_c($recibos_id)
	{
		//code here
		if(!$this->flagD){
			echo $this->config->item('accessTitle');
			exit();
		}

		if($this->recibos_model->delete_m($recibos_id)){ 
			$this->session->set_flashdata('flashConfirm', $this->config->item('recibos_flash_delete_message')); 
			redirect('recibos_controller','location');
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('recibos_flash_error_delete_message')); 
			redirect('recibos_controller','location');
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
		$data_search_recibos = array(); 
		$data_search_pagination = array(); 
		$flag = 0; 
		$data_search_recibos  = array();
		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->recibos_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '') 
				{
					$data_search_recibos[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}

			$data_search_pagination['count'] = true;
			$data_search_recibos['limit'] = $this->config->item('pag_perpage');
			$data_search_recibos['offset'] = $offset;
			$data_search_recibos['sortBy'] = 'recibos_id';
			$data_search_recibos['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'recibos_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['recibos'] = $this->recibos_model->get_m($data_search_recibos);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'recibos_model','perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
				$data['recibos'] = $this->recibos_model->get_m($data_search_recibos);
			}
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->recibos_model->getFieldsTable_m());
			$this->load->view('recibos_view/record_list_recibos',$data);
		}

	}


	/**
	 * This function check if the entered recibos_id exists in the db 
	 *
	 * @param integer $recibos_id
	 * @return boolean true 	if Not exists the recibos_id	 
	 */
	 
	function checkExistsRecibosId($recibos_id) 
	{
		$data = array();
		$this->form_validation->set_message('checkExistsRecibosId','El Id de recibo ingresado no existe en el sistema!');
		$recibo = $this->recibos_model->get_m(array('recibos_id' => $recibos_id));	    
	   
	  if($recibo) return true; else return false;	
	}

}