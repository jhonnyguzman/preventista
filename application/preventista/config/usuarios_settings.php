<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* Config general titles */

$config['recordListTitle']=' Listado de usuarios';
$config['recordAddTitle']=' Nuevo usuario';
$config['recordEditTitle']=' Editar usuario';
$config['accessTitle']='<div class="accessTitle"> No tienes permiso para realizar esta operaci&oacute;n </div>';

/* Config labels of the form fields */

$config['usuarios_id']='Id';
$config['usuarios_username']='Nombre de usuario';
$config['usuarios_password']='Contraseña';
$config['usuarios_nombre']='Nombre';
$config['usuarios_apellido']='Apellido';
$config['usuarios_email']='Email';
$config['usuarios_direccion']='Direccion';
$config['usuarios_telefono']='Telefono';
$config['usuarios_estado']='Estado';
$config['usuarios_estado_descripcion']='Estado';
$config['usuarios_legajo']='Legajo';
$config['perfiles_id']='Perfil';
$config['perfiles_descripcion']='Perfil';
$config['provincias_id']='Provincia';
$config['provincias_nombre']='Provincia';
$config['localidades_id']='Localidad';
$config['localidades_nombre']='Localidad';
$config['usuarios_activationcode']='Codigo de activación';
$config['usuarios_tokenforgotpasswd']='Token';
$config['usuarios_created_at']='Fecha de alta';
$config['usuarios_updated_at']='Actualizado el';

/* Config fields for search */

$config['search_by_usuarios_id']= 0;
$config['search_by_usuarios_username']= 1;
$config['search_by_usuarios_password']= 0;
$config['search_by_usuarios_nombre']= 1;
$config['search_by_usuarios_apellido']= 1;
$config['search_by_usuarios_email']= 0;
$config['search_by_usuarios_direccion']= 0;
$config['search_by_usuarios_telefono']= 0;
$config['search_by_usuarios_estado']= 0;
$config['search_by_usuarios_legajo']= 0;
$config['search_by_perfiles_id']= 0;
$config['search_by_provincias_id']= 0;
$config['search_by_localidades_id']= 0;
$config['search_by_usuarios_activationcode']= 0;
$config['search_by_usuarios_tokenforgotpasswd']= 0;
$config['search_by_usuarios_created_at']= 0;
$config['search_by_usuarios_updated_at']= 0;

/* Config fields for show in the result list */

$config['show_usuarios_id']= 1;
$config['show_usuarios_username']= 1;
$config['show_usuarios_password']= 1;
$config['show_usuarios_nombre']= 0;
$config['show_usuarios_apellido']= 0;
$config['show_usuarios_email']= 1;
$config['show_usuarios_direccion']= 0;
$config['show_usuarios_telefono']= 0;
$config['show_usuarios_estado']= 0;
$config['show_usuarios_estado_descripcion']= 0;
$config['show_usuarios_legajo']= 0;
$config['show_perfiles_id']= 0;
$config['show_perfiles_descripcion']= 1;
$config['show_provincias_id']= 0;
$config['show_provincias_nombre']= 0;
$config['show_localidades_id']= 0;
$config['show_localidades_nombre']= 0;
$config['show_usuarios_activationcode']= 0;
$config['show_usuarios_tokenforgotpasswd']= 0;
$config['show_usuarios_created_at']= 0;
$config['show_usuarios_updated_at']= 0;

/* Config required fields */

$config['isRequired_usuarios_id']= 1;
$config['isRequired_usuarios_username']= 1;
$config['isRequired_usuarios_password']= 1;
$config['isRequired_usuarios_nombre']= 1;
$config['isRequired_usuarios_apellido']= 1;
$config['isRequired_usuarios_email']= 1;
$config['isRequired_usuarios_direccion']= 1;
$config['isRequired_usuarios_telefono']= 1;
$config['isRequired_usuarios_estado']= 1;
$config['isRequired_usuarios_legajo']= 1;
$config['isRequired_perfiles_id']= 1;
$config['isRequired_provincias_id']= 1;
$config['isRequired_localidades_id']= 1;
$config['isRequired_usuarios_activationcode']= 1;
$config['isRequired_usuarios_tokenforgotpasswd']= 1;
$config['isRequired_usuarios_created_at']= 1;
$config['isRequired_usuarios_updated_at']= 1;

/* Config params of pagination */

$config['pag_perpage']= 4;

/* Config flash messages */

$config['usuarios_flash_add_message']= 'The usuarios has been successfully added.';
$config['usuarios_flash_edit_message']= 'The usuarios has been successfully updated.';
$config['usuarios_flash_delete_message']= 'The usuarios has been successfully deleted';
$config['usuarios_flash_error_delete_message']= 'The usuarios hasn\'t been deletedd';
$config['usuarios_flash_error_message']= 'A database error has occured, please contact your administrator.';

/* End of file usuarios_settings.php */
/* Location: ./application/config/usuarios_settings.php */
