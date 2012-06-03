<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sisperfil_Model extends CI_Model {

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
		$this->db->insert('sisperfil', $options);
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
		if(isset($options['perfiles_id']))
			$this->db->set('perfiles_id', $options['perfiles_id']);
		if(isset($options['sisperfil_estado']))
			$this->db->set('sisperfil_estado', $options['sisperfil_estado']);
		if(isset($options['sisperfil_created_at']))
			$this->db->set('sisperfil_created_at', $options['sisperfil_created_at']);
		if(isset($options['sisperfil_updated_at']))
			$this->db->set('sisperfil_updated_at', $options['sisperfil_updated_at']);

		$this->db->where('sisperfil_id', $options['sisperfil_id']);

		$this->db->update('sisperfil');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $sisperfil_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($sisperfil_id)
	{
		//code here
		$this->db->where('sisperfil_id', $sisperfil_id);
		$this->db->delete('sisperfil');
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
		if(isset($options['sisperfil_id']))
			$this->db->where('sisperfil_id', $options['sisperfil_id']);
		if(isset($options['sismenu_id']))
			$this->db->where('sismenu_id', $options['sismenu_id']);
		if(isset($options['perfiles_id']))
			$this->db->where('perfiles_id', $options['perfiles_id']);
		if(isset($options['sisperfil_estado']))
			$this->db->where('sisperfil_estado', $options['sisperfil_estado']);
		if(isset($options['sisperfil_created_at']))
			$this->db->where('sisperfil_created_at', $options['sisperfil_created_at']);
		if(isset($options['sisperfil_updated_at']))
			$this->db->where('sisperfil_updated_at', $options['sisperfil_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$query = $this->db->get('sisperfil');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['sisperfil_id']) && $flag==1){
				$query->row(0)->sisperfil_created_at = $this->basicrud->formatDateToHuman($query->row(0)->sisperfil_created_at);
				$query->row(0)->sisperfil_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->sisperfil_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->sisperfil_created_at = $this->basicrud->formatDateToHuman($row->sisperfil_created_at);
					$row->sisperfil_updated_at = $this->basicrud->formatDateToHuman($row->sisperfil_updated_at);
				}
				return $query->result();
			}
		}

	}


	/**
	 * This function gets all the menu options assigned of the sisperfil table for a particular perfil
	 *
	 * @access public
	 * @return array  fields of table
	 */
	function getMenuAssignedToPerfil_m()
	{
		//code here
		$query_str = "select sm.sismenu_id, sm.sismenu_descripcion from sisperfil as sp inner join sismenu as sm on sp.sismenu_id = sm.sismenu_id where sp.perfiles_id = ?";
		$query = $this->db->query($query_str,$options['perfiles_id']);
		if($query->num_rows()>0){
			return $query->result();
		}
	}


	/**
	 * This function gets all the menu options not assigned of the sismenu table for a particular perfil
	 *
	 * @access public
	 * @return array  fields of table
	 */
	function getMenuNotAssignedToPerfil_m()
	{
		//code here
		$query_str = "select sm.sismenu_id, sm.sismenu_descripcion from sismenu as sm where (select count(*) as cantidad from sisperfil as sp where sp.perfiles_id= ? and sp.sismenu_id = sm.sismenu_id) =  0";
		$query = $this->db->query($query_str,$options['perfiles_id']);
		if($query->num_rows()>0){
			return $query->result();
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
		$fields[]='sisperfil_id';
		$fields[]='sismenu_id';
		$fields[]='perfiles_id';
		$fields[]='sisperfil_estado';
		$fields[]='sisperfil_created_at';
		$fields[]='sisperfil_updated_at';
		return $fields;
	}

}