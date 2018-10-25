/* global confirm, redux, redux_change */


(function( $ ) {
    "use strict";

    redux.field_objects = redux.field_objects || {};
    redux.field_objects.custom_header_builder = redux.field_objects.custom_header_builder || {};

    var scroll = '';

    redux.field_objects.custom_header_builder.init = function( selector ) {
        if ( !selector ) {
            selector = $( document ).find( ".redux-group-tab:visible" ).find( '.redux-container-custom_header_builder:visible' );
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
                
                /**    Sorter (Layout Manager) */
                el.find( '.redux-sorter' ).each(
                    function() {
                        var id = $( this ).attr( 'id' );

                        el.find( '#' + id ).find( 'ul' ).sortable(
                            {
                                items: 'li',
                                placeholder: "placeholder",
                                connectWith: '.sortlist_' + id,
                                opacity: 0.8,
                                scroll: false,
                                out: function( event, ui ) {
                                    if ( !ui.helper ) return;
                                    if ( ui.offset.top > 0 ) {
                                        scroll = 'down';
                                    } else {
                                        scroll = 'up';
                                    }
                                    redux.field_objects.custom_header_builder.scrolling( $( this ).parents( '.redux-field-container:first' ) );

                                },
                                over: function( event, ui ) {
                                    scroll = '';
                                },

                                deactivate: function( event, ui ) {
                                    scroll = '';
                                },

                                stop: function( event, ui ) {
                                    var sorter = redux.fields.custom_header_builder[$( this ).attr( 'data-id' )];
                                    var id = $( this ).find( 'h3' ).text();
                                    if ( sorter.limits && id && sorter.limits[id] ) {
                                        if ( $( this ).children( 'li' ).length >= sorter.limits[id] ) {
                                            $( this ).addClass( 'filled' );
                                            if ( $( this ).children( 'li' ).length > sorter.limits[id] ) {
                                                $( ui.sender ).sortable( 'cancel' );
                                            }
                                        } else {
                                            $( this ).removeClass( 'filled' );
                                        }
                                    }
                                },

                                update: function( event, ui ) {
                                    var sorter = redux.fields.custom_header_builder[$( this ).attr( 'data-id' )];
                                    var id = $( this ).find( 'h3' ).text();

                                    if ( sorter.limits && id && sorter.limits[id] ) {
                                        if ( $( this ).children( 'li' ).length >= sorter.limits[id] ) {
                                            $( this ).addClass( 'filled' );
                                            if ( $( this ).children( 'li' ).length > sorter.limits[id] ) {
                                                $( ui.sender ).sortable( 'cancel' );
                                            }
                                        } else {
                                            $( this ).removeClass( 'filled' );
                                        }
                                    }

                                    $( this ).find( '.position' ).each(
                                        function() {
                                            //var listID = $( this ).parent().attr( 'id' );
                                            var listID = $( this ).parent().attr( 'data-id' );
                                            var parentID = $( this ).parent().parent().attr( 'data-group-id' );

                                            redux_change( $( this ) );

                                            var optionID = $( this ).parent().parent().parent().parent().attr( 'id' );
                                            $( this ).prop(
                                                "name",
                                                redux.args.opt_name + '[' + optionID + '][' + parentID + '][' + listID + ']'
                                            );
                                        }
                                    );
                                }
                            }
                        );
                        el.find( ".redux-sorter" ).disableSelection();
                    }
                );
                el.find( 'select.redux-select-item' ).each(
                    function() {
                        var default_params = {
                            width: 'resolve',
                            triggerChange: true,
                            allowClear: true
                        };

                        if ( $( this ).siblings( '.select2_params' ).size() > 0 ) {
                            var select2_params = $( this ).siblings( '.select2_params' ).val();
                            default_params = $.extend( {}, default_params, select2_params );
                        }

                        $( this ).select2( default_params );

                        $( this ).on(
                            "change", function() {
                                $( this ).siblings( '.select2_params' ).val($(this).val());
                                var parentID = jQuery( $( $( this ) ) ).closest( '.redux-group-tab' ).attr( 'id' );
                                if(parentID){
                                    redux_change( $( $( this ) ) );
                                    $( this ).select2SortableOrder();                                    
                                }

                            }
                        );
                    }
                );
            }
        );  
    };

    redux.field_objects.custom_header_builder.scrolling = function( selector ) {
        if (selector === undefined) {
            return;
        }
        
        var scrollable = selector.find( ".redux-sorter" );

        if ( scroll == 'up' ) {
            scrollable.scrollTop( scrollable.scrollTop() - 20 );
            setTimeout( redux.field_objects.custom_header_builder.scrolling, 50 );
        } else if ( scroll == 'down' ) {
            scrollable.scrollTop( scrollable.scrollTop() + 20 );
            setTimeout( redux.field_objects.custom_header_builder.scrolling, 50 );
        }
    };


})( jQuery );