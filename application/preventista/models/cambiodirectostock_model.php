<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cambiodirectostock_Model extends CI_Model {

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
		$this->db->insert('cambiodirectostock', $options);
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
		if(isset($options['cambiodirectostock_tipo']))
			$this->db->set('cambiodirectostock_tipo', $options['cambiodirectostock_tipo']);
		if(isset($options['articulos_id']))
			$this->db->set('articulos_id', $options['articulos_id']);
		if(isset($options['cambiodirectostock_stockantiguo']))
			$this->db->set('cambiodirectostock_stockantiguo', $options['cambiodirectostock_stockantiguo']);
		if(isset($options['cambiodirectostock_stocknuevo']))
			$this->db->set('cambiodirectostock_stocknuevo', $options['cambiodirectostock_stocknuevo']);
		if(isset($options['usuarios_id']))
			$this->db->set('usuarios_id', $options['usuarios_id']);
		if(isset($options['cambiodirectostock_comentario']))
			$this->db->set('cambiodirectostock_comentario', $options['cambiodirectostock_comentario']);
		if(isset($options['cambiodirectostock_created_at']))
			$this->db->set('cambiodirectostock_created_at', $options['cambiodirectostock_created_at']);
		if(isset($options['cambiodirectostock_updated_at']))
			$this->db->set('cambiodirectostock_updated_at', $options['cambiodirectostock_updated_at']);

		$this->db->where('cambiodirectostock_id', $options['cambiodirectostock_id']);

		$this->db->update('cambiodirectostock');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $cambiodirectostock_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($cambiodirectostock_id)
	{
		//code here
		$this->db->where('cambiodirectostock_id', $cambiodirectostock_id);
		$this->db->delete('cambiodirectostock');
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
		if(isset($options['cambiodirectostock_id']))
			$this->db->where('cd.cambiodirectostock_id', $options['cambiodirectostock_id']);
		if(isset($options['cambiodirectostock_tipo']))
			$this->db->where('cd.cambiodirectostock_tipo', $options['cambiodirectostock_tipo']);
		if(isset($options['articulos_id']))
			$this->db->where('cd.articulos_id', $options['articulos_id']);
		if(isset($options['cambiodirectostock_stockantiguo']))
			$this->db->where('cd.cambiodirectostock_stockantiguo', $options['cambiodirectostock_stockantiguo']);
		if(isset($options['cambiodirectostock_stocknuevo']))
			$this->db->where('cd.cambiodirectostock_stocknuevo', $options['cambiodirectostock_stocknuevo']);
		if(isset($options['usuarios_id']))
			$this->db->where('cd.usuarios_id', $options['usuarios_id']);
		if(isset($options['cambiodirectostock_comentario']))
			$this->db->like('cd.cambiodirectostock_comentario', $options['cambiodirectostock_comentario']);
		if(isset($options['cambiodirectostock_created_at']))
			$this->db->where('cd.cambiodirectostock_created_at', $options['cambiodirectostock_created_at']);
		if(isset($options['cambiodirectostock_updated_at']))
			$this->db->where('cd.cambiodirectostock_updated_at', $options['cambiodirectostock_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("cd.*, a.articulos_descripcion, u.usuarios_username");
		$this->db->from("cambiodirectostock as cd");
		$this->db->join("articulos as a", "a.articulos_id = cd.articulos_id");
		$this->db->join("usuarios as u",  "u.usuarios_id = cd.usuarios_id");
		
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['cambiodirectostock_id']) && $flag==1){
				$query->row(0)->cambiodirectostock_created_at = $this->basicrud->formatDateToHuman($query->row(0)->cambiodirectostock_created_at);
				$query->row(0)->cambiodirectostock_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->cambiodirectostock_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->cambiodirectostock_created_at = $this->basicrud->formatDateToHuman($row->cambiodirectostock_created_at);
					$row->cambiodirectostock_updated_at = $this->basicrud->formatDateToHuman($row->cambiodirectostock_updated_at);
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
		$fields[]='cambiodirectostock_id';
		$fields[]='cambiodirectostock_tipo';
		$fields[]='articulos_id';
		$fields[]='articulos_descripcion';
		$fields[]='cambiodirectostock_stockantiguo';
		$fields[]='cambiodirectostock_stocknuevo';
		$fields[]='usuarios_id';
		$fields[]='usuarios_username';
		$fields[]='cambiodirectostock_comentario';
		$fields[]='cambiodirectostock_created_at';
		$fields[]='cambiodirectostock_updated_at';
		return $fields;
	}

}