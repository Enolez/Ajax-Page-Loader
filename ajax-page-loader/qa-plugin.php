<?php
/*
	Plugin Name: Ajax Page Loader
	Plugin URI: http://TowhidN.com
	Plugin Description: Loads Q2A pages using Ajax Technology to provide faster & modern pageload
	Plugin Version: 1.0.0
	Plugin Date: 
	Plugin Author: QA-Themes.com
	Plugin Author URI: http://QA-Themes.com
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI:
*/


if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}


qa_register_plugin_layer('qa-ajax-layer.php', 'APL - Ajax Layer');
qa_register_plugin_module('module', 'qa-ajax-admin-form.php', 'qa_ajax_admin_form', 'Ajax Page Loader');
