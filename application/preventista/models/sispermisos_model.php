<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sispermisos_Model extends CI_Model {

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
		$this->db->insert('sispermisos', $options);
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
		if(isset($options['sispermisos_tabla']))
			$this->db->set('sispermisos_tabla', $options['sispermisos_tabla']);
		if(isset($options['sispermisos_flag_read']))
			$this->db->set('sispermisos_flag_read', $options['sispermisos_flag_read']);
		if(isset($options['sispermisos_flag_insert']))
			$this->db->set('sispermisos_flag_insert', $options['sispermisos_flag_insert']);
		if(isset($options['sispermisos_flag_update']))
			$this->db->set('sispermisos_flag_update', $options['sispermisos_flag_update']);
		if(isset($options['sispermisos_flag_delete']))
			$this->db->set('sispermisos_flag_delete', $options['sispermisos_flag_delete']);
		if(isset($options['perfiles_id']))
			$this->db->set('perfiles_id', $options['perfiles_id']);
		if(isset($options['sispermisos_created_at']))
			$this->db->set('sispermisos_created_at', $options['sispermisos_created_at']);
		if(isset($options['sispermisos_updated_at']))
			$this->db->set('sispermisos_updated_at', $options['sispermisos_updated_at']);

		$this->db->where('sispermisos_id', $options['sispermisos_id']);

		$this->db->update('sispermisos');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $sispermisos_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($sispermisos_id)
	{
		//code here
		$this->db->where('sispermisos_id', $sispermisos_id);
		$this->db->delete('sispermisos');
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
		if(isset($options['sispermisos_id']))
			$this->db->where('sispermisos_id', $options['sispermisos_id']);
		if(isset($options['sispermisos_tabla']))
			$this->db->like('sispermisos_tabla', $options['sispermisos_tabla']);
		if(isset($options['sispermisos_flag_read']))
			$this->db->where('sispermisos_flag_read', $options['sispermisos_flag_read']);
		if(isset($options['sispermisos_flag_insert']))
			$this->db->where('sispermisos_flag_insert', $options['sispermisos_flag_insert']);
		if(isset($options['sispermisos_flag_update']))
			$this->db->where('sispermisos_flag_update', $options['sispermisos_flag_update']);
		if(isset($options['sispermisos_flag_delete']))
			$this->db->where('sispermisos_flag_delete', $options['sispermisos_flag_delete']);
		if(isset($options['perfiles_id']))
			$this->db->where('perfiles_id', $options['perfiles_id']);
		if(isset($options['sispermisos_created_at']))
			$this->db->where('sispermisos_created_at', $options['sispermisos_created_at']);
		if(isset($options['sispermisos_updated_at']))
			$this->db->where('sispermisos_updated_at', $options['sispermisos_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("sp.*, p.perfiles_descripcion");
		$this->db->from("sispermisos as sp");
		$this->db->join("perfiles as p","p.perfiles_id = sp.perfiles_id");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['sispermisos_id']) && $flag==1){
				$query->row(0)->sispermisos_created_at = $this->basicrud->formatDateToHuman($query->row(0)->sispermisos_created_at);
				$query->row(0)->sispermisos_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->sispermisos_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->sispermisos_created_at = $this->basicrud->formatDateToHuman($row->sispermisos_created_at);
					$row->sispermisos_updated_at = $this->basicrud->formatDateToHuman($row->sispermisos_updated_at);
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
		$fields[]='sispermisos_id';
		$fields[]='sispermisos_tabla';
		$fields[]='sispermisos_flag_read';
		$fields[]='sispermisos_flag_insert';
		$fields[]='sispermisos_flag_update';
		$fields[]='sispermisos_flag_delete';
		$fields[]='perfiles_id';
		$fields[]='perfiles_descripcion';
		$fields[]='sispermisos_created_at';
		$fields[]='sispermisos_updated_at';
		return $fields;
	}

}