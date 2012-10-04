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
		$this->load->model('pedidodetalle_model');
		$this->load->model('articulos_model');
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
			$data['upedidos'] = $this->getUtilidadesPedidos($data['pedidos']);

			$this->load->view('utilidades_view/record_list_utilidades',$data);
			
		}
			
	}



	function getUtilidadesPedidos($pedidos = array())
	{
		$arrUtilidadesPedidos = array();
		$parcialUtilidad = array();
		if(count($pedidos) > 0)
		{
			foreach ($pedidos as $f) 
			{
				$utilidadpedido = 0;
				$pedidodetalle = $this->pedidodetalle_model->get_m(array('pedidos_id'  => $f->pedidos_id));
				foreach ($pedidodetalle as $g) 
				{
					$articulo = $this->articulos_model->get_m(array('articulos_id' => $g->articulos_id));
					$utilidadpedido+= $this->calcUtilidadPedido(
						$g->pedidodetalle_pv,
						$articulo[0]->articulos_preciocompra, 
						$g->pedidodetalle_cantidad,
						$g->pedidodetalle_montoacordado);
				}

				$parcialUtilidad['pedidos_id'] = $f->pedidos_id;
				$parcialUtilidad['pedidos_created_at'] = $f->pedidos_created_at;
				$parcialUtilidad['utilidad']  = $utilidadpedido;
				$arrUtilidadesPedidos[] = $parcialUtilidad;

			}
		}
		return $arrUtilidadesPedidos;	
	}


	function calcUtilidadPedido($pv, $pc, $cantidad, $montoacordado)
	{
		$utilidad = 0;
		if($montoacordado != 0){
			$utilidad = ($montoacordado - $pc) * $cantidad;
		}else{
			$utilidad = ($pv - $pc) * $cantidad;
		}
		return $utilidad;
	}
}
?>