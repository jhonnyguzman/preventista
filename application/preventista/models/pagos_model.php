<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagos_Model extends CI_Model {

	private $arr_log = array('search' => 'pagos_');

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
		$this->db->insert('pagos', $options);

		//log query
		$this->arr_log['new_id'] = $this->db->insert_id();
		$this->arr_log['string'] = $this->db->last_query();
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
		if(isset($options['pagos_monto']))
			$this->db->set('pagos_monto', $options['pagos_monto']);
		if(isset($options['clientes_id']))
			$this->db->set('clientes_id', $options['clientes_id']);
		if(isset($options['usuarios_id']))
			$this->db->set('usuarios_id', $options['usuarios_id']);
		if(isset($options['pagos_estado']))
			$this->db->set('pagos_estado', $options['pagos_estado']);
		if(isset($options['pagos_fechaingreso']))
			$this->db->set('pagos_fechaingreso', $options['pagos_fechaingreso']);
		if(isset($options['pagos_created_at']))
			$this->db->set('pagos_created_at', $options['pagos_created_at']);
		if(isset($options['pagos_updated_at']))
			$this->db->set('pagos_updated_at', $options['pagos_updated_at']);

		$this->db->where('pagos_id', $options['pagos_id']);

		$this->db->update('pagos');

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
	 * @param  integer $pagos_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($pagos_id)
	{
		//code here
		$this->db->where('pagos_id', $pagos_id);
		$this->db->delete('pagos');

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
		if(isset($options['pagos_id']))
			$this->db->where('r.pagos_id', $options['pagos_id']);
		if(isset($options['pagos_monto']))
			$this->db->where('r.pagos_monto', $options['pagos_monto']);
		if(isset($options['clientes_id']))
			$this->db->where('r.clientes_id', $options['clientes_id']);
		if(isset($options['usuarios_id']))
			$this->db->where('r.usuarios_id', $options['usuarios_id']);
		if(isset($options['pagos_estado']))
			$this->db->where('r.pagos_estado', $options['pagos_estado']);
		if(isset($options['pagos_fechaingreso'])){
			$string = "CAST(r.pagos_fechaingreso AS DATE) = '".$this->basicrud->getFormatDateToBD($options['pagos_fechaingreso'])."'";
			$this->db->where($string);
		}
		if(isset($options['pagos_created_at']))
			$this->db->where('r.pagos_created_at', $options['pagos_created_at']);
		if(isset($options['pagos_updated_at']))
			$this->db->where('r.pagos_updated_at', $options['pagos_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("r.*, c.clientes_apellido, c.clientes_nombre, CONCAT(c.clientes_apellido,' ',c.clientes_nombre) AS clientes_apellnom,
		 u.usuarios_username", false);
		$this->db->from("pagos as r");
		$this->db->join("clientes as c", "c.clientes_id = r.clientes_id",'left');
		$this->db->join("usuarios as u", "u.usuarios_id = r.usuarios_id", 'left');

		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['pagos_id']) && $flag==1){
				$query->row(0)->pagos_fechaingreso = $this->basicrud->formatDateToHuman($query->row(0)->pagos_fechaingreso);
				$query->row(0)->pagos_created_at = $this->basicrud->formatDateToHuman($query->row(0)->pagos_created_at);
				$query->row(0)->pagos_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->pagos_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->pagos_fechaingreso = $this->basicrud->formatDateToHuman($row->pagos_fechaingreso);
					$row->pagos_created_at = $this->basicrud->formatDateToHuman($row->pagos_created_at);
					$row->pagos_updated_at = $this->basicrud->formatDateToHuman($row->pagos_updated_at);
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
		$fields[]='pagos_id';
		$fields[]='pagos_monto';
		$fields[]='clientes_id';
		$fields[]='clientes_apellido';
		$fields[]='clientes_nombre';
		$fields[]='clientes_apellnom';
		$fields[]='usuarios_id';
		$fields[]='usuarios_username';
		$fields[]='pagos_estado';
		$fields[]='pagos_fechaingreso';
		$fields[]='pagos_created_at';
		$fields[]='pagos_updated_at';
		return $fields;
	}



	/**
	 * Esta funcion obtiene los datos de la tabla 'pagos' para luego ser cargados  
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
		$query = $this->db->get('pagos');
		return $query->result();
	}



	/**
	 * Esta función obtiene los nombres de los campos de la 
	 * tabla pagos con el proposito de que los datos de esta tabla
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
		$fields[]='pagos_id';
		$fields[]='pagos_monto';
		$fields[]='clientes_id';
		$fields[]='usuarios_id';
		$fields[]='pagos_estado';
		$fields[]='pagos_fechaingreso';
		$fields[]='pagos_created_at';
		$fields[]='pagos_updated_at';
		return $fields;
	}
}