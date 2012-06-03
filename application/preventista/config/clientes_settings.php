<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de clientes';
$config['recordAddTitle']=' Nuevo clientes';
$config['recordEditTitle']=' Editar clientes';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['clientes_id']='Id';
$config['clientes_nombre']='Nombre';
$config['clientes_apellido']='Apellido';
$config['clientes_direccion']='Direcci&oacute;n';
$config['clientes_telefono']='Tel&eacute;fono';
$config['clientescategoria_id']='Categoria';
$config['clientescategoria_descripcion']='Categoria';
$config['clientes_created_at']='Fecha de alta';
$config['clientes_updated_at']='Acualizado el';

/* Config fields for search */

$config['search_by_clientes_id']= 1;
$config['search_by_clientes_nombre']= 1;
$config['search_by_clientes_apellido']= 1;
$config['search_by_clientes_direccion']= 0;
$config['search_by_clientes_telefono']= 0;
$config['search_by_clientescategoria_id']= 0;
$config['search_by_clientes_created_at']= 0;
$config['search_by_clientes_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_clientes_id']= 1;
$config['show_clientes_nombre']= 1;
$config['show_clientes_apellido']= 1;
$config['show_clientes_direccion']= 1;
$config['show_clientes_telefono']= 1;
$config['show_clientescategoria_id']= 0;
$config['show_clientescategoria_descripcion']= 1;
$config['show_clientes_created_at']= 1;
$config['show_clientes_updated_at']= 0;

/* Config required fields */

$config['isRequired_clientes_id']= 1;
$config['isRequired_clientes_nombre']= 1;
$config['isRequired_clientes_apellido']= 1;
$config['isRequired_clientes_direccion']= 1;
$config['isRequired_clientes_telefono']= 1;
$config['isRequired_clientes_categoria']= 1;
$config['isRequired_clientes_created_at']= 1;
$config['isRequired_clientes_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 25;

/* Config flash messages */

$config['clientes_flash_add_message']= 'The clientes has been successfully added.';
$config['clientes_flash_edit_message']= 'The clientes has been successfully updated.';
$config['clientes_flash_delete_message']= 'The clientes has been successfully deleted';
$config['clientes_flash_error_delete_message']= 'The clientes hasn\'t been deletedd';
$config['clientes_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file clientes_settings.php */
/* Location: ./application/config/clientes_settings.php */
