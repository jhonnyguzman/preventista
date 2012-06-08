<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidos_Model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}


	/**
	 * This function saving the data in the db
	 *
	 * @access public
	 * @param array fields of the table
	 * @return integer  affected rows
	 */
	function add_m($options = array())
	{
		//code here
		$this->db->insert('pedidos', $options);
		return $this->db->insert_id();
	}


	/**
	 * This function editing the data in the db
	 *
	 * @access public
	 * @param array fields of the table
	 * @return integer  affected rows
	 */
	function edit_m($options = array())
	{
		//code here
		if(isset($options['peididos_montototal']))
			$this->db->set('peididos_montototal', $options['peididos_montototal']);
		if(isset($options['pedidos_montoadeudado']))
			$this->db->set('pedidos_montoadeudado', $options['pedidos_montoadeudado']);
		if(isset($options['clientes_id']))
			$this->db->set('clientes_id', $options['clientes_id']);
		if(isset($options['pedidos_estado']))
			$this->db->set('pedidos_estado', $options['pedidos_estado']);
		if(isset($options['pedidos_created_at']))
			$this->db->set('pedidos_created_at', $options['pedidos_created_at']);
		if(isset($options['pedidos_updated_at']))
			$this->db->set('pedidos_updated_at', $options['pedidos_updated_at']);
		if(isset($options['tramites_id']))
			$this->db->set('tramites_id', $options['tramites_id']);

		$this->db->where('pedidos_id', $options['pedidos_id']);

		$this->db->update('pedidos');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $pedidos_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($pedidos_id)
	{
		//code here
		$this->db->where('pedidos_id', $pedidos_id);
		$this->db->delete('pedidos');
		return $this->db->affected_rows();
	}


	/**
	 * This function get the data of the db
	 *
	 * @access public
	 * @param array fields of the table
	 * @param integer	flag to indicate if return one record or more of one record
	 * @return array  result
	 */
	function get_m($options = array(),$flag=0)
	{
		//code here
		if(isset($options['pedidos_id']))
			$this->db->where('p.pedidos_id', $options['pedidos_id']);
		if(isset($options['peididos_montototal']))
			$this->db->where('p.peididos_montototal', $options['peididos_montototal']);
		if(isset($options['pedidos_montoadeudado']))
			$this->db->where('p.pedidos_montoadeudado', $options['pedidos_montoadeudado']);
		if(isset($options['clientes_id']))
			$this->db->where('p.clientes_id', $options['clientes_id']);
		if(isset($options['pedidos_estado']))
			$this->db->where('p.pedidos_estado', $options['pedidos_estado']);
		if(isset($options['pedidos_created_at'])){
			$string = "CAST(p.pedidos_created_at AS DATE) = '".$this->basicrud->getFormatDateToBD($options['pedidos_created_at'])."'";
			$this->db->where($string);
		}
		if(isset($options['pedidos_updated_at']))
			$this->db->where('p.pedidos_updated_at', $options['pedidos_updated_at']);
		if(isset($options['tramites_id']))
			$this->db->where('p.tramites_id', $options['tramites_id']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);
		
		$this->db->select("p.*, tr.tramites_descripcion, c.clientes_apellido, c.clientes_nombre, c.clientescategoria_id, 
			cc.clientescategoria_descripcion, tg.tabgral_descripcion as pedidos_estado_descripcion");

		$this->db->from('pedidos as p');
		$this->db->join('tramites as tr', 'tr.tramites_id = p.tramites_id');
		$this->db->join('clientes as c', 'c.clientes_id = p.clientes_id');
		$this->db->join('clientescategoria as cc', 'cc.clientescategoria_id = c.clientescategoria_id');
		$this->db->join('tabgral as tg', 'tg.tabgral_id = p.pedidos_estado');
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['pedidos_id']) && $flag==1){
				$query->row(0)->pedidos_created_at = $this->basicrud->formatDateToHuman($query->row(0)->pedidos_created_at);
				$query->row(0)->pedidos_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->pedidos_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->pedidos_created_at = $this->basicrud->formatDateToHuman($row->pedidos_created_at);
					$row->pedidos_updated_at = $this->basicrud->formatDateToHuman($row->pedidos_updated_at);
				}
				return $query->result();
			}
		}

	}


	/**
	 * This function getting all the fields of the table
	 *
	 * @access public
	 * @return array  fields of table
	 */
	function getFieldsTable_m()
	{
		//code here
		$fields=array();
		$fields[]='pedidos_id';
		$fields[]='pedidos_estado';
		$fields[]='pedidos_estado_descripcion';
		$fields[]='peididos_montototal';
		$fields[]='pedidos_montoadeudado';
		$fields[]='clientes_id';
		$fields[]='clientes_nombre';
		$fields[]='clientes_apellido';
		$fields[]='clientescategoria_id';
		$fields[]='clientescategoria_descripcion';
		$fields[]='tramites_id';
		$fields[]='tramites_descripcion';
		$fields[]='pedidos_created_at';
		$fields[]='pedidos_updated_at';
		return $fields;
	}


	/**
	 * Esta función filtra aquellos pedidos que tengan 2 estados
	 *
	 * @access public
	 * @param array fields of the table
	 * @return array  result
	 */
	function get2_m($options = array())
	{
		$this->db->where("clientes_id = ".$options['clientes_id']." and (pedidos_estado = ".$options['pedidos_estado1']." or pedidos_estado = ".$options['pedidos_estado2'].")");
		/*$this->db->where('clientes_id', $options['clientes_id']);
		$this->db->where('pedidos_estado', $options['pedidos_estado1']);
		$this->db->or_where('pedidos_estado', $options['pedidos_estado2']); */
		
		$this->db->order_by('pedidos_created_at','asc');

		$query = $this->db->get('pedidos');	
		return $query->result();
	}


	/**
	 * Esta función calcula el haber de un cliente
	 *
	 * @access public
	 * @param integer $clientes_id
	 * @return float  $monto
	 */
	function getSumPedidos1($clientes_id)
	{
		$this->db->where("clientes_id = ".$clientes_id." and (pedidos_estado = 16 or pedidos_estado = 15)");
		//$this->db->where('clientes_id', $clientes_id);
		//$this->db->where('pedidos_estado', 16); // estado de pedido = Entregado y pagado
		//$this->db->or_where('pedidos_estado', 15); // estado de pedido = Entregado y parcialmente pagado
		$query = $this->db->get('pedidos');
		$monto = 0; 

		if($query->num_rows()>0){ 
			foreach ($query->result() as $f) {
				if($f->pedidos_montoadeudado == 0) $monto = $monto + $f->peididos_montototal;
				else $monto = $monto + ($f->peididos_montototal - $f->pedidos_montoadeudado);		
			}
		}
		return $monto;
	}


	/**
	 * Esta función calcula la deuda de un cliente
	 *
	 * @access public
	 * @param integer $clientes_id
	 * @return float  $monto
	 */
	function getSumPedidos2($clientes_id)
	{
		$this->db->where("clientes_id = ".$clientes_id." and (pedidos_estado = 8 or pedidos_estado = 15)");
		//$this->db->where('pedidos_estado', 8); // estado de pedido = Entregado
		//$this->db->or_where('pedidos_estado', 15); // estado de pedido = Entregado y parcialmente pagado
		$query = $this->db->get('pedidos');
		$monto = 0; 

		if($query->num_rows()>0){ 
			foreach ($query->result() as $f) {
				if($f->pedidos_montoadeudado == 0) $monto = $monto + $f->peididos_montototal;
				else $monto = $monto + $f->pedidos_montoadeudado;		
			}
		}
		return $monto;
	}


	/**
	 * Esta función devuelve todos los pedidos adeudados  de un cliente
	 *
	 * @access public
	 * @param array $options
	 * @return array  result
	 */
	function getPedidosAdeudados_m($options = array())
	{
		$this->db->where("p.clientes_id = ".$options['clientes_id']." and (p.pedidos_estado = 8 or p.pedidos_estado = 15) and r.remitos_estado = 13");
		
		//$this->db->where('p.clientes_id', $options['clientes_id']);
		//$this->db->where('p.pedidos_estado', 8); //pedido estado = entregado
		//$this->db->or_where('p.pedidos_estado', 15); //pedido estado = entregado y parcialmenten pagado
		//$this->db->where('r.remitos_estado', 13); //remitos estado = entregado

		$this->db->order_by('r.remitos_created_at','asc');

		$this->db->select("p.pedidos_id, p.peididos_montototal, p.pedidos_montoadeudado, r.remitos_id, r.remitos_created_at");
		$this->db->from("pedidos as p");
		$this->db->join("hojarutadetalle as hd","hd.pedidos_id = p.pedidos_id");
		$this->db->join("remitos as r","r.hojarutadetalle_id = hd.hojarutadetalle_id");
		$query = $this->db->get();	

		if($query->num_rows()>0){ 
			foreach ($query->result() as $f) {
				if($f->pedidos_montoadeudado != 0) $f->peididos_montototal = $f->pedidos_montoadeudado;
			}
		}
		return $query->result();
	}


	function getPedidosUtilidades_m($options = array())
	{
		
		$string = "CAST(pedidos_created_at AS DATE) BETWEEN '".$options['pedidos_created_at_from']."' AND 
		'".$options['pedidos_created_at_to']."' AND (pedidos_estado = 8 OR pedidos_estado = 15 OR pedidos_estado = 16)";
		
		$this->db->where($string);

		/*$this->db->where('p.pedidos_estado', 8); //pedido estado = entregado
		$this->db->or_where('p.pedidos_estado', 15); //pedido estado = entregado y parcialmenten pagado
		$this->db->or_where('p.pedidos_estado', 16); //pedido estado = entregado y pagado*/

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		$this->db->order_by('pedidos_created_at','asc');
	
		$query = $this->db->get('pedidos');	

		if(isset($options['count'])) return $query->num_rows();
		else return $query->result();

	}


	/**
	 * Esta función devuelve todos los pedidos pagados  de un cliente para mostrar en el detalle de la cuenta corriente
	 *
	 * @access public
	 * @param array $options
	 * @return array  result
	 */
	function getPedidosPagadosToShow_m($options = array())
	{
		$this->db->where("p.clientes_id = ".$options['clientes_id']." and (p.pedidos_estado = 15 or p.pedidos_estado = 16)");
		
		//$this->db->where('p.clientes_id', $options['clientes_id']);
		//$this->db->where('p.pedidos_estado', 15); //pedido estado = entregado
		//$this->db->or_where('p.pedidos_estado', 16); //pedido estado = entregado y parcialmenten pagado

		$this->db->order_by('p.pedidos_created_at','desc');

		$this->db->select("p.*");
		$this->db->from("pedidos as p");

		$query = $this->db->get();	
		return $query->result();
	}


	/**
	 * Esta función devuelve todos los pedidos adeudados  de un cliente para mostrar en el detalle de la cuenta corriente
	 *
	 * @access public
	 * @param array $options
	 * @return array  result
	 */
	function getPedidosAdeudadosToShow_m($options = array())
	{
		$this->db->where("p.clientes_id = ".$options['clientes_id']." and (p.pedidos_estado = 8 or p.pedidos_estado = 15)");
		
		//$this->db->where('p.clientes_id', $options['clientes_id']);
		//$this->db->where('p.pedidos_estado', 15); //pedido estado = entregado
		//$this->db->or_where('p.pedidos_estado', 16); //pedido estado = entregado y parcialmenten pagado

		$this->db->order_by('p.pedidos_created_at','desc');

		$this->db->select("p.*");
		$this->db->from("pedidos as p");

		$query = $this->db->get();	
		return $query->result();
	}
}