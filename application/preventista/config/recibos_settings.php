<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de recibos';
$config['recordAddTitle']=' Nuevo recibos';
$config['recordEditTitle']=' Editar recibos';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['recibos_id']='Recibo Id';
$config['recibos_monto']='Monto';
$config['clientes_id']='Cliente';
$config['clientes_apellido']='Cliente';
$config['clientes_nombre']='Cliente';
$config['clientes_apellnom']='Cliente';
$config['usuarios_id']='Usuario';
$config['usuarios_username']='Usuario';
$config['recibos_estado']='Estado';
$config['recibos_estado_descripcion']='Estado';
$config['recibos_fechaingreso']='Fecha de ingreso';
$config['recibos_created_at']='Fecha de alta';
$config['recibos_updated_at']='Actualizado en';

/* Config fields for search */

$config['search_by_recibos_id']= 0;
$config['search_by_recibos_monto']= 0;
$config['search_by_clientes_id']= 1;
$config['search_by_usuarios_id']= 1;
$config['search_by_recibos_estado']= 1;
$config['search_by_recibos_fechaingreso']= 1;
$config['search_by_recibos_created_at']= 0;
$config['search_by_recibos_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_recibos_id']= 1;
$config['show_recibos_monto']= 1;
$config['show_clientes_id']= 0;
$config['show_clientes_apellido']= 0;
$config['show_clientes_nombre']= 0;
$config['show_clientes_apellnom']= 1;
$config['show_usuarios_id']= 0;
$config['show_usuarios_username']= 1;
$config['show_recibos_estado']= 0;
$config['show_recibos_estado_descripcion']= 1;
$config['show_recibos_fechaingreso']= 1;
$config['show_recibos_created_at']= 1;
$config['show_recibos_updated_at']= 0;

/* Config required fields */

$config['isRequired_recibos_id']= 1;
$config['isRequired_recibos_monto']= 1;
$config['isRequired_clientes_id']= 1;
$config['isRequired_usuarios_id']= 1;
$config['isRequired_recibos_estado']= 1;
$config['isRequired_recibos_fechaingreso']= 1;
$config['isRequired_recibos_created_at']= 1;
$config['isRequired_recibos_updated_at']= 0;

/* Config params of pagination */

$config['pag_perpage']= 20;

/* Config flash messages */

$config['recibos_flash_add_message']= 'The recibos has been successfully added.';
$config['recibos_flash_edit_message']= 'The recibos has been successfully updated.';
$config['recibos_flash_delete_message']= 'The recibos has been successfully deleted';
$config['recibos_flash_error_delete_message']= 'The recibos hasn\'t been deletedd';
$config['recibos_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file recibos_settings.php */
/* Location: ./application/config/recibos_settings.php */
