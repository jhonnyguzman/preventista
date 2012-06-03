<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sismenu_Model extends CI_Model {

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
		$this->db->insert('sismenu', $options);
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
		if(isset($options['sismenu_descripcion']))
			$this->db->set('sismenu_descripcion', $options['sismenu_descripcion']);
		if(isset($options['sismenu_estado']))
			$this->db->set('sismenu_estado', $options['sismenu_estado']);
		if(isset($options['sismenu_parent']))
			$this->db->set('sismenu_parent', $options['sismenu_parent']);
		if(isset($options['sismenu_created_at']))
			$this->db->set('sismenu_created_at', $options['sismenu_created_at']);
		if(isset($options['sismenu_updated_at']))
			$this->db->set('sismenu_updated_at', $options['sismenu_updated_at']);

		$this->db->where('sismenu_id', $options['sismenu_id']);

		$this->db->update('sismenu');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $sismenu_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($sismenu_id)
	{
		//code here
		$this->db->where('sismenu_id', $sismenu_id);
		$this->db->delete('sismenu');
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
		if(isset($options['sismenu_id']))
			$this->db->where('sm.sismenu_id', $options['sismenu_id']);
		if(isset($options['sismenu_descripcion']))
			$this->db->like('sm.sismenu_descripcion', $options['sismenu_descripcion']);
		if(isset($options['sismenu_estado']))
			$this->db->where('sm.sismenu_estado', $options['sismenu_estado']);
		if(isset($options['sismenu_parent']))
			$this->db->where('sm.sismenu_parent', $options['sismenu_parent']);
		if(isset($options['sismenu_created_at']))
			$this->db->where('sm.sismenu_created_at', $options['sismenu_created_at']);
		if(isset($options['sismenu_updated_at']))
			$this->db->where('sm.sismenu_updated_at', $options['sismenu_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select('sm.*, (SELECT sm1.sismenu_descripcion FROM sismenu sm1 WHERE sm1.sismenu_id = sm.sismenu_parent) as sismenu_parent_descripcion,
		 sv.sisvinculos_link, tg.tabgral_descripcion as sismenu_estado_descripcion', false);
		
		$this->db->from('sismenu as sm');
		$this->db->join('sisvinculos as sv', 'sm.sismenu_id = sv.sismenu_id');
		$this->db->join('tabgral as tg', 'tg.tabgral_id = sm.sismenu_estado');
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['sismenu_id']) && $flag==1){
				$query->row(0)->sismenu_created_at = $this->basicrud->formatDateToHuman($query->row(0)->sismenu_created_at);
				$query->row(0)->sismenu_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->sismenu_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->sismenu_created_at = $this->basicrud->formatDateToHuman($row->sismenu_created_at);
					$row->sismenu_updated_at = $this->basicrud->formatDateToHuman($row->sismenu_updated_at);
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
		$fields[]='sismenu_id';
		$fields[]='sismenu_descripcion';
		$fields[]='sismenu_estado';
		$fields[]='sismenu_estado_descripcion';
		$fields[]='sismenu_parent';
		$fields[]='sismenu_parent_descripcion';
		$fields[]='sismenu_created_at';
		$fields[]='sismenu_updated_at';
		return $fields;
	}

}
