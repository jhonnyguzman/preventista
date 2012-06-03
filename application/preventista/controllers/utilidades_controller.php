<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilidades_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('pedidos_model');
		$this->load->model('compras_model');
		$this->config->load('pedidos_settings');
		$data['flags'] = $this->basicauth->getPermissions('pedidos');
		$this->flagR = $data['flags']['flag-read'];
		$this->flagI = $data['flags']['flag-insert'];
		$this->flagU = $data['flags']['flag-update'];
		$this->flagD = $data['flags']['flag-delete'];
		$this->flags = array('r'=> $this->flagR ,'i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = 'Utilidades';
			$this->load->view('utilidades_view/home_utilidades', $data);
			$this->search_c();
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
		$data_search_pedidos = array(); 
		$data_search_pagination = array(); 

		$data['flag'] = $this->flags;
		if($this->flagR)
		{
			//filtros para pedidos
			if($this->input->post('created_at_from')) 
				$data_search_pedidos['pedidos_created_at_from'] = $this->basicrud->getFormatDateToBD($this->input->post('created_at_from'));
			else $data_search_pedidos['pedidos_created_at_from'] = $this->basicrud->getDateToBDWithOutTime();

			if($this->input->post('created_at_to')) 
				$data_search_pedidos['pedidos_created_at_to'] = $this->basicrud->getFormatDateToBD($this->input->post('created_at_to'));
			else $data_search_pedidos['pedidos_created_at_to'] = $this->basicrud->getDateToBDWithOutTime();
			
			$data_search_pagination = $data_search_pedidos; 
			$data_search_pagination['count'] = true;
			$data_search_pedidos['limit'] = $this->config->item('pag_perpage');
			$data_search_pedidos['offset'] = $offset;

			$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'pedidos_model','nameMethod' => 'getPedidosUtilidades_m', 'perpage'=>$this->config->item('pag_perpage'),$data_search_pagination));
			$data['pedidos'] = $this->pedidos_model->getPedidosUtilidades_m($data_search_pedidos);
			
			//filtros para compras
			if($this->input->post('created_at_from')) 
				$data_search_compras['compras_created_at_from'] = $this->basicrud->getFormatDateToBD($this->input->post('created_at_from'));
			else $data_search_compras['compras_created_at_from'] = $this->basicrud->getDateToBDWithOutTime();

			if($this->input->post('created_at_to')) 
				$data_search_compras['compras_created_at_to'] = $this->basicrud->getFormatDateToBD($this->input->post('created_at_to'));
			else $data_search_compras['compras_created_at_to'] = $this->basicrud->getDateToBDWithOutTime();
			
			$data_search_pagination2 = $data_search_compras; 
			$data_search_pagination2['count'] = true;
			$data_search_compras['limit'] = $this->config->item('pag_perpage');
			$data_search_compras['offset'] = $offset;

			$data['paginationcompras'] = $this->basicrud->getPagination(array('nameModel'=>'compras_model','nameMethod' => 'getComprasUtilidades_m', 'perpage'=>$this->config->item('pag_perpage'),$data_search_pagination2));
			$data['compras'] = $this->compras_model->getComprasUtilidades_m($data_search_compras);
			

			$this->load->view('utilidades_view/record_list_utilidades',$data);
		}
			
	}




}
?>