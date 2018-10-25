/*global jQuery, document, redux*/

(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.custom_preset = redux.field_objects.custom_preset || {};

    redux.field_objects.custom_preset.init = function( selector ) {
        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-custom_preset:visible' );
        }

        $( selector ).each(
            function() {

                var el = $( this );
                var parent = el;
                if ( !el.hasClass( 'redux-field-container' ) ) {
                    parent = el.parents( '.redux-field-container:first' );
                }
                if ( parent.is( ":hidden" ) ) { // Skip hidden fields
                    return;
                }
                if ( parent.hasClass( 'redux-field-init' ) ) {
                    parent.removeClass( 'redux-field-init' );
                } else {
                    return;
                }

                el.each(
                    function() {                        
                    	//Global Variables
                    	var overlay = $( document.getElementById( 'redux_ajax_overlay' ) );
                    	$( '#redux-add-preset' ).click(
                            function( e ) {
                                e.preventDefault();
						        var $parent = jQuery( document.getElementById( "redux-form-wrapper" ) );	        
                            	$("#redux-save-preset-action").fadeIn();
                            }
                        );                    	

                    	// Delete Custom Preset
                    	jQuery(document).on( "click", '.redux-delete-preset',
                    		function( e ) {

                                e.preventDefault();
                                var $parent = jQuery( document.getElementById( "redux-form-wrapper" ) );		                                                                                                                     	
                            	var $nonce = $parent.attr( "data-nonce" );
                            	var $data = $(this).closest('.redux-group-tab').find('select:not(.bpt_save_preset), textarea:not(.bpt_save_preset), input:not(.bpt_save_preset)').serialize();
                            	var r;
                                if(jQuery(this).hasClass('reset-default')){
                                    r = confirm(bptLocalVars.reset);
                                }else{
                                    r = confirm(bptLocalVars.delete);
                                }
                                
            					if (r == false) return;
            					var selected = $(this).closest('li.redux-custom-preset-select').hasClass('item_selected');
            					
            					if(!selected){
	        						overlay.fadeIn();
	        						// Add the loading mechanism
                                    $(this).css({'opacity' : 0});
	        						$(this).siblings('.spinner').addClass( 'is-active' );            						
            					}

                            	jQuery.ajax({
                            		type: "post",
                            		cache: false,
                            		dataType: "json",
                            		url: ajaxurl,
                            		data: {
                            			action: redux.args.opt_name + "_ajax_save_preset",
                            			nonce: $nonce,
                            			'opt_name': redux.args.opt_name,
                            			data: $data,
                            			delete: true,
                            			reload: selected,
                            			name_preset: $(this).closest('.redux-custom-preset-select').find('label input').val()
                            		},
                            		success: function( response ) {                           			
                            			if(response.data.reload === 'true'){
											window.location.reload();	
                            			}else{
                            				$(this).siblings('.spinner').removeClass( 'is-active' );
                                            $(this).css({'opacity' : 1});
                        					overlay.fadeOut( 'fast' );
                            				$('ul.redux-custom-preset-select :input').filter(function(){                       				
                            					return this.value==response.data.name_preset;
                            				}).closest('li.redux-custom-preset-select').fadeOut(600, function(){ 
                            					$(this).remove();
                            				});
                            			}									
                            		}
                            	});								        				        
                            }
                        );                  	

                    	// Update Custom Preset
                        $( '.redux-update-preset' ).click(
                            function( e ) {
                                
                                e.preventDefault();
                                var $parent = jQuery( document.getElementById( "redux-form-wrapper" ) );
                            	// Editor field doesn't auto save. Have to call it. Boo.
						        
						        if ( redux.fields.hasOwnProperty( "editor" ) ) {
						            $.each(
						                redux.fields.editor, function( $key, $index ) {
						                    if ( typeof(tinyMCE) !== 'undefined' ) {
						                        var editor = tinyMCE.get( $key );
						                        if ( editor ) {
						                            editor.save();
						                        }
						                    }
						                }
						            );
						        }                                
                                                             
                                var $data = $(this).closest('.redux-group-tab').find('select:not(.bpt_save_preset), textarea:not(.bpt_save_preset), input:not(.bpt_save_preset)').serialize();
                            	
                            	$(this).closest('.redux-group-tab').find( 'input[type=checkbox]' ).each(
						            function() {
						                if ( typeof $( this ).attr( 'name' ) !== "undefined" ) {
						                    var chkVal = $( this ).is( ':checked' ) ? $( this ).val() : "0";
						                    $data += "&" + $( this ).attr( 'name' ) + "=" + chkVal;
						                }
						            }
						        );
                            	var $nonce = $parent.attr( "data-nonce" );

        						overlay.fadeIn();
        						// Add the loading mechanism
        						$('#selected-btn-preset .spinner').addClass( 'is-active' );

                            	jQuery.ajax({
                            		type: "post",
                            		cache: false,
                            		dataType: "json",
                            		url: ajaxurl,
                            		data: {
                            			action: redux.args.opt_name + "_ajax_save_preset",
                            			nonce: $nonce,
                            			'opt_name': redux.args.opt_name,
                            			data: $data,
                            			update: true,
                            			name_preset: $(this).closest('.redux-custom-preset-select').find('label input').val()
                            		},
                            		error: function( response ) {
                            			if ( !window.console ) console = {};
                            			console.log = console.log || function( name, data ) {
                            			};
                            			console.log( redux.ajax.console );
                            			console.log( response.responseText );
                            			jQuery( '.redux-action_bar input' ).removeAttr( 'disabled' );
                            			overlay.fadeOut( 'fast' );
                            			$('#selected-btn-preset .spinner').removeClass( 'is-active' );
                            			alert( redux.ajax.alert );
                            		},
                            		success: function( response ) {
                            			jQuery('#selected-btn-preset .spinner').removeClass( 'is-active' );
                        				overlay.fadeOut( 'fast' );
                            			$('ul.redux-custom-preset-select :input').filter(function(){                       				
                            				return this.value==response.data.name_preset;
                            			}).attr('data-presets', JSON.stringify(response.options) );
										
                            		}
                            	});								        	
                            }
                        );

                        // Add Custom Preset
                        $( '#redux-save-preset' ).click(
                            function( e ) {

                                e.preventDefault();
						        var $parent = jQuery( document.getElementById( "redux-form-wrapper" ) );

						        // Editor field doesn't auto save. Have to call it. Boo.
						        if ( redux.fields.hasOwnProperty( "editor" ) ) {
						            $.each(
						                redux.fields.editor, function( $key, $index ) {
						                    if ( typeof(tinyMCE) !== 'undefined' ) {
						                        var editor = tinyMCE.get( $key );
						                        if ( editor ) {
						                            editor.save();
						                        }
						                    }
						                }
						            );
						        }

						        var $data = $(this).closest('.redux-group-tab').find('select:not(.bpt_save_preset), textarea:not(.bpt_save_preset), input:not(.bpt_save_preset):not(input[name="' + redux.args.opt_name + '[opt-js-preset]"])').serialize();
								
								// add values for checked and unchecked checkboxes fields
						        $(this).closest('.redux-group-tab').find( 'input[type=checkbox]' ).each(
						            function() {
						                if ( typeof $( this ).attr( 'name' ) !== "undefined" ) {
						                    var chkVal = $( this ).is( ':checked' ) ? $( this ).val() : "0";
						                    $data += "&" + $( this ).attr( 'name' ) + "=" + chkVal;
						                }
						            }
						        );
						       	
						       	// add custom value to the active preset
						       	$data += '&'+ redux.args.opt_name + '[opt-js-preset]' + '=' + jQuery('.save-name-preset').val();
						       	var $nonce = $parent.attr( "data-nonce" );

						       	var nameExists = $('ul.redux-custom-preset-select :input').filter(function(){                       				
                            		return this.value==jQuery('.save-name-preset').val();
                            	});

                            	if(nameExists.length > 0){
                            		alert(bptLocalVars.taken_name);
                            		return;
                            	}else if(jQuery('.save-name-preset').val().length == 0){
                            		alert(bptLocalVars.empty_name);
                            		return;
                            	}
						       
        						overlay.fadeIn();
        						// Add the loading mechanism
        						$('#redux-save-preset-action .spinner').addClass( 'is-active' );

						        if(jQuery('.save-name-preset').val().length > 0){
							        jQuery.ajax({
							        	type: "post",
							        	dataType: "json",
							        	url: ajaxurl,
							        	cache: false,
							        	data: {
							        		action: redux.args.opt_name + "_ajax_save_preset",
							        		nonce: $nonce,
							        		'opt_name': redux.args.opt_name,
							        		data: $data,
							        		name_preset: jQuery('.save-name-preset').val()
							        	},
							        	error: function( response ) {
						                    if ( !window.console ) console = {};
						                    console.log = console.log || function( name, data ) {
						                        };
						                    console.log( redux.ajax.console );
						                    console.log( response.responseText );
						                    jQuery( '.redux-action_bar input' ).removeAttr( 'disabled' );
						                    overlay.fadeOut( 'fast' );
						                    jQuery( '.redux-action_bar .spinner' ).removeClass( 'is-active' );
						                    alert( redux.ajax.alert );
                						},
							        	success: function( response ) {
							        		jQuery('#redux-save-preset-action .spinner').removeClass( 'is-active' );
                        					overlay.fadeOut( 'fast' );
									        var ul = $('ul.redux-custom-preset-select');
											var item = $( ul ).find('li').length;
											item++;
											var node_str = '<li class="redux-custom-preset-select">';
											node_str  += '<label class="redux-custom-preset-select-preset-opt-js-preset_'+ item +'" for="opt-js-preset_'+ item +'">';
											node_str  += '<input type="radio" class="noUpdate redux-presets" id="opt-js-preset_'+ item +'" name="' + redux.args.opt_name + '[opt-js-preset]"  value="'+ response.data.name_preset +'" data-presets=\'' + JSON.stringify(response.options) + '\'>';
											node_str  += '<span>' + response.data.name_preset + '</span>';
											node_str  += '</label>';
											node_str  += '<div class="wrapper-btn-preset">';
											node_str  += '<div class="delete-preset">';
                                            node_str  += '<a href="#" title="'+bptLocalVars.delete+'" class="redux-delete-preset">';
                                            node_str  += '<i class="fa fa-trash" aria-hidden="true"></i>';
                                            node_str  += '</a>';
											node_str  += '<span class="spinner"></span>';
											node_str  += '</div>';
											node_str  += '</div>';
											node_str  += '</li>';
											jQuery(ul).append(node_str);
							        	}
							        });						        	
						        }
			        
                            }
                        );
						
						// Close Form Add Custom Preset
						$( '.close-save-preset' ).click(
                            function( e ) {
                            	if(jQuery('#redux-save-preset-action').css('display') == 'flex' ){
                            		jQuery('#redux-save-preset-action').fadeOut(500);
                            	}
                            }
                        );

                    }
                );
                
                // On label click, change the input and class
                jQuery(document).on( "click", '.redux-custom-preset-select label span',
                    function( e ) {

                        var id = $( this ).closest( 'label' ).attr( 'for' );
                        $( this ).parents( "fieldset:first" ).find( '.redux-custom-preset-select-selected' ).removeClass( 'redux-custom-preset-select-selected' ).find( "input[type='radio']" ).attr(
                            "checked", false
                        );

                        $( this ).closest( 'label' ).find( 'input[type="radio"]' ).prop( 'checked' );
                        if ( $( this ).closest( 'label' ).hasClass( 'redux-custom-preset-select-preset-' + id ) ) { // If they clicked on a preset, import!
                            e.preventDefault();

                            var presets = $( this ).closest( 'label' ).find( 'input' );
                            var data = presets.data( 'presets' );

                            if ( presets !== undefined && presets !== null ) {
                                var answer = confirm( redux.args.preset_confirm );

                                if ( answer ) {
                                    el.find( 'label[for="' + id + '"]' ).addClass( 'redux-custom-preset-select-selected' ).find( "input[type='radio']" ).attr(
                                        "checked", true
                                    );
                                    window.onbeforeunload = null;
                                    if ( $( '#import-code-value' ).length === 0 ) {
                                        $( this ).append( '<textarea id="import-code-value" style="display:none;" name="' + redux.args.opt_name + '[import_code]">' + JSON.stringify( data ) + '</textarea>' );
                                    } else {
                                        $( '#import-code-value' ).val( JSON.stringify( data ) );
                                    }
                                    if ( $( '#publishing-action #publish' ).length !== 0 ) {
                                        $( '#publish' ).click();
                                    } else {
                                        $( '#redux-import' ).click();
                                    }
                                }
                            } else {
                            }

                            return false;
                        } else {
                            el.find( 'label[for="' + id + '"]' ).addClass( 'redux-custom-preset-select-selected' ).find( "input[type='radio']" ).attr(
                                "checked", true
                            ).trigger('change');

                            redux_change( $( this ).closest( 'label' ).find( 'input[type="radio"]' ) );
                        }
                    }
                );
            }
        );

    };
    
    $.redux.stickyPreset = function(element = null) {
        var stickyWidth = $( '.redux-main' ).innerWidth() - 20;

        var active_selected = $('#bpt_custom_preset li.redux-custom-preset-select').filter(function(){                
        	return jQuery(this).hasClass("item_selected");
        });

        if(active_selected.length <= 0){
        	return;
        }
        var a = false;
        if(element){
            var hT = $( '#' + redux.args.opt_name + "-opt-js-preset" ).offset().top,
            hH = $( '#' + redux.args.opt_name + "-opt-js-preset" ).outerHeight(),
            wH = $(window).height(),
            wS = element.scrollTop();   
            a = wS > (hT+hH-wH)
        }       

        if ( !$( '#' + redux.args.opt_name + "-opt-js-preset" ).isOnScreen() && a ) {
        	var topPreset = '32px';
            if($('.redux-save-warn.notice-yellow').css('display') == 'block' ){
                topPreset = '67px';
            }
            $( '#bpt_custom_preset' ).css(
        	{
        		position: 'fixed',
        		top: topPreset,
        		width: stickyWidth,
        		right: 21
        	}
        	);
        	$( '#bpt_custom_preset' ).addClass( 'sticky-preset-fixed' );
        } else {
        	$( '#bpt_custom_preset' ).css(
        	{
        		background: '#fff',
        		position: 'inherit',
        		top: 'inherit',
        		width: 'inherit'
        	}
        	);
        	$( '#bpt_custom_preset' ).removeClass( 'sticky-preset-fixed' );

        }        
    };   

    if ( $( '#' + redux.args.opt_name + "-opt-js-preset" ).length !== 0 ) {
    	$( window ).scroll(
    		function() {
    			$.redux.stickyPreset($(this));
    		}
    	);

    	$( window ).resize(
    		function() {
    			$.redux.stickyPreset($(this));
    		}
    	);
    }

})( jQuery );