<?php

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}


function gifeed_instagram_docs_page() {
	
	ob_start(); ?>

	<div class="wrap about-wrap gifeed-class">
    
			<h1><?php printf( esc_html__( 'Welcome to %s', 'feed-instagram-lite' ), IFLITE_ITEM_NAME ); ?></h1>
			<div class="about-text"><?php printf( esc_html__( 'Thank you for installing this plugin. %s is ready to make your Instagram media more stunning and more elegant!', 'feed-instagram-lite' ), IFLITE_ITEM_NAME ); ?></div>
            <div id="settingpage" class="gifeed-badge">Version <?php echo IFLITE_VERSION; ?></div>
        <hr style="margin-bottom:20px;">

		<p id="todocs" style="border-bottom: 1px dotted #CCC; margin-top: 45px; padding-bottom: 5px;"><span class="dashicons dashicons-megaphone"></span>&nbsp;&nbsp;<?php _e( 'There are no complicated instructions because this plugin designed to make all easy. Please watch the following video and we believe that you will easily to understand it just in minutes :', 'feed-instagram-lite' ); ?></p>

            
				<div style="margin-top:10px;" class="feature-section">
                <div class="gifeed_credential_container">
                <p><iframe width="853" height="480" src="https://www.youtube.com/embed/H2sjEZrO31Q?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe></p></div>
                </div> 
		</div>



<!-- Content End -->
	<?php
	echo ob_get_clean();
}