jQuery(document).ready(function($) {

	var links = jQuery('.gifeedtabcon li a');
	var tabcont = jQuery("#tabs_container");
	var refreshTime;
	var validationClue = false;
	
	setTimeout(function(){
		
		$(".gifeeddefaulttab").trigger("click");
		
		gifeed_feedbuilder_id_filter();
  
  	}, 300);
	
	
	// Show reminder to validate
	$('#publish').on('click', function () {
		
		if ( validationClue == true ) {
			
			$("#insta-username-validation").notify("Please Validate first before Save / Update your Feed",{
				position:"top-right",
				arrowSize: 10,
				});
			
			return false;
		}
		
	});
			
    $("#gifeed_feedbuilder_format_users").focusout(function(){
		
		validationClue = true;
		
	});
			
			
	$('.gifeedtabcon li a').on('click', function () {

		if ($(this).attr('id') == 'adv' ) {
			
			refreshTime = setTimeout(refreshCodeMirror, 1000);
			
		}
				
		$(tabcont).hide();
		$(".tabloader").css("height", "300").addClass("tbloader");
		$(tabcont).find("tr").hide();
	
		$(tabcont).find("."+jQuery(this).attr("id")+"").fadeIn(500, function() {
			$(tabcont).fadeIn("slow");
			$(".tabloader").css("height", "auto").removeClass("tbloader");
		});				
				
     	links.removeClass('tabulous_active');
	 	$(this).addClass('tabulous_active');
								
	});
	
	function refreshCodeMirror() {
		
		$('.CodeMirror').each(function(i, el){
			el.CodeMirror.refresh();
			});
			
			clearInterval(refreshTime);
			
	}
	
	//	Feed Builder Field
	function gifeed_feedbuilder_id_filter() {
		
		var $iselmt = $('#gifeed_feedbuilder_format_users');
		var $allfeeds = $('#gifeed_feedbuilder_format_idstags');

		if ($iselmt.val() == '') {
			$('#insta-username-validation').attr('disabled','disabled');
			} else {
				$('#insta-username-validation').removeAttr('disabled');
				}
		
		// Remove last comma
		if ($iselmt.val().charAt(0) == ',') {
			$iselmt.val($iselmt.val().substring(1));
			}
			
		if ($allfeeds.val().charAt(0) == ',') {
			$allfeeds.val($allfeeds.val().substring(1));
			}
		
		if ($iselmt.val().indexOf(',') !== -1) {
			$('.feed_bulk_options').fadeIn(500);
			
			} else {
				$('.feed_bulk_options').fadeOut(100);
				$(".feed_bulk_options #individual").prop("checked", true);
				}
		
		// Remove double comma		
		if ($iselmt.val().indexOf(',,') !== -1) {
			$iselmt.val($iselmt.val().replace(/,,/g, ','));
			}
			
		if ($allfeeds.val().indexOf(',,') !== -1) {
			$allfeeds.val($allfeeds.val().replace(/,,/g, ','));
			}
			
		// Only allow alphabet, number, underscore and #
		if ($iselmt.val().match(/[^a-zA-Z0-9,#_. ]/g)) {
			$iselmt.val($iselmt.val().replace(/[^a-zA-Z0-9,#_. ]/g, ''));
            }
				
	} // End gifeed_feedbuilder_id_filter
	

	// Validate Username	
	jQuery('#insta-username-validation').click(function(){
		
		$('#gifeed_feedbuilder_format_idstags').val($('#gifeed_feedbuilder_format_users').val());
		
		var all_element = new Array();
			all_element = [$(this), $('#gifeed_feedbuilder_format_users'), $('.feed_validation_info'), $('#validation_status'), $('.btn_loading'), $('.items_to_val'), $('#gifeed_feedbuilder_format_idstags')];
		
		gifeed_validate_usernames(all_element);
		
	});		
		
		
	// Validate Username
	function gifeed_validate_usernames(elmt) {

		// Skip hastag(s) when validate username
		var res = new Array();
		str = elmt[1].val().replace(/,\s*$/, "");
			res = str.split(",");
			
			
		if ( ! res.length ) {
			
				elmt[2].fadeIn(300);
				elmt[3].removeClass().addClass('button_loading');
				elmt[4].css('display','inline-block');
				elmt[5].html('Please wait...');
				elmt[0].attr('disabled','disabled');
				elmt[1].attr('disabled','disabled');
				
			setTimeout(
			function() {
				elmt[3].removeClass().addClass('validation_valid');
				elmt[5].html('Done...');
			}, 500);		
			
			setTimeout(
			function() {
				$(elmt[2]).fadeOut(300);
				elmt[4].hide();
				elmt[0].removeAttr('disabled');
				elmt[1].removeAttr('disabled');
			}, 1500);					
								
		}
			
			
		// Check valid user ( one by one ) begin!	
		$.each( res, function( index, value ){
			
			var querySearch, inCheck, isID, isName, isHash;
			
			setTimeout(function () {
			
				elmt[2].fadeIn(300);
				elmt[3].removeClass().addClass('button_loading');
				elmt[4].css('display','inline-block');
				elmt[5].html('Please wait...');
				elmt[0].attr('disabled','disabled');
				elmt[1].attr('disabled','disabled');
				
				// Check for hashtags or Username
				if ( value.indexOf('#') > -1) {
					
					var cleanHashtag = value.replace('#', '');
					querySearch = 'https://api.instagram.com/v1/tags/search?q='+cleanHashtag+'&access_token='+elmt[0].data('instatoken')+'';
					inCheck = 'hashtags';
					
				} else {
					
					querySearch = 'https://api.instagram.com/v1/users/search?q='+value+'&count=1&access_token='+elmt[0].data('instatoken')+'';
					inCheck = 'username';
					
				}
			
				$.ajax({
					type: "GET",
					dataType: "jsonp",
					cache: false,
					url: encodeURI(querySearch),
					success: function(data) {
						if ( typeof data.data[0] == 'undefined' ) {
					
							elmt[1].val(elmt[1].val().replace(value, ''));
							elmt[6].val(elmt[6].val().replace(value, ''));
							gifeed_feedbuilder_id_filter();
							elmt[3].removeClass().addClass('validation_invalid');	
							elmt[5].html('<span style="color:red !important;"><strong>'+value+'</strong> '+inCheck+' is not valid!</span>');
						
							return;
						
						} else {
						
							elmt[3].removeClass().addClass('validation_valid');
							
							if (inCheck == 'username') {
								
								isID = data.data[0].id;
								isName = data.data[0].username;
								isHash = '';
								
							} else {
								
								isID = data.data[0].name;
								isName = data.data[0].name;
								isHash = '#';
								
							}

							elmt[5].html('<span style="color:blue !important;"><strong>'+isName+'</strong> '+inCheck+' is valid</span>');
							elmt[1].val(elmt[1].val().replace(value, isHash+isName));
							elmt[6].val(elmt[6].val().replace(value, isHash+isID));
						}
					}
							
				}); // End Ajax
			
			    	if (index+1 == res.length) {
						setTimeout(
							function() {
								$(elmt[2]).fadeOut(300);
								elmt[4].hide();
								elmt[1].val(elmt[1].val().replace(/,\s*$/, ""));
								elmt[6].val(elmt[6].val().replace(/,\s*$/, ""));
								elmt[0].removeAttr('disabled');
								elmt[1].removeAttr('disabled');
								gifeed_feedbuilder_id_filter();
								validationClue = false;
								
								}, 1500);
							}

				}, index*1000);
			
		}); // End Each

	} // End gifeed_validate_usernames
	
	
	// Validate username(s)
	$(document).on("keyup contextmenu input", '#gifeed_feedbuilder_format_users', function () {
		
		gifeed_feedbuilder_id_filter();
			
		});
		
		
	// Preview
	$("#gifeed-preview").click(function(){
		
		$("#post").attr("target","_blank");
		$("#post").attr("action","admin-ajax.php");
		$("#hiddenaction").val("gifeed_generate_preview");
		$("#originalaction").val("gifeed_generate_preview");
		$("<input>").attr("type","hidden").attr("name","action").attr("id","gifeed_preview").val("gifeed_generate_preview").appendTo("#post");
		$("#post").submit();
		$("#post").attr("target","");
		$("#post").attr("action","post.php");
		$("#hiddenaction").val("editpost");
		$("#gifeed_preview").remove();
		$("#originalaction").val("editpost");
		
		if ( validationClue == true ) {
			$('#publish').removeClass('disabled');
			$('.spinner').removeClass('is-active');
			}

		});
		

	// Typography
	var fontloader;
	
	$(".gifeed_font_list option[value=google-font]").attr('disabled','disabled').addClass('gifeed_list_disabled');
	$(".gifeed_font_list option[value=default-font]").attr('disabled','disabled').addClass('gifeed_list_disabled');
	
	
	/* Font Preview */
	jQuery(".gifeed_font_preview").click(function(){
		alert('Pro version only!');
	
	});

	
	/* Reset Typography */
	jQuery(".gifeed_font_reset").click(function(){
		
		jQuery('.gifeed-typo').each(function(){
			
			var value = jQuery(this).attr('data-def');
			
			jQuery(this).attr('value', value);
			if ( jQuery(this).hasClass('backonly') ) jQuery(this).prev().find('.col-indicator').css('background-color', value);
			
		});
		
		
	});	


	$("#tabs_container *").attr("disabled", "disabled").off('click');
	
		var over = '<div class="overlay">' +
            '</div><a href="'+gifeed_metabox_opt.upgrade_link+'"><div class="upgradenow hvr-wobble-bottom"></div></a>';
        $(over).appendTo('#tabs_container');	
	
	
	
}); // End Doc Ready