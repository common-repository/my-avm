<?php
/**
 * @package Myavm
 */
/*
Plugin Name: My Avm
Plugin URI: https://www.onboardinformatics.com/myavm/
Description: MyAVM is the first valuation tool designed for millennials with a modern, clean interface and in-depth, accurate information on the value of a home. Introducing a New Way to Generate Seller Leads.
Author: Onboard Informatics
Version: 1.0
Author URI: https://www.onboardinformatics.com/
Text Domain: Onboard Inc
*/

// File include using require_once from library folder
require_once(plugin_dir_path(__FILE__).'library/enqueuing.php' );

/*
Function name : onboard_myavm_create
Discription : This function is used for display Onboard MyAvm as admin menu over the wordpress admin panel
*/
add_action('admin_menu', 'onboard_myavm_create');
function onboard_myavm_create() {
    $page_title = 'Onboard MyAvm';
    $menu_title = 'Onboard MyAvm';
    $capability = 'edit_posts';
    $menu_slug = 'onboard_myavm';
    $function = 'my_onboard_myavm_display';
    $icon_url = 'dashicons-chart-area';
    $position = 24;
    add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
}

/*
Function name : my_onboard_myavm_display
Discription : This function is used for display MyAvm form when someone click on "Onboard MyAvm" menu from wordpress admin panel, From this section user can save the script which is provided by Onboard Informatics to Generate Seller Leads on the website. 
*/
function my_onboard_myavm_display() {
	
	//Check form is posted or not
	if ( ! empty( $_POST ) ) {
		//Check for nonce field verification
		if (isset( $_POST['custom_onboard_myavm_display_field'] ) && $_POST['custom_onboard_myavm_display_field'] !="" || wp_verify_nonce( $_POST['custom_onboard_myavm_display_field'], 'ob_custom_onboard_myavm_display' )){
			
			//Update Lead widget text script code, It will capture user email, Phone number and Cell number field through iframe and send the specific notification to that user.
			//Update address 1 field
			if (isset($_POST['avm_address1']) && !empty($_POST['avm_address1'])) {   
				$avm_address1 = sanitize_text_field($_POST['avm_address1']);
				update_option('avm_address1', $avm_address1);
			}
			//Update address 2 field
			if (isset($_POST['avm_address2']) && !empty($_POST['avm_address2'])) {
				$avm_address2 = sanitize_text_field($_POST['avm_address2']);
				update_option('avm_address2', $avm_address2); 
			}
			//Update myavm bar zip code field
			if (isset($_POST['avm_zip']) && !empty($_POST['avm_zip'])) {
				$avm_zip = sanitize_text_field($_POST['avm_zip']);
				update_option('avm_zip', $avm_zip);
			}
			//Update myavm bar email field
			if (isset($_POST['avm_email']) && !empty($_POST['avm_email'])) {
				$avm_email = sanitize_email($_POST['avm_email']);
				update_option('avm_email', $avm_email);
			}
			//Update myavm text this contain our main script code which is used to display navigation bar of our property detail. This script create navigation bar that will open a iframe with the requested property address.
			if (isset($_POST['avm_text']) && !empty($_POST['avm_text'])) {
				$value = sanitize_text_field(json_encode($_POST['avm_text']));
				update_option('avm_text', $value); 
			} 
		}
	}
	
	$avm_address1 	= get_option('avm_address1', ''); // get value of address 1 to display pre-filled in html form
    $avm_address2 	= get_option('avm_address2', ''); // get value of address 2 to display pre-filled in html form
    $avm_zip 		= get_option('avm_zip', ''); // get value of zip to display pre-filled in html form
    $avm_email 		= get_option('avm_email', ''); // get value of email to display pre-filled in html form
	$wd_set = get_option('avm_text', ''); // get value of widget text script code to display pre-filled in html form
	
	if(!empty($wd_set)){
		//Get the saved value to pre-filled the data into form.
		$value 	= stripslashes(json_decode($wd_set));  	
	}else{
		$value 	= '';  	
	}
	
    //Get form from this file
    include 'my-avm-form-file.php';
}


/*
Function name : ob_custom_myavm_shortcode
Discription : This function is used for generate shortcode so that user can easily use lead anywhere on his/her website. This lead widget display the form on your website to get the contact query which is related to property, It will capture user email, Phone number and Cell number field through iframe and send the specific notification to that user.
*/

function ob_custom_myavm_shortcode($atts) {
	
	if($atts['address1']=="" || $atts['address2']==""){
		return "Something went wrong, Please provide address1 and address2";
	}
	
	$wd_set = get_option('avm_text'); 
	$saveScript 	= stripslashes(json_decode($wd_set));
	$explodedScript      = explode("customer_id=",$saveScript); 
	$explodedScript1     = explode("&",$explodedScript[1]); 
	$cust_id             = $explodedScript1[0] ;
	
	if( $cust_id !== "") {
			$myavmScript = '$onboardJquery(document).ready(function(){var frame_url=window.parent.location.origin;var src="http://onboard.rocks/avm/?customer_id={{CUSTOMERID}}==&address1={{ADDRESS1}}&address2={{ADDRESS2}} ZI{{ZIPCODE}}&email={{EMAIL}}&frame_url="+frame_url;$onboardJquery("#iframe_id").attr("src",src)});var isMobile={Android:function(){return myavmigator.userAgent.match(/Android/i)},BlackBerry:function(){return myavmigator.userAgent.match(/BlackBerry/i)},iOS:function(){return myavmigator.userAgent.match(/iPhone|iPad|iPod/i)},Opera:function(){return myavmigator.userAgent.match(/Opera Mini/i)},Windows:function(){return myavmigator.userAgent.match(/IEMobile/i)||myavmigator.userAgent.match(/WPDesktop/i)},any:function(){return(isMobile.Android()||isMobile.BlackBerry()||isMobile.iOS()||isMobile.Opera()||isMobile.Windows())}};var iframeMobHeight="120px";var iframeMobOpenHeight="750px";if(isMobile.any()){iframeMobHeight="170px";var iframeMobOpenHeight="500px";$onboardJquery("#iframe_id").css("height",iframeMobHeight)}
var eventMethod=window.addEventListener?"addEventListener":"attachEvent";var eventer=window[eventMethod];var messageEvent=eventMethod=="attachEvent"?"onmessage":"message";eventer(messageEvent,function(e){if(e.data=="open"){$onboardJquery("#iframe_id").css("height",iframeMobOpenHeight)}else if(e.data=="close"){$onboardJquery("#iframe_id").css("height",iframeMobHeight)}else if(e.data=="closeOpenTab"){$onboardJquery("#iframe_id").css("height",iframeMobOpenHeight)}
e.data=""},!1);$onboardJquery("html").on("click","body",function(){var iframeCustom=document.getElementById("iframe_id");var iWindow=iframeCustom.contentWindow;iWindow.postMessage("closeOnBgClick","*")});';
			$myavmScript = str_replace(array("{{CUSTOMERID}}","{{ADDRESS1}}","{{ADDRESS2}}","{{ZIPCODE}}","{{EMAIL}}"),array($cust_id,$atts['address1'],$atts['address2'],$atts['zip'],$atts['email']),$myavmScript);
			ob_custom_enqueue_scripts($myavmScript);
			return '<iframe width="100%" id="iframe_id" style="height: 650px;" frameborder="0" scrolling="auto" src="" allowfullscreen="true"></iframe>';
	
	}else{
			return "Something went wrong, unable to find customer id in your saved script";
	}		
}

add_shortcode( 'onboard-myavm', 'ob_custom_myavm_shortcode' );

add_action( 'wp_footer', 'ob_custom_enqueue_scripts' );
function ob_custom_enqueue_scripts($customScript = null) {
	
   wp_enqueue_script( 'obmyavmscript', plugin_dir_url(dirname(__FILE__)).'myavm/js/avm_script.js', array(), '1.0' );
   wp_add_inline_script( 'obmyavmscript', $customScript );
}



function ob_custom_myavm_action_links( $links ) {
 $links = array_merge( array(
  '<a href="' . esc_url( admin_url( 'admin.php?page=onboard_myavm' ) ) . '">' . __( 'Settings', 'textdomain' ) . '</a>'
 ), $links );
 return $links;
}
add_action( 'plugin_action_links_' . plugin_basename( __FILE__), 'ob_custom_myavm_action_links' );



