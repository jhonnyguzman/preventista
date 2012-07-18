<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hojaruta_Model extends CI_Model {

	private $arr_log = array('search' => 'hojaruta_');

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
		$this->db->insert('hojaruta', $options);

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
		if(isset($options['fleteros_id']))
			$this->db->set('fleteros_id', $options['fleteros_id']);
		if(isset($options['usuarios_id']))
			$this->db->set('usuarios_id', $options['usuarios_id']);
		if(isset($options['hojaruta_estado']))
			$this->db->set('hojaruta_estado', $options['hojaruta_estado']);
		if(isset($options['hojaruta_created_at']))
			$this->db->set('hojaruta_created_at', $options['hojaruta_created_at']);
		if(isset($options['hojaruta_updated_at']))
			$this->db->set('hojaruta_updated_at', $options['hojaruta_updated_at']);

		$this->db->where('hojaruta_id', $options['hojaruta_id']);

		$this->db->update('hojaruta');

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
	 * @param  integer $hojaruta_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($hojaruta_id)
	{
		//code here
		$this->db->where('hojaruta_id', $hojaruta_id);
		$this->db->delete('hojaruta');

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
		if(isset($options['hojaruta_id']))
			$this->db->where('h.hojaruta_id', $options['hojaruta_id']);
		if(isset($options['fleteros_id']))
			$this->db->where('h.fleteros_id', $options['fleteros_id']);
		if(isset($options['usuarios_id']))
			$this->db->where('h.usuarios_id', $options['usuarios_id']);
		if(isset($options['hojaruta_estado']))
			$this->db->where('h.hojaruta_estado', $options['hojaruta_estado']);
		if(isset($options['hojaruta_created_at'])){
			$string = "CAST(h.hojaruta_created_at AS DATE) = '".$this->basicrud->getFormatDateToBD($options['hojaruta_created_at'])."'";
			$this->db->where($string);
		}
		if(isset($options['hojaruta_updated_at']))
			$this->db->where('h.hojaruta_updated_at', $options['hojaruta_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("h.*, f.fleteros_apellido, f.fleteros_nombre, CONCAT(f.fleteros_apellido,' ',f.fleteros_nombre) AS fleteros_apellnom,
		 u.usuarios_username, tg.tabgral_descripcion as hojaruta_estado_descripcion", false);
		$this->db->from("hojaruta as h");
		$this->db->join("fleteros as f","f.fleteros_id = h.fleteros_id");
		$this->db->join("usuarios as u","u.usuarios_id = h.usuarios_id");
		$this->db->join("tabgral as tg","tg.tabgral_id = h.hojaruta_estado");

		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['hojaruta_id']) && $flag==1){
				$query->row(0)->hojaruta_created_at = $this->basicrud->formatDateToHuman($query->row(0)->hojaruta_created_at);
				$query->row(0)->hojaruta_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->hojaruta_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->hojaruta_created_at = $this->basicrud->formatDateToHuman($row->hojaruta_created_at);
					$row->hojaruta_updated_at = $this->basicrud->formatDateToHuman($row->hojaruta_updated_at);
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
		$fields[]='hojaruta_id';
		$fields[]='fleteros_id';
		$fields[]='hojaruta_estado';
		$fields[]='hojaruta_estado_descripcion';	
		$fields[]='fleteros_apellido';
		$fields[]='fleteros_nombre';
		$fields[]='fleteros_apellnom';
		$fields[]='usuarios_id';
		$fields[]='usuarios_username';
		$fields[]='hojaruta_created_at';
		$fields[]='hojaruta_updated_at';
		return $fields;
	}


	/**
	 * Esta funcion obtiene los datos de la tabla 'hojaruta' para luego ser cargados  
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
		$query = $this->db->get('hojaruta');
		return $query->result();
	}



	/**
	 * Esta función obtiene los nombres de los campos de la 
	 * tabla hojaruta con el proposito de que los datos de esta tabla
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
		$fields[]='hojaruta_id';
		$fields[]='fleteros_id';
		$fields[]='usuarios_id';
		$fields[]='hojaruta_estado';
		$fields[]='hojaruta_created_at';
		$fields[]='hojaruta_updated_at';
		return $fields;
	}
}