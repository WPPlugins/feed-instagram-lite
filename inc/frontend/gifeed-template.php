<?php

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}


function gifeed_markup_generator( $feed_id = null, $unique_id = null, $opttype = null, $val = null ) {
	
	ob_start();
	
	$opt = gifeed_opt_generator( $feed_id, $opttype, $val );

	$instafeeds = array_map( 'trim', explode( ',', $opt['feeds']['instaidstags'] ) );
	$instafeeds = array_filter( $instafeeds );
	
	if ( empty( $instafeeds ) ) {
		
		echo '<div class="gifeed_error_msg"><p>'.__( 'No Instagram Id(s) or Hashtag(s) found!', 'feed-instagram-lite' ).'</p></div>';
		return; 
	}
	
	// START Generating Feed ----------------------------------------------------------//
	?>
    
    <!-- Start Feed ID : <?php echo $unique_id; ?> -->
    
    <?php gifeed_feed_html_markup_helper( $feed_id, $unique_id, $opt ); ?>
    
     <!-- End Feed ID : <?php echo $unique_id;  ?> -->
    
    <?php
	// END Generating Feed ------------------------------------------------------------//
	
	$feed = ob_get_clean();
	
	echo $feed;
	
}