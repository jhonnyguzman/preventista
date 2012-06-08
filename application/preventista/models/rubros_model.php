<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rubros_Model extends CI_Model {

	private $arr_log = array('search' => 'rubros_');

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
		$this->db->insert('rubros', $options);
		
		$this->arr_log['new_id'] = $this->db->insert_id();
		$this->arr_log['string'] = $this->db->last_query();
		
		//log query
		//log_message("info", "Row insert successfull: ".$this->basicrud->writeAddSqlToLog($this->arr_log));
		$this->basicrud->writeFileLog($this->basicrud->writeAddSqlToLog($this->arr_log));

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
		if(isset($options['rubros_descripcion']))
			$this->db->set('rubros_descripcion', $options['rubros_descripcion']);
		if(isset($options['rubros_estado']))
			$this->db->set('rubros_estado', $options['rubros_estado']);
		if(isset($options['rubros_created_at']))
			$this->db->set('rubros_created_at', $options['rubros_created_at']);
		if(isset($options['rubros_updated_at']))
			$this->db->set('rubros_updated_at', $options['rubros_updated_at']);

		$this->db->where('rubros_id', $options['rubros_id']);
		$this->db->update('rubros');
		
		//log query
		$this->arr_log['string'] = $this->db->last_query();
		//log_message("info", "Row update successfull: ".$this->basicrud->writeEditSqlToLog($this->arr_log));
		$this->basicrud->writeFileLog($this->basicrud->writeEditSqlToLog($this->arr_log));

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $rubros_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($rubros_id)
	{
		//code here
		$this->db->where('rubros_id', $rubros_id);
		$this->db->delete('rubros');
		
		//log query
		$this->arr_log['string'] = $this->db->last_query();
		//log_message("info", "Row delete successfull: ".$this->basicrud->writeDeleteSqlToLog($this->arr_log));
		$this->basicrud->writeFileLog($this->basicrud->writeDeleteSqlToLog($this->arr_log));

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
		if(isset($options['rubros_id']))
			$this->db->where('r.rubros_id', $options['rubros_id']);
		if(isset($options['rubros_descripcion']))
			$this->db->like('r.rubros_descripcion', $options['rubros_descripcion']);
		if(isset($options['rubros_estado']))
			$this->db->where('r.rubros_estado', $options['rubros_estado']);
		if(isset($options['rubros_created_at']))
			$this->db->where('r.rubros_created_at', $options['rubros_created_at']);
		if(isset($options['rubros_updated_at']))
			$this->db->where('r.rubros_updated_at', $options['rubros_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("r.*, tg.tabgral_descripcion as rubros_estado_descripcion");
		$this->db->from("rubros as r");
		$this->db->join("tabgral as tg","tg.tabgral_id = r.rubros_estado");
		

		$query = $this->db->get();


		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['rubros_id']) && $flag==1){
				$query->row(0)->rubros_created_at = $this->basicrud->formatDateToHuman($query->row(0)->rubros_created_at);
				$query->row(0)->rubros_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->rubros_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->rubros_created_at = $this->basicrud->formatDateToHuman($row->rubros_created_at);
					$row->rubros_updated_at = $this->basicrud->formatDateToHuman($row->rubros_updated_at);
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
		$fields[]='rubros_id';
		$fields[]='rubros_descripcion';
		$fields[]='rubros_estado';
		$fields[]='rubros_estado_descripcion';
		$fields[]='rubros_created_at';
		$fields[]='rubros_updated_at';
		return $fields;
	}

}