<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comprasdetalle_Model extends CI_Model {

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
		$this->db->insert('comprasdetalle', $options);
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
		if(isset($options['compras_id']))
			$this->db->set('compras_id', $options['compras_id']);
		if(isset($options['articulos_id']))
			$this->db->set('articulos_id', $options['articulos_id']);
		if(isset($options['comprasdetalle_cantidad']))
			$this->db->set('comprasdetalle_cantidad', $options['comprasdetalle_cantidad']);
		if(isset($options['comprasdetalle_costo']))
			$this->db->set('comprasdetalle_costo', $options['comprasdetalle_costo']);
		if(isset($options['comprasdetalle_subtotal']))
			$this->db->set('comprasdetalle_subtotal', $options['comprasdetalle_subtotal']);
		if(isset($options['comprasdetalle_created_at']))
			$this->db->set('comprasdetalle_created_at', $options['comprasdetalle_created_at']);
		if(isset($options['comprasdetalle_updated_at']))
			$this->db->set('comprasdetalle_updated_at', $options['comprasdetalle_updated_at']);

		$this->db->where('comprasdetalle_id', $options['comprasdetalle_id']);

		$this->db->update('comprasdetalle');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $comprasdetalle_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($comprasdetalle_id)
	{
		//code here
		$this->db->where('comprasdetalle_id', $comprasdetalle_id);
		$this->db->delete('comprasdetalle');
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
		if(isset($options['comprasdetalle_id']))
			$this->db->where('cd.comprasdetalle_id', $options['comprasdetalle_id']);
		if(isset($options['compras_id']))
			$this->db->where('cd.compras_id', $options['compras_id']);
		if(isset($options['articulos_id']))
			$this->db->where('cd.articulos_id', $options['articulos_id']);
		if(isset($options['comprasdetalle_cantidad']))
			$this->db->where('cd.comprasdetalle_cantidad', $options['comprasdetalle_cantidad']);
		if(isset($options['comprasdetalle_costo']))
			$this->db->where('cd.comprasdetalle_costo', $options['comprasdetalle_costo']);
		if(isset($options['comprasdetalle_subtotal']))
			$this->db->where('cd.comprasdetalle_subtotal', $options['comprasdetalle_subtotal']);
		if(isset($options['comprasdetalle_created_at']))
			$this->db->where('cd.comprasdetalle_created_at', $options['comprasdetalle_created_at']);
		if(isset($options['comprasdetalle_updated_at']))
			$this->db->where('cd.comprasdetalle_updated_at', $options['comprasdetalle_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("cd.*, a.articulos_descripcion, a.articulos_stockreal");
		$this->db->from("comprasdetalle as cd");
		$this->db->join("articulos as a","a.articulos_id = cd.articulos_id");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['comprasdetalle_id']) && $flag==1){
				$query->row(0)->comprasdetalle_created_at = $this->basicrud->formatDateToHuman($query->row(0)->comprasdetalle_created_at);
				$query->row(0)->comprasdetalle_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->comprasdetalle_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->comprasdetalle_created_at = $this->basicrud->formatDateToHuman($row->comprasdetalle_created_at);
					$row->comprasdetalle_updated_at = $this->basicrud->formatDateToHuman($row->comprasdetalle_updated_at);
				}
				return $query->result();
			}
		}

	}


	/**
	 * This function get the data of the db
	 *
	 * @access public
	 * @param array fields of the table
	 * @param integer	flag to indicate if return one record or more of one record
	 * @return array  result
	 */
	function getByArticulo_m($options = array(),$flag=0)
	{
		//code here
		if(isset($options['articulos_descripcion']))
			$this->db->like('a.articulos_descripcion', $options['articulos_descripcion']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("a.articulos_descripcion, cd.*, p.proveedores_apellido  ,p.proveedores_nombre");
		$this->db->from("articulos as a");
		$this->db->join("comprasdetalle as cd","cd.articulos_id = a.articulos_id");
		$this->db->join("compras as c","c.compras_id = cd.compras_id");
		$this->db->join("proveedores as p","p.proveedores_id = c.proveedores_id");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['comprasdetalle_id']) && $flag==1){
				$query->row(0)->comprasdetalle_created_at = $this->basicrud->formatDateToHuman($query->row(0)->comprasdetalle_created_at);
				$query->row(0)->comprasdetalle_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->comprasdetalle_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->comprasdetalle_created_at = $this->basicrud->formatDateToHuman($row->comprasdetalle_created_at);
					$row->comprasdetalle_updated_at = $this->basicrud->formatDateToHuman($row->comprasdetalle_updated_at);
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
		$fields[]='comprasdetalle_id';
		$fields[]='compras_id';
		$fields[]='articulos_id';
		$fields[]='articulos_descripcion';
		$fields[]='articulos_stockreal';
		$fields[]='comprasdetalle_cantidad';
		$fields[]='comprasdetalle_costo';
		$fields[]='comprasdetalle_subtotal';
		$fields[]='comprasdetalle_created_at';
		$fields[]='comprasdetalle_updated_at';
		return $fields;
	}

}