<?php

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}

if ( strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post-new.php' ) || strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post.php' ) ) {
	
	// ADD STYLE & SCRIPT
	add_action( 'admin_head', 'gifeed_editor_add_init' );
		function gifeed_editor_add_init() {
			
			if ( get_post_type( get_the_ID() ) != 'ginstagramfeed' ) {
				
				wp_enqueue_style( 'gifeed_tinymce_css', plugins_url( 'css/tinymce.css', __FILE__ ), array(), IFLITE_VERSION );
				wp_enqueue_script( 'gifeed_tinymce_js', plugins_url( 'js/tinymce.js', __FILE__ ), array(), IFLITE_VERSION );
				
				$tinymcedata = array(
						'sc_icon' => plugins_url( 'img/wp-dashboard-icon.png' , __FILE__ ),
						'sc_version' => IFLITE_VERSION
						);
				
				wp_localize_script( 'gifeed_tinymce_js', 'gifeed_tinymce_vars', $tinymcedata );
				
				
			}
			
		}
		
	// ADD MEDIA BUTOON	
	add_action( 'media_buttons_context', 'gifeed_shortcode_button', 1 );
		function gifeed_shortcode_button($context) {
			$img = plugins_url( 'img/wp-dashboard-icon.png' , __FILE__ );
			$container_id = 'gifeedmodal';
			$title = 'Shortcode Generator';
			$context .= '
			<a class="thickbox button" data-nonce="'.wp_create_nonce( "gifeed_get_feed" ).'" id="gifeed_shortcode_button" title="'.$title.'" style="outline: medium none !important; cursor: pointer;" >
			<img src="'.$img.'" alt="Instagram Feed Lite" width="20" height="20" style="position:relative; top:-1px"/>Instagram Feed Lite</a>';
			return $context;
		}	
		
}


// GENERATE POPUP CONTENT
add_action('admin_footer', 'gifeed_popup_content');	
function gifeed_popup_content() {
	
	if ( strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post-new.php' ) || strstr( $_SERVER['REQUEST_URI'], 'wp-admin/post.php' ) ) {
		
		if ( get_post_type( get_the_ID() ) != 'ginstagramfeed' ) { ?>
<div id="gifeedmodal" style="display:none;">
<div id="tinyfeed">
<div class="gifeed_input" id="gifeedtinymce_select_feed_div">
<label class="label_option" for="gifeedtinymce_select_feed">Select Feed</label>
	<select class="gifeed_select" name="gifeedtinymce_select_feed" id="gifeedtinymce_select_feed">
    <option id="selectfeed" type="text" value="select">- Select feed -</option>
</select>
<div class="clearfix"></div>
</div>

<div class="gifeed_button">
<input type="button" value="Insert Shortcode" name="gifeed_insert_scrt" id="gifeed_insert_scrt" class="button-secondary" />	
<div class="clearfix"></div>
</div>

<div style="border-top: 1px solid #DDD; margin-top:10px; padding: 7px;display:block; width:505px;"></div>
<div style="display:inline-block;vertical-align: top;">
<h4 class="gifeed_pro_here">Pro Version DEMO :</h4>
<ul class="gifeed_pro_demo_list">
<li><a href="http://demo.ghozylab.com/plugins/instagram-feed-plugin/#!/eleganmasonry" target="_blank">Elegant Instagram Masonry</a></li>
<li><a href="http://demo.ghozylab.com/plugins/instagram-feed-plugin/#!/simpleblue" target="_blank">Simple Blue Gallery</a></li>
<li><a href="http://demo.ghozylab.com/plugins/instagram-feed-plugin/#!/classic3col" target="_blank">Classic 3 Columns</a></li>
<li><a href="http://demo.ghozylab.com/plugins/instagram-feed-plugin/#!/thumbnails" target="_blank">Thumbnails Gallery</a></li>
</ul>
<div class="clearfix"></div>
</div>
<div style="display:inline-block; vertical-align: bottom; float: right; position: relative; right:50px;">
<img src="<?php echo plugins_url( 'img/tinymce/goto_pro_version.png' , __FILE__ ); ?>" alt="Pro Version" width="130" height="182" style="margin-left:100px;"/>
</div>


</div>
</div>
<?php 
	}
  } //END
}
