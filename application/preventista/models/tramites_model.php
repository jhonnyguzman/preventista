<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tramites_Model extends CI_Model {

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
		$this->db->insert('tramites', $options);
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
		if(isset($options['tramites_descripcion']))
			$this->db->set('tramites_descripcion', $options['tramites_descripcion']);
		if(isset($options['tramites_created_at']))
			$this->db->set('tramites_created_at', $options['tramites_created_at']);
		if(isset($options['tramites_updated_at']))
			$this->db->set('tramites_updated_at', $options['tramites_updated_at']);

		$this->db->where('tramites_id', $options['tramites_id']);

		$this->db->update('tramites');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $tramites_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($tramites_id)
	{
		//code here
		$this->db->where('tramites_id', $tramites_id);
		$this->db->delete('tramites');
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
		if(isset($options['tramites_id']))
			$this->db->where('tramites_id', $options['tramites_id']);
		if(isset($options['tramites_descripcion']))
			$this->db->like('tramites_descripcion', $options['tramites_descripcion']);
		if(isset($options['tramites_created_at']))
			$this->db->where('tramites_created_at', $options['tramites_created_at']);
		if(isset($options['tramites_updated_at']))
			$this->db->where('tramites_updated_at', $options['tramites_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$query = $this->db->get('tramites');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['tramites_id']) && $flag==1){
				$query->row(0)->tramites_created_at = $this->basicrud->formatDateToHuman($query->row(0)->tramites_created_at);
				$query->row(0)->tramites_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->tramites_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->tramites_created_at = $this->basicrud->formatDateToHuman($row->tramites_created_at);
					$row->tramites_updated_at = $this->basicrud->formatDateToHuman($row->tramites_updated_at);
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
		$fields[]='tramites_id';
		$fields[]='tramites_descripcion';
		$fields[]='tramites_created_at';
		$fields[]='tramites_updated_at';
		return $fields;
	}

}