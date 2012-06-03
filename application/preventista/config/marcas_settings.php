<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de Marcas';
$config['recordAddTitle']=' Nuevo Marca';
$config['recordEditTitle']=' Editar Marca';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['marcas_id']='Marca Id';
$config['marcas_parent']='Marca Padre';
$config['marcas_parent_descripcion']='Marca Padre';
$config['marcas_descripcion']='Descripci&oacute;n';
$config['marcas_estado']='Estado';
$config['marcas_estado_descripcion']='Estado';
$config['marcas_created_at']='Fecha de alta';
$config['marcas_updated_at']='Actualizado el';

/* Config fields for search */

$config['search_by_marcas_id']= 0;
$config['search_by_marcas_parent']= 1;
$config['search_by_marcas_descripcion']= 1;
$config['search_by_marcas_estado']= 0;
$config['search_by_marcas_created_at']= 0;
$config['search_by_marcas_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_marcas_id']= 1;
$config['show_marcas_parent']= 0;
$config['show_marcas_parent_descripcion']= 1;
$config['show_marcas_descripcion']= 1;
$config['show_marcas_estado']= 0;
$config['show_marcas_estado_descripcion']= 1;
$config['show_marcas_created_at']= 1;
$config['show_marcas_updated_at']= 1;

/* Config required fields */

$config['isRequired_marcas_id']= 1;
$config['isRequired_marcas_parent']= 1;
$config['isRequired_marcas_descripcion']= 1;
$config['isRequired_marcas_estado']= 1;
$config['isRequired_marcas_created_at']= 1;
$config['isRequired_marcas_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 25;

/* Config flash messages */

$config['marcas_flash_add_message']= 'The marcas has been successfully added.';
$config['marcas_flash_edit_message']= 'The marcas has been successfully updated.';
$config['marcas_flash_delete_message']= 'The marcas has been successfully deleted';
$config['marcas_flash_error_delete_message']= 'The marcas hasn\'t been deletedd';
$config['marcas_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file marcas_settings.php */
/* Location: ./application/config/marcas_settings.php */
