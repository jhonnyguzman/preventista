<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de localidades';
$config['recordAddTitle']=' Nuevo localidades';
$config['recordEditTitle']=' Editar localidades';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['localidades_id']='localidades_id';
$config['localidades_nombre']='localidades_nombre';
$config['localidades_codpostal']='localidades_codpostal';
$config['provincias_id']='provincias_id';
$config['localidades_created_at']='localidades_created_at';
$config['localidades_updated_at']='localidades_updated_at';

/* Config fields for search */

$config['search_by_localidades_id']= 1;
$config['search_by_localidades_nombre']= 0;
$config['search_by_localidades_codpostal']= 0;
$config['search_by_provincias_id']= 0;
$config['search_by_localidades_created_at']= 0;
$config['search_by_localidades_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_localidades_id']= 1;
$config['show_localidades_nombre']= 1;
$config['show_localidades_codpostal']= 1;
$config['show_provincias_id']= 1;
$config['show_localidades_created_at']= 1;
$config['show_localidades_updated_at']= 1;

/* Config required fields */

$config['isRequired_localidades_id']= 1;
$config['isRequired_localidades_nombre']= 1;
$config['isRequired_localidades_codpostal']= 1;
$config['isRequired_provincias_id']= 1;
$config['isRequired_localidades_created_at']= 1;
$config['isRequired_localidades_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['localidades_flash_add_message']= 'The localidades has been successfully added.';
$config['localidades_flash_edit_message']= 'The localidades has been successfully updated.';
$config['localidades_flash_delete_message']= 'The localidades has been successfully deleted';
$config['localidades_flash_error_delete_message']= 'The localidades hasn\'t been deletedd';
$config['localidades_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file localidades_settings.php */
/* Location: ./application/config/localidades_settings.php */
