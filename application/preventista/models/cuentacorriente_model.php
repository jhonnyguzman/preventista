<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cuentacorriente_Model extends CI_Model {

	private $arr_log = array('search' => 'cuentacorriente_');

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
		$this->db->insert('cuentacorriente', $options);

		$this->arr_log['new_id'] = $this->db->insert_id();
		$this->arr_log['string'] = $this->db->last_query();
		
		//log query
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
		if(isset($options['clientes_id']))
			$this->db->set('clientes_id', $options['clientes_id']);
		if(isset($options['cuentacorriente_haber']))
			$this->db->set('cuentacorriente_haber', $options['cuentacorriente_haber']);
		if(isset($options['cuentacorriente_debe']))
			$this->db->set('cuentacorriente_debe', $options['cuentacorriente_debe']);
		if(isset($options['cuentacorriente_saldo']))
			$this->db->set('cuentacorriente_saldo', $options['cuentacorriente_saldo']);
		if(isset($options['cuentacorriente_created_at']))
			$this->db->set('cuentacorriente_created_at', $options['cuentacorriente_created_at']);
		if(isset($options['cuentacorriente_updated_at']))
			$this->db->set('cuentacorriente_updated_at', $options['cuentacorriente_updated_at']);

		if(isset($options['cuentacorriente_id']))
			$this->db->where('cuentacorriente_id', $options['cuentacorriente_id']);
		if(isset($options['clientes_id']))
			$this->db->where('clientes_id', $options['clientes_id']);

		$this->db->update('cuentacorriente');

		//log query
		$this->arr_log['string'] = $this->db->last_query();
		$this->basicrud->writeFileLog($this->basicrud->writeEditSqlToLog($this->arr_log));

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $cuentacorriente_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($cuentacorriente_id)
	{
		//code here
		$this->db->where('cuentacorriente_id', $cuentacorriente_id);
		$this->db->delete('cuentacorriente');

		//log query
		$this->arr_log['string'] = $this->db->last_query();
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
		if(isset($options['cuentacorriente_id']))
			$this->db->where('cc.cuentacorriente_id', $options['cuentacorriente_id']);
		if(isset($options['clientes_id']))
			$this->db->where('cc.clientes_id', $options['clientes_id']);
		if(isset($options['cuentacorriente_haber']))
			$this->db->where('cc.cuentacorriente_haber', $options['cuentacorriente_haber']);
		if(isset($options['cuentacorriente_debe']))
			$this->db->where('cc.cuentacorriente_debe', $options['cuentacorriente_debe']);
		if(isset($options['cuentacorriente_saldo']))
			$this->db->where('cc.cuentacorriente_saldo', $options['cuentacorriente_saldo']);
		if(isset($options['cuentacorriente_created_at']))
			$this->db->where('cc.cuentacorriente_created_at', $options['cuentacorriente_created_at']);
		if(isset($options['cuentacorriente_updated_at']))
			$this->db->where('cc.cuentacorriente_updated_at', $options['cuentacorriente_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("cc.*, c.clientes_apellido, c.clientes_nombre, CONCAT(c.clientes_apellido,' ',c.clientes_nombre) AS clientes_apellnom", false);
		$this->db->from("cuentacorriente as cc");
		$this->db->join("clientes as c","c.clientes_id = cc.clientes_id");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['cuentacorriente_id']) && $flag==1){
				$query->row(0)->cuentacorriente_created_at = $this->basicrud->formatDateToHuman($query->row(0)->cuentacorriente_created_at);
				$query->row(0)->cuentacorriente_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->cuentacorriente_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->cuentacorriente_created_at = $this->basicrud->formatDateToHuman($row->cuentacorriente_created_at);
					$row->cuentacorriente_updated_at = $this->basicrud->formatDateToHuman($row->cuentacorriente_updated_at);
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
		$fields[]='cuentacorriente_id';
		$fields[]='clientes_id';
		$fields[]='clientes_apellido';
		$fields[]='clientes_nombre';
		$fields[]='clientes_apellnom';
		$fields[]='cuentacorriente_haber';
		$fields[]='cuentacorriente_debe';
		$fields[]='cuentacorriente_saldo';
		$fields[]='cuentacorriente_created_at';
		$fields[]='cuentacorriente_updated_at';
		return $fields;
	}

}