jQuery(document).ready(function($) {
	
	$('.update_notify').hide();

	if(window.location.hash) {
		
		var hash, realHash;
		
		hash = window.location.hash.split('=')[1];
		
		realHash =  hash.split('.')[0];
		
		switch ( realHash ){
			
			case 'e400':
			
			$(".gifeed_generate_token_button").notify("Please Generate your Instagram Access Token first.",{
				position:"right-middle",
				arrowSize: 5,
			});
			  
			return false;
			
			break;
			
	  		default:
			
			if ( jQuery.isNumeric(realHash) ) {
				
				id = hash.split('.')[0];
				$("#gif_instagram_opt_token").val(hash);
				$("#gif_instagram_opt_uid").val(id);
				
				if ( gifeed_admin_settings_script_opt.is_on_save == 'No' ) {
					$(".gifeed_credential_container, #gif_instagram_opt_token, #gif_instagram_opt_uid").effect( "highlight", {color:"#f0d377"}, 4000 );
					$("#note-to-save-con").fadeIn(1000, function() {
						$("#note-to-save").effect( "pulsate", {times:6}, 3000 );
					});
					
					$('html, body').animate({scrollTop: $("#toscroll").offset().top}, 1000);	
				}
			
			} else {
				$('html, body').animate({scrollTop: $("#"+realHash).offset().top}, 1000);
			}
		
		}

	}
				
	if ( gifeed_admin_settings_script_opt.is_on_save == 'onSave' ) {
		
		$(".gifeed_credential_container, #gif_instagram_opt_token, #gif_instagram_opt_uid").effect("highlight", {
			color:"#a3ddab"
			}, 1000);
			
		$('html, body').animate({
			scrollTop: $("#toscroll").offset().top}, 1000);
			
		$("#save-notice	").css("display", 'inline-block').fadeOut(1000, function() {
			window.location = ""+gifeed_admin_settings_script_opt.redirect_to+"";
			});
					
	}
	

	// Validate username(s)
	$(document).on("keyup contextmenu input", '#gifeed_google_fonts_api_key', function () {
		
		jQuery(this).val(jQuery.trim(jQuery(this).val()));
			
		});
	

	
	/* General Settings */
	jQuery('.gifeed-opt-cont input').not('#gifeed_google_fonts_api_key').bind('click', function() {
		
		loadingOverlay();
		gifeed_ajax_options(jQuery(this));
		
	});
	
	function gifeed_ajax_options(el) {

		var data = {
			action: 'gifeed_ajax_update_settings',
			security: jQuery(el).attr('data-nonce'),				
			cmd: [jQuery(el).attr('data-opt'), jQuery(el).val()],
			};
			
			jQuery.post(ajaxurl, data, function(response) {
	
				var notify = jQuery(el).parent().find('.update_notify');
				notify.hide();
				notify.removeClass('notifyupdated notifyerror');
				
				if (response == 1) {
					$('#overlay').remove();
					notify.removeClass('notifyupdated notifyerror').addClass('notifyupdated').fadeIn(500, function() {
						notify.fadeOut(2000);
					});
					
					}						
					else {
						$('#overlay').remove();
						notify.removeClass('notifyupdated notifyerror').addClass('notifyerror').fadeIn(500, function() {
						notify.fadeOut(2000);
						});
						alert('Ajax request failed, please refresh your browser window.');
						}
						
			});
			
	}
	
		
	function afterAjax(el, msg, sts) {
		
		jQuery(el[0]).removeAttr('disabled');
		$('#overlay').remove();
		el[1].text(msg).css('color', sts).fadeIn(2000, function() {
			el[1].fadeOut(2000);
			});

	}
	
	
	function loadingOverlay() {
		
		var over = '<div id="overlay">' +
            '<div id="loading"></div>' +
            '</div>';
        $(over).appendTo('#wpcontent');	
		
	}

	
});