<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de cambiodirectostock';
$config['recordAddTitle']=' Nuevo cambiodirectostock';
$config['recordEditTitle']=' Editar cambiodirectostock';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['cambiodirectostock_id']='Id';
$config['cambiodirectostock_tipo']='Tipo';
$config['articulos_id']='Articulo';
$config['articulos_descripcion']='Articulo';
$config['cambiodirectostock_stockantiguo']='St.Antiguo';
$config['cambiodirectostock_stocknuevo']='St.Nuevo';
$config['usuarios_id']='Usuario';
$config['usuarios_username']='Usuario';
$config['cambiodirectostock_comentario']='Comentario';
$config['cambiodirectostock_created_at']='Fecha de alta';
$config['cambiodirectostock_updated_at']='Actualizado el';

/* Config fields for search */

$config['search_by_cambiodirectostock_id']= 1;
$config['search_by_cambiodirectostock_tipo']= 0;
$config['search_by_articulos_id']= 0;
$config['search_by_cambiodirectostock_stockantiguo']= 0;
$config['search_by_cambiodirectostock_stocknuevo']= 0;
$config['search_by_usuarios_id']= 0;
$config['search_by_cambiodirectostock_comentario']= 0;
$config['search_by_cambiodirectostock_created_at']= 0;
$config['search_by_cambiodirectostock_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_cambiodirectostock_id']= 1;
$config['show_cambiodirectostock_tipo']= 1;
$config['show_articulos_id']= 0;
$config['show_articulos_descripcion']= 1;
$config['show_cambiodirectostock_stockantiguo']= 1;
$config['show_cambiodirectostock_stocknuevo']= 1;
$config['show_usuarios_id']= 0;
$config['show_usuarios_username']= 1;
$config['show_cambiodirectostock_comentario']= 1;
$config['show_cambiodirectostock_created_at']= 1;
$config['show_cambiodirectostock_updated_at']= 0;

/* Config required fields */

$config['isRequired_cambiodirectostock_id']= 1;
$config['isRequired_cambiodirectostock_tipo']= 1;
$config['isRequired_articulos_id']= 1;
$config['isRequired_cambiodirectostock_stockantiguo']= 1;
$config['isRequired_cambiodirectostock_stocknuevo']= 1;
$config['isRequired_usuarios_id']= 1;
$config['isRequired_cambiodirectostock_comentario']= 1;
$config['isRequired_cambiodirectostock_created_at']= 1;
$config['isRequired_cambiodirectostock_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['cambiodirectostock_flash_add_message']= 'The cambiodirectostock has been successfully added.';
$config['cambiodirectostock_flash_edit_message']= 'The cambiodirectostock has been successfully updated.';
$config['cambiodirectostock_flash_delete_message']= 'The cambiodirectostock has been successfully deleted';
$config['cambiodirectostock_flash_error_delete_message']= 'The cambiodirectostock hasn\'t been deletedd';
$config['cambiodirectostock_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file cambiodirectostock_settings.php */
/* Location: ./application/config/cambiodirectostock_settings.php */
