<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hojarutadetalle_Model extends CI_Model {

	private $arr_log = array('search' => 'hojarutadetalle_');

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
		$this->db->insert('hojarutadetalle', $options);

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
		if(isset($options['hojaruta_id']))
			$this->db->set('hojaruta_id', $options['hojaruta_id']);
		if(isset($options['pedidos_id']))
			$this->db->set('pedidos_id', $options['pedidos_id']);
		if(isset($options['hojarutadetalle_created_at']))
			$this->db->set('hojarutadetalle_created_at', $options['hojarutadetalle_created_at']);
		if(isset($options['hojarutadetalle_updated_at']))
			$this->db->set('hojarutadetalle_updated_at', $options['hojarutadetalle_updated_at']);

		$this->db->where('hojarutadetalle_id', $options['hojarutadetalle_id']);

		$this->db->update('hojarutadetalle');
		
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
	 * @param  integer $hojarutadetalle_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($hojarutadetalle_id)
	{
		//code here
		$this->db->where('hojarutadetalle_id', $hojarutadetalle_id);
		$this->db->delete('hojarutadetalle');

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
		if(isset($options['hojarutadetalle_id']))
			$this->db->where('hojarutadetalle_id', $options['hojarutadetalle_id']);
		if(isset($options['hojaruta_id']))
			$this->db->where('hojaruta_id', $options['hojaruta_id']);
		if(isset($options['pedidos_id']))
			$this->db->where('pedidos_id', $options['pedidos_id']);
		if(isset($options['hojarutadetalle_created_at']))
			$this->db->where('hojarutadetalle_created_at', $options['hojarutadetalle_created_at']);
		if(isset($options['hojarutadetalle_updated_at']))
			$this->db->where('hojarutadetalle_updated_at', $options['hojarutadetalle_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("hd.*, c.clientes_apellido, c.clientes_nombre, c.clientes_direccion, p.peididos_montototal, 
			p.pedidos_montoadeudado, tr.tramites_id, tr.tramites_descripcion");

		$this->db->from("hojarutadetalle as hd");
		$this->db->join("pedidos as p","p.pedidos_id = hd.pedidos_id");
		$this->db->join("tramites as tr","tr.tramites_id = p.tramites_id");
		$this->db->join("clientes as c","c.clientes_id = p.clientes_id");
		
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['hojarutadetalle_id']) && $flag==1){
				$query->row(0)->hojarutadetalle_created_at = $this->basicrud->formatDateToHuman($query->row(0)->hojarutadetalle_created_at);
				$query->row(0)->hojarutadetalle_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->hojarutadetalle_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->hojarutadetalle_created_at = $this->basicrud->formatDateToHuman($row->hojarutadetalle_created_at);
					$row->hojarutadetalle_updated_at = $this->basicrud->formatDateToHuman($row->hojarutadetalle_updated_at);
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
		$fields[]='hojarutadetalle_id';
		$fields[]='hojaruta_id';
		$fields[]='pedidos_id';
		$fields[]='tramites_id';
		$fields[]='tramites_descripcion';
		$fields[]='peididos_montototal';
		$fields[]='pedidos_montoadeudado';
		$fields[]='clientes_apellido';
		$fields[]='clientes_nombre';
		$fields[]='clientes_direccion';
		$fields[]='hojarutadetalle_created_at';
		$fields[]='hojarutadetalle_updated_at';
		return $fields;
	}



	/**
	 * Esta funcion obtiene los datos de la tabla 'hojarutadetalle' para luego ser cargados  
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
		$query = $this->db->get('hojarutadetalle');
		return $query->result();
	}



	/**
	 * Esta función obtiene los nombres de los campos de la 
	 * tabla hojarutadetalle con el proposito de que los datos de esta tabla
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
		$fields[]='hojarutadetalle_id';
		$fields[]='hojaruta_id';
		$fields[]='pedidos_id';
		$fields[]='hojarutadetalle_created_at';
		$fields[]='hojarutadetalle_updated_at';
		return $fields;
	}
}