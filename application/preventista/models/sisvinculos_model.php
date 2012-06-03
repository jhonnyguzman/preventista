<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sisvinculos_Model extends CI_Model {

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
		$this->db->insert('sisvinculos', $options);
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
		if(isset($options['sismenu_id']))
			$this->db->set('sismenu_id', $options['sismenu_id']);
		if(isset($options['sisvinculos_link']))
			$this->db->set('sisvinculos_link', $options['sisvinculos_link']);
		if(isset($options['sisvinculos_created_at']))
			$this->db->set('sisvinculos_created_at', $options['sisvinculos_created_at']);
		if(isset($options['sisvinculos_updated_at']))
			$this->db->set('sisvinculos_updated_at', $options['sisvinculos_updated_at']);

		$this->db->where('sismenu_id', $options['sismenu_id']);

		$this->db->update('sisvinculos');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $sisvinculos_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($sisvinculos_id)
	{
		//code here
		$this->db->where('sisvinculos_id', $sisvinculos_id);
		$this->db->delete('sisvinculos');
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
		if(isset($options['sisvinculos_id']))
			$this->db->where('sisvinculos_id', $options['sisvinculos_id']);
		if(isset($options['sismenu_id']))
			$this->db->where('sismenu_id', $options['sismenu_id']);
		if(isset($options['sisvinculos_link']))
			$this->db->like('sisvinculos_link', $options['sisvinculos_link']);
		if(isset($options['sisvinculos_created_at']))
			$this->db->where('sisvinculos_created_at', $options['sisvinculos_created_at']);
		if(isset($options['sisvinculos_updated_at']))
			$this->db->where('sisvinculos_updated_at', $options['sisvinculos_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$query = $this->db->get('sisvinculos');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['sisvinculos_id']) && $flag==1){
				$query->row(0)->sisvinculos_created_at = $this->basicrud->formatDateToHuman($query->row(0)->sisvinculos_created_at);
				$query->row(0)->sisvinculos_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->sisvinculos_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->sisvinculos_created_at = $this->basicrud->formatDateToHuman($row->sisvinculos_created_at);
					$row->sisvinculos_updated_at = $this->basicrud->formatDateToHuman($row->sisvinculos_updated_at);
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
		$fields[]='sisvinculos_id';
		$fields[]='sismenu_id';
		$fields[]='sisvinculos_link';
		$fields[]='sisvinculos_created_at';
		$fields[]='sisvinculos_updated_at';
		return $fields;
	}

}