<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de men&uacute;s del Sistema';
$config['recordAddTitle']=' Nuevo Men&uacute;';
$config['recordEditTitle']=' Editar Men&uacute;';

/* Config labels of the form fields */

$config['sismenu_id']='Men&uacute; Id';
$config['sismenu_descripcion']='Descripci&oacute;n';
$config['sismenu_estado']='Estado';
$config['sismenu_estado_descripcion']='Estado';
$config['sismenu_parent']='Men&uacute; Padre';
$config['sismenu_parent_descripcion']='Men&uacute; Padre';
$config['sismenu_created_at']='Fecha de alta';
$config['sismenu_updated_at']='Actualizado el';
$config['sisvinculos_link']='Enlace';

/* Config fields for search */

$config['search_by_sismenu_id']= 0;
$config['search_by_sismenu_descripcion']= 1;
$config['search_by_sismenu_estado']= 0;
$config['search_by_sismenu_parent']= 0;
$config['search_by_sismenu_created_at']= 0;
$config['search_by_sismenu_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_sismenu_id']= 1;
$config['show_sismenu_descripcion']= 1;
$config['show_sismenu_estado']= 0;
$config['show_sismenu_estado_descripcion']= 1;
$config['show_sismenu_parent']= 0;
$config['show_sismenu_parent_descripcion']= 1;
$config['show_sismenu_created_at']= 1;
$config['show_sismenu_updated_at']= 1;
$config['show_sisvinculos_link']= 1;

/* Config params of pagination */

$config['pag_perpage']= 25;

/* Config flash messages */

$config['sismenu_flash_add_message']= 'The sismenu has been successfully added.';
$config['sismenu_flash_edit_message']= 'The sismenu has been successfully updated.';
$config['sismenu_flash_delete_message']= 'The sismenu has been successfully deleted';
$config['sismenu_flash_error_delete_message']= 'The sismenu hasn\'t been deletedd';
$config['sismenu_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file sismenu_settings.php */
/* Location: ./application/config/sismenu_settings.php */
