<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de remitos';
$config['recordAddTitle']=' Nuevo remitos';
$config['recordEditTitle']=' Editar remitos';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['remitos_id']='Remito Id';
$config['pedidos_id']='Pedido Id';
$config['hojarutadetalle_id']='hojarutadetalle_id';
$config['remitos_estado']='Estado';
$config['remitos_estado_descripcion']='Estado';
$config['remitos_created_at']='Fecha de alta';
$config['remitos_updated_at']='Actualizado en';

/* Config fields for search */

$config['search_by_remitos_id']= 1;
$config['search_by_hojarutadetalle_id']= 0;
$config['search_by_remitos_estado']= 1;
$config['search_by_remitos_created_at']= 0;
$config['search_by_remitos_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_remitos_id']= 1;
$config['show_pedidos_id']= 1;
$config['show_hojarutadetalle_id']= 0;
$config['show_remitos_estado']= 0;
$config['show_remitos_estado_descripcion']= 1;
$config['show_remitos_created_at']= 1;
$config['show_remitos_updated_at']= 0;

/* Config required fields */

$config['isRequired_remitos_id']= 1;
$config['isRequired_pedidos_id']= 1;
$config['isRequired_hojaruta_id']= 1;
$config['isRequired_remitos_created_at']= 1;
$config['isRequired_remitos_updated_at']= 0;

/* Config params of pagination */

$config['pag_perpage']= 30;

/* Config flash messages */

$config['remitos_flash_add_message']= 'The remitos has been successfully added.';
$config['remitos_flash_edit_message']= 'The remitos has been successfully updated.';
$config['remitos_flash_delete_message']= 'The remitos has been successfully deleted';
$config['remitos_flash_error_delete_message']= 'The remitos hasn\'t been deletedd';
$config['remitos_flash_error_message']= 'A database error has occured, please contact your administrator.';
$config['remitos_flash_errorX1_message']= "Error, s&oacute;lo puedes imprimir remitos de Hojas de ruta con estado 'Ejecutada'";

/* End of file remitos_settings.php */
/* Location: ./application/config/remitos_settings.php */
