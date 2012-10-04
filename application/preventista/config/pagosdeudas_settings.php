<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de pagosdeudas';
$config['recordAddTitle']=' Nuevo pagosdeudas';
$config['recordEditTitle']=' Editar pagosdeudas';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['pagosdeudas_id']='pagosdeudas_id';
$config['deudas_id']='deudas_id';
$config['pagos_id']='pagos_id';
$config['pagosdeudas_montocubierto']='pagosdeudas_montocubierto';
$config['pagosdeudas_created_at']='pagosdeudas_created_at';
$config['pagosdeudas_updated_at']='pagosdeudas_updated_at';

/* Config fields for search */

$config['search_by_pagosdeudas_id']= 1;
$config['search_by_deudas_id']= 0;
$config['search_by_pagos_id']= 0;
$config['search_by_pagosdeudas_montocubierto']= 0;
$config['search_by_pagosdeudas_created_at']= 0;
$config['search_by_pagosdeudas_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_pagosdeudas_id']= 1;
$config['show_deudas_id']= 1;
$config['show_pagos_id']= 1;
$config['show_pagosdeudas_montocubierto']= 1;
$config['show_pagosdeudas_created_at']= 1;
$config['show_pagosdeudas_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['pagosdeudas_flash_add_message']= 'The pagosdeudas has been successfully added.';
$config['pagosdeudas_flash_edit_message']= 'The pagosdeudas has been successfully updated.';
$config['pagosdeudas_flash_delete_message']= 'The pagosdeudas has been successfully deleted';
$config['pagosdeudas_flash_error_delete_message']= 'The pagosdeudas hasn\'t been deletedd';
$config['pagosdeudas_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file pagosdeudas_settings.php */
/* Location: ./application/config/pagosdeudas_settings.php */
