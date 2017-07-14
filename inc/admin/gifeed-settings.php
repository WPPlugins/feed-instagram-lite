<?php

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}


function gifeed_instagram_settings_page() {

	if ( ! isset( $_POST['gifeed_on_saving_settings_nonce'] ) || ! wp_verify_nonce( $_POST['gifeed_on_saving_settings_nonce'],
	'gifeed_on_saving_settings' ) ) {
		
		// Skip
		
		} else {
		
		$gif_instagram_opt_token = sanitize_text_field( $_POST[ 'gif_instagram_opt_token' ] );
        $gif_instagram_opt_uid = sanitize_text_field( $_POST[ 'gif_instagram_opt_uid' ] );
		
		$options = get_option( 'ghozylab_instagram_feed_options' );
		$options[ 'gif_instagram_opt_token' ] = $gif_instagram_opt_token;
		$options[ 'gif_instagram_opt_uid' ] = $gif_instagram_opt_uid;

		update_option( 'ghozylab_instagram_feed_options', $options );

		
	}
	

	ob_start(); ?>

	<div class="wrap about-wrap gifeed-class">
    
			<h1><?php printf( esc_html__( 'Welcome to %s', 'feed-instagram-lite' ), IFLITE_ITEM_NAME ); ?></h1>
			<div class="about-text"><?php printf( esc_html__( 'Thank you for installing this plugin. %s is ready to make your Instagram media more stunning and more elegant!', 'feed-instagram-lite' ), IFLITE_ITEM_NAME ); ?></div>
            <div id="settingpage" class="gifeed-badge">Version <?php echo IFLITE_VERSION; ?></div>
        <hr style="margin-bottom:20px;">

		<p id="toscroll" style="font-style:italic; color:rgb(225, 35, 35); border-bottom: 1px dotted #CCC; margin-top: 45px; padding-bottom: 5px;"><span class="dashicons dashicons-megaphone"></span>&nbsp;&nbsp;<?php _e( 'You need an Access Token from Instagram in order to be able to display Instagram media ( images or videos ). Simply click the red button below, log into Instagram and hit Authorize button.', 'feed-instagram-lite' ); ?></p>
		<form method="post" action="" name="gifeed_form">

			<?php wp_nonce_field( 'gifeed_on_saving_settings', 'gifeed_on_saving_settings_nonce' ); ?>

			<table class="form-table">
				<tbody class="gifeed_credential_container">
                <tr valign="top">
                        <div id="gifeed_config">
                        <a href="<?php echo esc_url( add_query_arg( array( 
						'client_id' => IFLITE_CLIENT_ID,
						'scope' => 'basic+public_content+comments',
						'redirect_uri' => 'https://instagram.ghozylab.com/?return_uri='.admin_url( "edit.php?post_type=ginstagramfeed&page=ghozylab-instagram-settings" ).'',
						'response_type' => 'token' ), 'https://instagram.com/oauth/authorize/' ) ); ?>" class="gifeed_generate_token_button"><?php _e('Generate Access Token', 'feed-instagram-lite'); ?></a>
                    </div>            
                </tr>

					<tr valign="top">
						<th scope="row" valign="top">
							<span class="dashicons dashicons-admin-network"></span>&nbsp;<?php _e( 'Access Token', 'feed-instagram-lite' ); ?>
						</th>
						<td>
							<input id="gif_instagram_opt_token" name="gif_instagram_opt_token" type="text" value="<?php echo esc_attr( gifeed_opt( 'gif_instagram_opt_token' ) ); ?>" size="65" />
						</td>
					</tr>
                    
					<tr valign="top">
						<th scope="row" valign="top">
							<span class="dashicons dashicons-businessman"></span>&nbsp;<?php _e( 'User ID', 'feed-instagram-lite' ); ?>
						</th>
						<td>
							<input id="gif_instagram_opt_uid" name="gif_instagram_opt_uid" type="text" value="<?php echo esc_attr( gifeed_opt( 'gif_instagram_opt_uid' ) ); ?>" size="15" />
                            <input type="hidden" name="ghozylab_on_save" value="onSave">
						</td>
					</tr>

                    <tr style="display:none;" id="note-to-save-con" valign="top">
                        <th scope="row" valign="top">
                        <td>
                 <p id="note-to-save" style="font-size: 12px;"><span class="dashicons dashicons-warning"></span>&nbsp; <b><span style="color: red;">Important:</span> Do not forget</b> to click <b>"Save Changes"</b> button.</p> 
                 </td>
                          </th>
                    </tr>                 
                 
				</tbody>
                
                <tbody>
                    <tr valign="top">
                        <th id="gifeed-submit-btn" style="padding-top:0px !important;" scope="row" valign="top">
						<?php submit_button(); ?><span id="save-notice" style="display:none; margin-left:15px; color:#386793;"><p style="font-size: 13px;"><?php _e('Settings saved.', 'feed-instagram-lite' ); ?></p></span> 
                        </th>
                    </tr>
                </tbody>
			</table>

		</form>
        <hr style="margin-bottom:20px;">   
            
				<div style="margin-top:10px;" class="feature-section">

					<h1 id="gfonts_section" style="font-size:26px;margin-bottom:30px;"><span class="dashicons dashicons-admin-generic" style="margin: 7px 10px 0px 0px;"></span><?php _e( 'General Settings', 'feed-instagram-lite' );?><span class="update_notify"></span></h1>
                  
                    
                    <p class="faq-question"><span class="dashicons dashicons-admin-tools" style="margin-right: 5px;margin-top: 2px;"></span><?php _e( 'Plugin Auto Update', 'feed-instagram-lite' );?></p>
					<p class="opt-desc"><?php _e( 'We recommend you to enable this option to get the latest features and other important updates of this plugin.', 'feed-instagram-lite' );?></p>
                    
            <div class="gifeed-opt-cont">
			<?php $gifeed_opt_updt = gifeed_opt( 'gif_instagram_opt_autoupdate' ); ?>
            <input type="radio" data-nonce="<?php echo wp_create_nonce( "gif_instagram_opt_autoupdate"); ?>" data-opt="gif_instagram_opt_autoupdate" name="gif_instagram_opt_autoupdate" <?php echo $gifeed_opt_updt == "active" ? "checked=\"checked\"" : "";?> value="active"><label style="vertical-align: baseline;"><?php _e( "Enable", 'feed-instagram-lite' ); ?></label>
            <input type="radio" data-nonce="<?php echo wp_create_nonce( "gif_instagram_opt_autoupdate"); ?>" data-opt="gif_instagram_opt_autoupdate" name="gif_instagram_opt_autoupdate" <?php echo $gifeed_opt_updt == "inactive" ? "checked=\"checked\"" : "";?> style="margin-left: 10px;" value="inactive"><label style="vertical-align: baseline;"><?php _e( "Disable", 'feed-instagram-lite' ); ?></label>
            <span class="update_notify"></span></div>
                </div>
	</div>


<!-- Content End -->
	<?php
	echo ob_get_clean();
}