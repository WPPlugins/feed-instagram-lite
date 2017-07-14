<?php

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}


/*-------------------------------------------------------------------------------------------------------*/
/*   Option Meta Generator
/*-------------------------------------------------------------------------------------------------------*/
function gifeed_opt_generator( $id, $ispreview = null, $val = null ) {
	
	$opt = array();
	
	if ( !trim( $ispreview ) ) {
	
	// Feed Builder	
	$opt['feeds'] = get_post_meta( $id, 'gifeed_feedbuilder_format', true );
	$opt['header'] = 'on';

	} else {
	
	// Feed Builder	
	$opt['feeds'] = $val['gifeed_feedbuilder_format'];
	$opt['header'] = 'on';
	}
	
	
	return $opt;
	
}