<?php
/*
Plugin Name: wpSEO
Text Domain: wpseo
Domain Path: /lang
Description: Powerful and reliable Plugin for search engine optimization and metadata formatting. A Swiss Army Knife of SEO with innovation from Germany.
Author: Sergej M&uuml;ller
Author URI: http://ebiene.de
Plugin URI: http://wpseo.de
Version: 3.0.1
*/


if ( !class_exists('WP') ) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit();
}


if ( !((defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) or (defined('DOING_CRON') && DOING_CRON) or (defined('DOING_AJAX') && DOING_AJAX)) ) {
	define('WPSEO_DIR', dirname(__FILE__));
	define('WPSEO_FILE', __FILE__);
	define('WPSEO_BASE', plugin_basename(__FILE__));
	
	include_once sprintf(
		'%s/inc/_%s.class.php',
		WPSEO_DIR,
		( is_admin() ? 'be' : 'fe' )
	);
	
	add_action(
		'plugins_loaded',
		array(
			'wpSEO',
			'init'
		)
	);
	
	register_activation_hook(
		__FILE__,
		array(
			'wpSEO',
			'install'
		)
	);
	register_uninstall_hook(
		__FILE__,
		array(
			'wpSEO',
			'uninstall'
		)
	);
	if ( function_exists('register_update_hook') ) {
		register_update_hook(
			__FILE__,
			array(
				'wpSEO',
				'update'
			)
		);
	}
}