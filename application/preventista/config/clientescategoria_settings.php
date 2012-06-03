<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de categorias de clientes';
$config['recordAddTitle']=' Nuevo Categoria';
$config['recordEditTitle']=' Editar Categoria';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['clientescategoria_id']='Categoria Id';
$config['clientescategoria_descripcion']='Descripci&oacute;n';
$config['clientescategoria_estado']='Estado';
$config['clientescategoria_created_at']='Fecha de alta';
$config['clientescategoria_updated_at']='Actualizado el';

/* Config fields for search */

$config['search_by_clientescategoria_id']= 0;
$config['search_by_clientescategoria_descripcion']= 1;
$config['search_by_clientescategoria_estado']= 0;
$config['search_by_clientescategoria_created_at']= 0;
$config['search_by_clientescategoria_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_clientescategoria_id']= 1;
$config['show_clientescategoria_descripcion']= 1;
$config['show_clientescategoria_estado']= 1;
$config['show_clientescategoria_created_at']= 1;
$config['show_clientescategoria_updated_at']= 1;

/* Config required fields */

$config['isRequired_clientescategoria_id']= 1;
$config['isRequired_clientescategoria_descripcion']= 1;
$config['isRequired_clientescategoria_estado']= 0;
$config['isRequired_clientescategoria_created_at']= 1;
$config['isRequired_clientescategoria_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 25;

/* Config flash messages */

$config['clientescategoria_flash_add_message']= 'The clientescategoria has been successfully added.';
$config['clientescategoria_flash_edit_message']= 'The clientescategoria has been successfully updated.';
$config['clientescategoria_flash_delete_message']= 'The clientescategoria has been successfully deleted';
$config['clientescategoria_flash_error_delete_message']= 'The clientescategoria hasn\'t been deletedd';
$config['clientescategoria_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file clientescategoria_settings.php */
/* Location: ./application/config/clientescategoria_settings.php */
