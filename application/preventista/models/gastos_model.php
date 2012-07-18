<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gastos_Model extends CI_Model {

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
		$this->db->insert('gastos', $options);
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
		if(isset($options['gastos_descripcion']))
			$this->db->set('gastos_descripcion', $options['gastos_descripcion']);
		if(isset($options['hojaruta_id']))
			$this->db->set('hojaruta_id', $options['hojaruta_id']);
		if(isset($options['gastos_monto']))
			$this->db->set('gastos_monto', $options['gastos_monto']);
		if(isset($options['gastos_created_at']))
			$this->db->set('gastos_created_at', $options['gastos_created_at']);
		if(isset($options['gastos_updated_at']))
			$this->db->set('gastos_updated_at', $options['gastos_updated_at']);

		$this->db->where('gastos_id', $options['gastos_id']);

		$this->db->update('gastos');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $gastos_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($gastos_id)
	{
		//code here
		$this->db->where('gastos_id', $gastos_id);
		$this->db->delete('gastos');
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
		if(isset($options['gastos_id']))
			$this->db->where('gastos_id', $options['gastos_id']);
		if(isset($options['gastos_descripcion']))
			$this->db->like('gastos_descripcion', $options['gastos_descripcion']);
		if(isset($options['hojaruta_id']))
			$this->db->where('hojaruta_id', $options['hojaruta_id']);
		if(isset($options['gastos_monto']))
			$this->db->where('gastos_monto', $options['gastos_monto']);
		if(isset($options['gastos_created_at']))
			$this->db->where('gastos_created_at', $options['gastos_created_at']);
		if(isset($options['gastos_updated_at']))
			$this->db->where('gastos_updated_at', $options['gastos_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$query = $this->db->get('gastos');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['gastos_id']) && $flag==1){
				$query->row(0)->gastos_created_at = $this->basicrud->formatDateToHuman($query->row(0)->gastos_created_at);
				$query->row(0)->gastos_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->gastos_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->gastos_created_at = $this->basicrud->formatDateToHuman($row->gastos_created_at);
					$row->gastos_updated_at = $this->basicrud->formatDateToHuman($row->gastos_updated_at);
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
		$fields[]='gastos_id';
		$fields[]='gastos_descripcion';
		$fields[]='hojaruta_id';
		$fields[]='gastos_monto';
		$fields[]='gastos_created_at';
		$fields[]='gastos_updated_at';
		return $fields;
	}

}