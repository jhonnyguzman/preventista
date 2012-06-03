<?php 

/**
 * Clase Basicauth 
 * 
 * Esta clase contiene los métodos neecesarios para autentificación de usuarios 
 * y para generar el menú dinámico de la aplicación. 
 * Está configurada para que se autocargue cada ves que se inicia la aplicación,
 * por los  que los métodos de la misma pueden ser llamados desde cualquier controlador.
 * 
 * @package libraries
 * @author Johnny Guzmán
 * @version  1.0  
 */
 
 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 
class Basicauth {
	
	private $CI;
	
	function __construct() 
	{
		$this->CI = & get_instance();			
	}
	
	
	
	/**
	 * El método _required permite verificar si los índices de 
	 * uno de los arrays asociativos que ricibe existe en el otro array que recibe  
	 * 
	 *
	 * @param array  $required  índices a verificar
	 * @param array  $data  índices que tienen que estar en el arrat $required
	 * @return boolean true si los índices del array $data estan en el array %required
	 */
	function _required($required, $data)
	{
		foreach($required as $field)
			if(!isset($data[$field])) return false;
			
		return true;
	}
	
	
	
	function _default($defaults, $options)
	{
		return array_merge($defaults, $options);
	}
	
		
		
	/**
	 * Método de autentificación de usuarios
	 *
	 * El método login agrega información desde la base de datos a la sessión de datos del usuario.
	 * 
	 * Option: Values
	 * --------------
	 * username |
	 * password
	 *
	 * @param array $options
	 * @return array data
	 */
	function login($options = array()) 
	{
		
		$data = array();
		
		// valores requeridos
		if(!$this->_required(
			array('usuarios_username', 'usuarios_password'),
			$options)
		) return false;
		
		$query_a = $this->CI->db->get_where('usuarios', array('usuarios_username'=>$options['usuarios_username'], 'usuarios_password'=>$options['usuarios_password']));
		
		//comprabamos si existe el usuario
		if($query_a->num_rows() > 0){
			
			//comprobamos que el usuario este habilitado
			if($query_a->row()->usuarios_estado == 1){
				
				//comprobamos si el perfil del usuario esta habilitado
				$query_b = $this->CI ->db->get_where('perfiles',array('perfiles_id'=>$query_a->row()->perfiles_id,'perfiles_estado'=>1));
				
				if($query_b->num_rows()>0) {
					$this->CI->session->sess_destroy();
					$this->CI->session->sess_create();
					$this->CI->session->set_userdata(
						array(
						'logged_in'=> true, 
						'usuarios_username'=>$query_a->row()->usuarios_username,
						'usuarios_email'=>$query_a->row()->usuarios_email,
						'usuarios_id'=>$query_a->row()->usuarios_id,
						'usuarios_estado'=> $query_a->row()->usuarios_estado,
						'perfiles_id'=> $query_b->row()->perfiles_id,
						'perfiles_descripcion'=> $query_b->row()->perfiles_descripcion
						)
					);
				} else {
					$data['error'] = "El perfil de este usuario esta deshabilitado temporalmente. Consulte con el administrador de sistema";	
				}
			} else {
				$data['error'] = "El usuario esta deshabilitado temporalmente";	
			}
					
		} else {
			$data['error'] = "Usuario o contrase&ntilde;a incorrecta";	
		}
		
		return $data;
	}
	
	
	
	/**
	 * Método para eliminar la sessión de datos del usuario que actualmente esta identificado
	 * 
	 */
	function logout() 
	{
		$CI = & get_instance();	
		$CI->session->sess_destroy();	
	}	
	
	
	
	/**
	 * Método de verificación de opciones de menu del asuario segun su perfil
	 *
	 * El método checkMenuUser verifica si el perfil del usuario tiene asignado opciones del menu.
	 * 
	 * @return array data
	 */
	function checkMenuUser()
	{
		
		$data = array();
		
		//listamos todos los menus e items para este usuario  
		$query_str = "select sp.perfiles_id,sm.sismenu_id, sm.sismenu_descripcion, sv.sisvinculos_link, sp.sisperfil_estado 
		from sisperfil as sp inner join sismenu as sm 
		on sp.sismenu_id = sm.sismenu_id 
		inner join sisvinculos as sv 
		on sp.sismenu_id = sv.sismenu_id 
		where sp.perfiles_id = ? and sp.sisperfil_estado = 1 and sm.sismenu_estado = 1;";
						 
		$query_a = $this->CI->db->query($query_str,$this->CI->session->userdata('perfiles_id'));
		
		if(!$query_a->num_rows()>0){	
			$data['error'] = "Su perfil aun no tiene asignadas opciones de menu. Consulte con el administrador del sistema";
			$this->logout();
		}
		
		return $data;
	}
	
		
	/**
	 * Método de generación de menu de usuario
	 *
	 * El método generarMenu se encarga de construir el menu principal de la aplicación según el peril del usuario.
	 * 
	 * @return string data
	 */
	function getMenu($parent=0,$ul_start="<ul id='menu'>")
	{
		
		$query_str = "select s.sismenu_id, s.sismenu_descripcion, s.sismenu_parent, sv.sisvinculos_link from sismenu as s 
		inner join sisperfil as sp on s.sismenu_id = sp.sismenu_id inner join
		sisvinculos as sv on s.sismenu_id = sv.sismenu_id where 
		s.sismenu_parent =$parent and 
		s.sismenu_estado=1
		and sp.perfiles_id = ".$this->CI->session->userdata('perfiles_id')."";
		
		$query_a = $this->CI->db->query($query_str);
		
		if($query_a->num_rows()>0)
		{		
			echo $ul_start;
			foreach($query_a->result() as $field)
			{
				if($field->sisvinculos_link == "#"){
					echo " <li> <a href='#' >".$field->sismenu_descripcion."</a>";		
				}else{
			   	echo " <li> <a href='#' onClick=\"loadPage('".base_url()."".$field->sisvinculos_link."','right-content')\">".$field->sismenu_descripcion."</a>";
			   }
				$this->getMenu($field->sismenu_id,$ul_start="<ul>"); 	
			}
			echo "</ul>";
		}
		echo "</li>";
		
	}
	
	
	/**
	 * This function checks the permissions that a profile has on a table
	 *
	 * @access	public
	 * @param	string		the name of the table
	 * @return	array			flags the permissions
	 */
	function getPermissions($nameTable) 
	{
		$data = array();
		
		$query_str = "select sispermisos_flag_read, sispermisos_flag_insert, sispermisos_flag_update, sispermisos_flag_delete
		from sispermisos where perfiles_id=".$this->CI->session->userdata('perfiles_id')." and sispermisos_tabla = '$nameTable'";
		
		$query = $this->CI->db->query($query_str);
		if($query->num_rows()>0)
		{
			$data['flag-read'] = $query->row(0)->sispermisos_flag_read;
			$data['flag-insert'] = $query->row(0)->sispermisos_flag_insert;
			$data['flag-update'] = $query->row(0)->sispermisos_flag_update;
			$data['flag-delete'] = $query->row(0)->sispermisos_flag_delete;														
		}
		
		return $data;	
	}
	
	
}
?>
