<?php

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}


/*-------------------------------------------------------------------------------*/
/*  POST/PAGE SHORTCODE
/*-------------------------------------------------------------------------------*/
function gifeed_shortcode( $attr ) {

	extract( shortcode_atts( array(
	'feed' => -1,
	), $attr ) );
	
	ob_start();
	
	if ( $feed ) {
	
		$feed_id = explode( ",", $feed );

		$arg = array(
				'post__in' => $feed_id, 
				'post_type' => 'ginstagramfeed',
				);
		
		}
	 else {
		 
		 $arg = null;
		 
		}

	$feed_query = new WP_Query( $arg );

	if ( $feed_query->have_posts() ):
	
	while ( $feed_query->have_posts() ) : $feed_query->the_post();

	$feed_unique_id = gifeed_RandomString(8);
	
	// Enqueue Frontend CSS & JS
	
	wp_enqueue_style( 'gifeed_frontend_main_style' );
	wp_enqueue_style( 'gifeed_frontend_fontawesome' );
	wp_enqueue_script( 'gifeed_frontend_imagesloaded' );
	wp_enqueue_script( 'gifeed_frontend_masonry' );
	wp_enqueue_script( 'gifeed_frontend_main_script' );

	require_once dirname( __FILE__ ) .'/gifeed-template.php';
	
	gifeed_markup_generator( get_the_ID(), $feed_unique_id, null, null );
	
	endwhile;
	
	else:
	
		gifeed_frontend_notify( $feed ); 

	$feed_content = ob_get_clean();
	return $feed_content;  

	endif;
	
	wp_reset_postdata();

	$feed_content = ob_get_clean();
	return $feed_content;

}
add_shortcode( 'ghozylab-instagram', 'gifeed_shortcode' );