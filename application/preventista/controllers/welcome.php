<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->login();
	}


	/**
	 * This function check if the user is validate
	 *
	 * @access public
	 * @return void
	 */
	function login()
	{
		//code here
		$this->load->model('usuarios_model');
		$data = array();
		$data['subtitle'] = $this->config->item('recordAddTitle');
		$this->form_validation->set_rules('usuarios_username', 'Usuario', 'trim|required|alpha_numeric|xss_clean');
		$this->form_validation->set_rules('usuarios_password', 'Contrase&ntilde;a', 'trim|required|alpha_numeric|md5|xss_clean');
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
	function logout()
	{
		//code here
		$this->basicauth->logout();
		redirect('welcome/index');	
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */