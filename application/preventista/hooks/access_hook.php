<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_Hook {

	function checkUser()
	{
		$CI =& get_instance();
		$privatecontrollers = array(
			'localidades_controller',
			'pedidodetalle_controller',
			'proveedores_controller',
			'sisperfil_controller',
			'usuarios_controller',
			'sismenu_controller',
			'rubros_controller',
			'articulos_controller',
			'pedidos_controller',
			'perfiles_controller',
			'pedidosrecibos_controller',
			'sispermisos_controller',
			'main_controller',
			'recibos_controller',
			'fleteros_controller',
			'clientes_controller',
			'remitos_controller',
			'hojaruta_controller',
			'sisvinculos_controller',
			'hojarutadetalle_controller',
			'compras_controller',
			'comprasdetalle_controller',
			'cambiodirectostock_controller',
			'cuentacorriente_controller',
			'autocomplete_controller',
			'tramites_controller');
		if($CI->session->userdata('logged_in') == true && $CI->router->method == 'login') redirect('main_controller');
		if($CI->session->userdata('logged_in') != true && $CI->router->method != 'login' && in_array($CI->router->class, $privatecontrollers))
		{
			//redirect('usuarios_controller/login_c');
			echo "<script>window.open('".base_url()."welcome/index','_top');</script>";
		}
	}

}
