<?php

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}


function gifeed_frontend_script() {

	// CSS
	wp_register_style( 'gifeed_frontend_main_style', plugins_url( 'css/gifeed-frontend.css', __FILE__ ), false, IFLITE_VERSION );
	wp_register_style( 'gifeed_frontend_fontawesome', plugins_url( 'css/font-awesome.min.css', __FILE__ ), false, IFLITE_VERSION );
	
	// JS
	wp_register_script( 'gifeed_frontend_masonry', plugins_url( 'js/masonry.pkgd.min.js', __FILE__ ), array(), IFLITE_VERSION, true );	
	wp_register_script( 'gifeed_frontend_imagesloaded', plugins_url( 'js/imagesloaded.pkgd.min.js', __FILE__ ), array(), IFLITE_VERSION, true );
	wp_register_script( 'gifeed_frontend_main_script', plugins_url( 'js/gifeed-frontend.js', __FILE__ ), array(), IFLITE_VERSION, true );

}

add_action( 'wp_enqueue_scripts', 'gifeed_frontend_script' );



