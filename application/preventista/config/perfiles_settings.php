<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de perfiles';
$config['recordAddTitle']=' Nuevo perfil';
$config['recordEditTitle']=' Editar perfil';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['perfiles_id']='Perfil Id';
$config['perfiles_descripcion']='Descripci&oacute;n';
$config['perfiles_estado']='Estado';
$config['perfiles_estado_descripcion']='Estado';
$config['perfiles_created_at']='Fecha de alta';
$config['perfiles_updated_at']='Actualizado el';

/* Config fields for search */

$config['search_by_perfiles_id']= 0;
$config['search_by_perfiles_descripcion']= 1;
$config['search_by_perfiles_estado']= 0;
$config['search_by_perfiles_created_at']= 0;
$config['search_by_perfiles_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_perfiles_id']= 1;
$config['show_perfiles_descripcion']= 1;
$config['show_perfiles_estado']= 0;
$config['show_perfiles_estado_descripcion']= 1;
$config['show_perfiles_created_at']= 1;
$config['show_perfiles_updated_at']= 1;

/* Config required fields */

$config['isRequired_perfiles_id']= 1;
$config['isRequired_perfiles_descripcion']= 1;
$config['isRequired_perfiles_estado']= 1;
$config['isRequired_perfiles_created_at']= 1;
$config['isRequired_perfiles_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['perfiles_flash_add_message']= 'The perfiles has been successfully added.';
$config['perfiles_flash_edit_message']= 'The perfiles has been successfully updated.';
$config['perfiles_flash_delete_message']= 'The perfiles has been successfully deleted';
$config['perfiles_flash_error_delete_message']= 'The perfiles hasn\'t been deletedd';
$config['perfiles_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file perfiles_settings.php */
/* Location: ./application/config/perfiles_settings.php */
