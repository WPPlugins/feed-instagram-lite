<?php

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly!');
}


/*--------------------------------------------------------------------------------*/
/*  Register Custom Post
/*--------------------------------------------------------------------------------*/
function gifeed_register_custom_post() {
	
	$labels = array(
		'name' 				=> _x( 'Instagram Feeds', 'post type general name' ),
		'singular_name'		=> _x( 'Instagram Feed', 'post type singular name' ),
		'add_new' 			=> __( 'Add New Feed', 'feed-instagram-lite' ),
		'add_new_item' 		=> __( 'Feeds', 'feed-instagram-lite' ),
		'edit_item' 		=> __( 'Edit Feed', 'feed-instagram-lite' ),
		'new_item' 			=> __( 'New Feed', 'feed-instagram-lite' ),
		'view_item' 		=> __( 'View Feed', 'feed-instagram-lite' ),
		'search_items' 		=> __( 'Search Feeds', 'feed-instagram-lite' ),
		'not_found' 		=> __( 'No Feed Found', 'feed-instagram-lite' ),
		'not_found_in_trash'=> __( 'No Feed Found In Trash', 'feed-instagram-lite' ),
		'parent_item_colon' => __( 'Parent Feed', 'feed-instagram-lite' ),
		'menu_name'			=> __( 'Instagram Lite', 'feed-instagram-lite' )
	);

	$taxonomies = array( 'instafeeds' );
	$supports = array( 'title' );
	
	$post_type_args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __( 'Instagram Lite', 'feed-instagram-lite' ),
		'public' 			=> false,
		'show_ui' 			=> true,
		'publicly_queryable'=> true,
		'query_var'			=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> false,
		'hierarchical' 		=> false,
		'rewrite' 			=> array( 'slug' => 'ginstagramfeed', 'with_front' => false ),
		'supports' 			=> $supports,
		'menu_position' 	=> 20,
		'menu_icon' 		=>  plugins_url( 'admin/img/wp-dashboard-icon.png' , dirname(__FILE__) ),		
		'taxonomies'		=> $taxonomies
	);


	 register_post_type( 'ginstagramfeed', $post_type_args );

}


/*--------------------------------------------------------------------------------*/
/*  Rename submenu
/*--------------------------------------------------------------------------------*/
function gifeed_rename_submenu() {  
    global $submenu;     
	$submenu['edit.php?post_type=ginstagramfeed'][5][0] = __( 'All Feeds', 'feed-instagram-lite' );  
}  


/*--------------------------------------------------------------------------------*/
/*  Add Custom Columns
/*--------------------------------------------------------------------------------*/
add_filter( 'manage_edit-ginstagramfeed_columns', 'ginstagramfeed_edit_columns' );
function ginstagramfeed_edit_columns( $gifeed_columns ){  
	$gifeed_columns = array(  
		'cb' => '<input type="checkbox" />',  
		'gifeed_ttl' => __( 'Feed Name', 'feed-instagram-lite' ),
		'gifeed_type' => __( 'Feed(s) Info', 'feed-instagram-lite' ),
		'gifeed_sc' => __( 'Shortcode', 'feed-instagram-lite' ),
		'gifeed_editor' => __( 'Actions', 'feed-instagram-lite' ),	
			
	);  
	unset( $gifeed_columns['Date'] );
	return $gifeed_columns;  
}


/*-------------------------------------------------------------------------------*/
/*  Setup Admin Sub Menu
/*-------------------------------------------------------------------------------*/
function gifeed_instagram_menu() {

    $settings_page = add_submenu_page(
        'edit.php?post_type=ginstagramfeed',
        __( 'Settings', "feed-instagram-lite" ),
        __( 'Settings', "feed-instagram-lite" ),
        'manage_options',
        'ghozylab-instagram-settings',
        'gifeed_instagram_settings_page'
    );

    $freeplug_page = add_submenu_page(
        'edit.php?post_type=ginstagramfeed',
        __( 'Free Plugins', "feed-instagram-lite" ),
        __( 'Free Plugins', "feed-instagram-lite" ),
        'manage_options',
        'ghozylab-free-plugins',
        'gifeed_free_plugin_page'
    );
	
    $premiumplug_page = add_submenu_page(
        'edit.php?post_type=ginstagramfeed',
        __( 'Premium Plugins', "feed-instagram-lite" ),
        __( 'Premium Plugins', "feed-instagram-lite" ),
        'manage_options',
        'ghozylab-premium-plugins',
        'gifeed_premium_plugin_page'
    );
	
    $pricing_page = add_submenu_page(
        'edit.php?post_type=ginstagramfeed',
        __( 'Upgrade to PRO', "feed-instagram-lite" ),
        __( 'Upgrade to PRO', "feed-instagram-lite" ),
        'manage_options',
        'ghozylab-instagram-comparison',
        'gifeed_instagram_comparison_page'
    );
	
    $docs_page = add_submenu_page(
        'edit.php?post_type=ginstagramfeed',
        __( 'Documentation', "feed-instagram-lite" ),
        __( 'Documentation', "feed-instagram-lite" ),
        'manage_options',
        'ghozylab-instagram-docs',
        'gifeed_instagram_docs_page'
    );
	
	add_action( 'load-' . $settings_page, 'gifeed_global_script_loader' );
	add_action( 'load-' . $settings_page, 'gifeed_settings_script_loader' );
	
	add_action( 'load-' . $docs_page, 'gifeed_global_script_loader' );
	add_action( 'load-' . $docs_page, 'gifeed_settings_script_loader' );
	
	add_action( 'load-' . $freeplug_page, 'gifeed_global_script_loader' );
	add_action( 'load-' . $freeplug_page, 'gifeed_settings_script_loader' );
	
	add_action( 'load-' . $premiumplug_page, 'gifeed_global_script_loader' );
	add_action( 'load-' . $premiumplug_page, 'gifeed_settings_script_loader' );
	
	add_action( 'load-' . $pricing_page, 'gifeed_global_script_loader' );
	add_action( 'load-' . $pricing_page, 'gifeed_settings_script_loader' );
	
}


/*-------------------------------------------------------------------------------*/
/*   Hide & Disabled View, Quick Edit and Preview Button
/*-------------------------------------------------------------------------------*/
function gifeed_remove_row_actions( $actions ) {
	global $post;
    if( $post->post_type == 'ginstagramfeed' ) {
		unset( $actions['edit'] );
		unset( $actions['view'] );
		unset( $actions['trash'] );
		unset( $actions['inline hide-if-no-js'] );
	}
    return $actions;
}

if ( is_admin() ) {
	add_filter( 'post_row_actions','gifeed_remove_row_actions', 10, 2 );
}


function gifeed_overview_script() {
	
	global $current_screen;

	if( 'ginstagramfeed' == $current_screen->post_type ) {
		
    	echo '<style type="text/css">
		
		#gifeed_ttl {
			width: 21%;
		}

		.alternate, .striped > tbody > :nth-child(2n+1), ul.striped > :nth-child(2n+1) {
			background-color: #f5f5f5;
			}
		
		.tablenav { display: none; }
		
		.gifeed_editor a:focus {
			box-shadow: none !important;
		}
		
		.column-gifeed_editor {
			text-align: right !important;
			padding-right: 21px !important;
			width:160px;
		}
		.check-column {
			vertical-align: middle !important;
			padding-bottom: 7px !important;
		}
		.gifeed_sc, .gifeed_type, .gifeed_ttl, .gifeed_editor {
			vertical-align: middle !important;	
		}
		
		.column-gifeed_editor {
			text-align:right;
		}
		.gifeed-scode-block {
		padding: 4px;
		background: none repeat scroll 0% 0% rgba(0, 0, 0, 0.07);
		font-family: "courier new",courier;
		cursor: pointer;
		text-align: center;
		font-size:1em !important;
		width:100%;
		margin-top: 5px;
		}
		.gifeed-shortcode-message {
    	font-style: italic;
    	color: #2EA2CC !important;
		}
		.column-gifeed_sc {max-width: 275px;}
		.gifeed_form_actions {margin-right: 15px !important;margin-top: 5px !important;}
		.gifeed_tooltips[alt] { position: relative;}
		.gifeed_tooltips[alt]:hover:after{
		content: attr(alt);
		padding: 3px 12px;
		color: #85003a;
		position: absolute;
		white-space: nowrap;
		z-index: 20;
		right:0px;
		top:33px;
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
		border-radius: 3px;
		-moz-box-shadow: 0px 0px 2px #c0c1c2;
		-webkit-box-shadow: 0px 0px 2px #c0c1c2;
		box-shadow: 0px 0px 2px #c0c1c2;
		background-image: -moz-linear-gradient(top, #ffffff, #eeeeee);
		background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, #ffffff),color-stop(1, #eeeeee));
		background-image: -webkit-linear-gradient(top, #ffffff, #eeeeee);
		background-image: -moz-linear-gradient(top, #ffffff, #eeeeee);
		background-image: -ms-linear-gradient(top, #ffffff, #eeeeee);
		background-image: -o-linear-gradient(top, #ffffff, #eeeeee);}
		.delfeed:hover {color:rgb(171, 27, 27);}</style>';
		?>
		<script>
				
					jQuery(function($) {
						$('.gifeed-scode-block').click( function () {
							try {
								//select the contents
								this.select();
								//copy the selection
								document.execCommand('copy');
								//show the copied message
								$('.gifeed-shortcode-message').remove();
								$(this).after('<p class="gifeed-shortcode-message"><?php _e( 'Shortcode copied to clipboard','feed-instagram-lite' ); ?></p>');
							} catch(err) {
								console.log('Oops, unable to copy!');
							}
						});
					});
				</script>
                
                <?php
		
		}
		
}
add_action('admin_head','gifeed_overview_script');


function ginstagramfeed_columns_edit_columns_list( $gifeed_columns, $post_id ){

	switch ( $gifeed_columns ) {
		
		case 'gifeed_ttl':
		
		echo '<span class="dashicons dashicons-format-aside" style="margin: 0px 5px 0px 0px;"></span> <strong>'.strip_tags( get_the_title( $post_id ) ).'</strong>';
		if ( isset( $_GET['post_status'] ) && $_GET['post_status'] == 'trash' ) {
		echo '<span style="display:block;"><a alt="Restore Feed" href="'.wp_nonce_url( admin_url( 'post.php?post='.$post_id.'&amp;action=untrash', $post_id ), 'untrash-post_' .$post_id ).'">Restore</a></span>';
		}
		
	        break;
		
	    case 'gifeed_type':
		
		$feeds = get_post_meta( $post_id, 'gifeed_feedbuilder_format', true );
		
		if ( isset( $feeds ) && !empty( $feeds['instauname'] ) ) {
			
			$eachFeeds = explode( ',', $feeds['instauname'] );
			$eachFeedsId = explode( ',', $feeds['instaidstags'] );
			
			echo '<span style="font-style:italic;">Feeds : </span>';
			
				foreach ( $eachFeeds as $usr => $indx ) {
					echo '<p style="margin-top:5px;"><span class="dashicons '.( strpos( $indx, '#') !== false  ? 'dashicons-tag' : '
dashicons-businessman' ).'" style="margin-right:1px;"></span><strong>'.$indx.'</strong> ( '.( strpos( $indx, '#') !== false  ? 'hashtag' : $eachFeedsId[$usr] ).' )</p>';
				
				}
				
			//echo '<span style="font-style:italic;">Header Type : </span><p style="margin-top:5px;"><strong>'.$feeds['format'].'</strong></p>';
			
			} else {
				
			echo 'empty';
				
		}
		

	        break;

	    case 'gifeed_sc':
		
		echo '<span style="margin-bottom:5px;font-style:italic;">Click on shortcode box to copy</span><input readonly="readonly" value="[ghozylab-instagram feed='.$post_id.']" class="gifeed-scode-block" type="text">';

	        break;
			
	    case 'gifeed_editor':

		echo '<a class="gifeed_tooltips" alt="Edit Feed" href="'.get_edit_post_link( $post_id ).'"><span class="dashicons dashicons-edit gifeed_form_actions"></span></a>'.( current_user_can('edit_posts') ? '<a class="gifeed_tooltips" alt="Duplicate Feed" href="'.admin_url( 'admin.php?action=gifeed_duplicate_feed&amp;post=' . $post_id . '"><span class="dashicons dashicons-admin-page gifeed_form_actions"></span></a>' ) : '').'<a class="gifeed_tooltips" alt="Preview" href="'.admin_url( 'admin-ajax.php?action=gifeed_generate_preview&feed_id='.$post_id.'&prev_type=review' ).'" target="_blank"><span class="dashicons dashicons-desktop gifeed_form_actions"></span></a><a class="gifeed_tooltips delfeed" alt="Delete Feed" href="'.( isset( $_GET['post_status'] ) && $_GET['post_status'] == 'trash' ? get_delete_post_link( $post_id, '', true ) : get_delete_post_link( $post_id ) ).'"><span class="dashicons dashicons-trash gifeed_form_actions"></span></a>';
		
	        break;

		default:
			break;
	}  
}  

add_filter( 'manage_posts_custom_column',  'ginstagramfeed_columns_edit_columns_list', 10, 2 );  