<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Articulos_Model extends CI_Model {

	private $arr_log = array('search' => 'articulos_');

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
		$this->db->insert('articulos', $options);

		$this->arr_log['new_id'] = $this->db->insert_id();
		$this->arr_log['string'] = $this->db->last_query();

		//log query
		log_message("info", "Row insert successfull: ".$this->db->last_query());
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
		if(isset($options['articulos_descripcion']))
			$this->db->set('articulos_descripcion', $options['articulos_descripcion']);
		if(isset($options['articulos_preciocompra']))
			$this->db->set('articulos_preciocompra', $options['articulos_preciocompra']);
		if(isset($options['articulos_stockreal']))
			$this->db->set('articulos_stockreal', $options['articulos_stockreal']);
		if(isset($options['articulos_stockmin']))
			$this->db->set('articulos_stockmin', $options['articulos_stockmin']);
		if(isset($options['articulos_stockmax']))
			$this->db->set('articulos_stockmax', $options['articulos_stockmax']);
		if(isset($options['rubros_id']))
			$this->db->set('rubros_id', $options['rubros_id']);
		if(isset($options['articulos_observaciones']))
			$this->db->set('articulos_observaciones', $options['articulos_observaciones']);
		if(isset($options['articulos_precio1']))
			$this->db->set('articulos_precio1', $options['articulos_precio1']);
		if(isset($options['articulos_precio2']))
			$this->db->set('articulos_precio2', $options['articulos_precio2']);
		if(isset($options['articulos_precio3']))
			$this->db->set('articulos_precio3', $options['articulos_precio3']);
		if(isset($options['articulos_porcentaje1']))
			$this->db->set('articulos_porcentaje1', $options['articulos_porcentaje1']);
		if(isset($options['articulos_porcentaje2']))
			$this->db->set('articulos_porcentaje2', $options['articulos_porcentaje2']);
		if(isset($options['articulos_porcentaje3']))
			$this->db->set('articulos_porcentaje3', $options['articulos_porcentaje3']);
		if(isset($options['articulos_estado']))
			$this->db->set('articulos_estado', $options['articulos_estado']);
		if(isset($options['marcas_id']))
			$this->db->set('marcas_id', $options['marcas_id']);
		if(isset($options['articulos_created_at']))
			$this->db->set('articulos_created_at', $options['articulos_created_at']);
		if(isset($options['articulos_updated_at']))
			$this->db->set('articulos_updated_at', $options['articulos_updated_at']);

		$this->db->where('articulos_id', $options['articulos_id']);

		$this->db->update('articulos');

		//log query
		$this->arr_log['string'] = $this->db->last_query();
		log_message("info", "Row update successfull: ".$this->basicrud->writeEditSqlToLog($this->arr_log));
		$this->basicrud->writeFileLog($this->basicrud->writeEditSqlToLog($this->arr_log));

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $articulos_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($articulos_id)
	{
		//code here
		$this->db->where('articulos_id', $articulos_id);
		$this->db->delete('articulos');

		//log query
		$this->arr_log['string'] = $this->db->last_query();
		log_message("info", "Row delete successfull: ".$this->basicrud->writeDeleteSqlToLog($this->arr_log));
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
		if(isset($options['articulos_id']))
			$this->db->where('a.articulos_id', $options['articulos_id']);
		if(isset($options['articulos_descripcion']))
			$this->db->like('a.articulos_descripcion', $options['articulos_descripcion'],'after');
		if(isset($options['articulos_preciocompra']))
			$this->db->where('a.articulos_preciocompra', $options['articulos_preciocompra']);
		if(isset($options['articulos_stockreal']))
			$this->db->where('a.articulos_stockreal', $options['articulos_stockreal']);
		if(isset($options['articulos_stockmin']))
			$this->db->where('a.articulos_stockmin', $options['articulos_stockmin']);
		if(isset($options['articulos_stockmax']))
			$this->db->where('a.articulos_stockmax', $options['articulos_stockmax']);
		if(isset($options['rubros_id']))
			$this->db->where('a.rubros_id', $options['rubros_id']);
		if(isset($options['articulos_observaciones']))
			$this->db->like('a.articulos_observaciones', $options['articulos_observaciones']);
		if(isset($options['articulos_precio1']))
			$this->db->where('a.articulos_precio1', $options['articulos_precio1']);
		if(isset($options['articulos_precio2']))
			$this->db->where('a.articulos_precio2', $options['articulos_precio2']);
		if(isset($options['articulos_precio3']))
			$this->db->where('a.articulos_precio3', $options['articulos_precio3']);
		if(isset($options['articulos_porcentaje1']))
			$this->db->where('a.articulos_porcentaje1', $options['articulos_porcentaje1']);
		if(isset($options['articulos_porcentaje2']))
			$this->db->where('a.articulos_porcentaje2', $options['articulos_porcentaje2']);
		if(isset($options['articulos_porcentaje3']))
			$this->db->where('a.articulos_porcentaje3', $options['articulos_porcentaje3']);
		if(isset($options['articulos_estado']))
			$this->db->where('a.articulos_estado', $options['articulos_estado']);
		if(isset($options['marcas_id']))
			$this->db->where('a.marcas_id', $options['marcas_id']);
		if(isset($options['articulos_created_at']))
			$this->db->where('a.articulos_created_at', $options['articulos_created_at']);
		if(isset($options['articulos_updated_at']))
			$this->db->where('a.articulos_updated_at', $options['articulos_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);
		$this->db->select("a.*, r.rubros_descripcion, m.marcas_descripcion, tabgral_descripcion as articulos_estado_descripcion");
		$this->db->from("articulos as a");
		$this->db->join("marcas as m","m.marcas_id = a.marcas_id");
		$this->db->join("rubros as r","r.rubros_id = a.rubros_id");
		$this->db->join("tabgral as tg","tg.tabgral_id = a.articulos_estado");
		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['articulos_id']) && $flag==1){
				$query->row(0)->articulos_created_at = $this->basicrud->formatDateToHuman($query->row(0)->articulos_created_at);
				$query->row(0)->articulos_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->articulos_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->articulos_created_at = $this->basicrud->formatDateToHuman($row->articulos_created_at);
					$row->articulos_updated_at = $this->basicrud->formatDateToHuman($row->articulos_updated_at);
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
		$fields[]='articulos_id';
		$fields[]='articulos_descripcion';
		$fields[]='rubros_id';
		$fields[]='rubros_descripcion';
		$fields[]='marcas_id';
		$fields[]='marcas_descripcion';
		$fields[]='articulos_preciocompra';
		$fields[]='articulos_stockreal';
		$fields[]='articulos_stockmin';
		$fields[]='articulos_stockmax';
		$fields[]='articulos_observaciones';
		$fields[]='articulos_precio1';
		$fields[]='articulos_precio2';
		$fields[]='articulos_precio3';
		$fields[]='articulos_porcentaje1';
		$fields[]='articulos_porcentaje2';
		$fields[]='articulos_porcentaje3';
		$fields[]='articulos_estado';
		$fields[]='articulos_estado_descripcion';
		$fields[]='articulos_created_at';
		$fields[]='articulos_updated_at';
		return $fields;
	}


	/**
	 * Esta función actualiza el stock cuando se ingresa un nuevo pedido y
	 * cuando se eliminar un pedido
	 *
	 * @access public
	 * @param array fields of the table
	 * @return integer or boolean affected rows
	 */
	function editstock_m($options = array())
	{
		$this->db->set('articulos_stockreal', "articulos_stockreal ".$options['operacion']." ".$options['cantidad']."", FALSE);
		$this->db->where('articulos_id', $options['articulos_id']);
		
		$this->db->update('articulos');

		// gives INSERT INTO mytable (field) VALUES (field+1)

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return false;
	}



	/**
	 * Esta función actualiza el stock de un articulo en el que caso de que haya sido modificado 
	 * en una linea de pedido
	 *
	 * @access public
	 * @param array fields of the table
	 * @return integer or boolean affected rows
	 */
	function editstock2_m($options = array())
	{
		$descuento = $options['cantidad'] - $options['cantidad_old'];
		$operacion = $options['operacion'];

		$this->db->set('articulos_stockreal', "articulos_stockreal ".$operacion." (".$descuento.")", FALSE);
		$this->db->where('articulos_id', $options['articulos_id']);
		
		$this->db->update('articulos');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}
}