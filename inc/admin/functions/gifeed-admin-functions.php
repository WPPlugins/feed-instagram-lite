<?php

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}


/*-------------------------------------------------------------------------------*/
/*  Duplicate Forms
/*-------------------------------------------------------------------------------*/
function gifeed_duplicate_feed(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'gifeed_duplicate_feed' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
 
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
 
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
 
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
 
		/*
		 * new post data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => 'COPY of '. $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
 
		/*
		 * insert the post by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );
 
		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
 
		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
 
 
		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		 
		 if ( wp_get_referer() ) {
			 
			 wp_safe_redirect( wp_get_referer() );
			 
			 } else {
				 
				 wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
				 
				 }
		
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}


add_action( 'admin_action_gifeed_duplicate_feed', 'gifeed_duplicate_feed' );


/*-------------------------------------------------------------------------------*/
/*  Create Preview Metabox
/*-------------------------------------------------------------------------------*/
function gifeed_preview_metabox() {
	
	$gprev = '<div style="text-align:center;">';
	$gprev .= '<img class="grayscale" id="gifeed-preview" style="-moz-border-radius: 3px;-webkit-border-radius: 3px;-khtml-border-radius: 3px;border-radius:3px;margin-top:9px;cursor:pointer;" src="'.plugins_url( 'img/metabox/preview.png' , dirname(__FILE__) ).'" width="130" height="65" alt="Preview" >';
	$gprev .= '</div>';
	
	echo $gprev;
	
}


/*-------------------------------------------------------------------------------*/
/*   CHECK BROWSER VERSION ( IE ONLY )
/*-------------------------------------------------------------------------------*/
function gifeed_check_browser_version_admin( $sid ) {
	
	if ( is_admin() && get_post_type( $sid ) == 'ginstagramfeed' ){

		preg_match( '/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches );
		if ( count( $matches )>1 ){
			$version = explode(".", $matches[1]);
			switch(true){
				case ( $version[0] <= '8' ):
				$msg = 'ie8';

			break; 
			  
				case ( $version[0] > '8' ):
		  		$msg = 'gah';
			  
			break; 			  

			  default:
			}
			return $msg;
		} else {
			$msg = 'notie';
			return $msg;
			}
	}
}


/*-------------------------------------------------------------------------------*/
/*   Generate Number on Loop
/*-------------------------------------------------------------------------------*/
function gifeed_generate_number( $from = null, $to = null ) {
	
	$num = range( $from, $to );
	$res = array_combine( $num, $num );
	return $res;
	
}


/*-------------------------------------------------------------------------------*/
/*   AJAX Get Feed List
/*-------------------------------------------------------------------------------*/
function gifeed_grab_feed_list_ajax() {
	
	// run a quick security check
	if( ! check_ajax_referer( 'gifeed_get_feed', 'security' ) )
		return;
	
	$list = array();
	
	global $post;
			
	$args = array(
			'post_type' => 'ginstagramfeed',
  			'order' => 'ASC',
  			'post_status' => 'publish',
  			'posts_per_page' => -1,
				);

	$myposts = get_posts( $args );
	foreach( $myposts as $post ) :	setup_postdata($post);
	
	$list[$post->ID] = array('val' => $post->ID, 'title' => esc_html(esc_js(the_title(NULL, NULL, FALSE))) );
	
	endforeach;
		
	echo json_encode($list); //Send to Option List ( Array )
	die();
	
}
add_action('wp_ajax_gifeed_grab_feed_list_ajax', 'gifeed_grab_feed_list_ajax');


/*-------------------------------------------------------------------------------*/
/*   AJAX Update Settings
/*-------------------------------------------------------------------------------*/
function gifeed_ajax_update_settings() {
	
	// run a quick security check
	if( ! check_ajax_referer( $_POST['cmd'][0], 'security' ) )
		return;
		
		$options = get_option( 'ghozylab_instagram_feed_options' );
		$options[ $_POST['cmd'][0] ] = $_POST['cmd'][1];
		
		update_option( 'ghozylab_instagram_feed_options', $options );
		
		echo '1';
		die();
		
	
}
add_action('wp_ajax_gifeed_ajax_update_settings', 'gifeed_ajax_update_settings');


/*-------------------------------------------------------------------------------*/
/*   GENERATE SHARE BUTTONS
/*-------------------------------------------------------------------------------*/
function gfeed_share() {
?>
<div style="position:relative; margin-top:6px;">
<ul class='easycform-social' id='easycform-cssanime'>
<li class='easycform-facebook'>
<a onclick="window.open('http://www.facebook.com/sharer.php?s=100&amp;p[title]=Check out the Best Instagram Feed Wordpress Plugin&amp;p[summary]=Best Instagram Feed Wordpress Plugin is powerful plugin to create Instagram gallery just in
minutes&amp;p[url]=http://demo.ghozylab.com/plugins/instagram-feed-plugin/&amp;p[images][0]=<?php echo IFLITE_URL . '/inc/frontend/img/instagram-feed-pro.png'; ?>', 'sharer', 'toolbar=0,status=0,width=548,height=325');" href="javascript: void(0)" title="Share"><strong>Facebook</strong></a>
</li>
<li class='easycform-twitter'>
<a onclick="window.open('https://twitter.com/share?text=Best Wordpress Instagram Feed Plugin &url=http://demo.ghozylab.com/plugins/instagram-feed-plugin/', 'sharer', 'toolbar=0,status=0,width=548,height=325');" title="Twitter" class="circle"><strong>Twitter</strong></a>
</li>
<li class='easycform-googleplus'>
<a onclick="window.open('https://plus.google.com/share?url=http://demo.ghozylab.com/plugins/instagram-feed-plugin/','','width=415,height=450');"><strong>Google+</strong></a>
</li>
<li class='easycform-pinterest'>
<a onclick="window.open('http://pinterest.com/pin/create/button/?url=http://demo.ghozylab.com/plugins/instagram-feed-plugin/;media=<?php echo IFLITE_URL . '/inc/frontend/img/instagram-feed-pro.png'; ?>;description=Best Instagram Feed Wordpress Plugin','','width=600,height=300');"><strong>Pinterest</strong></a>
</li>
</ul>
</div>

    <?php
	}