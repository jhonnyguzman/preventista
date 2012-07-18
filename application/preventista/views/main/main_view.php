<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>preventista</title>
		<link rel="stylesheet" href="<?=base_url()?>css/reset.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?=base_url()?>css/style.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?=base_url()?>css/jquery-modal-messages/jquery.messages.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?=base_url()?>css/jquery-modal-alerts/jquery.alerts.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?=base_url()?>css/jquery-ui/flick/jquery.ui.all.css" type="text/css" media="screen">
		<link rel="stylesheet" href="<?=base_url()?>css/jquery-autocomplete/jquery.autocomplete.css" type="text/css" media="screen">
		<script type="text/javascript" src="<?=base_url()?>js/jquery-1.7.1.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/general_functions.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-modal-messages/jquery.messages.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-modal-alerts/jquery.alerts.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-menu-acordion/jquery.acordion.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/start_codjs.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui/jquery.ui.core.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui/jquery.ui.mouse.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui/jquery.ui.position.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui/jquery.ui.datepicker.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui/jquery.ui.dialog.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui/jquery.ui.tabs.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-ui/i18n/jquery.ui.datepicker-es.js"></script>
		<script type="text/javascript" src="<?=base_url()?>js/jquery-autocomplete/jquery.autocomplete.js"></script>
	</head>
	<body>
		<div id="wrap">
			<div id="header">
				<div id="header-left">
					<?=$this->config->item('title_header')?>
				</div>
				<div id="header-center">
				</div>
				<div id="header-right">
					<div id='header-menu'>
						<ul>
						<li>Usuario:&nbsp;<?=$this->session->userdata('usuarios_username')?>&nbsp;|&nbsp;</li>
						<li>Perfil:&nbsp;<?=$this->session->userdata('perfiles_descripcion')?>&nbsp;|&nbsp;</li>
						<li><a href="<?=base_url()?>welcome/logout">Salir</a><li>
						</ul>
					</div>
				</div>
			</div>
			<div id="main-content">
				<div id="left-content">
					<div id="left-side-menu">
						<div id="left-side-menu-title">
						<?=$this->config->item('title_menu_main_controllers')?>
						</div>
						<?php $this->basicauth->getMenu();?>
					</div>
				</div>
				<div id="right-content"></div>
			</div>
			<div id="footer"><?=$this->config->item('title_footer')?></div>
		</div>
		<div id="content_detail_modal"></div>
	</body>
</html>
