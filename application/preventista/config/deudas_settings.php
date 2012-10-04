<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de deudas';
$config['recordAddTitle']=' Nuevo deudas';
$config['recordEditTitle']=' Editar deudas';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['deudas_id']='Id';
$config['deudas_montototal']='Monto';
$config['deudas_fecha']='Fecha';
$config['clientes_id']='Cliente';
$config['clientes_apellido']='Cliente';
$config['clientes_nombre']='Cliente';
$config['deudas_created_at']='Fecha de alta';
$config['deudas_updated_at']='Actualzido el';
$config['usuarios_id']='Usuario';
$config['usuarios_username']='Usuario';
$config['deudas_estado']='Estado';
$config['deudas_estado_descripcion']='Estado';
$config['deudas_montoadeudado']='Monto Adeudado';

/* Config fields for search */

$config['search_by_deudas_id']= 0;
$config['search_by_deudas_montototal']= 0;
$config['search_by_deudas_fecha']= 1;
$config['search_by_clientes_id']= 1;
$config['search_by_deudas_created_at']= 0;
$config['search_by_deudas_updated_at']= 0;
$config['search_by_usuarios_id']= 1;
$config['search_by_deudas_estado']= 0;
$config['search_by_deudas_montoadeudado']= 0;

/* Config fields for show in the result list */

$config['show_deudas_id']= 1;
$config['show_deudas_montototal']= 1;
$config['show_deudas_fecha']= 1;
$config['show_clientes_id']= 0;
$config['show_clientes_apellido']= 1;
$config['show_clientes_nombre']= 1;
$config['show_deudas_created_at']= 0;
$config['show_deudas_updated_at']= 0;
$config['show_usuarios_id']= 0;
$config['show_usuarios_username']= 1;
$config['show_deudas_estado']= 1;
$config['show_deudas_estado_descripcion']= 1;
$config['show_deudas_montoadeudado']= 1;

/* Config params of pagination */

$config['pag_perpage']= 30;

/* Config flash messages */

$config['deudas_flash_add_message']= 'The deudas has been successfully added.';
$config['deudas_flash_edit_message']= 'The deudas has been successfully updated.';
$config['deudas_flash_delete_message']= 'The deudas has been successfully deleted';
$config['deudas_flash_error_delete_message']= 'The deudas hasn\'t been deletedd';
$config['deudas_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file deudas_settings.php */
/* Location: ./application/config/deudas_settings.php */
