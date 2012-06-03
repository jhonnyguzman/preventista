<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes_Model extends CI_Model {

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
		$this->db->insert('clientes', $options);
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
		if(isset($options['clientes_nombre']))
			$this->db->set('clientes_nombre', $options['clientes_nombre']);
		if(isset($options['clientes_apellido']))
			$this->db->set('clientes_apellido', $options['clientes_apellido']);
		if(isset($options['clientes_direccion']))
			$this->db->set('clientes_direccion', $options['clientes_direccion']);
		if(isset($options['clientes_telefono']))
			$this->db->set('clientes_telefono', $options['clientes_telefono']);
		if(isset($options['clientescategoria_id']))
			$this->db->set('clientescategoria_id', $options['clientescategoria_id']);
		if(isset($options['clientes_created_at']))
			$this->db->set('clientes_created_at', $options['clientes_created_at']);
		if(isset($options['clientes_updated_at']))
			$this->db->set('clientes_updated_at', $options['clientes_updated_at']);

		$this->db->where('clientes_id', $options['clientes_id']);

		$this->db->update('clientes');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $clientes_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($clientes_id)
	{
		//code here
		$this->db->where('clientes_id', $clientes_id);
		$this->db->delete('clientes');
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
		if(isset($options['clientes_id']))
			$this->db->where('c.clientes_id', $options['clientes_id']);
		if(isset($options['clientes_nombre']))
			$this->db->like('c.clientes_nombre', $options['clientes_nombre']);
		if(isset($options['clientes_apellido']))
			$this->db->like('c.clientes_apellido', $options['clientes_apellido']);
		if(isset($options['clientes_direccion']))
			$this->db->like('c.clientes_direccion', $options['clientes_direccion']);
		if(isset($options['clientes_telefono']))
			$this->db->like('c.clientes_telefono', $options['clientes_telefono']);
		if(isset($options['clientescategoria_id']))
			$this->db->where('c.clientescategoria_id', $options['clientescategoria_id']);
		if(isset($options['clientes_created_at']))
			$this->db->where('c.clientes_created_at', $options['clientes_created_at']);
		if(isset($options['clientes_updated_at']))
			$this->db->where('c.clientes_updated_at', $options['clientes_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("c.*, cc.clientescategoria_descripcion");
		$this->db->from("clientes as c");
		$this->db->join("clientescategoria as cc","cc.clientescategoria_id = c.clientescategoria_id");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['clientes_id']) && $flag==1){
				$query->row(0)->clientes_created_at = $this->basicrud->formatDateToHuman($query->row(0)->clientes_created_at);
				$query->row(0)->clientes_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->clientes_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->clientes_created_at = $this->basicrud->formatDateToHuman($row->clientes_created_at);
					$row->clientes_updated_at = $this->basicrud->formatDateToHuman($row->clientes_updated_at);
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
		$fields[]='clientes_id';
		$fields[]='clientes_nombre';
		$fields[]='clientes_apellido';
		$fields[]='clientes_direccion';
		$fields[]='clientes_telefono';
		$fields[]='clientescategoria_id';
		$fields[]='clientescategoria_descripcion';
		$fields[]='clientes_created_at';
		$fields[]='clientes_updated_at';
		return $fields;
	}

}