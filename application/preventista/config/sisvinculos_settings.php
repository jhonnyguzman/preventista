<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de sisvinculos';
$config['recordAddTitle']=' Nuevo sisvinculos';
$config['recordEditTitle']=' Editar sisvinculos';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['sisvinculos_id']='sisvinculos_id';
$config['sismenu_id']='sismenu_id';
$config['sisvinculos_link']='sisvinculos_link';
$config['sisvinculos_created_at']='sisvinculos_created_at';
$config['sisvinculos_updated_at']='sisvinculos_updated_at';

/* Config fields for search */

$config['search_by_sisvinculos_id']= 1;
$config['search_by_sismenu_id']= 0;
$config['search_by_sisvinculos_link']= 0;
$config['search_by_sisvinculos_created_at']= 0;
$config['search_by_sisvinculos_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_sisvinculos_id']= 1;
$config['show_sismenu_id']= 1;
$config['show_sisvinculos_link']= 1;
$config['show_sisvinculos_created_at']= 1;
$config['show_sisvinculos_updated_at']= 1;

/* Config required fields */

$config['isRequired_sisvinculos_id']= 1;
$config['isRequired_sismenu_id']= 1;
$config['isRequired_sisvinculos_link']= 1;
$config['isRequired_sisvinculos_created_at']= 1;
$config['isRequired_sisvinculos_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['sisvinculos_flash_add_message']= 'The sisvinculos has been successfully added.';
$config['sisvinculos_flash_edit_message']= 'The sisvinculos has been successfully updated.';
$config['sisvinculos_flash_delete_message']= 'The sisvinculos has been successfully deleted';
$config['sisvinculos_flash_error_delete_message']= 'The sisvinculos hasn\'t been deletedd';
$config['sisvinculos_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file sisvinculos_settings.php */
/* Location: ./application/config/sisvinculos_settings.php */
