<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fleteros_Model extends CI_Model {

	private $arr_log = array('search' => 'fleteros_');

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
		$this->db->insert('fleteros', $options);

		//log query
		$this->arr_log['new_id'] = $this->db->insert_id();
		$this->arr_log['string'] = $this->db->last_query();
		$this->basicrud->writeFileLog($this->basicrud->writeAddSqlToLogPedidos($this->arr_log));

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
		if(isset($options['fleteros_nombre']))
			$this->db->set('fleteros_nombre', $options['fleteros_nombre']);
		if(isset($options['fleteros_apellido']))
			$this->db->set('fleteros_apellido', $options['fleteros_apellido']);
		if(isset($options['fleteros_telefono']))
			$this->db->set('fleteros_telefono', $options['fleteros_telefono']);
		if(isset($options['fleteros_direccion']))
			$this->db->set('fleteros_direccion', $options['fleteros_direccion']);
		if(isset($options['fleteros_created_at']))
			$this->db->set('fleteros_created_at', $options['fleteros_created_at']);
		if(isset($options['fleteros_updated_at']))
			$this->db->set('fleteros_updated_at', $options['fleteros_updated_at']);

		$this->db->where('fleteros_id', $options['fleteros_id']);
		$this->db->update('fleteros');

		//log query
		$this->arr_log['string'] = $this->db->last_query();
		$this->basicrud->writeFileLog($this->basicrud->writeEditSqlToLogPedidos($this->arr_log));

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $fleteros_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($fleteros_id)
	{
		//code here
		$this->db->where('fleteros_id', $fleteros_id);
		$this->db->delete('fleteros');

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
		if(isset($options['fleteros_id']))
			$this->db->where('fleteros_id', $options['fleteros_id']);
		if(isset($options['fleteros_nombre']))
			$this->db->like('fleteros_nombre', $options['fleteros_nombre']);
		if(isset($options['fleteros_apellido']))
			$this->db->like('fleteros_apellido', $options['fleteros_apellido']);
		if(isset($options['fleteros_telefono']))
			$this->db->like('fleteros_telefono', $options['fleteros_telefono']);
		if(isset($options['fleteros_direccion']))
			$this->db->like('fleteros_direccion', $options['fleteros_direccion']);
		if(isset($options['fleteros_created_at']))
			$this->db->where('fleteros_created_at', $options['fleteros_created_at']);
		if(isset($options['fleteros_updated_at']))
			$this->db->where('fleteros_updated_at', $options['fleteros_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$query = $this->db->get('fleteros');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['fleteros_id']) && $flag==1){
				$query->row(0)->fleteros_created_at = $this->basicrud->formatDateToHuman($query->row(0)->fleteros_created_at);
				$query->row(0)->fleteros_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->fleteros_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->fleteros_created_at = $this->basicrud->formatDateToHuman($row->fleteros_created_at);
					$row->fleteros_updated_at = $this->basicrud->formatDateToHuman($row->fleteros_updated_at);
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
		$fields[]='fleteros_id';
		$fields[]='fleteros_nombre';
		$fields[]='fleteros_apellido';
		$fields[]='fleteros_telefono';
		$fields[]='fleteros_direccion';
		$fields[]='fleteros_created_at';
		$fields[]='fleteros_updated_at';
		return $fields;
	}



	/**
	 * Esta funcion obtiene los datos de la tabla 'fleteros' para luego ser cargados  
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
		$query = $this->db->get('fleteros');
		return $query->result();
	}



	/**
	 * Esta función obtiene los nombres de los campos de la 
	 * tabla fleteros con el proposito de que los datos de esta tabla
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
		$fields[]='fleteros_id';
		$fields[]='fleteros_nombre';
		$fields[]='fleteros_apellido';
		$fields[]='fleteros_telefono';
		$fields[]='fleteros_direccion';
		$fields[]='fleteros_created_at';
		$fields[]='fleteros_updated_at';
		return $fields;
	}
}