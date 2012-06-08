<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de pagos';
$config['recordAddTitle']=' Nuevo pagos';
$config['recordEditTitle']=' Editar pagos';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['pagos_id']='Recibo Id';
$config['pagos_monto']='Monto';
$config['clientes_id']='Cliente';
$config['clientes_apellido']='Cliente';
$config['clientes_nombre']='Cliente';
$config['clientes_apellnom']='Cliente';
$config['usuarios_id']='Usuario';
$config['usuarios_username']='Usuario';
$config['pagos_estado']='Estado';
$config['pagos_fechaingreso']='Fecha de ingreso';
$config['pagos_created_at']='Fecha de alta';
$config['pagos_updated_at']='Actualizado en';

/* Config fields for search */

$config['search_by_pagos_id']= 0;
$config['search_by_pagos_monto']= 0;
$config['search_by_clientes_id']= 1;
$config['search_by_usuarios_id']= 1;
$config['search_by_pagos_estado']= 1;
$config['search_by_pagos_fechaingreso']= 1;
$config['search_by_pagos_created_at']= 0;
$config['search_by_pagos_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_pagos_id']= 1;
$config['show_pagos_monto']= 1;
$config['show_clientes_id']= 0;
$config['show_clientes_apellido']= 0;
$config['show_clientes_nombre']= 0;
$config['show_clientes_apellnom']= 1;
$config['show_usuarios_id']= 0;
$config['show_usuarios_username']= 1;
$config['show_pagos_estado']= 0;
$config['show_pagos_fechaingreso']= 1;
$config['show_pagos_created_at']= 1;
$config['show_pagos_updated_at']= 0;

/* Config required fields */

$config['isRequired_pagos_id']= 1;
$config['isRequired_pagos_monto']= 1;
$config['isRequired_clientes_id']= 1;
$config['isRequired_usuarios_id']= 1;
$config['isRequired_pagos_estado']= 1;
$config['isRequired_pagos_fechaingreso']= 1;
$config['isRequired_pagos_created_at']= 1;
$config['isRequired_pagos_updated_at']= 0;

/* Config params of pagination */

$config['pag_perpage']= 20;

/* Config flash messages */

$config['pagos_flash_add_message']= 'The pagos has been successfully added.';
$config['pagos_flash_edit_message']= 'The pagos has been successfully updated.';
$config['pagos_flash_delete_message']= 'The pagos has been successfully deleted';
$config['pagos_flash_error_delete_message']= 'The pagos hasn\'t been deletedd';
$config['pagos_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file pagos_settings.php */
/* Location: ./application/config/pagos_settings.php */
