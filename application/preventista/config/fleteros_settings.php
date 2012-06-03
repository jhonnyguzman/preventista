<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de Fleteros';
$config['recordAddTitle']=' Nuevo Fletero';
$config['recordEditTitle']=' Editar Fletero';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['fleteros_id']='Fletero Id';
$config['fleteros_nombre']='Nombre';
$config['fleteros_apellido']='Apellido';
$config['fleteros_telefono']='Tel&eacute;fono';
$config['fleteros_direccion']='Direcci&oacute;n';
$config['fleteros_created_at']='Fecha de alta';
$config['fleteros_updated_at']='Actualizado el';

/* Config fields for search */

$config['search_by_fleteros_id']= 0;
$config['search_by_fleteros_nombre']= 1;
$config['search_by_fleteros_apellido']= 1;
$config['search_by_fleteros_telefono']= 0;
$config['search_by_fleteros_direccion']= 0;
$config['search_by_fleteros_created_at']= 0;
$config['search_by_fleteros_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_fleteros_id']= 1;
$config['show_fleteros_nombre']= 1;
$config['show_fleteros_apellido']= 1;
$config['show_fleteros_telefono']= 1;
$config['show_fleteros_direccion']= 1;
$config['show_fleteros_created_at']= 1;
$config['show_fleteros_updated_at']= 1;

/* Config required fields */

$config['isRequired_fleteros_id']= 1;
$config['isRequired_fleteros_nombre']= 1;
$config['isRequired_fleteros_apellido']= 1;
$config['isRequired_fleteros_telefono']= 1;
$config['isRequired_fleteros_direccion']= 1;
$config['isRequired_fleteros_created_at']= 1;
$config['isRequired_fleteros_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 25;

/* Config flash messages */

$config['fleteros_flash_add_message']= 'The fleteros has been successfully added.';
$config['fleteros_flash_edit_message']= 'The fleteros has been successfully updated.';
$config['fleteros_flash_delete_message']= 'The fleteros has been successfully deleted';
$config['fleteros_flash_error_delete_message']= 'The fleteros hasn\'t been deletedd';
$config['fleteros_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file fleteros_settings.php */
/* Location: ./application/config/fleteros_settings.php */
