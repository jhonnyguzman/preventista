<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Proveedores_Model extends CI_Model {

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
		$this->db->insert('proveedores', $options);
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
		if(isset($options['proveedores_nombre']))
			$this->db->set('proveedores_nombre', $options['proveedores_nombre']);
		if(isset($options['proveedores_apellido']))
			$this->db->set('proveedores_apellido', $options['proveedores_apellido']);
		if(isset($options['proveedores_direccion']))
			$this->db->set('proveedores_direccion', $options['proveedores_direccion']);
		if(isset($options['proveedores_telefono']))
			$this->db->set('proveedores_telefono', $options['proveedores_telefono']);
		if(isset($options['proveedores_created_at']))
			$this->db->set('proveedores_created_at', $options['proveedores_created_at']);
		if(isset($options['proveedores_updated_at']))
			$this->db->set('proveedores_updated_at', $options['proveedores_updated_at']);

		$this->db->where('proveedores_id', $options['proveedores_id']);

		$this->db->update('proveedores');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $proveedores_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($proveedores_id)
	{
		//code here
		$this->db->where('proveedores_id', $proveedores_id);
		$this->db->delete('proveedores');
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
		if(isset($options['proveedores_id']))
			$this->db->where('proveedores_id', $options['proveedores_id']);
		if(isset($options['proveedores_nombre']))
			$this->db->like('proveedores_nombre', $options['proveedores_nombre']);
		if(isset($options['proveedores_apellido']))
			$this->db->like('proveedores_apellido', $options['proveedores_apellido']);
		if(isset($options['proveedores_direccion']))
			$this->db->like('proveedores_direccion', $options['proveedores_direccion']);
		if(isset($options['proveedores_telefono']))
			$this->db->like('proveedores_telefono', $options['proveedores_telefono']);
		if(isset($options['proveedores_created_at']))
			$this->db->where('proveedores_created_at', $options['proveedores_created_at']);
		if(isset($options['proveedores_updated_at']))
			$this->db->where('proveedores_updated_at', $options['proveedores_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$query = $this->db->get('proveedores');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['proveedores_id']) && $flag==1){
				$query->row(0)->proveedores_created_at = $this->basicrud->formatDateToHuman($query->row(0)->proveedores_created_at);
				$query->row(0)->proveedores_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->proveedores_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->proveedores_created_at = $this->basicrud->formatDateToHuman($row->proveedores_created_at);
					$row->proveedores_updated_at = $this->basicrud->formatDateToHuman($row->proveedores_updated_at);
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
		$fields[]='proveedores_id';
		$fields[]='proveedores_nombre';
		$fields[]='proveedores_apellido';
		$fields[]='proveedores_direccion';
		$fields[]='proveedores_telefono';
		$fields[]='proveedores_created_at';
		$fields[]='proveedores_updated_at';
		return $fields;
	}

}