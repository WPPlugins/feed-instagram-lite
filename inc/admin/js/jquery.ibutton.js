jQuery(document).ready(function($) {
	
			jQuery("input[type=checkbox].gifeedswitch").each(function() {
				// Insert switch
				jQuery(this).before('<span class="gifeedswitch"><span class="background" /><span class="gifeedmask" /></span>');
				 //Hide checkbox
				jQuery(this).hide();
				if (!jQuery(this)[0].checked) jQuery(this).prev().find(".background").css({left: "-49px"});
				if (jQuery(this)[0].checked) jQuery(this).prev().find(".background").css({left: "-2px"});	
			});
			// Toggle switch when clicked
			jQuery("span.gifeedswitch").click(function() {
				// Slide switch off
				if (jQuery(this).next()[0].checked) {
					jQuery(this).find(".background").animate({left: "-49px"}, 200);
				// Slide switch on
				} else {
					jQuery(this).find(".background").animate({left: "-2px"}, 200);
				}
				// Toggle state of checkbox
				jQuery('#').attr('checked', true);
				jQuery(this).next()[0].checked = !jQuery(this).next()[0].checked;
				
		if (jQuery("#gifeed_meta_content_title_truncate_truncate").is(':checked')) {
			jQuery('#gifeed_meta_content_title_truncate').fadeIn(500);
		} else {
				jQuery('#gifeed_meta_content_title_truncate').fadeOut(500);
				}
				
												
			});
			
			
});