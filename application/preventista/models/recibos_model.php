<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recibos_Model extends CI_Model {

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
		$this->db->insert('recibos', $options);
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
		if(isset($options['recibos_monto']))
			$this->db->set('recibos_monto', $options['recibos_monto']);
		if(isset($options['clientes_id']))
			$this->db->set('clientes_id', $options['clientes_id']);
		if(isset($options['usuarios_id']))
			$this->db->set('usuarios_id', $options['usuarios_id']);
		if(isset($options['recibos_estado']))
			$this->db->set('recibos_estado', $options['recibos_estado']);
		if(isset($options['recibos_fechaingreso']))
			$this->db->set('recibos_fechaingreso', $options['recibos_fechaingreso']);
		if(isset($options['recibos_created_at']))
			$this->db->set('recibos_created_at', $options['recibos_created_at']);
		if(isset($options['recibos_updated_at']))
			$this->db->set('recibos_updated_at', $options['recibos_updated_at']);

		$this->db->where('recibos_id', $options['recibos_id']);

		$this->db->update('recibos');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $recibos_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($recibos_id)
	{
		//code here
		$this->db->where('recibos_id', $recibos_id);
		$this->db->delete('recibos');
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
		if(isset($options['recibos_id']))
			$this->db->where('r.recibos_id', $options['recibos_id']);
		if(isset($options['recibos_monto']))
			$this->db->where('r.recibos_monto', $options['recibos_monto']);
		if(isset($options['clientes_id']))
			$this->db->where('r.clientes_id', $options['clientes_id']);
		if(isset($options['usuarios_id']))
			$this->db->where('r.usuarios_id', $options['usuarios_id']);
		if(isset($options['recibos_estado']))
			$this->db->where('r.recibos_estado', $options['recibos_estado']);
		if(isset($options['recibos_fechaingreso'])){
			$string = "CAST(r.recibos_fechaingreso AS DATE) = '".$this->basicrud->getFormatDateToBD($options['recibos_fechaingreso'])."'";
			$this->db->where($string);
		}
		if(isset($options['recibos_created_at']))
			$this->db->where('r.recibos_created_at', $options['recibos_created_at']);
		if(isset($options['recibos_updated_at']))
			$this->db->where('r.recibos_updated_at', $options['recibos_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("r.*, c.clientes_apellido, c.clientes_nombre, CONCAT(c.clientes_apellido,' ',c.clientes_nombre) AS clientes_apellnom,
		 u.usuarios_username, tg.tabgral_descripcion as recibos_estado_descripcion", false);
		$this->db->from("recibos as r");
		$this->db->join("clientes as c", "c.clientes_id = r.clientes_id",'left');
		$this->db->join("usuarios as u", "u.usuarios_id = r.usuarios_id", 'left');
		$this->db->join("tabgral as tg", "tg.tabgral_id = r.recibos_estado");

		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['recibos_id']) && $flag==1){
				$query->row(0)->recibos_fechaingreso = $this->basicrud->formatDateToHuman($query->row(0)->recibos_fechaingreso);
				$query->row(0)->recibos_created_at = $this->basicrud->formatDateToHuman($query->row(0)->recibos_created_at);
				$query->row(0)->recibos_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->recibos_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->recibos_fechaingreso = $this->basicrud->formatDateToHuman($row->recibos_fechaingreso);
					$row->recibos_created_at = $this->basicrud->formatDateToHuman($row->recibos_created_at);
					$row->recibos_updated_at = $this->basicrud->formatDateToHuman($row->recibos_updated_at);
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
		$fields[]='recibos_id';
		$fields[]='recibos_monto';
		$fields[]='clientes_id';
		$fields[]='clientes_apellido';
		$fields[]='clientes_nombre';
		$fields[]='clientes_apellnom';
		$fields[]='usuarios_id';
		$fields[]='usuarios_username';
		$fields[]='recibos_estado';
		$fields[]='recibos_estado_descripcion';
		$fields[]='recibos_fechaingreso';
		$fields[]='recibos_created_at';
		$fields[]='recibos_updated_at';
		return $fields;
	}

}