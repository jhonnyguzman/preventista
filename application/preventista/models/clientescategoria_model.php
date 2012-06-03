<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientescategoria_Model extends CI_Model {

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
		$this->db->insert('clientescategoria', $options);
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
		if(isset($options['clientescategoria_descripcion']))
			$this->db->set('clientescategoria_descripcion', $options['clientescategoria_descripcion']);
		if(isset($options['clientescategoria_estado']))
			$this->db->set('clientescategoria_estado', $options['clientescategoria_estado']);
		if(isset($options['clientescategoria_created_at']))
			$this->db->set('clientescategoria_created_at', $options['clientescategoria_created_at']);
		if(isset($options['clientescategoria_updated_at']))
			$this->db->set('clientescategoria_updated_at', $options['clientescategoria_updated_at']);

		$this->db->where('clientescategoria_id', $options['clientescategoria_id']);

		$this->db->update('clientescategoria');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $clientescategoria_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($clientescategoria_id)
	{
		//code here
		$this->db->where('clientescategoria_id', $clientescategoria_id);
		$this->db->delete('clientescategoria');
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
		if(isset($options['clientescategoria_id']))
			$this->db->where('clientescategoria_id', $options['clientescategoria_id']);
		if(isset($options['clientescategoria_descripcion']))
			$this->db->like('clientescategoria_descripcion', $options['clientescategoria_descripcion']);
		if(isset($options['clientescategoria_estado']))
			$this->db->where('clientescategoria_estado', $options['clientescategoria_estado']);
		if(isset($options['clientescategoria_created_at']))
			$this->db->where('clientescategoria_created_at', $options['clientescategoria_created_at']);
		if(isset($options['clientescategoria_updated_at']))
			$this->db->where('clientescategoria_updated_at', $options['clientescategoria_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$query = $this->db->get('clientescategoria');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['clientescategoria_id']) && $flag==1){
				$query->row(0)->clientescategoria_created_at = $this->basicrud->formatDateToHuman($query->row(0)->clientescategoria_created_at);
				$query->row(0)->clientescategoria_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->clientescategoria_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->clientescategoria_created_at = $this->basicrud->formatDateToHuman($row->clientescategoria_created_at);
					$row->clientescategoria_updated_at = $this->basicrud->formatDateToHuman($row->clientescategoria_updated_at);
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
		$fields[]='clientescategoria_id';
		$fields[]='clientescategoria_descripcion';
		$fields[]='clientescategoria_estado';
		$fields[]='clientescategoria_created_at';
		$fields[]='clientescategoria_updated_at';
		return $fields;
	}

}