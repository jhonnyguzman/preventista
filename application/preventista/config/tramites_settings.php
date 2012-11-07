<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de Tr&aacute;mites';
$config['recordAddTitle']=' Nuevo Tr&aacute;mite';
$config['recordEditTitle']=' Editar Tr&aacute;mite';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['tramites_id']='Tramite Id';
$config['tramites_descripcion']='Descripci&oacute;n';
$config['tramites_created_at']='Fecha de alta';
$config['tramites_updated_at']='Actualizado el';

/* Config fields for search */

$config['search_by_tramites_id']= 0;
$config['search_by_tramites_descripcion']= 1;
$config['search_by_tramites_created_at']= 0;
$config['search_by_tramites_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_tramites_id']= 1;
$config['show_tramites_descripcion']= 1;
$config['show_tramites_created_at']= 1;
$config['show_tramites_updated_at']= 1;

/* Config required fields */

$config['isRequired_tramites_id']= 1;
$config['isRequired_tramites_descripcion']= 1;
$config['isRequired_tramites_created_at']= 1;
$config['isRequired_tramites_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 20;

/* Config flash messages */

$config['tramites_flash_add_message']= 'The tramites has been successfully added.';
$config['tramites_flash_edit_message']= 'The tramites has been successfully updated.';
$config['tramites_flash_delete_message']= 'The tramites has been successfully deleted';
$config['tramites_flash_error_delete_message']= 'The tramites hasn\'t been deletedd';
$config['tramites_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file tramites_settings.php */
/* Location: ./application/config/tramites_settings.php */
