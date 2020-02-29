<?php
/*
	Plugin Name: Enolez Page Loader
	Plugin URI: https://github.com/Enolez/Ajax-Page-Loader/
	Plugin Description: Loads Enolez pages using Enolez Page Loader to provide faster & modern pageload
	Plugin Update Check URI: https://raw.githubusercontent.com/Towhidn/Ajax-Page-Loader/master/ajax-page-loader/qa-plugin.php
	Plugin Version: 1.0.2
	Plugin Date: 
	Plugin Author: Masud
	Plugin Author URI: https://www.enolez.com/আব্দুল্লাহ+আল+মাসুদ
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI:
*/


if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}


qa_register_plugin_layer('qa-ajax-layer.php', 'APL - Enolez Layer');
qa_register_plugin_module('module', 'qa-ajax-admin-form.php', 'qa_ajax_admin_form', 'Enolez Page Loader');
