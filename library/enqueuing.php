<?php
	/*
	 * Function name : nurturebar_admin_enqueue_stuff
	 * Functionality : This function is add CSS and JS file on admin end when plugin get activated
	*/
	function ob_myavm_admin_enqueue_stuff() { 
		wp_enqueue_media();
		wp_enqueue_style( 'my-avm-style-admin', plugin_dir_url(dirname(__FILE__)).'css/ob_my_avm.css' );
		wp_enqueue_script('ob_myavm_custom_developer_validation', plugin_dir_url(dirname(__FILE__)).'js/ob_my_avm_developer.js');
	}
	//Call the files function for include css and js stuff through admin_enqueue_scripts from library folder
	add_action( 'admin_enqueue_scripts', 'ob_myavm_admin_enqueue_stuff' );