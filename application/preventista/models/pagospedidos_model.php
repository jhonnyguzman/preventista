<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagospedidos_Model extends CI_Model {

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
		$this->db->insert('pagospedidos', $options);
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
		if(isset($options['pedidos_id']))
			$this->db->set('pedidos_id', $options['pedidos_id']);
		if(isset($options['recibos_id']))
			$this->db->set('recibos_id', $options['recibos_id']);
		if(isset($options['pagospedidos_montocubierto']))
			$this->db->set('pagospedidos_montocubierto', $options['pagospedidos_montocubierto']);
		if(isset($options['pedidosremitos_created_at']))
			$this->db->set('pedidosremitos_created_at', $options['pedidosremitos_created_at']);
		if(isset($options['pedidosremitos_updated_at']))
			$this->db->set('pedidosremitos_updated_at', $options['pedidosremitos_updated_at']);

		$this->db->where('pagospedidos_id', $options['pagospedidos_id']);

		$this->db->update('pagospedidos');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $pagospedidos_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($pagospedidos_id)
	{
		//code here
		$this->db->where('pagospedidos_id', $pagospedidos_id);
		$this->db->delete('pagospedidos');
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
		if(isset($options['pagospedidos_id']))
			$this->db->where('pagospedidos_id', $options['pagospedidos_id']);
		if(isset($options['pedidos_id']))
			$this->db->where('pedidos_id', $options['pedidos_id']);
		if(isset($options['recibos_id']))
			$this->db->where('recibos_id', $options['recibos_id']);
		if(isset($options['pagospedidos_montocubierto']))
			$this->db->where('pagospedidos_montocubierto', $options['pagospedidos_montocubierto']);
		if(isset($options['pedidosremitos_created_at']))
			$this->db->where('pedidosremitos_created_at', $options['pedidosremitos_created_at']);
		if(isset($options['pedidosremitos_updated_at']))
			$this->db->where('pedidosremitos_updated_at', $options['pedidosremitos_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$query = $this->db->get('pagospedidos');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['pagospedidos_id']) && $flag==1){
				$query->row(0)->pedidosremitos_created_at = $this->basicrud->formatDateToHuman($query->row(0)->pedidosremitos_created_at);
				$query->row(0)->pedidosremitos_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->pedidosremitos_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->pedidosremitos_created_at = $this->basicrud->formatDateToHuman($row->pedidosremitos_created_at);
					$row->pedidosremitos_updated_at = $this->basicrud->formatDateToHuman($row->pedidosremitos_updated_at);
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
		$fields[]='pagospedidos_id';
		$fields[]='pedidos_id';
		$fields[]='recibos_id';
		$fields[]='pagospedidos_montocubierto';
		$fields[]='pedidosremitos_created_at';
		$fields[]='pedidosremitos_updated_at';
		return $fields;
	}

}