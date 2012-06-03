<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perfiles_Model extends CI_Model {

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
		$this->db->insert('perfiles', $options);
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
		if(isset($options['perfiles_descripcion']))
			$this->db->set('perfiles_descripcion', $options['perfiles_descripcion']);
		if(isset($options['perfiles_estado']))
			$this->db->set('perfiles_estado', $options['perfiles_estado']);
		if(isset($options['perfiles_created_at']))
			$this->db->set('perfiles_created_at', $options['perfiles_created_at']);
		if(isset($options['perfiles_updated_at']))
			$this->db->set('perfiles_updated_at', $options['perfiles_updated_at']);

		$this->db->where('perfiles_id', $options['perfiles_id']);

		$this->db->update('perfiles');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $perfiles_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($perfiles_id)
	{
		//code here
		$this->db->where('perfiles_id', $perfiles_id);
		$this->db->delete('perfiles');
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
		if(isset($options['perfiles_id']))
			$this->db->where('perfiles_id', $options['perfiles_id']);
		if(isset($options['perfiles_descripcion']))
			$this->db->like('perfiles_descripcion', $options['perfiles_descripcion']);
		if(isset($options['perfiles_estado']))
			$this->db->where('perfiles_estado', $options['perfiles_estado']);
		if(isset($options['perfiles_created_at']))
			$this->db->where('perfiles_created_at', $options['perfiles_created_at']);
		if(isset($options['perfiles_updated_at']))
			$this->db->where('perfiles_updated_at', $options['perfiles_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("p.*, tg.tabgral_descripcion as perfiles_estado_descripcion");
		$this->db->from("perfiles as p");
		$this->db->join("tabgral as tg", "tg.tabgral_id = p.perfiles_estado");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['perfiles_id']) && $flag==1){
				$query->row(0)->perfiles_created_at = $this->basicrud->formatDateToHuman($query->row(0)->perfiles_created_at);
				$query->row(0)->perfiles_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->perfiles_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->perfiles_created_at = $this->basicrud->formatDateToHuman($row->perfiles_created_at);
					$row->perfiles_updated_at = $this->basicrud->formatDateToHuman($row->perfiles_updated_at);
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
		$fields[]='perfiles_id';
		$fields[]='perfiles_descripcion';
		$fields[]='perfiles_estado';
		$fields[]='perfiles_estado_descripcion';
		$fields[]='perfiles_created_at';
		$fields[]='perfiles_updated_at';
		return $fields;
	}

}