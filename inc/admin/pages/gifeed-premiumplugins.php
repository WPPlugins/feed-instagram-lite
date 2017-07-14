<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function gifeed_premium_plugin_page() {
	
	if ( false === ( $cache = get_transient( 'gifeed_featured_feed' ) ) ) {
		$feed = wp_remote_get( 'http://content.ghozylab.com/feed.php?c=featuredplugins', array( 'sslverify' => false ) );
		if ( ! is_wp_error( $feed ) ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient( 'gifeed_featured_feed', $cache, 3600 );
			}
		} else {
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the list from the server. Please try again later.', 'feed-instagram-lite' ) . '</div>';
		}
	}

	ob_start(); ?>
    
    <style>
			.gifeed-container-cnt .feature-section p {
			max-width: 100% !important;	
		}
	</style>
    
    
	<div class="wrap about-wrap gifeed-class" id="ghozy-featured">
    
			<h1><?php printf( esc_html__( 'Welcome to %s', 'feed-instagram-lite' ), IFLITE_ITEM_NAME ); ?></h1>
			<div class="about-text"><?php printf( esc_html__( 'Thank you for installing this plugin. %s is ready to make your Instagram media more stunning and more elegant!', 'feed-instagram-lite' ), IFLITE_ITEM_NAME ); ?></div>
            <div id="settingpage" class="gifeed-badge">Version <?php echo IFLITE_VERSION; ?></div>
        <hr style="margin-bottom:20px;">    
        
		<p id="todocs" style="border-bottom: 1px dotted #CCC; margin-top: 45px; padding-bottom: 5px;margin-bottom:30px;"><span class="dashicons dashicons-megaphone"></span>&nbsp;&nbsp;<?php _e( 'Several plugins below are a premium plugins that will help you to take your website to the next level. Get it Now !', 'feed-instagram-lite' ); ?></p>
       <div class="gifeed-container-cnt"> 
       	<div class="feature-section"> 
        <?php echo $cache; ?>
		</div>
      </div> 
	</div>
    
    <?php
	
	$feeds = ob_get_clean();
	
	echo $feeds;
	
}

