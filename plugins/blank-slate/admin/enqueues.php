<?php
/*
** Enqueue scripts and styles? Want to check into this later.
*/
add_action( 'admin_enqueue_scripts', function(){

	global $wp_scripts;
	$ui = $wp_scripts->query('jquery-ui-core');

	wp_enqueue_media();

	wp_enqueue_style(
		'bs_jquery-ui-smoothness'
	,	"//ajax.googleapis.com/ajax/libs/jqueryui/{$ui->ver}/themes/smoothness/jquery-ui.css"
	,	false
	,	null
	);
	wp_enqueue_style(
		'bs_admin_styles'
	,	BS_URL.'resources/css/admin.css'
	);

	wp_enqueue_script(
		'bs_admin_scripts'
	,	BS_URL.'resources/js/admin.js'
	,	array(
			'jquery'
		,	'jquery-ui-datepicker'
		,	'jquery-ui-slider'
		)
	);

} );