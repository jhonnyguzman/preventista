<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de pedidos';
$config['recordAddTitle']=' Nuevo pedidos';
$config['recordEditTitle']=' Editar pedidos';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['pedidos_id']='Pedido Id';
$config['peididos_montototal']='Monto total';
$config['pedidos_montoadeudado']='Monto adeudado';
$config['pedidos_estado']='Estado';
$config['pedidos_estado_descripcion']='Estado';
$config['clientes_id']='clientes_id';
$config['clientes_apellido']='Cliente Apellido';
$config['clientes_nombre']='Cliente Nombre';
$config['clientescategoria_id']='Categ.';
$config['clientescategoria_descripcion']='Categ.';
$config['tramites_id']='Tr&aacute;mite';
$config['tramites_descripcion']='Tr&aacute;mite';
$config['pedidos_created_at']='Fecha de alta';
$config['pedidos_updated_at']='updated_at';
$config['pedidos_observaciones']='Obs.';

/* Config fields for search */

$config['search_by_pedidos_id']= 0;
$config['search_by_peididos_montototal']= 0;
$config['search_by_pedidos_montoadeudado']= 0;
$config['search_by_pedidos_estado']= 1;
$config['search_by_pedidos_estado_descripcion']= 0;
$config['search_by_clientes_id']= 1;
$config['search_by_clientes_apellido']= 0;
$config['search_by_clientes_nombre']= 0;
$config['search_by_clientescategoria_id']= 0;
$config['search_by_clientescategoria_descripcion']= 0;
$config['search_by_tramites_id']= 0;
$config['search_by_tramites_descripcion']= 0;
$config['search_by_pedidos_created_at']= 1;
$config['search_by_pedidos_updated_at']= 0;
$config['search_by_pedidos_observaciones']= 0;

/* Config fields for show in the result list */

$config['show_pedidos_id']= 1;
$config['show_peididos_montototal']= 1;
$config['show_pedidos_montoadeudado']= 1;
$config['show_pedidos_estado']= 0;
$config['show_pedidos_estado_descripcion']= 1;
$config['show_clientes_id']= 0;
$config['show_clientes_apellido']= 1;
$config['show_clientes_nombre']= 1;
$config['show_clientescategoria_id']= 0;
$config['show_clientescategoria_descripcion']= 0;
$config['show_tramites_id']= 0;
$config['show_tramites_descripcion']= 1;
$config['show_pedidos_created_at']= 1;
$config['show_pedidos_updated_at']= 0;
$config['show_pedidos_observaciones']= 0;

/* Config required fields */

$config['isRequired_pedidos_id']= 1;
$config['isRequired_peididos_montototal']= 1;
$config['isRequired_pedidos_montoadeudado']= 1;
$config['isRequired_clientes_id']= 1;
$config['isRequired_pedidos_created_at']= 1;
$config['isRequired_pedidos_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 27;

/* Config flash messages */

$config['pedidos_flash_add_message']= 'The pedidos has been successfully added.';
$config['pedidos_flash_edit_message']= 'The pedidos has been successfully updated.';
$config['pedidos_flash_delete_message']= 'The pedidos has been successfully deleted';
$config['pedidos_flash_error_delete_message']= 'The pedidos hasn\'t been deletedd';
$config['pedidos_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file pedidos_settings.php */
/* Location: ./application/config/pedidos_settings.php */
