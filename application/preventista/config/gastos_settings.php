<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de gastos';
$config['recordAddTitle']=' Nuevo gastos';
$config['recordEditTitle']=' Editar gastos';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['gastos_id']='gastos_id';
$config['gastos_descripcion']='gastos_descripcion';
$config['hojaruta_id']='hojaruta_id';
$config['gastos_monto']='gastos_monto';
$config['gastos_created_at']='gastos_created_at';
$config['gastos_updated_at']='gastos_updated_at';

/* Config fields for search */

$config['search_by_gastos_id']= 1;
$config['search_by_gastos_descripcion']= 0;
$config['search_by_hojaruta_id']= 0;
$config['search_by_gastos_monto']= 0;
$config['search_by_gastos_created_at']= 0;
$config['search_by_gastos_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_gastos_id']= 1;
$config['show_gastos_descripcion']= 1;
$config['show_hojaruta_id']= 1;
$config['show_gastos_monto']= 1;
$config['show_gastos_created_at']= 1;
$config['show_gastos_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['gastos_flash_add_message']= 'The gastos has been successfully added.';
$config['gastos_flash_edit_message']= 'The gastos has been successfully updated.';
$config['gastos_flash_delete_message']= 'The gastos has been successfully deleted';
$config['gastos_flash_error_delete_message']= 'The gastos hasn\'t been deletedd';
$config['gastos_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file gastos_settings.php */
/* Location: ./application/config/gastos_settings.php */
