<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de Rubros';
$config['recordAddTitle']=' Nuevo Rubro';
$config['recordEditTitle']=' Editar Rubro';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['rubros_id']='Rubro Id';
$config['rubros_descripcion']='Descripci&oacute;n';
$config['rubros_estado']='Estado';
$config['rubros_estado_descripcion']='Estado';
$config['rubros_created_at']='Fecha de alta';
$config['rubros_updated_at']='Actualizado el';

/* Config fields for search */

$config['search_by_rubros_id']= 0;
$config['search_by_rubros_descripcion']= 1;
$config['search_by_rubros_estado']= 0;
$config['search_by_rubros_created_at']= 0;
$config['search_by_rubros_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_rubros_id']= 1;
$config['show_rubros_descripcion']= 1;
$config['show_rubros_estado']= 0;
$config['show_rubros_estado_descripcion']= 1;
$config['show_rubros_created_at']= 1;
$config['show_rubros_updated_at']= 1;

/* Config required fields */

$config['isRequired_rubros_id']= 1;
$config['isRequired_rubros_descripcion']= 1;
$config['isRequired_rubros_estado']= 1;
$config['isRequired_rubros_created_at']= 1;
$config['isRequired_rubros_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 25;


/* Config flash messages */

$config['rubros_flash_add_message']= 'The rubros has been successfully added.';
$config['rubros_flash_edit_message']= 'The rubros has been successfully updated.';
$config['rubros_flash_delete_message']= 'The rubros has been successfully deleted';
$config['rubros_flash_error_delete_message']= 'The rubros hasn\'t been deletedd';
$config['rubros_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file rubros_settings.php */
/* Location: ./application/config/rubros_settings.php */
