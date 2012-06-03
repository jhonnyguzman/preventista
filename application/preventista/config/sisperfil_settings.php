<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de sisperfil';
$config['recordAddTitle']=' Nuevo sisperfil';
$config['recordEditTitle']=' Editar sisperfil';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['sisperfil_id']='sisperfil_id';
$config['sismenu_id']='sismenu_id';
$config['perfiles_id']='perfiles_id';
$config['sisperfil_estado']='sisperfil_estado';
$config['sisperfil_created_at']='sisperfil_created_at';
$config['sisperfil_updated_at']='sisperfil_updated_at';

/* Config fields for search */

$config['search_by_sisperfil_id']= 1;
$config['search_by_sismenu_id']= 0;
$config['search_by_perfiles_id']= 0;
$config['search_by_sisperfil_estado']= 0;
$config['search_by_sisperfil_created_at']= 0;
$config['search_by_sisperfil_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_sisperfil_id']= 1;
$config['show_sismenu_id']= 1;
$config['show_perfiles_id']= 1;
$config['show_sisperfil_estado']= 1;
$config['show_sisperfil_created_at']= 1;
$config['show_sisperfil_updated_at']= 1;

/* Config required fields */

$config['isRequired_sisperfil_id']= 1;
$config['isRequired_sismenu_id']= 1;
$config['isRequired_perfiles_id']= 1;
$config['isRequired_sisperfil_estado']= 1;
$config['isRequired_sisperfil_created_at']= 1;
$config['isRequired_sisperfil_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['sisperfil_flash_add_message']= 'The sisperfil has been successfully added.';
$config['sisperfil_flash_edit_message']= 'The sisperfil has been successfully updated.';
$config['sisperfil_flash_delete_message']= 'The sisperfil has been successfully deleted';
$config['sisperfil_flash_error_delete_message']= 'The sisperfil hasn\'t been deletedd';
$config['sisperfil_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file sisperfil_settings.php */
/* Location: ./application/config/sisperfil_settings.php */
