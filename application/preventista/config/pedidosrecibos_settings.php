<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de pedidosrecibos';
$config['recordAddTitle']=' Nuevo pedidosrecibos';
$config['recordEditTitle']=' Editar pedidosrecibos';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['pedidosrecibos_id']='pedidosrecibos_id';
$config['pedidos_id']='pedidos_id';
$config['recibos_id']='recibos_id';
$config['pedidosrecibos_montocubierto']='pedidosrecibos_montocubierto';
$config['pedidosremitos_created_at']='pedidosremitos_created_at';
$config['pedidosremitos_updated_at']='pedidosremitos_updated_at';

/* Config fields for search */

$config['search_by_pedidosrecibos_id']= 1;
$config['search_by_pedidos_id']= 0;
$config['search_by_recibos_id']= 0;
$config['search_by_pedidosrecibos_montocubierto']= 0;
$config['search_by_pedidosremitos_created_at']= 0;
$config['search_by_pedidosremitos_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_pedidosrecibos_id']= 1;
$config['show_pedidos_id']= 1;
$config['show_recibos_id']= 1;
$config['show_pedidosrecibos_montocubierto']= 1;
$config['show_pedidosremitos_created_at']= 1;
$config['show_pedidosremitos_updated_at']= 1;

/* Config required fields */

$config['isRequired_pedidosrecibos_id']= 1;
$config['isRequired_pedidos_id']= 1;
$config['isRequired_recibos_id']= 1;
$config['isRequired_pedidosrecibos_montocubierto']= 1;
$config['isRequired_pedidosremitos_created_at']= 1;
$config['isRequired_pedidosremitos_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['pedidosrecibos_flash_add_message']= 'The pedidosrecibos has been successfully added.';
$config['pedidosrecibos_flash_edit_message']= 'The pedidosrecibos has been successfully updated.';
$config['pedidosrecibos_flash_delete_message']= 'The pedidosrecibos has been successfully deleted';
$config['pedidosrecibos_flash_error_delete_message']= 'The pedidosrecibos hasn\'t been deletedd';
$config['pedidosrecibos_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file pedidosrecibos_settings.php */
/* Location: ./application/config/pedidosrecibos_settings.php */
