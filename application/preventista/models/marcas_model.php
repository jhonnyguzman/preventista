<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marcas_Model extends CI_Model {

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
		$this->db->insert('marcas', $options);
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
		if(isset($options['marcas_parent']))
			$this->db->set('marcas_parent', $options['marcas_parent']);
		if(isset($options['marcas_descripcion']))
			$this->db->set('marcas_descripcion', $options['marcas_descripcion']);
		if(isset($options['marcas_estado']))
			$this->db->set('marcas_estado', $options['marcas_estado']);
		if(isset($options['marcas_created_at']))
			$this->db->set('marcas_created_at', $options['marcas_created_at']);
		if(isset($options['marcas_updated_at']))
			$this->db->set('marcas_updated_at', $options['marcas_updated_at']);

		$this->db->where('marcas_id', $options['marcas_id']);

		$this->db->update('marcas');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $marcas_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($marcas_id)
	{
		//code here
		$this->db->where('marcas_id', $marcas_id);
		$this->db->delete('marcas');
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
		if(isset($options['marcas_id']))
			$this->db->where('m.marcas_id', $options['marcas_id']);
		if(isset($options['marcas_parent']))
			$this->db->where('m.marcas_parent', $options['marcas_parent']);
		if(isset($options['marcas_descripcion']))
			$this->db->like('m.marcas_descripcion', $options['marcas_descripcion']);
		if(isset($options['marcas_estado']))
			$this->db->where('m.marcas_estado', $options['marcas_estado']);
		if(isset($options['marcas_created_at']))
			$this->db->where('m.marcas_created_at', $options['marcas_created_at']);
		if(isset($options['marcas_updated_at']))
			$this->db->where('m.marcas_updated_at', $options['marcas_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("m.*, (SELECT marcas_descripcion from marcas where marcas_id = m.marcas_parent) as marcas_parent_descripcion, 
			tg.tabgral_descripcion as marcas_estado_descripcion",false);
		$this->db->from("marcas as m");
		$this->db->join("tabgral as tg","tg.tabgral_id = m.marcas_estado");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['marcas_id']) && $flag==1){
				$query->row(0)->marcas_created_at = $this->basicrud->formatDateToHuman($query->row(0)->marcas_created_at);
				$query->row(0)->marcas_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->marcas_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->marcas_created_at = $this->basicrud->formatDateToHuman($row->marcas_created_at);
					$row->marcas_updated_at = $this->basicrud->formatDateToHuman($row->marcas_updated_at);
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
		$fields[]='marcas_id';
		$fields[]='marcas_descripcion';
		$fields[]='marcas_parent';
		$fields[]='marcas_parent_descripcion';
		$fields[]='marcas_estado';
		$fields[]='marcas_estado_descripcion';
		$fields[]='marcas_created_at';
		$fields[]='marcas_updated_at';
		return $fields;
	}

}