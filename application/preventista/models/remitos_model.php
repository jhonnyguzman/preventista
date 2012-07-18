<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Remitos_Model extends CI_Model {

	private $arr_log = array('search' => 'remitos_');

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
		$this->db->insert('remitos', $options);

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
		if(isset($options['hojarutadetalle_id']))
			$this->db->set('hojarutadetalle_id', $options['hojarutadetalle_id']);
		if(isset($options['remitos_estado']))
			$this->db->set('remitos_estado', $options['remitos_estado']);
		if(isset($options['remitos_created_at']))
			$this->db->set('remitos_created_at', $options['remitos_created_at']);
		if(isset($options['remitos_updated_at']))
			$this->db->set('remitos_updated_at', $options['remitos_updated_at']);

		$this->db->where('remitos_id', $options['remitos_id']);

		$this->db->update('remitos');

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
	 * @param  integer $remitos_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($remitos_id)
	{
		//code here
		$this->db->where('remitos_id', $remitos_id);
		$this->db->delete('remitos');

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
		if(isset($options['remitos_id']))
			$this->db->where('r.remitos_id', $options['remitos_id']);
		if(isset($options['hojarutadetalle_id']))
			$this->db->where('r.hojarutadetalle_id', $options['hojarutadetalle_id']);
		if(isset($options['remitos_estado']))
			$this->db->where('r.remitos_estado', $options['remitos_estado']);
		if(isset($options['remitos_created_at']))
			$this->db->where('r.remitos_created_at', $options['remitos_created_at']);
		if(isset($options['remitos_updated_at']))
			$this->db->where('r.remitos_updated_at', $options['remitos_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("r.*,r.remitos_created_at as remitos_created_at_without_format, 
			hd.pedidos_id, tg.tabgral_descripcion as remitos_estado_descripcion");
		$this->db->from("remitos as r");
		$this->db->join("hojarutadetalle as hd", "hd.hojarutadetalle_id = r.hojarutadetalle_id");
		$this->db->join("tabgral as tg","tg.tabgral_id = r.remitos_estado");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['remitos_id']) && $flag==1){
				$query->row(0)->remitos_created_at = $this->basicrud->formatDateToHuman($query->row(0)->remitos_created_at);
				$query->row(0)->remitos_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->remitos_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->remitos_created_at = $this->basicrud->formatDateToHuman($row->remitos_created_at);
					$row->remitos_updated_at = $this->basicrud->formatDateToHuman($row->remitos_updated_at);
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
		$fields[]='remitos_id';
		$fields[]='pedidos_id';
		$fields[]='hojarutadetalle_id';
		$fields[]='remitos_estado';
		$fields[]='remitos_estado_descripcion';
		$fields[]='remitos_created_at';
		$fields[]='remitos_updated_at';
		return $fields;
	}


	/**
	 * Esta funcion obtiene los datos de la tabla 'remitos' para luego ser cargados  
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
		$query = $this->db->get('remitos');
		return $query->result();
	}



	/**
	 * Esta función obtiene los nombres de los campos de la 
	 * tabla remitos con el proposito de que los datos de esta tabla
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
		$fields[]='remitos_id';
		$fields[]='hojarutadetalle_id';
		$fields[]='remitos_estado';
		$fields[]='remitos_created_at';
		$fields[]='remitos_updated_at';
		return $fields;
	}
}