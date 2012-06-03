<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_Model extends CI_Model {

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
		$this->db->insert('usuarios', $options);
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
		if(isset($options['usuarios_username']))
			$this->db->set('usuarios_username', $options['usuarios_username']);
		if(isset($options['usuarios_password']))
			$this->db->set('usuarios_password', $options['usuarios_password']);
		if(isset($options['usuarios_nombre']))
			$this->db->set('usuarios_nombre', $options['usuarios_nombre']);
		if(isset($options['usuarios_apellido']))
			$this->db->set('usuarios_apellido', $options['usuarios_apellido']);
		if(isset($options['usuarios_email']))
			$this->db->set('usuarios_email', $options['usuarios_email']);
		if(isset($options['usuarios_direccion']))
			$this->db->set('usuarios_direccion', $options['usuarios_direccion']);
		if(isset($options['usuarios_telefono']))
			$this->db->set('usuarios_telefono', $options['usuarios_telefono']);
		if(isset($options['usuarios_estado']))
			$this->db->set('usuarios_estado', $options['usuarios_estado']);
		if(isset($options['usuarios_legajo']))
			$this->db->set('usuarios_legajo', $options['usuarios_legajo']);
		if(isset($options['perfiles_id']))
			$this->db->set('perfiles_id', $options['perfiles_id']);
		if(isset($options['provincias_id']))
			$this->db->set('provincias_id', $options['provincias_id']);
		if(isset($options['localidades_id']))
			$this->db->set('localidades_id', $options['localidades_id']);
		if(isset($options['usuarios_activationcode']))
			$this->db->set('usuarios_activationcode', $options['usuarios_activationcode']);
		if(isset($options['usuarios_tokenforgotpasswd']))
			$this->db->set('usuarios_tokenforgotpasswd', $options['usuarios_tokenforgotpasswd']);
		if(isset($options['usuarios_created_at']))
			$this->db->set('usuarios_created_at', $options['usuarios_created_at']);
		if(isset($options['usuarios_updated_at']))
			$this->db->set('usuarios_updated_at', $options['usuarios_updated_at']);

		$this->db->where('usuarios_id', $options['usuarios_id']);

		$this->db->update('usuarios');

		if($this->db->affected_rows()>0) return $this->db->affected_rows();
		else return $this->db->affected_rows() + 1;
	}


	/**
	 * This function deleting the data in the db
	 *
	 * @access public
	 * @param  integer $usuarios_id primary key of record
	 * @return integer  affected rows
	 */
	function delete_m($usuarios_id)
	{
		//code here
		$this->db->where('usuarios_id', $usuarios_id);
		$this->db->delete('usuarios');
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
		if(isset($options['usuarios_id']))
			$this->db->where('usuarios_id', $options['usuarios_id']);
		if(isset($options['usuarios_username']))
			$this->db->like('usuarios_username', $options['usuarios_username']);
		if(isset($options['usuarios_password']))
			$this->db->like('usuarios_password', $options['usuarios_password']);
		if(isset($options['usuarios_nombre']))
			$this->db->like('usuarios_nombre', $options['usuarios_nombre']);
		if(isset($options['usuarios_apellido']))
			$this->db->like('usuarios_apellido', $options['usuarios_apellido']);
		if(isset($options['usuarios_email']))
			$this->db->like('usuarios_email', $options['usuarios_email']);
		if(isset($options['usuarios_direccion']))
			$this->db->like('usuarios_direccion', $options['usuarios_direccion']);
		if(isset($options['usuarios_telefono']))
			$this->db->like('usuarios_telefono', $options['usuarios_telefono']);
		if(isset($options['usuarios_estado']))
			$this->db->where('usuarios_estado', $options['usuarios_estado']);
		if(isset($options['usuarios_legajo']))
			$this->db->where('usuarios_legajo', $options['usuarios_legajo']);
		if(isset($options['perfiles_id']))
			$this->db->where('perfiles_id', $options['perfiles_id']);
		if(isset($options['provincias_id']))
			$this->db->where('provincias_id', $options['provincias_id']);
		if(isset($options['localidades_id']))
			$this->db->where('localidades_id', $options['localidades_id']);
		if(isset($options['usuarios_activationcode']))
			$this->db->like('usuarios_activationcode', $options['usuarios_activationcode']);
		if(isset($options['usuarios_tokenforgotpasswd']))
			$this->db->like('usuarios_tokenforgotpasswd', $options['usuarios_tokenforgotpasswd']);
		if(isset($options['usuarios_created_at']))
			$this->db->where('usuarios_created_at', $options['usuarios_created_at']);
		if(isset($options['usuarios_updated_at']))
			$this->db->where('usuarios_updated_at', $options['usuarios_updated_at']);

		//limit / offset
		if(isset($options['limit']) && isset($options['offset']))
			$this->db->limit($options['limit'],$options['offset']);
		else if(isset($options['limit']))
			$this->db->limit($options['limit']);

		//sort
		if(isset($options['sortBy']) && isset($options['sortDirection']))
			$this->db->order_by($options['sortBy'],$options['sortDirection']);

		$this->db->select("u.*,p.perfiles_descripcion, tg.tabgral_descripcion as usuarios_estado_descripcion, pr.provincias_nombre, l.localidades_nombre");
		$this->db->from("usuarios as u");
		$this->db->join("perfiles as p", "p.perfiles_id = u.perfiles_id");
		$this->db->join("tabgral as tg", "tg.tabgral_id = u.usuarios_estado");
		$this->db->join("provincias as pr", "pr.provincias_id = u.provincias_id","left");
		$this->db->join("localidades as l", "l.localidades_id = u.localidades_id","left");

		$query = $this->db->get();

		if(isset($options['count'])) return $query->num_rows();

		//format field of type date if it exist for human 
		if($query->num_rows()>0){ 
			if(isset($options['usuarios_id']) && $flag==1){
				$query->row(0)->usuarios_created_at = $this->basicrud->formatDateToHuman($query->row(0)->usuarios_created_at);
				$query->row(0)->usuarios_updated_at = $this->basicrud->formatDateToHuman($query->row(0)->usuarios_updated_at);
				return $query->row(0);
			}else{
				foreach($query->result() as $row){ 
					$row->usuarios_created_at = $this->basicrud->formatDateToHuman($row->usuarios_created_at);
					$row->usuarios_updated_at = $this->basicrud->formatDateToHuman($row->usuarios_updated_at);
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
		$fields[]='usuarios_id';
		$fields[]='usuarios_username';
		$fields[]='usuarios_password';
		$fields[]='usuarios_nombre';
		$fields[]='usuarios_apellido';
		$fields[]='usuarios_email';
		$fields[]='usuarios_direccion';
		$fields[]='usuarios_telefono';
		$fields[]='usuarios_estado';
		$fields[]='usuarios_estado_descripcion';
		$fields[]='usuarios_legajo';
		$fields[]='perfiles_id';
		$fields[]='perfiles_descripcion';
		$fields[]='provincias_id';
		$fields[]='provincias_nombre';
		$fields[]='localidades_id';
		$fields[]='localidades_nombre';
		$fields[]='usuarios_activationcode';
		$fields[]='usuarios_tokenforgotpasswd';
		$fields[]='usuarios_created_at';
		$fields[]='usuarios_updated_at';
		return $fields;
	}

}