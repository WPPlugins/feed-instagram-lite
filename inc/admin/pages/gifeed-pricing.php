<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function gifeed_instagram_comparison_page() {

?>
<!-- DC Pricing Tables:3 Start -->

    <script>
        jQuery(document).ready(function ($){
            $(".column_1, .column_3, .column_2, .column_4").click(function (){
                $('html, body').animate({
                    scrollTop: $(".gfeedscrollto").offset().top
                }, 1500);
            });
        });
    </script>
    
    <style>
	.about-wrap h2 {
		margin-top: 17px;
	}
	.col1, .col2 {
		margin-right: 0px !important;
	}
	div.tsc_pt3_style1 h2.caption {
		text-align:left;
	}
	</style>

	<div class="wrap about-wrap gifeed-class">
    
			<h1><?php printf( esc_html__( 'Welcome to %s', 'feed-instagram-lite' ), IFLITE_ITEM_NAME ); ?></h1>
			<div class="about-text"><?php printf( esc_html__( 'Thank you for installing this plugin. %s is ready to make your Instagram media more stunning and more elegant!', 'feed-instagram-lite' ), IFLITE_ITEM_NAME ); ?></div>
            <div id="settingpage" class="gifeed-badge">Version <?php echo IFLITE_VERSION; ?></div>
        <hr style="margin-bottom:20px;">    
        
		<p id="todocs" style="border-bottom: 1px dotted #CCC; margin-top: 45px; padding-bottom: 5px;margin-bottom:30px;"><span class="dashicons dashicons-megaphone"></span>&nbsp;&nbsp;<?php _e( 'You can select plan to suit your needs here.', 'feed-instagram-lite' ); ?></p>
        
  <div class="tsc_pricingtable03 tsc_pt3_style1" style="margin-bottom:110px; height:850px;">
    <div class="caption_column">
      <ul class="ftr_ttl">
        <li class="header_row_1 align_center radius5_topleft"><?php gfeed_share(); ?></li>
        <li class="header_row_2">
          <h2 class="caption"><?php echo IFLITE_ITEM_NAME; ?></h2>
        </li> 
        <li class="row_style_2"><span>License</span></li>
        <li class="row_style_4"><span>Unlimited Feeds</span></li>
        <li class="row_style_2"><span>100% Responsive</span></li>       
        <li class="row_style_4"><span style="color: rgb(255, 24, 24);">Unlimited colors and layout</span></li>
        <li class="row_style_2"><span>Multiple usernames & hashtags</span></li>   
        <li class="row_style_4"><span>Use +700 Google Fonts</span></li>
        <li class="row_style_2"><span>Use +60 Options</span></li>
        <li class="row_style_4"><span>Open image / video in Lightbox</span></li>
        <li class="row_style_2"><span>Instagram Comments</span></li>
        <li class="row_style_4"><span>Custom CSS</span></li>  
        <li class="row_style_2"><span>Custom JS</span></li>  
        <li class="row_style_4"><span>Custom Template</span></li>
        <li class="row_style_2"><span>SEO Images</span></li>
        <li class="row_style_4"><span>Title, followers, Likes & Comments</span></li>
        <li class="row_style_2"><span>WP Multisite</span></li>
        <li class="row_style_4"><span>Support</span></li>
        <li class="row_style_2"><span>Update</span></li>
        <li class="row_style_4"><span>License</span></li>
        <li class="footer_row gfeedscrollto"></li>
      </ul>
    </div>
    <div class="column_1">
      <ul>
        <li class="header_row_1 align_center">
          <h2 class="col1 plug_ver">Lite</h2>
        </li>
        <li class="header_row_2 align_center">
          <h1 class="col1">Free</h1>
        </li>
        <li class="row_style_1 align_center">Free</li>
        <li class="row_style_3 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_1 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_3 align_center"><span class="pricing_no"></span></li> 
        <li class="row_style_1 align_center"><span class="pricing_no"></span></li>  
        <li class="row_style_3 align_center"><span class="pricing_no"></span></li> 
        <li class="row_style_1 align_center"><span class="pricing_no"></span></li>  
        <li class="row_style_3 align_center"><span class="pricing_no"></span></li> 
        <li class="row_style_1 align_center"><span class="pricing_no"></span></li>      
        <li class="row_style_3 align_center"><span class="pricing_no"></span></li>
        <li class="row_style_1 align_center"><span class="pricing_no"></span></li>
        <li class="row_style_3 align_center"><span class="pricing_no"></span></li> 
        <li class="row_style_1 align_center"><span class="pricing_no"></span></li>
        <li class="row_style_3 align_center"><span class="pricing_no"></span></li>        
        <li class="row_style_1 align_center"><span class="pricing_no"></span></li>         
        <li class="row_style_3 align_center"><span>none</span></li>
        <li class="row_style_1 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_3 align_center">Free</li>
         
        <li class="footer_row"></li>
      </ul>
    </div>
    
    <div class="column_2 featured">
    <span class="bestbuy"></span>
      <ul>
        <li class="header_row_1 align_center">
          <h2 class="col2 plug_ver">Pro</h2>
        </li>
        <li class="header_row_2 align_center">
          <h1 class="col2">$<span><?php echo IFLITE_PRO; ?></span></h1>
        </li>
        <li class="row_style_2 align_center"><span style="font-weight: bold; color:#F77448; font-size:14px;">1 Site</span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li>        
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li>   
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span>1 Month</span></li>
        <li class="row_style_2 align_center"><span>1 Year</span></li>
        <li class="row_style_4 align_center"><span style="font-weight: bold; color:#F77448; font-size:14px;">1 Site</span></li>
        <li class="footer_row"><a target="_blank" href="https://ghozylab.com/plugins/ordernow.php?order=ifppro" class="tsc_buttons2 blue">Upgrade Now</a></li>
      </ul>
    </div>    
    
    <div class="column_2">
      <ul>
        <li class="header_row_1 align_center">
          <h2 class="col2 plug_ver">Pro+</h2>
        </li>
        <li class="header_row_2 align_center">
          <h1 class="col2">$<span><?php echo IFLITE_PROPLUS; ?></span></h1>
        </li>
        <li class="row_style_2 align_center"><span style="font-weight: bold; color:#F77448; font-size:14px;">3 Sites</span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li>        
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li>   
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span>1 Year</span></li>
        <li class="row_style_2 align_center"><span>1 Year</span></li>
        <li class="row_style_4 align_center"><span style="font-weight: bold; color:#F77448; font-size:14px;">3 Sites</span></li>
        <li class="footer_row"><a target="_blank" href="https://ghozylab.com/plugins/ordernow.php?order=ifpplus" class="tsc_buttons2 orange">Upgrade Now</a></li>
      </ul>
    </div>
    <div class="column_2">
      <ul>
        <li class="header_row_1 align_center">
          <h2 class="col2 plug_ver">Pro++</h2>
        </li>
        <li class="header_row_2 align_center">
          <h1 class="col2">$<span><?php echo IFLITE_PROPLUSPLUS; ?></span></h1>
        </li>
        <li class="row_style_2 align_center"><span style="font-weight: bold; color:#F77448; font-size:14px;">5 Sites</span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li>        
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span class="pricing_yes"></span></li>   
        <li class="row_style_2 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_4 align_center"><span>1 Year</span></li>
        <li class="row_style_2 align_center"><span>1 Year</span></li>
        <li class="row_style_4 align_center"><span style="font-weight: bold; color:#F77448; font-size:14px;">5 Sites</span></li>
        <li class="footer_row"><a target="_blank" href="https://ghozylab.com/plugins/ordernow.php?order=ifpplusplus" class="tsc_buttons2 green">Upgrade Now</a></li>
      </ul>
    </div>    
     <div class="column_4">
      <ul>
        <li class="header_row_1 align_center">
          <h2 class="col2 plug_ver">Developer</h2>
        </li>
        <li class="header_row_2 align_center">
          <h1 class="col2">$<span><?php echo IFLITE_DEV; ?></span></h1>
        </li>
        <li class="row_style_1 align_center"><span style="font-weight: bold; color: #F77448; font-size:14px;">15 Sites</span></li>
        <li class="row_style_3 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_1 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_3 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_1 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_3 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_1 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_3 align_center"><span class="pricing_yes"></span></li> 
        <li class="row_style_1 align_center"><span class="pricing_yes"></span></li>         
        <li class="row_style_3 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_1 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_3 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_1 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_3 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_1 align_center"><span class="pricing_yes"></span></li>
        <li class="row_style_3 align_center"><span>1 year</span></li>
        <li class="row_style_1 align_center"><span>1 year</span></li>
        <li class="row_style_3 align_center"><span style="font-weight: bold; color: #F77448; font-size:14px;">15 Sites</span></li>
        <li class="footer_row"><a target="_blank" href="https://ghozylab.com/plugins/ordernow.php?order=ifpdev" class="tsc_buttons2 red">Upgrade Now</a></li>
      </ul>
    </div>   
    
    
    </div>
  </div>
<!-- DC Pricing Tables:3 End -->
<div class="tsc_clear"></div> <!-- line break/clear line -->
<?php


}