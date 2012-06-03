<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidodetalle_Model extends CI_Model {

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
		$this->db->insert('pedidodetalle', $options);
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
		if(isset($options['pedidos_id']))
			$this->db->set('pedidos_id', $options['pedidos_id']);
		if(isset($options['articulos_id']))
			$this->db->set('articulos_id', $options['articulos_id']);
		if(isset($options['pedidodetalle_cantidad']))
			$this->db->set('pedidodetalle_cantidad', $options['pedidodetalle_cantidad']);
		if(isset($options['pedidodetalle_montoacordado']))
			$this->db->set('pedidodetalle_montoacordado', $options['pedidodetalle_montoacordado']);
		if(isset($options['pedidodetalle_created_at']))
			$this->db->set('pedidodetalle_created_at', $options['pedidodetalle_created_at']);
		if(isset($options['pedidodetalle_updated_at']))
			$this->db->set('pedidodetalle_updated_at', $options['pedidodetalle_updated_at']);
		if(isset($options['pedidodetalle_subtotal']))
			$this->db->set('pedidodetalle_subtotal', $options['pedidodetalle_subtotal']);
		if(isset($options['pedidodetalle_pv']))
			$this->db->set('pedidodetalle_pv', $options['pedidodetalle_pv']);

		$this->db->where('pedidodetalle_id', $options['pedidodetalle_id']);

		$this->db->update('pedidodetalle');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $pedidodetalle_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($pedidodetalle_id)
	{
		//code here
		$this->db->where('pedidodetalle_id', $pedidodetalle_id);
		$this->db->delete('pedidodetalle');
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
		if(isset($options['pedidodetalle_id']))
			$this->db->where('pd.pedidodetalle_id', $options['pedidodetalle_id']);
		if(isset($options['pedidos_id']))
			$this->db->where('pd.pedidos_id', $options['pedidos_id']);
		if(isset($options['articulos_id']))
			$this->db->where('pd.articulos_id', $options['articulos_id']);
		if(isset($options['pedidodetalle_cantidad']))
			$this->db->where('pd.pedidodetalle_cantidad', $options['pedidodetalle_cantidad']);
		if(isset($options['pedidodetalle_montoacordado']))
			$this->db->where('pd.pedidodetalle_montoacordado', $options['pedidodetalle_montoacordado']);
		if(isset($options['pedidodetalle_created_at']))
			$this->db->where('pd.pedidodetalle_created_at', $options['pedidodetalle_created_at']);
		if(isset($options['pedidodetalle_updated_at']))
			$this->db->where('pd.pedidodetalle_updated_at', $options['pedidodetalle_updated_at']);
		if(isset($options['pedidodetalle_subtotal']))
			$this->db->where('pd.pedidodetalle_subtotal', $options['pedidodetalle_subtotal']);
		if(isset($options['pedidodetalle_pv']))
			$this->db->where('pd.pedidodetalle_pv', $options['pedidodetalle_pv']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);
		
		if(isset($options['clientescategoria_id']))
			$this->db->select($this->getPrecioCat_m($options['clientescategoria_id']));
		else
			$this->db->select("pd.*, a.articulos_descripcion, a.articulos_stockreal");

		$this->db->from("pedidodetalle as pd");
		$this->db->join("articulos as a", "a.articulos_id = pd.articulos_id");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['pedidodetalle_id']) && $flag==1){
				$query->row(0)->pedidodetalle_created_at = $this->basicrud->formatDateToHuman($query->row(0)->pedidodetalle_created_at);
				$query->row(0)->pedidodetalle_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->pedidodetalle_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->pedidodetalle_created_at = $this->basicrud->formatDateToHuman($row->pedidodetalle_created_at);
					$row->pedidodetalle_updated_at = $this->basicrud->formatDateToHuman($row->pedidodetalle_updated_at);
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
		$fields[]='pedidodetalle_id';
		$fields[]='pedidos_id';
		$fields[]='articulos_id';
		$fields[]='articulos_descripcion';
		$fields[]='articulos_stockreal';
		$fields[]='articulos_precio';
		$fields[]='pedidodetalle_cantidad';
		$fields[]='pedidodetalle_montoacordado';
		$fields[]='pedidodetalle_created_at';
		$fields[]='pedidodetalle_updated_at';
		$fields[]='pedidodetalle_subtotal';
		$fields[]='pedidodetalle_pv';
		return $fields;
	}


	/**
	 * Esta funcion retorna una consulta sql con el precio del 
	 * articulo segun la categoria del cliente
	 *
	 * @access public
	 * @param integer $clientes_categoria   3,4 o 5
	 * @return string  consulta sql
	 */
	function getPrecioCat_m($clientes_categoria)
	{
		if($clientes_categoria == 1)
			$query_str = "pd.*, a.articulos_descripcion, a.articulos_stockreal, a.articulos_precio1 as articulos_precio"; //clientes categoria 1
		elseif($clientes_categoria == 2)
			$query_str = "pd.*, a.articulos_descripcion, a.articulos_stockreal, a.articulos_precio2 as articulos_precio"; //clientes categoria 2
		else 
			$query_str = "pd.*, a.articulos_descripcion, a.articulos_stockreal, a.articulos_precio3 as articulos_precio"; //clientes categoria 3	
		return $query_str;
	}

}