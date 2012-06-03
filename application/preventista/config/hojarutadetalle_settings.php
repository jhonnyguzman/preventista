<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de hojarutadetalle';
$config['recordAddTitle']=' Nuevo hojarutadetalle';
$config['recordEditTitle']=' Editar hojarutadetalle';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['hojarutadetalle_id']='Id';
$config['hojaruta_id']='Hoja de ruta Id';
$config['pedidos_id']='Pedido Id';
$config['peididos_montototal']='Monto total';
$config['pedidos_montoadeudado']='Monto Adeudado';
$config['clientes_apellido']='Cliente apellido';
$config['clientes_nombre']='Cliente nombre';
$config['tramites_id']='Tr&aacute;mite';
$config['tramites_descripcion']='Tr&aacute;mite';
$config['clientes_direccion']='Cliente direcci&oacute;n';
$config['hojarutadetalle_created_at']='Fecha de alta';
$config['hojarutadetalle_updated_at']='Actualizado en';

/* Config fields for search */

$config['search_by_hojarutadetalle_id']= 1;
$config['search_by_hojaruta_id']= 0;
$config['search_by_pedidos_id']= 0;
$config['search_by_hojarutadetalle_created_at']= 0;
$config['search_by_hojarutadetalle_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_hojarutadetalle_id']= 1;
$config['show_hojaruta_id']= 1;
$config['show_pedidos_id']= 0;
$config['show_peididos_montototal']= 1;
$config['show_pedidos_montoadeudado']= 1;
$config['show_clientes_apellido']= 1;
$config['show_clientes_nombre']= 1;
$config['show_clientes_direccion']= 1;
$config['show_tramites_id']= 1;
$config['show_tramites_descripcion']= 1;
$config['show_hojarutadetalle_created_at']= 0;
$config['show_hojarutadetalle_updated_at']= 0;

/* Config required fields */

$config['isRequired_hojarutadetalle_id']= 1;
$config['isRequired_hojaruta_id']= 1;
$config['isRequired_pedidos_id']= 1;
$config['isRequired_hojarutadetalle_created_at']= 1;
$config['isRequired_hojarutadetalle_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 25;

/* Config flash messages */

$config['hojarutadetalle_flash_add_message']= 'The hojarutadetalle has been successfully added.';
$config['hojarutadetalle_flash_edit_message']= 'The hojarutadetalle has been successfully updated.';
$config['hojarutadetalle_flash_delete_message']= 'The hojarutadetalle has been successfully deleted';
$config['hojarutadetalle_flash_error_delete_message']= 'The hojarutadetalle hasn\'t been deletedd';
$config['hojarutadetalle_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file hojarutadetalle_settings.php */
/* Location: ./application/config/hojarutadetalle_settings.php */
