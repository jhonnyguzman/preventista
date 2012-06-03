<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de hojas de ruta';
$config['recordAddTitle']=' Nueva hoja de ruta';
$config['recordEditTitle']=' Editar hoja ruta';
$config['recordShowTitle']=' Hoja de ruta';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['hojaruta_id']='Hoja ruta Id';
$config['hojaruta_estado']='Estado';
$config['hojaruta_estado_descripcion']='Estado';
$config['fleteros_id']='Fletero';
$config['fleteros_apellido']='Apellido';
$config['fleteros_nombre']='Nombre';
$config['fleteros_apellnom']='Fletero';
$config['usuarios_id']='Usuario';
$config['usuarios_username']='Usuario';
$config['hojaruta_created_at']='Fecha de alta';
$config['hojaruta_updated_at']='updated_at';

/* Config fields for search */

$config['search_by_hojaruta_id']= 1;
$config['search_by_hojaruta_estado']= 1;
$config['search_by_fleteros_id']= 1;
$config['search_by_fleteros_apellido']= 0;
$config['search_by_fleteros_nombre']= 0;
$config['search_by_usuarios_id']= 0;
$config['search_by_usuarios_username']= 0;
$config['search_by_hojaruta_created_at']= 1;
$config['search_by_hojaruta_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_hojaruta_id']= 1;
$config['show_hojaruta_estado']= 0;
$config['show_hojaruta_estado_descripcion']= 1;
$config['show_fleteros_id']= 0;
$config['show_fleteros_apellido']= 0;
$config['show_fleteros_nombre']= 0;
$config['show_fleteros_apellnom']= 1;
$config['show_usuarios_id']= 0;
$config['show_usuarios_username']= 1;
$config['show_hojaruta_created_at']= 1;
$config['show_hojaruta_updated_at']= 0;

/* Config required fields */

$config['isRequired_hojaruta_id']= 1;
$config['isRequired_fleteros_id']= 1;
$config['isRequired_usuarios_id']= 1;
$config['isRequired_hojaruta_created_at']= 1;
$config['isRequired_hojaruta_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 30;

/* Config flash messages */

$config['hojaruta_flash_add_message']= 'The hojaruta has been successfully added.';
$config['hojaruta_flash_edit_message']= 'The hojaruta has been successfully updated.';
$config['hojaruta_flash_delete_message']= 'The hojaruta has been successfully deleted';
$config['hojaruta_flash_error_delete_message']= 'The hojaruta hasn\'t been deletedd';
$config['hojaruta_flash_error_message']= 'A database error has occured, please contact your administrator.';
$config['hojaruta_flash_errorX2_message']= "Error, selecciona s&oacute;lo pedidos con estado 'Solicitado'";
$config['hojaruta_flash_errorX3_message']= "Error, s&oacute;lo puedes editar Hojas de rutas con estado 'Planteada'";
$config['hojaruta_flash_errorX4_message']= "Error, selecciona s&oacute;lo Hoja de Rutas con estado 'Planteada'";

$config['hojaruta_flash_print_message']= 'Atenci&oacute;n, se van a generar los remitos para cada pedido incluido dentro de las Hojas de Ruta seleccionadas';
$config['hojaruta_flash_error_print_message']= "A ocurrido un error al generar los remitos de cada pedido.";
$config['hojaruta_flash_print_success_message']= "Se han generado con &eacute;xito los remitos";
/* End of file hojaruta_settings.php */
/* Location: ./application/config/hojaruta_settings.php */
