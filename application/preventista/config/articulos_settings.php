<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de articulos';
$config['recordAddTitle']=' Nuevo articulos';
$config['recordEditTitle']=' Editar articulos';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['articulos_id']='Id';
$config['articulos_descripcion']='Descripci&oacute;n';
$config['articulos_preciocompra']='PC';
$config['articulos_stockreal']='Stock real';
$config['articulos_stockmin']='Stock min';
$config['articulos_stockmax']='Stock max';
$config['rubros_id']='rubros_id';
$config['rubros_descripcion']='Rubro';
$config['articulos_observaciones']='Obs.';
$config['articulos_precio1']='Precio1';
$config['articulos_precio2']='Precio2';
$config['articulos_precio3']='Precio3';
$config['articulos_porcentaje1']='%1';
$config['articulos_porcentaje2']='%2';
$config['articulos_porcentaje3']='%3';
$config['articulos_estado']='estado';
$config['articulos_estado_descripcion']='Estado';
$config['marcas_id']='marcas_id';
$config['marcas_descripcion']='Marca';
$config['articulos_created_at']='Fecha de alta';
$config['articulos_updated_at']='Actualizado el';

/* Config fields for search */

$config['search_by_articulos_id']= 0;
$config['search_by_articulos_descripcion']= 1;
$config['search_by_articulos_preciocompra']= 0;
$config['search_by_articulos_stockreal']= 0;
$config['search_by_articulos_stockmin']= 0;
$config['search_by_articulos_stockmax']= 0;
$config['search_by_rubros_id']= 1;
$config['search_by_articulos_observaciones']= 0;
$config['search_by_articulos_precio1']= 0;
$config['search_by_articulos_precio2']= 0;
$config['search_by_articulos_precio3']= 0;
$config['search_by_articulos_porcentaje1']= 0;
$config['search_by_articulos_porcentaje2']= 0;
$config['search_by_articulos_porcentaje3']= 0;
$config['search_by_articulos_estado']= 0;
$config['search_by_marcas_id']= 1;
$config['search_by_articulos_created_at']= 0;
$config['search_by_articulos_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_articulos_id']= 1;
$config['show_articulos_descripcion']= 1;
$config['show_articulos_preciocompra']= 1;
$config['show_articulos_stockreal']= 1;
$config['show_articulos_stockmin']= 0;
$config['show_articulos_stockmax']= 0;
$config['show_rubros_id']= 0;
$config['show_rubros_descripcion']= 1;
$config['show_articulos_observaciones']= 0;
$config['show_articulos_precio1']= 1;
$config['show_articulos_precio2']= 1;
$config['show_articulos_precio3']= 1;
$config['show_articulos_porcentaje1']= 1;
$config['show_articulos_porcentaje2']= 1;
$config['show_articulos_porcentaje3']= 1;
$config['show_articulos_estado']= 0;
$config['show_articulos_estado_descripcion']= 0;
$config['show_marcas_id']= 0;
$config['show_marcas_descripcion']= 1;
$config['show_articulos_created_at']= 0;
$config['show_articulos_updated_at']= 0;

/* Config required fields */

$config['isRequired_articulos_id']= 1;
$config['isRequired_articulos_descripcion']= 1;
$config['isRequired_articulos_preciocompra']= 1;
$config['isRequired_articulos_stockreal']= 1;
$config['isRequired_articulos_stockmin']= 1;
$config['isRequired_articulos_stockmax']= 1;
$config['isRequired_rubros_id']= 1;
$config['isRequired_articulos_observaciones']= 1;
$config['isRequired_articulos_precio1']= 1;
$config['isRequired_articulos_precio2']= 1;
$config['isRequired_articulos_precio3']= 1;
$config['isRequired_articulos_porcentaje1']= 1;
$config['isRequired_articulos_porcentaje2']= 1;
$config['isRequired_articulos_porcentaje3']= 1;
$config['isRequired_articulos_estado']= 1;
$config['isRequired_marcas_id']= 1;
$config['isRequired_articulos_created_at']= 1;
$config['isRequired_articulos_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 20;


/* Config flash messages */

$config['articulos_flash_add_message']= 'The articulos has been successfully added.';
$config['articulos_flash_edit_message']= 'The articulos has been successfully updated.';
$config['articulos_flash_delete_message']= 'The articulos has been successfully deleted';
$config['articulos_flash_error_delete_message']= 'The articulos hasn\'t been deletedd';
$config['articulos_flash_error_message']= 'A database error has occured, please contact your administrator.';
$config['articulos_flash_x1_message']= 'Se actualizó el precio correctamente de todos los articulos seleccionados';
$config['articulos_flash_x2_message']= 'Error al actualizar el precio de uno o mas articulos';

/* End of file articulos_settings.php */
/* Location: ./application/config/articulos_settings.php */
