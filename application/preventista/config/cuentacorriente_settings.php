<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de Cuentas Corrientes';
$config['recordAddTitle']=' Nuevo Cuenta';
$config['recordEditTitle']=' Editar Cuenta';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['cuentacorriente_id']='Id';
$config['clientes_id']='Cliente';
$config['clientes_apellido']='Cliente';
$config['clientes_nombre']='Cliente';
$config['clientes_apellnom']='Cliente';
$config['cuentacorriente_haber']='Haber';
$config['cuentacorriente_debe']='Debe';
$config['cuentacorriente_saldo']='Saldo';
$config['cuentacorriente_created_at']='Fecha de alta';
$config['cuentacorriente_updated_at']='Actualizado el';

/* Config fields for search */

$config['search_by_cuentacorriente_id']= 0;
$config['search_by_clientes_id']= 1;
$config['search_by_cuentacorriente_haber']= 0;
$config['search_by_cuentacorriente_debe']= 0;
$config['search_by_cuentacorriente_saldo']= 0;
$config['search_by_cuentacorriente_created_at']= 0;
$config['search_by_cuentacorriente_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_cuentacorriente_id']= 1;
$config['show_clientes_id']= 0;
$config['show_clientes_apellido']= 0;
$config['show_clientes_nombre']= 0;
$config['show_clientes_apellnom']= 1;
$config['show_cuentacorriente_haber']= 1;
$config['show_cuentacorriente_debe']= 1;
$config['show_cuentacorriente_saldo']= 0;
$config['show_cuentacorriente_created_at']= 1;
$config['show_cuentacorriente_updated_at']= 1;

/* Config required fields */

$config['isRequired_cuentacorriente_id']= 1;
$config['isRequired_clientes_id']= 1;
$config['isRequired_cuentacorriente_haber']= 1;
$config['isRequired_cuentacorriente_debe']= 1;
$config['isRequired_cuentacorriente_saldo']= 1;
$config['isRequired_cuentacorriente_created_at']= 1;
$config['isRequired_cuentacorriente_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 25;

/* Config flash messages */

$config['cuentacorriente_flash_add_message']= 'The cuentacorriente has been successfully added.';
$config['cuentacorriente_flash_edit_message']= 'The cuentacorriente has been successfully updated.';
$config['cuentacorriente_flash_delete_message']= 'The cuentacorriente has been successfully deleted';
$config['cuentacorriente_flash_error_delete_message']= 'The cuentacorriente hasn\'t been deletedd';
$config['cuentacorriente_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file cuentacorriente_settings.php */
/* Location: ./application/config/cuentacorriente_settings.php */
