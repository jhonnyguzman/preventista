<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de proveedores';
$config['recordAddTitle']=' Nuevo proveedor';
$config['recordEditTitle']=' Editar proveedor';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['proveedores_id']='Id';
$config['proveedores_nombre']='Nombre';
$config['proveedores_apellido']='Apellido';
$config['proveedores_direccion']='Direccion';
$config['proveedores_telefono']='Telefono';
$config['proveedores_created_at']='Fecha de alta';
$config['proveedores_updated_at']='Actualizado';

/* Config fields for search */

$config['search_by_proveedores_id']= 0;
$config['search_by_proveedores_nombre']= 1;
$config['search_by_proveedores_apellido']= 1;
$config['search_by_proveedores_direccion']= 0;
$config['search_by_proveedores_telefono']= 0;
$config['search_by_proveedores_created_at']= 0;
$config['search_by_proveedores_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_proveedores_id']= 1;
$config['show_proveedores_nombre']= 1;
$config['show_proveedores_apellido']= 1;
$config['show_proveedores_direccion']= 1;
$config['show_proveedores_telefono']= 1;
$config['show_proveedores_created_at']= 1;
$config['show_proveedores_updated_at']= 0;

/* Config required fields */

$config['isRequired_proveedores_id']= 1;
$config['isRequired_proveedores_nombre']= 1;
$config['isRequired_proveedores_apellido']= 1;
$config['isRequired_proveedores_direccion']= 1;
$config['isRequired_proveedores_telefono']= 1;
$config['isRequired_proveedores_created_at']= 1;
$config['isRequired_proveedores_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['proveedores_flash_add_message']= 'The proveedores has been successfully added.';
$config['proveedores_flash_edit_message']= 'The proveedores has been successfully updated.';
$config['proveedores_flash_delete_message']= 'The proveedores has been successfully deleted';
$config['proveedores_flash_error_delete_message']= 'The proveedores hasn\'t been deletedd';
$config['proveedores_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file proveedores_settings.php */
/* Location: ./application/config/proveedores_settings.php */
