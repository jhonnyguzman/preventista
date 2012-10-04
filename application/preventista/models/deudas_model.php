<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deudas_Model extends CI_Model {

	private $arr_log = array('search' => 'deudas_');

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
		$this->db->insert('deudas', $options);

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
		if(isset($options['deudas_montototal']))
			$this->db->set('deudas_montototal', $options['deudas_montototal']);
		if(isset($options['deudas_fecha']))
			$this->db->set('deudas_fecha', $options['deudas_fecha']);
		if(isset($options['clientes_id']))
			$this->db->set('clientes_id', $options['clientes_id']);
		if(isset($options['deudas_created_at']))
			$this->db->set('deudas_created_at', $options['deudas_created_at']);
		if(isset($options['deudas_updated_at']))
			$this->db->set('deudas_updated_at', $options['deudas_updated_at']);
		if(isset($options['usuarios_id']))
			$this->db->set('usuarios_id', $options['usuarios_id']);
		if(isset($options['deudas_estado']))
			$this->db->set('deudas_estado', $options['deudas_estado']);
		if(isset($options['deudas_montoadeudado']))
			$this->db->set('deudas_montoadeudado', $options['deudas_montoadeudado']);

		$this->db->where('deudas_id', $options['deudas_id']);

		$this->db->update('deudas');

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
	 * @param  integer $deudas_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($deudas_id)
	{
		//code here
		$this->db->where('deudas_id', $deudas_id);
		$this->db->delete('deudas');

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
		if(isset($options['deudas_id']))
			$this->db->where('d.deudas_id', $options['deudas_id']);
		if(isset($options['deudas_montototal']))
			$this->db->where('d.deudas_montototal', $options['deudas_montototal']);
		if(isset($options['deudas_fecha'])){
			$string = "CAST(d.deudas_fecha AS DATE) = '".$this->basicrud->getFormatDateToBD($options['deudas_fecha'])."'";
			$this->db->where($string);
		}
		if(isset($options['clientes_id']))
			$this->db->where('d.clientes_id', $options['clientes_id']);
		if(isset($options['deudas_created_at']))
			$this->db->where('d.deudas_created_at', $options['deudas_created_at']);
		if(isset($options['deudas_updated_at']))
			$this->db->where('d.deudas_updated_at', $options['deudas_updated_at']);
		if(isset($options['usuarios_id']))
			$this->db->where('d.usuarios_id', $options['usuarios_id']);
		if(isset($options['deudas_estado']))
			$this->db->where('d.deudas_estado', $options['deudas_estado']);
		if(isset($options['deudas_montoadeudado']))
			$this->db->where('d.deudas_montoadeudado', $options['deudas_montoadeudado']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("d.*, c.clientes_apellido, c.clientes_nombre, u.usuarios_username, tg.tabgral_descripcion as deudas_estado_descripcion");
		$this->db->from("deudas as d");
		$this->db->join("clientes as c","c.clientes_id = d.clientes_id");
		$this->db->join("usuarios as u","u.usuarios_id = d.usuarios_id");
		$this->db->join("tabgral as tg","tg.tabgral_id = d.deudas_estado");

		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['deudas_id']) && $flag==1){
				$query->row(0)->deudas_fecha = $this->basicrud->formatDateToHuman($query->row(0)->deudas_fecha);
				$query->row(0)->deudas_created_at = $this->basicrud->formatDateToHuman($query->row(0)->deudas_created_at);
				$query->row(0)->deudas_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->deudas_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->deudas_fecha = $this->basicrud->formatDateToHuman($row->deudas_fecha);
					$row->deudas_created_at = $this->basicrud->formatDateToHuman($row->deudas_created_at);
					$row->deudas_updated_at = $this->basicrud->formatDateToHuman($row->deudas_updated_at);
				}
				return $query->result();
			}
		}

	}


	/**
	 * Esta función filtra aquellas deudasa que tengan 2 estados
	 *
	 * @access public
	 * @param array fields of the table
	 * @return array  result
	 */
	function getConVariosEstados_m($options = array())
	{
		$this->db->where("clientes_id = ".$options['clientes_id']." and (deudas_estado = ".$options['deudas_estado1']." or deudas_estado = ".$options['deudas_estado2'].")");
		
		$this->db->order_by('deudas_created_at','asc');

		$query = $this->db->get('deudas');	
		return $query->result();
	}


	/**
	 * Esta función calcula el haber de un cliente
	 *
	 * @access public
	 * @param integer $clientes_id
	 * @return float  $monto
	 */
	function getSumDeudas1($clientes_id)
	{
		$this->db->where("clientes_id = ".$clientes_id." and (deudas_estado = 28 or deudas_estado = 27)"); //deuda estado 'Pagada' y 'Pagada parcialmente'
		$query = $this->db->get('deudas');
		$monto = 0; 

		if($query->num_rows()>0){ 
			foreach ($query->result() as $f) {
				$monto = $monto + ($f->deudas_montototal - $f->deudas_montoadeudado);
			}
		}
		return $monto;
	}


	/**
	 * Esta función calcula la deuda de un cliente
	 *
	 * @access public
	 * @param integer $clientes_id
	 * @return float  $monto
	 */
	function getSumDeudas2($clientes_id)
	{
		$this->db->where("clientes_id = ".$clientes_id." and (deudas_estado = 26 or deudas_estado = 27)"); //deuda estado 'Sin Pagar' y 'Pagada parcialmente'
		$query = $this->db->get('deudas');
		$monto = 0; 

		if($query->num_rows()>0){ 
			foreach ($query->result() as $f) {
				$monto = $monto + $f->deudas_montoadeudado;
			}
		}
		return $monto;
	}



	/**
	 * Esta función calcula la deuda de un cliente
	 * Es usada al momento de imprimir los remitos de cada hoja
	 * de ruta
	 *
	 * @access public
	 * @param integer $clientes_id
	 * @return float  $monto
	 */
	function getSumDeudas3($clientes_id, $fecha)
	{	
		//filtrar todas las deudas con estado 'Sin pagar' y 'Parcialmente pagada'
		$this->db->where("clientes_id = ".$clientes_id." and 
			(deudas_estado = 26 or deudas_estado = 27) and CAST(deudas_fecha AS DATE) <= CAST('".$fecha."' as DATE)");
		$query = $this->db->get('deudas');
		$monto = 0; 

		if($query->num_rows()>0){ 
			foreach ($query->result() as $f) {	
				$monto = $monto + $f->deudas_montoadeudado;

			}
		}
		return $monto;
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
		$fields[]='deudas_id';
		$fields[]='deudas_montototal';
		$fields[]='deudas_fecha';
		$fields[]='clientes_id';
		$fields[]='clientes_apellido';
		$fields[]='clientes_nombre';
		$fields[]='deudas_created_at';
		$fields[]='deudas_updated_at';
		$fields[]='usuarios_id';
		$fields[]='usuarios_username';
		$fields[]='deudas_estado';
		$fields[]='deudas_estado_descripcion';
		$fields[]='deudas_montoadeudado';
		return $fields;
	}



	/**
	 * Esta funcion obtiene los datos de la tabla 'deudas' para luego ser cargados  
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
		$query = $this->db->get('deudas');
		return $query->result();
	}



	/**
	 * Esta función obtiene los nombres de los campos de la 
	 * tabla deudas con el proposito de que los datos de esta tabla
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
		$fields[]='deudas_id';
		$fields[]='deudas_montototal';
		$fields[]='deudas_fecha';
		$fields[]='clientes_id';
		$fields[]='deudas_created_at';
		$fields[]='deudas_updated_at';
		$fields[]='usuarios_id';
		$fields[]='deudas_estado';
		$fields[]='deudas_montoadeudado';
		return $fields;
	}
}