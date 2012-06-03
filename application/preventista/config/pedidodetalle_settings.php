<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de pedidodetalle';
$config['recordAddTitle']=' Nuevo pedidodetalle';
$config['recordEditTitle']=' Editar pedidodetalle';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['pedidodetalle_id']='pedidodetalle_id';
$config['pedidos_id']='pedidos_id';
$config['articulos_id']='articulos_id';
$config['articulos_descripcion']='articulos_descripcion';
$config['articulos_precio']='articulos_precio';
$config['articulos_stockreal']='articulos_stockreal';
$config['pedidodetalle_cantidad']='pedidodetalle_cantidad';
$config['pedidodetalle_montoacordado']='pedidodetalle_montoacordado';
$config['pedidodetalle_created_at']='pedidodetalle_created_at';
$config['pedidodetalle_updated_at']='pedidodetalle_updated_at';
$config['pedidodetalle_subtotal']='pedidodetalle_subtotal';
$config['pedidodetalle_pv']='pedidodetalle_pv';

/* Config fields for search */

$config['search_by_pedidodetalle_id']= 1;
$config['search_by_pedidos_id']= 0;
$config['search_by_articulos_id']= 0;
$config['search_by_articulos_descripcion']= 0;
$config['search_by_articulos_precio']= 0;
$config['search_by_articulos_stockreal']= 0;
$config['search_by_pedidodetalle_cantidad']= 0;
$config['search_by_pedidodetalle_montoacordado']= 0;
$config['search_by_pedidodetalle_created_at']= 0;
$config['search_by_pedidodetalle_updated_at']= 0;
$config['search_by_pedidodetalle_subtotal']= 0;
$config['search_by_pedidodetalle_pv']= 0;

/* Config fields for show in the result list */

$config['show_pedidodetalle_id']= 1;
$config['show_pedidos_id']= 1;
$config['show_articulos_id']= 1;
$config['show_articulos_descripcion']= 1;
$config['show_articulos_precio']= 1;
$config['show_articulos_stockreal']= 0;
$config['show_pedidodetalle_cantidad']= 1;
$config['show_pedidodetalle_montoacordado']= 1;
$config['show_pedidodetalle_created_at']= 1;
$config['show_pedidodetalle_updated_at']= 1;
$config['show_pedidodetalle_subtotal']= 1;
$config['show_pedidodetalle_pv']= 1;

/* Config required fields */

$config['isRequired_pedidodetalle_id']= 1;
$config['isRequired_pedidos_id']= 1;
$config['isRequired_articulos_id']= 1;
$config['isRequired_pedidodetalle_cantidad']= 1;
$config['isRequired_pedidodetalle_montoacordado']= 1;
$config['isRequired_pedidodetalle_created_at']= 1;
$config['isRequired_pedidodetalle_updated_at']= 1;
$config['isRequired_pedidodetalle_subtotal']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['pedidodetalle_flash_add_message']= 'The pedidodetalle has been successfully added.';
$config['pedidodetalle_flash_edit_message']= 'The pedidodetalle has been successfully updated.';
$config['pedidodetalle_flash_delete_message']= 'The pedidodetalle has been successfully deleted';
$config['pedidodetalle_flash_error_delete_message']= 'The pedidodetalle hasn\'t been deletedd';
$config['pedidodetalle_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file pedidodetalle_settings.php */
/* Location: ./application/config/pedidodetalle_settings.php */
