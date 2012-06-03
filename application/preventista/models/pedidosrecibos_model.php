<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pedidosrecibos_Model extends CI_Model {

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
		$this->db->insert('pedidosrecibos', $options);
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
		if(isset($options['pedidosrecibos_montocubierto']))
			$this->db->set('pedidosrecibos_montocubierto', $options['pedidosrecibos_montocubierto']);
		if(isset($options['pedidosremitos_created_at']))
			$this->db->set('pedidosremitos_created_at', $options['pedidosremitos_created_at']);
		if(isset($options['pedidosremitos_updated_at']))
			$this->db->set('pedidosremitos_updated_at', $options['pedidosremitos_updated_at']);

		$this->db->where('pedidosrecibos_id', $options['pedidosrecibos_id']);

		$this->db->update('pedidosrecibos');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $pedidosrecibos_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($pedidosrecibos_id)
	{
		//code here
		$this->db->where('pedidosrecibos_id', $pedidosrecibos_id);
		$this->db->delete('pedidosrecibos');
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
		if(isset($options['pedidosrecibos_id']))
			$this->db->where('pedidosrecibos_id', $options['pedidosrecibos_id']);
		if(isset($options['pedidos_id']))
			$this->db->where('pedidos_id', $options['pedidos_id']);
		if(isset($options['recibos_id']))
			$this->db->where('recibos_id', $options['recibos_id']);
		if(isset($options['pedidosrecibos_montocubierto']))
			$this->db->where('pedidosrecibos_montocubierto', $options['pedidosrecibos_montocubierto']);
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

		$query = $this->db->get('pedidosrecibos');

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['pedidosrecibos_id']) && $flag==1){
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
		$fields[]='pedidosrecibos_id';
		$fields[]='pedidos_id';
		$fields[]='recibos_id';
		$fields[]='pedidosrecibos_montocubierto';
		$fields[]='pedidosremitos_created_at';
		$fields[]='pedidosremitos_updated_at';
		return $fields;
	}

}