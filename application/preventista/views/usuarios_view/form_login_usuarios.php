<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>Sistemas de Gesti&oacute;n | Acceso </title>
		<link type="text/css" href="<?=base_url()?>css/jquery-ui/ui-darkness/jquery-ui-1.8.18.custom.css" rel="stylesheet" />	
		<link rel='stylesheet' href='<?=base_url()?>css/login.css' type='text/css' media='screen' />
		<script type="text/javascript" src="<?=base_url()?>js/jquery-1.7.1.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui/jquery-ui-1.8.18.custom.js"></script>
		<!--<script type="text/javascript" src="<?=base_url()?>js/facebox.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery.wysiwyg.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/simpla.jquery.configuration.js"></script>-->
	</head>
	<body id="login">
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
				<h1>Acceso</h1>
				<img id="logo" src="<?=base_url()?>css/images/mas/logo_big.png" alt="Logo" />
			</div>
			<div id="login-content">
				<form action="<?=base_url()?>welcome/login" method="post" name="formLoginusuarios" id="formLoginusuarios">
					<div class="notification information png_bg">
						<div>
							<?php if(validation_errors()): ?> 
								<?=validation_errors()?>
							<?php elseif(isset($error)): ?> 
								<?=$error?>
							<?php else: ?>
								Ingrese usuario y contrase&ntilde;a 
							<?php endif; ?>
						</div>
					</div>
					<p>
						<label>Usuario:</label>
						<input type="text" name="usuarios_username" id="usuarios_username" class="text-input" />
					</p>
					<div class="clear"></div>
					<p>
						<label>Contraseña:</label>
						<input type="password" name="usuarios_password" id="usuarios_password"  class="text-input" />
					</p>
					<div class="clear"></div>
					<div class="clear"></div>

					<input type="submit" name="Ingresar"  value="Ingresar" class="button" />
				</form>
			</div>
		</div>

	</body>
</html>
