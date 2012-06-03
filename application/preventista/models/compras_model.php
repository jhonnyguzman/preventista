<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compras_Model extends CI_Model {

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
		$this->db->insert('compras', $options);
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
		if(isset($options['proveedores_id']))
			$this->db->set('proveedores_id', $options['proveedores_id']);
		if(isset($options['compras_montototal']))
			$this->db->set('compras_montototal', $options['compras_montototal']);
		if(isset($options['usuarios_id']))
			$this->db->set('usuarios_id', $options['usuarios_id']);
		if(isset($options['compras_created_at']))
			$this->db->set('compras_created_at', $options['compras_created_at']);
		if(isset($options['compras_updated_at']))
			$this->db->set('compras_updated_at', $options['compras_updated_at']);

		$this->db->where('compras_id', $options['compras_id']);

		$this->db->update('compras');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $compras_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($compras_id)
	{
		//code here
		$this->db->where('compras_id', $compras_id);
		$this->db->delete('compras');
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
		if(isset($options['compras_id']))
			$this->db->where('c.compras_id', $options['compras_id']);
		if(isset($options['proveedores_id']))
			$this->db->where('c.proveedores_id', $options['proveedores_id']);
		if(isset($options['compras_montototal']))
			$this->db->where('c.compras_montototal', $options['compras_montototal']);
		if(isset($options['usuarios_id']))
			$this->db->where('c.usuarios_id', $options['usuarios_id']);
		if(isset($options['compras_created_at'])){
			$string = "CAST(c.compras_created_at AS DATE) = '".$this->basicrud->getFormatDateToBD($options['compras_created_at'])."'";
			$this->db->where($string);
		}
		if(isset($options['compras_updated_at']))
			$this->db->where('c.compras_updated_at', $options['compras_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("c.*, p.proveedores_apellido, p.proveedores_nombre, u.usuarios_username");
		$this->db->from("compras as c");
		$this->db->join("proveedores as p","p.proveedores_id = c.proveedores_id");
		$this->db->join("usuarios as u", "u.usuarios_id = c.usuarios_id");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['compras_id']) && $flag==1){
				$query->row(0)->compras_created_at = $this->basicrud->formatDateToHuman($query->row(0)->compras_created_at);
				$query->row(0)->compras_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->compras_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->compras_created_at = $this->basicrud->formatDateToHuman($row->compras_created_at);
					$row->compras_updated_at = $this->basicrud->formatDateToHuman($row->compras_updated_at);
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
		$fields[]='compras_id';
		$fields[]='proveedores_id';
		$fields[]='proveedores_apellido';
		$fields[]='proveedores_nombre';
		$fields[]='compras_montototal';
		$fields[]='usuarios_id';
		$fields[]='usuarios_username';
		$fields[]='compras_created_at';
		$fields[]='compras_updated_at';
		return $fields;
	}



	function getComprasUtilidades_m($options = array())
	{
		
		$string = "CAST(compras_created_at AS DATE) BETWEEN '".$options['compras_created_at_from']."' AND 
		'".$options['compras_created_at_to']."'";
		
		$this->db->where($string);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		$this->db->order_by('compras_created_at','asc');
	
		$query = $this->db->get('compras');	

		if(isset($options['count'])) return $query->num_rows();
		else return $query->result();

	}

}