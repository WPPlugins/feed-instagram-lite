<?php

if ( ! defined( 'ABSPATH' ) ) exit;


/*-------------------------------------------------------------------------------*/
/*  Get Global Setting Options
/*-------------------------------------------------------------------------------*/
function gifeed_opt( $name ){
	
    $gifeed_values = get_option( 'ghozylab_instagram_feed_options' );
    if ( is_array( $gifeed_values ) && array_key_exists( $name, $gifeed_values ) ) return $gifeed_values[$name];
    return false;
	
}


/*-------------------------------------------------------------------------------*/
/* Default Options
/*-------------------------------------------------------------------------------*/
function gifeed_def_opt(){
	
    $opt = get_option( 'ghozylab_instagram_feed_options' );
	
	if ( !is_array( $opt ) ) {
		
		update_option( 'ghozylab_instagram_feed_options', array() );
		$opt['gif_instagram_opt_token'] = '';
		$opt['gif_instagram_opt_uid'] = '';
		$opt['gifeed_google_fonts_api_key'] = '';
		$opt['gifeed_google_fonts_short'] = 'none';
		$opt['gif_instagram_opt_autoupdate'] = 'active';
		$opt['gif_instagram_opt_fetch'] = 'server';
		$opt['gif_instagram_is_lite'] = 'yes';
		update_option( 'ghozylab_instagram_feed_options', $opt );
		
	}
	
	if ( !is_network_admin() && ! gifeed_opt( 'gif_instagram_opt_token' ) ) wp_redirect( admin_url( 'edit.php?post_type=ginstagramfeed&page=ghozylab-instagram-settings#go=settingpage' ) );
	} 


/*-------------------------------------------------------------------------------*/
/*  Generate Random Strings
/*-------------------------------------------------------------------------------*/
function gifeed_RandomString( $length ) {
	
	$original_string = array_merge( range( 'a','z' ), range( 'A', 'Z' ) );
	$original_string = implode( '', $original_string );
	return substr( str_shuffle( strtolower( $original_string) ), 0, $length );
	
}


/*-------------------------------------------------------------------------------*/
/*  Handle wrong Feed ID
/*-------------------------------------------------------------------------------*/
function gifeed_frontend_notify( $feed ) {
	
		$gifeednotify = '<style>/* FEED Notification */
.gifeed-frontinf {
	-moz-border-radius-bottomleft:4px;
	-moz-border-radius-bottomright:4px;
	padding: 16px;
	-moz-border-radius: 7px;
	-webkit-border-radius: 7px;
	-khtml-border-radius: 10px;
	border-radius: 7px;
	background: #fffadb;
	font-style: italic;
	font-family: Georgia, "Times New Roman", Times, serif;
	font-size: 16px;
	border: 1px solid #f5d145;
	color: #9e660d;
	width: auto;
	line-height:1.5em;
	margin: 0 auto;
	margin-top: 30px;
	margin-bottom: 30px;
	text-align:center;
}

.gifeed-frontinf-img {
	margin: 0 auto;
	text-align:center;
	display:block;
	box-shadow: none !important;
	border-radius: none !important;
	margin-bottom:10px;
	max-height: 48px !important;
	max-width: 48px !important;
}

.idfeed {
	font-weight: bold;
	color: #ff3333;
}

</style><div class="gifeed-frontinf"><img class="gifeed-frontinf-img" src="'.plugins_url( 'frontend/img/warning.png' , dirname(__FILE__) ).'" height="48" width="48"><span>Instagram Feed ID: <span class="idfeed">'.$feed.'</span> cannot be found. Please check your current shortcode!</span></div>';
			
	echo $gifeednotify;
}