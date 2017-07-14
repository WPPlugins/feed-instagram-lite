<?php

/**
* File for creating Feed Shortcode Generator Component
*
*/

/**
* Function for Adding Feed Shortcode Generator Component on gifeed_sc_generator_component hook
*
* @param void
*
* @return void
*/
add_action( 'vc_before_init', 'gifeed_sc_generator_component' );

function gifeed_sc_generator_component() {

    vc_map(
        array(
            'name' => __( 'Instagram Feed Lite', 'feed-instagram-lite' ),
            'base' => 'ghozylab-instagram',
			'icon' => plugins_url( 'vc/img/vc-logo.png' , dirname(__FILE__) ),
            'category' => __( 'Content', 'js_composer' ),
			'description' => __( 'Display Instagram media in post / page', 'feed-instagram-lite' ),
            'params' => array(
                array(
                    'type' => 'dropdown',
                    'holder' => 'div',
                    'class' => 'gifeed_vc_get_feeds',
                    'heading' => __( 'Feed ID', 'feed-instagram-lite' ),
                    'param_name' => 'feed',
                    'value' => gifeed_vc_feed_list(),
                    'description' => __( 'Select your current feed(s) from dropdown above.', 'feed-instagram-lite' )
                ),
            )
        )
    );
}


/*-------------------------------------------------------------------------------*/
/*   Get Feed List
/*-------------------------------------------------------------------------------*/
function gifeed_vc_feed_list() {

	$list = array();
	
	global $post;
			
	$args = array(
			'post_type' => 'ginstagramfeed',
  			'order' => 'ASC',
  			'post_status' => 'publish',
  			'posts_per_page' => -1,
				);

	$myposts = get_posts( $args );
	foreach( $myposts as $post ) :	setup_postdata( $post );
	
	$list[$post->ID] = array( $post->ID, esc_html( esc_js( the_title( NULL, NULL, FALSE ) ) ) );
	
	endforeach;
	
	$list = array_merge( array( '- select -' ), $list );
	
	return $list;
	
}