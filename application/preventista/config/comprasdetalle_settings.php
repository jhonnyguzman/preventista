<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de comprasdetalle';
$config['recordAddTitle']=' Nuevo comprasdetalle';
$config['recordEditTitle']=' Editar comprasdetalle';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['comprasdetalle_id']='Id';
$config['compras_id']='Compras Id';
$config['articulos_id']='Articulo';
$config['articulos_descripcion']='Articulo';
$config['articulos_stockreal']='Stock real';
$config['comprasdetalle_cantidad']='Cantidad';
$config['comprasdetalle_costo']='Costo';
$config['comprasdetalle_subtotal']='Subtotal';
$config['comprasdetalle_created_at']='Fecha de alta';
$config['comprasdetalle_updated_at']='Actualizado en';

/* Config fields for search */

$config['search_by_comprasdetalle_id']= 1;
$config['search_by_compras_id']= 0;
$config['search_by_articulos_id']= 1;
$config['search_by_comprasdetalle_cantidad']= 0;
$config['search_by_comprasdetalle_costo']= 0;
$config['search_by_comprasdetalle_subtotal']= 0;
$config['search_by_comprasdetalle_created_at']= 0;
$config['search_by_comprasdetalle_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_comprasdetalle_id']= 1;
$config['show_compras_id']= 1;
$config['show_articulos_id']= 1;
$config['show_articulos_descripcion']= 1;
$config['show_articulos_stockreal']= 1;
$config['show_comprasdetalle_cantidad']= 1;
$config['show_comprasdetalle_costo']= 1;
$config['show_comprasdetalle_subtotal']= 1;
$config['show_comprasdetalle_created_at']= 1;
$config['show_comprasdetalle_updated_at']= 1;

/* Config required fields */

$config['isRequired_comprasdetalle_id']= 1;
$config['isRequired_compras_id']= 1;
$config['isRequired_articulos_id']= 1;
$config['isRequired_comprasdetalle_cantidad']= 1;
$config['isRequired_comprasdetalle_costo']= 1;
$config['isRequired_comprasdetalle_subtotal']= 1;
$config['isRequired_comprasdetalle_created_at']= 1;
$config['isRequired_comprasdetalle_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 18;

/* Config flash messages */

$config['comprasdetalle_flash_add_message']= 'The comprasdetalle has been successfully added.';
$config['comprasdetalle_flash_edit_message']= 'The comprasdetalle has been successfully updated.';
$config['comprasdetalle_flash_delete_message']= 'The comprasdetalle has been successfully deleted';
$config['comprasdetalle_flash_error_delete_message']= 'The comprasdetalle hasn\'t been deletedd';
$config['comprasdetalle_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file comprasdetalle_settings.php */
/* Location: ./application/config/comprasdetalle_settings.php */
