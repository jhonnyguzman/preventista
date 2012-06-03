<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de Permisos';
$config['recordAddTitle']=' Nuevo Permiso';
$config['recordEditTitle']=' Editar Permiso';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['sispermisos_id']='Id';
$config['sispermisos_tabla']='Tabla';
$config['sispermisos_flag_read']='¿Puede leer?';
$config['sispermisos_flag_insert']='¿Puede insertar?';
$config['sispermisos_flag_update']='¿Puede modificar?';
$config['sispermisos_flag_delete']='¿Puede eliminar?';
$config['perfiles_id']='Perfil';
$config['perfiles_descripcion']='Perfil';
$config['sispermisos_created_at']='Fecha de alta';
$config['sispermisos_updated_at']='Actualizado';

/* Config fields for search */

$config['search_by_sispermisos_id']= 0;
$config['search_by_sispermisos_tabla']= 1;
$config['search_by_sispermisos_flag_read']= 0;
$config['search_by_sispermisos_flag_insert']= 0;
$config['search_by_sispermisos_flag_update']= 0;
$config['search_by_sispermisos_flag_delete']= 0;
$config['search_by_perfiles_id']= 0;
$config['search_by_sispermisos_created_at']= 0;
$config['search_by_sispermisos_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_sispermisos_id']= 1;
$config['show_sispermisos_tabla']= 1;
$config['show_sispermisos_flag_read']= 1;
$config['show_sispermisos_flag_insert']= 1;
$config['show_sispermisos_flag_update']= 1;
$config['show_sispermisos_flag_delete']= 1;
$config['show_perfiles_id']= 0;
$config['show_perfiles_descripcion']= 1;
$config['show_sispermisos_created_at']= 0;
$config['show_sispermisos_updated_at']= 0;

/* Config required fields */

$config['isRequired_sispermisos_id']= 1;
$config['isRequired_sispermisos_tabla']= 1;
$config['isRequired_sispermisos_flag_read']= 1;
$config['isRequired_sispermisos_flag_insert']= 1;
$config['isRequired_sispermisos_flag_update']= 1;
$config['isRequired_sispermisos_flag_delete']= 1;
$config['isRequired_perfiles_id']= 1;
$config['isRequired_sispermisos_created_at']= 1;
$config['isRequired_sispermisos_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 20;

/* Config flash messages */

$config['sispermisos_flash_add_message']= 'The sispermisos has been successfully added.';
$config['sispermisos_flash_edit_message']= 'The sispermisos has been successfully updated.';
$config['sispermisos_flash_delete_message']= 'The sispermisos has been successfully deleted';
$config['sispermisos_flash_error_delete_message']= 'The sispermisos hasn\'t been deletedd';
$config['sispermisos_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file sispermisos_settings.php */
/* Location: ./application/config/sispermisos_settings.php */
