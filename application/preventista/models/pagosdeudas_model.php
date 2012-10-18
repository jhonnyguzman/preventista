<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagosdeudas_Model extends CI_Model {

	private $arr_log = array('search' => 'pagosdeudas_');

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
		$this->db->insert('pagosdeudas', $options);

		//log query
		$this->arr_log['new_id'] = $this->db->insert_id();
		$this->arr_log['string'] = $this->db->last_query();
		$this->basicrud->writeFileLog($this->basicrud->writeAddSqlToLogWithoutId($this->arr_log));

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
		if(isset($options['deudas_id']))
			$this->db->set('deudas_id', $options['deudas_id']);
		if(isset($options['pagos_id']))
			$this->db->set('pagos_id', $options['pagos_id']);
		if(isset($options['pagosdeudas_montocubierto']))
			$this->db->set('pagosdeudas_montocubierto', $options['pagosdeudas_montocubierto']);
		if(isset($options['pagosdeudas_created_at']))
			$this->db->set('pagosdeudas_created_at', $options['pagosdeudas_created_at']);
		if(isset($options['pagosdeudas_updated_at']))
			$this->db->set('pagosdeudas_updated_at', $options['pagosdeudas_updated_at']);

		$this->db->where('pagosdeudas_id', $options['pagosdeudas_id']);

		$this->db->update('pagosdeudas');

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
	 * @param  integer $pagosdeudas_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($pagosdeudas_id)
	{
		//code here
		$this->db->where('pagosdeudas_id', $pagosdeudas_id);
		$this->db->delete('pagosdeudas');

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
		if(isset($options['pagosdeudas_id']))
			$this->db->where('pagosdeudas_id', $options['pagosdeudas_id']);
		if(isset($options['deudas_id']))
			$this->db->where('deudas_id', $options['deudas_id']);
		if(isset($options['pagos_id']))
			$this->db->where('pagos_id', $options['pagos_id']);
		if(isset($options['pagosdeudas_montocubierto']))
			$this->db->where('pagosdeudas_montocubierto', $options['pagosdeudas_montocubierto']);
		if(isset($options['pagosdeudas_created_at']))
			$this->db->where('pagosdeudas_created_at', $options['pagosdeudas_created_at']);
		if(isset($options['pagosdeudas_updated_at']))
			$this->db->where('pagosdeudas_updated_at', $options['pagosdeudas_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$query = $this->db->get('pagosdeudas');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['pagosdeudas_id']) && $flag==1){
				$query->row(0)->pagosdeudas_created_at = $this->basicrud->formatDateToHuman($query->row(0)->pagosdeudas_created_at);
				$query->row(0)->pagosdeudas_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->pagosdeudas_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->pagosdeudas_created_at = $this->basicrud->formatDateToHuman($row->pagosdeudas_created_at);
					$row->pagosdeudas_updated_at = $this->basicrud->formatDateToHuman($row->pagosdeudas_updated_at);
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
		$fields[]='pagosdeudas_id';
		$fields[]='deudas_id';
		$fields[]='pagos_id';
		$fields[]='pagosdeudas_montocubierto';
		$fields[]='pagosdeudas_created_at';
		$fields[]='pagosdeudas_updated_at';
		return $fields;
	}



	/**
	 * Esta funcion obtiene los datos de la tabla 'pagosdeudas' para luego ser cargados  
	 * en la base de datos sqlite3 para el modulo 
	 * que funciona en el telefono movil
	 *
	 * @access public
	 * @param array fields of the table
	 * @param integer	flag to indicate if return one record or more of one record
	 * @return array  result
	 */
	function getMobile($options = array(),$flag=0)
	{
		//code here
		$query = $this->db->get('pagosdeudas');
		return $query->result();
	}



	/**
	 * Esta función obtiene los nombres de los campos de la 
	 * tabla pagosdeudas con el proposito de que los datos de esta tabla
	 * sean grabados correctamente en la base de datos sqlite3 que 
	 * funciona en el telefono movil
	 *
	 * @access public
	 * @return array  fields of table
	 */
	function getFieldsMobile_m()
	{
		//code here
		$fields=array();
		$fields[]='pagosdeudas_id';
		$fields[]='deudas_id';
		$fields[]='pagos_id';
		$fields[]='pagosdeudas_montocubierto';
		$fields[]='pagosdeudas_created_at';
		$fields[]='pagosdeudas_updated_at';
		return $fields;
	}

}