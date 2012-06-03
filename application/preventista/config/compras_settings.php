<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de compras';
$config['recordAddTitle']=' Nueva compra';
$config['recordEditTitle']=' Editar compra';
$config['recordShowTitle']=' Compra';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['compras_id']='Compra Id';
$config['proveedores_id']='Proveedor';
$config['proveedores_apellido']='Proveedor';
$config['proveedores_nombre']='Proveedor';
$config['compras_montototal']='Monto total';
$config['usuarios_id']='Usuario';
$config['usuarios_username']='Usuario';
$config['compras_created_at']='Fecha de alta';
$config['compras_updated_at']='Actualizado en';

/* Config fields for search */

$config['search_by_compras_id']= 0;
$config['search_by_proveedores_id']= 1;
$config['search_by_compras_montototal']= 0;
$config['search_by_usuarios_id']= 0;
$config['search_by_compras_created_at']= 1;
$config['search_by_compras_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_compras_id']= 1;
$config['show_proveedores_id']= 0;
$config['show_proveedores_apellido']= 1;
$config['show_proveedores_nombre']= 1;
$config['show_compras_montototal']= 1;
$config['show_usuarios_id']= 0;
$config['show_usuarios_username']= 1;
$config['show_compras_created_at']= 1;
$config['show_compras_updated_at']= 0;

/* Config required fields */

$config['isRequired_compras_id']= 1;
$config['isRequired_proveedores_id']= 1;
$config['isRequired_compras_montototal']= 1;
$config['isRequired_usuarios_id']= 1;
$config['isRequired_compras_created_at']= 1;
$config['isRequired_compras_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 20;

/* Config flash messages */

$config['compras_flash_add_message']= 'The compras has been successfully added.';
$config['compras_flash_edit_message']= 'The compras has been successfully updated.';
$config['compras_flash_delete_message']= 'The compras has been successfully deleted';
$config['compras_flash_error_delete_message']= 'The compras hasn\'t been deletedd';
$config['compras_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file compras_settings.php */
/* Location: ./application/config/compras_settings.php */
