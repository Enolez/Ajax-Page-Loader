<?php

//	Output this header as early as possible
	header('Content-Type: text/plain; charset=utf-8');


//	Ensure no PHP errors are shown in the Ajax response
	//error_reporting(0);
	//@ini_set('display_errors', 0);


//	Load the Q2A base file which sets up a bunch of crucial functions
	require_once './../../qa-include/qa-base.php';
	qa_report_process_stage('init_ajax');		

//	Get general Ajax parameters from the POST payload, and clear $_GET
	qa_set_request(qa_post_text('qa_request'), qa_post_text('qa_root'));

	require_once QA_INCLUDE_DIR.'qa-db-selects.php';
	require_once QA_INCLUDE_DIR.'qa-app-users.php';
	require_once QA_INCLUDE_DIR.'qa-app-cookies.php';
	require_once QA_INCLUDE_DIR.'qa-app-votes.php';
	require_once QA_INCLUDE_DIR.'qa-app-format.php';
	require_once QA_INCLUDE_DIR.'qa-app-options.php';

	if(version_compare(QA_VERSION, '1.7.0', ">="))
		require_once 'ajax-pages17.php';
	else
		require_once 'ajax-pages16.php';


	
	if(isset($_REQUEST['url'])){
		$action = $_REQUEST['url'];
	}else
		die();
	
	$requestlower = strtolower($action);
	
	qa_set_request($requestlower, qa_post_text('qa_root'));
	
	qa_page_queue_pending();
	$qa_content = qa_get_request_content();	

	global $qa_template;
	$tmpl = substr($qa_template, 0, 7) == 'custom-' ? 'custom' : $qa_template;
	$themeclass = qa_load_theme_class(qa_get_site_theme(), $tmpl, $qa_content, qa_request());
	// I'm too tired to check why this call didn't work for some instances :(
	//$themeclass->initialize();

	$themeclass->main();
	$themeclass->sidepanel();
	
	// finish
	qa_db_disconnect();
	die();
	
/*
	Omit PHP closing tag to help avoid accidental output
*/