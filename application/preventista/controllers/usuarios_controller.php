<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_Controller extends CI_Controller {

	private $flagR;
	private $flagI;
	private $flagU;
	private $flagD;
	private $flags;

	function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');
		$this->load->model('perfiles_model');
		$this->load->model('provincias_model');
		$this->load->model('tabgral_model');
		$this->config->load('usuarios_settings');
		if($this->session->userdata('logged_in') == true) { 
			$data['flags'] = $this->basicauth->getPermissions('usuarios');
			$this->flagR = $data['flags']['flag-read'];
			$this->flagI = $data['flags']['flag-insert'];
			$this->flagU = $data['flags']['flag-update'];
			$this->flagD = $data['flags']['flag-delete'];
			$this->flags = array('i'=>$this->flagI,'u'=>$this->flagU,'d'=>$this->flagD);
		}
	}

	function index()
	{
		//code here
		if($this->flagR){
			$data['flag'] = $this->flags;
			$data['subtitle'] = $this->config->item('recordListTitle');
			$data['fieldSearch'] = $this->basicrud->getFieldSearch($this->usuarios_model->getFieldsTable_m());
			$this->load->view('usuarios_view/home_usuarios', $data);
			$this->search_c();
		}
	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for saving 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function add_c()
	{
		//code here
		$data = array();
		$data['subtitle'] = $this->config->item('recordAddTitle');
		$data['perfiles'] = $this->perfiles_model->get_m(array('perfiles_estado' => 1));
		$data['estados'] = $this->tabgral_model->get_m(array("grupos_tabgral_id" => 1));

		$this->form_validation->set_rules('usuarios_username', 'usuarios_username', 'trim|required|alpha_numeric|callback_checkExistsUsername|xss_clean');
		$this->form_validation->set_rules('usuarios_password', 'usuarios_password', 'trim|required|alpha_numeric|matches[usuarios_passwordconf]|md5|xss_clean');
		$this->form_validation->set_rules('usuarios_passwordconf', 'Repite Contrase&ntilde;a', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_nombre', 'usuarios_nombre', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_apellido', 'usuarios_apellido', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_email', 'usuarios_email', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_direccion', 'usuarios_direccion', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_telefono', 'usuarios_telefono', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_estado', 'usuarios_estado', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('perfiles_id', 'perfiles_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('provincias_id', 'provincias_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('localidades_id', 'localidades_id', 'trim|integer|xss_clean');
		
		if($this->form_validation->run())
		{	
			$data_usuarios  = array();
				$data_usuarios['usuarios_username'] = $this->input->post('usuarios_username');
				$data_usuarios['usuarios_password'] = $this->input->post('usuarios_password');
				$data_usuarios['usuarios_nombre'] = $this->input->post('usuarios_nombre');
				$data_usuarios['usuarios_apellido'] = $this->input->post('usuarios_apellido');
			if($this->input->post('usuarios_email'))
				$data_usuarios['usuarios_email'] = $this->input->post('usuarios_email');
			if($this->input->post('usuarios_direccion'))
				$data_usuarios['usuarios_direccion'] = $this->input->post('usuarios_direccion');
			if($this->input->post('usuarios_telefono'))
				$data_usuarios['usuarios_telefono'] = $this->input->post('usuarios_telefono');
			$data_usuarios['usuarios_estado'] = $this->input->post('usuarios_estado');
			$data_usuarios['perfiles_id'] = $this->input->post('perfiles_id');
			if($this->input->post('provincias_id'))
				$data_usuarios['provincias_id'] = $this->input->post('provincias_id');
			if($this->input->post('localidades_id'))
				$data_usuarios['localidades_id'] = $this->input->post('localidades_id');
		
			$data_usuarios['usuarios_updated_at'] = $this->basicrud->formatDateToBD();

			$id_usuarios = $this->usuarios_model->add_m($data_usuarios);
			if($id_usuarios){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('usuarios_flash_add_message')); 
				redirect('usuarios_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('usuarios_flash_error_message')); 
				redirect('usuarios_controller','location');
			}
		}
		$this->load->view('usuarios_view/form_add_usuarios',$data);

	}


	/**
	 * This function validates and sends the data to the 
	 * method of the model responsible for updating 
	 * the data in the db
	 *
	 * @access public
	 * @return void
	 */
	function edit_c($usuarios_id)
	{
		//code here
		$data = array();
		$data['subtitle'] = $this->config->item('recordEditTitle');
		$data['usuarios'] = $this->usuarios_model->get_m(array('usuarios_id' => $usuarios_id),$flag=1);
		$data['perfiles'] = $this->perfiles_model->get_m(array('perfiles_estado' => 1));
		$data['estados'] = $this->tabgral_model->get_m(array("grupos_tabgral_id" => 1));

		$this->form_validation->set_rules('usuarios_id', 'usuarios_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('usuarios_username', 'usuarios_username', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_password', 'usuarios_password', 'trim|alpha_numeric|matches[usuarios_passwordconf]|md5|xss_clean');
		$this->form_validation->set_rules('usuarios_passwordconf', 'Repite Contrase&ntilde;a', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_nombre', 'usuarios_nombre', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_apellido', 'usuarios_apellido', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_email', 'usuarios_email', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_direccion', 'usuarios_direccion', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_telefono', 'usuarios_telefono', 'trim|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_estado', 'usuarios_estado', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('perfiles_id', 'perfiles_id', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('provincias_id', 'provincias_id', 'trim|integer|xss_clean');
		$this->form_validation->set_rules('localidades_id', 'localidades_id', 'trim|integer|xss_clean');
	
		if($this->form_validation->run()){
			$data_usuarios  = array();
			$data_usuarios['usuarios_id'] = $this->input->post('usuarios_id');
			$data_usuarios['usuarios_username'] = $this->input->post('usuarios_username');
			if($this->input->post('usuarios_password'))
				$data_usuarios['usuarios_password'] = $this->input->post('usuarios_password');
			$data_usuarios['usuarios_nombre'] = $this->input->post('usuarios_nombre');
			$data_usuarios['usuarios_apellido'] = $this->input->post('usuarios_apellido');
			if($this->input->post('usuarios_email'))
				$data_usuarios['usuarios_email'] = $this->input->post('usuarios_email');
			if($this->input->post('usuarios_direccion'))
				$data_usuarios['usuarios_direccion'] = $this->input->post('usuarios_direccion');
			if($this->input->post('usuarios_telefono'))
				$data_usuarios['usuarios_telefono'] = $this->input->post('usuarios_telefono');
			
			$data_usuarios['usuarios_estado'] = $this->input->post('usuarios_estado');
			$data_usuarios['perfiles_id'] = $this->input->post('perfiles_id');
			if($this->input->post('provincias_id'))
				$data_usuarios['provincias_id'] = $this->input->post('provincias_id');
			if($this->input->post('localidades_id'))
				$data_usuarios['localidades_id'] = $this->input->post('localidades_id');
			
			$data_usuarios['usuarios_updated_at'] = $this->basicrud->formatDateToBD();

			if($this->usuarios_model->edit_m($data_usuarios)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('usuarios_flash_edit_message')); 
				redirect('usuarios_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('usuarios_flash_error_message')); 
				redirect('usuarios_controller','location');
			}
		}
		$this->load->view('usuarios_view/form_edit_usuarios',$data);

	}


	/**
	 * This function sends the id of record to the
	 * method of the model responsible for deleting 
	 * the record in the db
	 *
	 * @access public
	 * @param $usuarios_id id of record
	 * @return void
	 */
	function delete_c($usuarios_id)
	{
		//code here
		if($usuarios_id != 1){ // impedir eliminacion de usuario 'admin'
			if($this->usuarios_model->delete_m($usuarios_id)){ 
				$this->session->set_flashdata('flashConfirm', $this->config->item('usuarios_flash_delete_message')); 
				redirect('usuarios_controller','location');
			}else{
				$this->session->set_flashdata('flashError', $this->config->item('usuarios_flash_error_delete_message')); 
				redirect('usuarios_controller','location');
			}
		}else{
			$this->session->set_flashdata('flashError', $this->config->item('usuarios_flash_error_delete_message')); 
			redirect('usuarios_controller','location');			
		}

	}

	function search_c($offset = 0)
	{
		//code here
		$data = array(); 
		$fieldSearch = array(); 
		$data_search_usuarios  = array();
		$data_search_pagination  = array();
		$flag = 0;
		
		if($this->flagR)
		{
			$fieldSearch = $this->basicrud->getFieldSearch($this->usuarios_model->getFieldsTable_m());
			foreach($fieldSearch as $field)
			{
				if($this->input->post($field) != '')
				{ 
					$data_search_usuarios[$field] = $this->input->post($field);
					$data_search_pagination[$field] = $this->input->post($field);
					$flag = 1;
				}
			}
			
			$data_search_pagination['count'] = true;
			$data_search_usuarios['limit'] = $this->config->item('pag_perpage');
			$data_search_usuarios['offset'] = $offset;
			$data_search_usuarios['sortBy'] = 'usuarios_id';
			$data_search_usuarios['sortDirection'] = 'asc';

			if($flag==1){
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'usuarios_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['usuarios'] = $this->usuarios_model->get_m($data_search_usuarios);
			}else{
				$data['pagination'] = $this->basicrud->getPagination(array('nameModel'=>'usuarios_model','perpage'=>$this->config->item('pag_perpage')),$data_search_pagination);
				$data['usuarios'] = $this->usuarios_model->get_m($data_search_usuarios);
			}
			
			$data['flag'] = $this->flags;		
			$data['fieldShow'] = $this->basicrud->getFieldToShow($this->usuarios_model->getFieldsTable_m());
			$this->load->view('usuarios_view/record_list_usuarios',$data);
		}

	}

	/**
	 * This function check if the user is validate
	 *
	 * @access public
	 * @return void
	 */
	function login_c()
	{
		//code here
		$data = array();
		$data['subtitle'] = $this->config->item('recordAddTitle');
		$this->form_validation->set_rules('usuarios_username', 'usuarios_username', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_password', 'usuarios_password', 'trim|required|alpha_numeric|md5|xss_clean');
		if($this->form_validation->run())
		{	
			$reponse = $this->basicauth->login(array('usuarios_username'=>$this->input->post('usuarios_username'),'usuarios_password'=>$this->input->post('usuarios_password')));
			if(!isset($reponse['error'])){
				$reponse_menu = $this->basicauth->checkMenuUser();
				if(!isset($reponse_menu['error'])){
					redirect('main_controller');
				}else {
					$data['error'] = $reponse_menu['error'];
					$this->load->view('usuarios_view/form_login_usuarios',$data);
				}
			}else {
				$data['error'] = $reponse['error'];
				$this->load->view('usuarios_view/form_login_usuarios',$data);
			}
		}else{
			$this->load->view('usuarios_view/form_login_usuarios',$data);
		}
	}


	/**
	 * This function closes the user session
	 *
	 * @access public
	 * @return void
	 */
	function logout_c()
	{
		//code here
		$this->basicauth->logout();
		redirect('usuarios_controller/login_c');	
	}



	/**
	 * This function check if the entered username is correct 
	 *
	 * @param string $usuarios_username
	 * @return boolean true 	if Not exists the username	 
	 */	 
	function checkExistsUsername($usuarios_username) 
	{
		$data = array();
		$this->form_validation->set_message('checkExistsUsername','El Nombre de usuario ingresado ya existe. Ingrese otro por favor.');
		
		$data['usuario'] = $this->usuarios_model->get_m(array('usuarios_username' => $usuarios_username));	    
	   
	   if($data['usuario']) return false;
	   else return true;	
	}
}