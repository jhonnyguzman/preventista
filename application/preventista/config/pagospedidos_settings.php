<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de pagospedidos';
$config['recordAddTitle']=' Nuevo pagospedidos';
$config['recordEditTitle']=' Editar pagospedidos';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['pagospedidos_id']='pagospedidos_id';
$config['pedidos_id']='pedidos_id';
$config['recibos_id']='recibos_id';
$config['pagospedidos_montocubierto']='pagospedidos_montocubierto';
$config['pedidosremitos_created_at']='pedidosremitos_created_at';
$config['pedidosremitos_updated_at']='pedidosremitos_updated_at';

/* Config fields for search */

$config['search_by_pagospedidos_id']= 1;
$config['search_by_pedidos_id']= 0;
$config['search_by_recibos_id']= 0;
$config['search_by_pagospedidos_montocubierto']= 0;
$config['search_by_pedidosremitos_created_at']= 0;
$config['search_by_pedidosremitos_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_pagospedidos_id']= 1;
$config['show_pedidos_id']= 1;
$config['show_recibos_id']= 1;
$config['show_pagospedidos_montocubierto']= 1;
$config['show_pedidosremitos_created_at']= 1;
$config['show_pedidosremitos_updated_at']= 1;

/* Config required fields */

$config['isRequired_pagospedidos_id']= 1;
$config['isRequired_pedidos_id']= 1;
$config['isRequired_recibos_id']= 1;
$config['isRequired_pagospedidos_montocubierto']= 1;
$config['isRequired_pedidosremitos_created_at']= 1;
$config['isRequired_pedidosremitos_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['pagospedidos_flash_add_message']= 'The pagospedidos has been successfully added.';
$config['pagospedidos_flash_edit_message']= 'The pagospedidos has been successfully updated.';
$config['pagospedidos_flash_delete_message']= 'The pagospedidos has been successfully deleted';
$config['pagospedidos_flash_error_delete_message']= 'The pagospedidos hasn\'t been deletedd';
$config['pagospedidos_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file pagospedidos_settings.php */
/* Location: ./application/config/pagospedidos_settings.php */
