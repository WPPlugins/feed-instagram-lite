jQuery(document).ready(function($) {
	
			FeedList = jQuery('#gifeedtinymce_select_feed');
			var feed_H = 360;
			var feed_W = 550;

// END LOAD MEDIA

	jQuery("body").delegate("#gifeed_shortcode_button","click",function(){
		
			var nonce = jQuery(this).attr('data-nonce');
			FeedList.find('option').remove();
			jQuery("<option/>").val(0).text('Loading...').appendTo(FeedList);
			
		setTimeout(function() {
			tb_show( '<img class="gfeed_sc_ttl_ico" src="'+gifeed_tinymce_vars.sc_icon+'" alt="Instagram Feed Lite">Shortcode Generator<span class="gfeed_cp_version">v'+gifeed_tinymce_vars.sc_version+'</span>', '#TB_inline?height='+feed_H+'&width='+feed_W+'&inlineId=gifeedmodal' );
			jQuery("#TB_window").addClass("TB_gifeed_window").css('z-index','999999');
			jQuery("#TB_ajaxContent").addClass("TB_gifeed_ajaxContent");
			jQuery(".TB_gifeed_ajaxContent").css('height','auto');
			jQuery("select#gifeedtinymce_select_feed").val("select");
			feed_H = 360;
			
			$("#TB_closeWindowButton").replaceWith($("<div class='closetb' id='TB_closeWindowButton'><span class='screen-reader-text'>Close</span><span class='tb-close-icon'></span></div>"));
			
			//load ajax to grab feed list ( we need this methode to avoid conflict in media editor with another plugin )
			grabFeed(nonce);
			
			gfeedtbReposition();
			

		}, 300);	
		
	});
	

	// Close Thickbox
	$("body").delegate(".closetb","click",function(){
		tb_remove();
	});
	
	// add the shortcode to the post editor
	jQuery('#gifeed_insert_scrt').on("click", function () {

		if ( jQuery( "#gifeedtinymce_select_feed" ).val() != 'select' ) {
		
			var sccode;
			sccode = "[ghozylab-instagram feed="+jQuery( "#gifeedtinymce_select_feed option:selected" ).val()+"]";
		
			if( jQuery('#wp-content-editor-container > textarea').is(':visible') ) {
				var val = jQuery('#wp-content-editor-container > textarea').val() + sccode;
				jQuery('#wp-content-editor-container > textarea').val(val);	
				}
				else {
				tinyMCE.activeEditor.execCommand('mceInsertContent', 0, sccode);
					}

			tb_remove();
			}
			else {
				alert('Please select feed first!');
				//tb_remove();
				}
		});	
		
		
		function grabFeed(nnc) {
	
			jQuery.ajax({
				url: ajaxurl,
				data:{
					'action': 'gifeed_grab_feed_list_ajax',
					'security': nnc
				},
				dataType: 'JSON',
				type: 'POST',
				success:function(response){
					FeedList.find('option').remove();
					jQuery("<option/>").val('select').text('- Select Feed -').appendTo(FeedList);
					jQuery.each(response, function(i, option)
					{
						jQuery("<option/>").val(option.val).text(option.title).appendTo(FeedList);
					});
				},
				error: function(errorThrown){
				   jQuery("<option/>").val('select').text('- Select Feed -').appendTo(FeedList);
				}
				
			}); // End Grab	
		
		}
		
		
		// Reposition Thickbox
		function gfeedtbReposition() {
			
			$('.TB_gifeed_window').css({
				'top' : ((jQuery(window).height() - feed_H) / 6) + 'px',
				'left' : ((jQuery(window).width() - feed_W) / 4) + 'px',
				'margin-top' : ((jQuery(window).height() - feed_H) / 6) + 'px',
				'margin-left' : ((jQuery(window).width() - feed_W) / 4) + 'px',
				'max-height' : parseInt(feed_H) + 'px',
				'min-height' : parseInt(feed_H) + 'px',
			});
				
		}
		
		$(window).resize(function() {
			
			gfeedtbReposition();
			
		});	
		
		
});