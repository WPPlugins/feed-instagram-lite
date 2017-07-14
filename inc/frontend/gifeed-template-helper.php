<?php

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}

// Generate HTML Markup
function gifeed_feed_html_markup_helper( $feed_id = null, $unique_num = null, $opt = null ) {

	ob_start();
	
	$instafeeds = array_map( 'trim', explode( ',', $opt['feeds']['instaidstags'] ) );
	$instafeeds = array_filter( $instafeeds );
	$getby = array();
	$getbyType = array();
	$feed_header_id = 'none';

	// Arrange each Options
	foreach( range( 0, count( $instafeeds ) -1 ) as $i ) {
		
		if ( strpos( $instafeeds[$i], '#') !== false ) {
			$getbyType[] = 'tagName';
			$getby[] = 'tagged';
			$instafeeds[$i] = str_replace( '#', '', $instafeeds[$i] );	
		} else {
			$getbyType[] = 'userId';
			$getby[] = 'user';
			}
	}
	
	// Get Default Header ID
	if ( $opt['feeds']['format'] == 'group' ) {
		
		foreach ( $instafeeds as $feeds ) {
			
			if ( is_numeric( $feeds ) ) {
				
				$feed_header_id = $feeds;
				
				break;
				
			}
		}
	}

	// Stored Options into Array
	wp_localize_script( 'gifeed_frontend_main_script', 'gifeed_opt'.$feed_id.$unique_num,
		array(
		'feed_id' => $feed_id,
		'unique_num' => $unique_num,
		'instafeeds' => $instafeeds,
		'getby' => $getby,
		'getbytype' => $getbyType,
		'opt' => $opt,
		'feed_format' => $opt['feeds']['format'],
		'feed_header_id' => $feed_header_id,
		'app_client_id' => IFLITE_CLIENT_ID,
		'gifeed_at' => gifeed_opt( 'gif_instagram_opt_token' ),
			)
	);

	// Main Container
    echo '<div data-localize="gifeed_opt'.$feed_id.$unique_num.'" style="width:100%;" class="gifeed_main_container gifeed_main_'.$unique_num.'">';

		 
		 		if ( count( $instafeeds ) > 1 ) {
						
						switch ( $opt['feeds']['format'] ) {
					
							case 'group': // Group All Feed(s)
							
								if ( $opt['header'] == 'on' ) {
									
									foreach ( $instafeeds as $feeds ) {
										
										if ( is_numeric( $feeds ) ) {
											
											$mainheader = $feeds;
											
											break;
										
										} else {
										
											$mainheader = '';
											
											}
											
									} // End Foreach
									?>
                <div id="insta-cont-<?php echo $unique_num.'-'.$mainheader; ?>" class="gifeed-container"><div id="insta-header-<?php echo $unique_num.'-'. $mainheader; ?>" class="gifeed-header-container"></div><?php for ( $x = 0; $x <= count( $instafeeds )-1; $x++ ){$add_id = '-'.ltrim( $instafeeds[$x], '#' ); ?><ul class="gifeed-main-items" id="gifeed-<?php echo $unique_num.''.$add_id; ?>"></ul><?php } ?><div class="gifeed-loadmore-container"><span id="insta-loadmore-<?php echo $unique_num; ?>" class="gifeed-loadmore">Load More</span></div></div><?php } else { // Header OFF ?>
        		<div id="insta-cont-<?php echo $unique_num; ?>" class="gifeed-container">
				<?php for ( $x = 0; $x <= count( $instafeeds )-1; $x++ ) {$add_id = '-'.ltrim( $instafeeds[$x], '#' ); ?><ul class="gifeed-main-items" id="gifeed-<?php echo $unique_num.''.$add_id; ?>"></ul><?php } ?><div class="gifeed-loadmore-container"><span id="insta-loadmore-<?php echo $unique_num; ?>" class="gifeed-loadmore loadmore-<?php echo $unique_num; ?>">Load More</span></div></div> <?php }
		
						break;
						
						case 'individual': //This is for Individual feeds ( Multiple IDs / Tags ) ( by usernames / hashtags )
						
						if ( $opt['header'] == 'on' ) {
							
							for ( $x = 0; $x <= count( $instafeeds )-1; $x++ ) {
								
								if ( count( $instafeeds ) == 1 ) {
									
									$add_id = '';
									
									} else {
										
										$add_id = '-'.ltrim( $instafeeds[$x], '#' );
									
									} ?>
		<div id="insta-cont-<?php echo $unique_num.$add_id; ?>" class="gifeed-container"><div id="insta-header-<?php echo $unique_num.$add_id; ?>" class="gifeed-header-container"></div><ul class="gifeed-main-items" id="gifeed-<?php echo $unique_num.$add_id; ?>"></ul><div class="gifeed-loadmore-container"><span id="insta-loadmore-<?php echo $unique_num.$add_id; ?>" class="gifeed-loadmore loadmore-<?php echo $unique_num; ?>">Load More</span></div></div><?php } // End For
						} // End If Header ON
						
						else {
        
						for ( $x = 0; $x <= count( $instafeeds )-1; $x++ ) {
							
							if ( count( $instafeeds ) == 1 ) {
								
								$add_id = '';
								
								} else {
									
									$add_id = '-'.ltrim( $instafeeds[$x], '#' );
									
									} ?>
                                  <div id="insta-cont-<?php echo $unique_num.$add_id; ?>" class="gifeed-container"><ul class="gifeed-main-items" id="gifeed-<?php echo $unique_num.$add_id; ?>"></ul><div class="gifeed-loadmore-container"><span id="insta-loadmore-<?php echo $unique_num.$add_id; ?>" class="gifeed-loadmore loadmore-<?php echo $unique_num; ?>">Load More</span></div></div><?php
        				} // End For
						
						} // End Header OFF
                        
						break;
						
						default:
						
					} // End SWITCH
	 			
				} else { // --------------------- END Multiple ID. This is for Single IDs or Tags 
				
						if ( $opt['header'] == 'on' ) {	
				?><div id="insta-cont-<?php echo $unique_num.'-'.ltrim( $instafeeds[0], '#' ); ?>" class="gifeed-container"><div id="insta-header-<?php echo $unique_num.'-'.ltrim( $instafeeds[0], '#' ); ?>" class="gifeed-header-container"></div><ul class="gifeed-main-items" id="gifeed-<?php echo $unique_num.'-'.ltrim( $instafeeds[0], '#' ); ?>"></ul><div class="gifeed-loadmore-container"><span id="insta-loadmore-<?php echo $unique_num.'-'.ltrim( $instafeeds[0], '#' ); ?>" class="gifeed-loadmore loadmore-<?php echo $unique_num; ?>">Load More</span></div></div><?php
                    //END Header ON ( Single Feed )
					} else { ?><div id="insta-cont-<?php echo $unique_num.'-'.ltrim( $instafeeds[0], '#' ); ?>" class="gifeed-container"><ul class="gifeed-main-items" id="gifeed-<?php echo $unique_num.'-'.ltrim( $instafeeds[0], '#' ); ?>"></ul><div class="gifeed-loadmore-container"><span id="insta-loadmore-<?php echo $unique_num.'-'.ltrim( $instafeeds[0], '#' ); ?>" class="gifeed-loadmore loadmore-<?php echo $unique_num; ?>">Load More</span></div></div><?php } // End Header OFF ( Single Feed )
				} // End Feed type check
	
	// End Main Container
	?></div> 
	
    <!-- Preloader -->
	<div class="bubblingG" id="preloader-<?php echo $unique_num; ?>" style="text-align:center;display:block;width:100%; margin:0 auto;"><span id="bubblingG_1"></span><span id="bubblingG_2"></span><span id="bubblingG_3"></span></div><?php
	$final = ob_get_clean();
	
	echo $final;
	
	
}