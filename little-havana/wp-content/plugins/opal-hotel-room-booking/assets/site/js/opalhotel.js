'use strict';

(function($){

	var OpalHotelSite = {

		init: function () {

			/* search init */
			this.search.init();

			/* process single room page */
			this.single.init();

			/* process cart */
			this.cart.init();

			/* checkout init */
			this.checkout.init();

			/* reservation step */
			this.reservation.init();
		},

		search: {
			init: function() {
				var _doc = $( document );

				_doc.on( 'click', '.opalhotel-room-toggle-packages', this.collapse );

				_doc.on( 'submit', '.opalhotel_check_availability', this.check_availability );

				_doc.on( 'click', '.opalhotel-view-price', this.view_pricing );

				_doc.on( 'click', '.opalhotel-modal-close', this.close_pricing );

				//fancybox galerry
				$('.opalhotel-room-gallery-button').click( function(){  
					$("a[rel="+$(this).data('rel')+"]").first().click();
					return false;
				});

				/// 
				_doc.on( 'click', '.opalhotel-view-package-details', this.package_details );
			},

			collapse: function( e ) {
				e.preventDefault();
				var _self = $( this );
				var	_collapse =  $(_self.attr('href') ).find( '.opalhotel-room-package-wrapper' );

				// alert(); 
				_self.toggleClass( 'active' );

				if ( _self.hasClass( 'active' ) ) {
					_collapse.addClass( 'active' );
				} else {
					_collapse.removeClass( 'active' );
				}
				return false;
			},

			check_availability: function( e ) {
				e.preventDefault();
				var _form = $( this ),
					_action = _form.attr( 'action' ),
					_arrival = _form.find( '.opalhotel_arrival_date' ),
					_arrival_date = _arrival.datepicker( 'getDate' ),
					_departure = _form.find( '.opalhotel-departure-date' ),
					_departure_date = _departure.datepicker( 'getDate' );

				if ( _arrival_date === null || new Date( _arrival.val() ) === 'Invalid Date' ) {
					_arrival.focus();
					return false;
				}

				if ( _departure_date === null || new Date( _departure.val() ) === 'Invalid Date' ) {
					_departure.focus();
					return false;
				}

				if ( new Date( _arrival_date ) >= new Date( _departure_date ) ) {
					_form.opalhotel_modal({
		                tmpl: 'opalhotel-alert',
		                settings: {
		                	message: OpalHotel.arrival_departure_invalid
		                }
		            });
		            return false;
				}

				// if ( typeof OpalHotel.is_reservation_page === 'undefined' || ! OpalHotel.is_reservation_page ) {
				// 	window.location.href = _action + '?' + _form.serialize();
				// 	return false;
				// }

				var data = OpalHotelSite.form_data( _form );
				data.action = 'opalhotel_reservation_step';
				$.ajax({
	    			url: OpalHotel.ajaxurl,
	    			type: 'POST',
	    			data: data,
	    			beforeSend: function() {
	    				OpalHotelSite.reservation.beforeSend();
	    			}
	    		}).always( function() {

	    			/* disappear effect */
				    OpalHotelSite.reservation.afterSend();

			    }).done( function( res ) {

			    	if ( typeof res.redirect !== 'undefined' ) {
			    		window.location.href = res.redirect;
			    	}

	    			if ( res.status === true && typeof res.step !== 'undefined' ) {
	    				$( '.opalhotel-reservation-container' ).replaceWith( res.step );
	    				/* remove review cart because is empty */
	    				$( '.opalhotel-reservation-available-review' ).slideUp(400, function(){
	    					// $(this).remove();
	    				});
	    			} else if( res.status === false && typeof res.message !== 'undefined' ) {
	    				_form.opalhotel_modal({
			                tmpl: 'opalhotel-alert',
			                settings: {
			                	message: res.message
			                }
			            });
	    			}

	    		} ).fail( function( jqXHR, textStatus ) {
	    			_form.opalhotel_modal({
		                tmpl: 'opalhotel-alert',
		                settings: {
		                	message: textStatus
		                }
		            });
	    		});
				return false;
			},

			view_pricing: function( e ) {  
				e.preventDefault();
				var _self = $( this ),
					_form = _self.parents( '.opalhotel-available-form:first' ),
					_pricing = _form.find( '.opalhotel-modal-pricing' );

				setTimeout(function(){
					_pricing.addClass( 'active' );
				}, 100 ); 
			},

			package_details: function( e ) {
				e.preventDefault();
				var _self = $( this ),
					_form = _self.parents( '.opalhotel-room-package-item:first' ),
					_package_details = _form.find( '.opalhotel-package-desc' );

				setTimeout(function(){
					_package_details.toggleClass( 'hide' );
					_package_details.toggleClass( 'active' );
				}, 100 ); 
				return false;
			},

			close_pricing: function( e ) {
				 e.preventDefault();
				var _self = $( this ),
					_lightbox = _self.parents( '.opalhotel-modal-pricing:first' );
				_lightbox.removeClass( 'active' );
				 	
			}
		},

		single: {

			/* init single process. Eg: tabs ... */
			init: function() {
				var _doc = $( document );

				/* room gallery */
				this.gallery();

				/* init tabs */
				this.init_tabs();

				/* review */
				this.review();

				/* submit review */
				_doc.on( 'submit', '.opalhotel-comment-form', this.submit_review );
				_doc.on( 'click', '.opalhotel-single-tabs .opalhotel-single-tabs-ul .tab', this.single_tabs );

				$('.package-item .package-description').hide();
				_doc.on( 'click', '.package-item .package-content', this.package_action );
			},
			package_action:function(){
				$(this).parent().toggleClass('active').find('.package-description').toggle();
			},
			init_tabs: function() {
				$( '.opalhotel-single-tabs .opalhotel-single-tabs-ul .opalhotel-single-tabs a.tab:first' ).addClass( 'active' );
				$( '.opalhotel-single-tabs .opalhotel-single-tab-panel:first' ).addClass( 'active' );
			},

			review: function() {
				var reviews = $( '.opalhotel-star' );
				for( var i = 0; i < reviews.length; i++ ) {
					var _review = $( reviews[i] ),
						type = _review.attr( 'data-type' ),
						html = [];

					html.push( '<p>' );
					html.push( '<span class="star-wrapper" data-type="' + type + '">' )
					html.push( '<span href="#" class="star" data-star="1"></span>' );
					html.push( '<span href="#" class="star" data-star="2"></span>' );
					html.push( '<span href="#" class="star" data-star="3"></span>' );
					html.push( '<span href="#" class="star" data-star="4"></span>' );
					html.push( '<span href="#" class="star" data-star="5"></span>' );
					html.push( '<input type="hidden" name="opalhotel_rating[' + type + ']" />' );
					html.push( '</span>' );
					html.push( '</p>' );
					_review.append( html.join( '' ) );
					_review = _review.find( '.star-wrapper' );
					_review.mousemove( function( e ){
						e.preventDefault();
						var parentOffset = $( this ).offset(),
							relX = e.pageX - parentOffset.left,
							star = $(this).find( '.star' ),
							width = star.width(),
							rate = Math.ceil( relX / width );

						for( var y = 0; y < star.length; y++ ) {
							var st = $( star[y] ),
								_data_star = parseInt( st.attr( 'data-star' ) );
							if( _data_star <= rate ) {
								st.addClass( 'active' );
							}
						}
					}).mouseout( function( e ){
						var parentOffset = $( this ).offset(),
							relX = e.pageX - parentOffset.left,
							star = $(this).find( '.star' ),
							width = star.width(),
							rate = $(this).find( '.star.selected' );

						if( rate.length === 0 ) {
							star.removeClass( 'active' );
						} else {
							for( var y = 0; y < star.length; y++ ) {
								var st = $( star[y] ),
									_data_star = parseInt( st.attr( 'data-star' ) );

								if( _data_star <= parseInt( rate.attr( 'data-star' ) ) ) {
									st.addClass( 'active' );
								} else {
									st.removeClass( 'active' );
								}
							}
						}
					}).mousedown( function( e ){
						e.preventDefault();
						var parentOffset = $( this ).offset(),
							relX = e.pageX - parentOffset.left,
							star = $(this).find( '.star' ),
							width = star.width(),
							type = $( this ).attr( 'data-type' ),
							rate = Math.ceil( relX / width );
						star.removeClass( 'selected' ).removeClass( 'active' );
						for( var y = 0; y < star.length; y++ ) {
							var st = $( star[y] ),
								_data_star = parseInt( st.attr( 'data-star' ) );
							if( _data_star === rate ) {
								st.addClass( 'selected' ).addClass( 'active' );
								break;
							} else {
								st.addClass( 'active' );
							}
						}
						$( this ).find( 'input[name="opalhotel_rating[' + type + ']"]' ).val( rate );
					} );
				}
			},

			submit_review: function( e ) {
				var _self = $( this ),
					_rating = _self.find( 'input[name^="opalhotel_rating"]' );
					// _rating_val = _rating.val();

				if ( typeof OpalHotel.options.enabled_require_rating !== 'undefined' && typeof OpalHotel.options.enabled_rating !== 'undefined'
					&& OpalHotel.options.enabled_rating == '1'
					&& OpalHotel.options.enabled_require_rating == '1' ) {

					var rated = true;
					for ( var i = 0; i < _rating.length; i++ ) {
						var __rate = $( _rating[i] );
						if ( __rate.val() === '' ) {
							rated = false;
						}
					}

					if ( rated === false ) {
						_self.opalhotel_modal({
			                tmpl: 'opalhotel-alert',
			                settings: {
			                	message: OpalHotel.require_rating
			                }
			            });

			            return false;
					}
				}
				// _self.submit();
				return true;
			},

			single_tabs: function( e ) {
				e.preventDefault();
				var _self = $( this ),
					_parent = _self.parents( '.opalhotel-single-tabs:first' ),
					_tab = _self.find( 'a:first' ).attr( 'href' );

				_parent.find( '.tab' ).removeClass( 'active' );
				_self.addClass( 'active' );
				_parent.find( '.opalhotel-single-tab-panel' ).removeClass( 'active' );
				_parent.find( _tab ).addClass( 'active' );

			},

			gallery: function() {

				if ( ! $.fn.owlCarousel ){
					return;
				}

			    var sync1 = $( '.opalhotel-room-single-gallery' );
			    var sync2 = $( '.opalhotel-room-single-gallery-thumb' );

			    sync1.owlCarousel({
					singleItem 	: true,
					slideSpeed 	: 500,
					navigation	: true,
					navigationText : false,
					pagination	:false,
					afterAction : syncPosition,
					responsiveRefreshRate : 200,
				});

				$( ".owl-prev").html('<i class="fa fa-angle-left"></i>');
 				$( ".owl-next").html('<i class="fa fa-angle-right"></i>');

			    sync2.owlCarousel({
				    items : 10,
				    itemsDesktop      : [1199,10],
				    itemsDesktopSmall : [979,10],
				    itemsTablet       : [768,8],
				    itemsMobile       : [479,4],
				    pagination:false,
				    responsiveRefreshRate : 100,
				    afterInit : function(el){
				      el.find( '.owl-item' ).eq(0).addClass( 'synced' );
				    }
				});

				function syncPosition(el){
				    var current = this.currentItem;
				    sync2.find( '.owl-item' ).removeClass( 'synced' ).eq( current ).addClass( 'synced' )
					    if( sync2.data( 'owlCarousel' ) !== undefined ){
					      	center( current )
					    }
			 	}

				sync2.on( 'click', ".owl-item", function(e){
					e.preventDefault();
					var number = $(this).data( 'owlItem' );
					sync1.trigger(( 'owl.goTo' ), number );
				});

				function center( number ){
					var sync2visible = sync2.data( 'owlCarousel' ).owl.visibleItems;
					var num = number;
					var found = false;
					for( var i in sync2visible ){
					  	if(num === sync2visible[i]){
					    	var found = true;
					  	}
					}

					if( found === false ){
					  	if( num > sync2visible[sync2visible.length-1] ){
					    	sync2.trigger(( 'owl.goTo' ), num - sync2visible.length+2)
					  	} else {
					    if( num - 1 === -1 ){
							num = 0;
					    }
							sync2.trigger( ( 'owl.goTo' ), num );
					  	}
					} else if( num === sync2visible[ sync2visible.length - 1 ] ){
						sync2.trigger( ( 'owl.goTo' ), sync2visible[1] )
					} else if( num === sync2visible[0] ){
						sync2.trigger( ( 'owl.goTo' ), num-1 )
					}

				}
			}

		},

		cart: {

			init: function() {

				var _doc = $( document );

				/* add to cart function */
				_doc.on( 'submit', '.opalhotel-available-form', this.add_to_cart );

				_doc.on( 'click', '.opalhotel-reservation-available-review .cart_remove_item', this.remove_cart_item );
			},

			add_to_cart: function( e ) {
				e.preventDefault();

				var _self = $( this ),
					_button = _self.find( '.opalhotel-button-submit' ),
					_data = OpalHotelSite.form_data( _self );

				if ( _data.qty == 0 ) {
					_self.opalhotel_modal({
		                tmpl: 'opalhotel-alert',
		                settings: {
		                	message: OpalHotel.quantity_invalid
		                }
		            });
		            return false;
				}

				$.ajax({
					url: OpalHotel.ajaxurl,
					type: 'POST',
					data: _data,
					beforeSend: function(){
						_button.append( '<i class="fa fa-spinner fa-spin"></i>' );
					}
				}).done( function( res ){
					_button.find( '.fa' ).remove();
					if ( res.status === false && typeof res.message !== 'undefined' ) {
						_self.opalhotel_modal({
			                tmpl: 'opalhotel-alert',
			                settings: {
			                	message: res.message
			                }
			            });
					} else if ( res.status === true && typeof res.review !== 'undefined' ) {
						var reviews = $( '.opalhotel-reservation-available-review' ),
							header = $( '.opalhotel_check_availability header' );
						if ( reviews.length > 0 ) {
							reviews.slideUp( 400, function(){
								$( this ).slideDown( 400, function(){
									$( this ).replaceWith( res.review );
								});
							});
						} else {
							header.after( res.review );
						}

						if ( typeof res.message !== 'undefined' ) {
							$( 'body' ).prepend( res.message );
							$( '.opalhotel-flash-message' ).slideDown( 400, function(){
								var timeout = setTimeout( function(){
									$( '.opalhotel-flash-message' ).slideUp( 400, function(){
										$( this ).remove();
									});
									clearTimeout( timeout );
								}, 2000);
							});
							if( $( 'body' ).find('.reservation_step').length ){
								$('html, body').animate({
				                    scrollTop: $( 'body' ).find('.reservation_step').offset().top - 200
				                }, 2000);
							}
						}
					}
					if ( typeof res.redirect !== 'undefined' ) {
						window.location.href = res.redirect;
					}
				} ).fail( function( jqXHR, textStatus ){
					_button.find( '.fa' ).remove();
					_self.opalhotel_modal({
		                tmpl: 'opalhotel-alert',
		                settings: {
		                	message: textStatus
		                }
		            });
		            return false;
				});
			},

			remove_cart_item: function( e ) {
				e.preventDefault();
				var _self = $( this ),
					_cart_item_id = _self.attr( 'data-id' );

				$.ajax({
					url: OpalHotel.ajaxurl,
					type: 'POST',
					data: {
						action: 'opalhotel_remove_cart_item',
						cart_item_id: _cart_item_id
					},
					beforeSend: function(){
						_self.addClass( 'fa-spin' );
						OpalHotelSite.reservation.beforeSend();
					}
				}).always( function(){
					_self.removeClass( 'fa-spin' );
				 	OpalHotelSite.reservation.afterSend();
				}).done( function( res ){
					if ( res.status === false && res.message !== '' ) {
						_self.opalhotel_modal({
			                tmpl: 'opalhotel-alert',
			                settings: {
			                	message: res.message
			                }
			            });
			            return false;
					}
					if ( typeof res.checkout_review !== 'undefined' ) {
	    				$( '.opalhotel-checkout-review' ).html( res.checkout_review );
	    			}
					if ( typeof res.reservation_review !== 'undefined' ) {
						$( '.opalhotel-reservation-available-review' ).replaceWith( res.reservation_review );
					}

					if ( typeof res.cart_empty !== 'undefined' ) {
						$( '.opalhotel-checkout-form' ).replaceWith( res.cart_empty );
					}
				} ).fail( function( jqXHR, textStatus ){
					_self.opalhotel_modal({
		                tmpl: 'opalhotel-alert',
		                settings: {
		                	message: textStatus
		                }
		            });
		            return false;
				});
			},

		},

	    // form data
	    form_data: function( form ){
	    	var _data = form.serializeArray(),
	    		data = {};

	    	$.each ( _data, function( index, value ){
	    		if ( data.hasOwnProperty( value.name ) ) {
					data[ value.name ] = $.makeArray( data[ value.name ] );
					data[ value.name ].push( value.value );
				} else {
					data[ value.name ] = value.value;
				}
	    	} );

	    	return data;
	    },

	    reservation: {

	    	select: false,

	    	init: function(){

	    		/* calendar init */
	    		this.calendar();

	    		var _doc = $( document );

	    		_doc.on( 'click', '.opalhotel-reservation-step .reservation_step, .opalhotel-pagination-available .opalhotel-page', this.step  );

	    	},

	    	calendar: function() {
	    		var _calendar = $( '#opalhotel_check_availability' );

		        /* date */
		        var today = new Date();
		        var tomorrow = new Date();

		        /* allow hook set min date check out date */
		        var start_plus = $( document ).triggerHandler( 'opalhotel_min_arrival_date', [ 1, today, tomorrow ] );
		        if ( typeof start_plus === 'undefined' || ! Number( start_plus ) || ( start_plus % 1 !== 0 ) ) { // valid integer
		            start_plus = 0;
		        }
		        tomorrow.setDate( today.getDate() + start_plus );

	    		_calendar.datepicker({
		            closeText       : OpalHotel.datepicker.closeText,
		            currentText     : OpalHotel.datepicker.currentText,
		            monthNames      : OpalHotel.datepicker.monthNames,
		            monthNamesShort : OpalHotel.datepicker.monthNamesShort,
		            dayNames        : OpalHotel.datepicker.dayNames,
		            dayNamesShort   : OpalHotel.datepicker.dayNamesShort,
		            dayNamesMin     : OpalHotel.datepicker.dayNamesMin,
		            dateFormat      : OpalHotel.datepicker.dateFormat,
		            firstDay        : OpalHotel.datepicker.firstDay,
		            isRTL           : OpalHotel.datepicker.isRTL,
		            numberOfMonths	: [ 1, 2 ],
		            minDate 		: tomorrow,
		            beforeShow 		: function(){
		                $( '#opalhotel_check_availability > div:first' ).addClass( 'opalhotel-datpicker' );;
		            },
		            beforeShowDay: function( date ) {
		    			var _arrival = $( '.opalhotel_arrival_date:first' ).datepicker( 'getDate' ),
		    			_departure = $( '.opalhotel-departure-date:first' ).datepicker( 'getDate' ),
		    			_highlight = [ new Date( _arrival ).getTime(), new Date( _departure ).getTime() ];

		    			if ( ! _arrival || _arrival.length === 0 ) {
		    				_arrival = _calendar.attr( 'data-arrival' ) * 1000;
		    			}

		    			if ( ! _departure || _departure.length === 0 ) {
		    				_departure = _calendar.attr( 'data-departure' ) * 1000;
		    			}
		            	var _date = new Date( date ).getTime();
		            	if ( _date >= new Date( _arrival ).getTime() && _date <= new Date( _departure ).getTime() ) {
		            		return [ true, 'ui-state-highlight' ];
		            	}
		            	return [ true, '' ];
		            },
		            onSelect: function( date, inst ) {
		            	_calendar.find( 'td' ).removeClass('ui-datepicker-calendar');
		            	var _arrival = $( '.opalhotel_arrival_date:first' ),
		            		_arrival_date = _arrival.datepicker( 'getDate' ),
		            		_arrival_time = new Date( _arrival_date ).getTime(),
	    					_departure = $( '.opalhotel-departure-date:first' ),
	    					_departure_date = _departure.datepicker( 'getDate' ),
	    					_departure_time = new Date( _departure_date ).getTime();

    					var timestamp = new Date( date ).getTime(),
    						hidden_timestamp = timestamp  / 1000 - ( new Date().getTimezoneOffset() * 60 );
	    				if ( OpalHotelSite.reservation.select === false || timestamp < _arrival_time ) {
	    					_arrival.datepicker( 'setDate', new Date( timestamp ) );
	    					_departure.datepicker( 'setDate', null );

	    					/* new timestamp */
	    					$( 'input[name="arrival_timestamp"]' ).val( hidden_timestamp );
	    					OpalHotelSite.reservation.select = true;
	    				}
	    				if ( OpalHotelSite.reservation.select === true && ! _departure_date && timestamp > _arrival_time ) {
	    					_departure.datepicker( 'setDate', new Date( timestamp ) );
	    					/* new timestamp */
	    					$( 'input[name="departure_timestamp"]' ).val( hidden_timestamp );

	    					OpalHotelSite.reservation.select = false;
	    				}
						// OpalHotelSite.reservation.select = ! OpalHotelSite.reservation.select;
	    				$(this).datepicker( 'refresh' );
		            },
		        });

	    	},

	    	step: function( e ) {
	    		e.preventDefault();
	    		var _self = $( this ),
	    			step = _self.attr( 'data-step' ),
	    			current_page_id = _self.attr( 'data-pageid' ),
	    			arrival = _self.attr( 'data-arrival' ),
	    			departure = _self.attr( 'data-departure' ),
	    			adult = _self.attr( 'data-adult' ),
	    			child = _self.attr( 'data-child' ),
	    			room_type = _self.attr( 'data-room-type' ),
	    			page = _self.attr( 'data-page' ),
	    			container = $( '.opalhotel-reservation-container' );

	    		$.ajax({
	    			url: OpalHotel.ajaxurl,
	    			type: 'POST',
	    			data: {
	    				action: 'opalhotel_reservation_step',
	    				step: step,
	    				current_page_id: current_page_id,
	    				arrival_timestamp: arrival,
	    				departure_timestamp: departure,
	    				adult: adult,
	    				child: child,
	    				room_type: room_type,
	    				paged: page
	    			},
	    			beforeSend: function() {
	    				OpalHotelSite.reservation.beforeSend();
	    			}
	    		}).always( function() {
	    			/* disappear effect */
				    OpalHotelSite.reservation.afterSend();
			    }).done( function( res ) {

			    	if ( typeof res.redirect !== 'undefined' ) {
			    		window.location.href = res.redirect;
			    	}

	    			if ( res.status === true && typeof res.step !== 'undefined' ) {
	    				container.replaceWith( res.step );

	    				if ( step == 1 ) {
	    					opalhotel_datepicker_init();
	    					// OpalHotelSite.reservation.calendar();
	    				}

	    				if ( step == 3 ) {
	    					/* focus */
	    					OpalHotelSite.checkout.focus();
	    					/* validate payment input field. */
	    					OpalHotelSite.checkout.init_payment_validate();
	    				}
	    				OpalHotelSite.checkout.scroll_top( container.offset().top );
	    			}

	    			if( res.status === false && typeof res.message !== 'undefined' ) {
	    				_self.opalhotel_modal({
			                tmpl: 'opalhotel-alert',
			                settings: {
			                	message: res.message
			                }
			            });
	    			}

	    		} ).fail( function( jqXHR, textStatus ) {
	    			_self.opalhotel_modal({
		                tmpl: 'opalhotel-alert',
		                settings: {
		                	message: textStatus
		                }
		            });
	    		});

	    		return false;
	    	},

	    	beforeSend: function( element ) {
	    		var html = [];
	    		html.push( '<div class="opalhotel-reservation-loading">' );
	    		html.push( '<div class="content"></div>' );
	    		html.push( '</div>' );

	    		if ( typeof element === 'undefined' ) {
	    			element = $( '.opalhotel-reservation-container' );
	    		}
	    		element.append( html.join( '' ) );
	    	},

	    	afterSend: function( element ) {
	    		if ( typeof element === 'undefined' ) {
	    			element = $( '.opalhotel-reservation-container' );
	    		}
	    		element.find( '.opalhotel-reservation-loading' ).remove();
	    	},

	    },

	    checkout: {

	    	init: function() {

	    		var _doc = $( document );

	    		/* select payment method */
	    		_doc.on( 'change', 'input[name="payment_method"]', this.select_payment_method );

	    		/* apply coupon */
	    		_doc.on( 'click', '#opalhotel_apply_coupon', this.apply_coupon );

	    		/* remove coupon */
	    		_doc.on( 'click', '.opalhotel-review-subtotal .remove_coupon', this.remove_coupon );

	    		/* submit checkout form */
	    		_doc.on( 'submit', '.opalhotel-checkout-form', this.place_reservation );

	    		/* focus */
	    		this.focus();

	    		/* validate payment input field jquery.payment.min.js */
	    		this.init_payment_validate();
	    	},

	    	apply_coupon: function( e ) {
	    		e.preventDefault();

	    		var _self = $( this ),
	    			_coupon = $( '#opalhotel_coupon_code' ),
	    			_coupon_code = $( '#opalhotel_coupon_code' ).val(),
	    			_review = $( '.opalhotel-checkout-review' );

	    		if ( $.trim( _coupon_code ) === '' ) {
	    			_self.opalhotel_modal({
		                tmpl: 'opalhotel-alert',
		                settings: {
		                	message: OpalHotel.coupon_empty
		                }
		            });

		            _coupon.focus(); return false;
	    		}

	    		$.ajax({
	    			url: OpalHotel.ajaxurl,
	    			type: 'POST',
	    			data: {
	    				action: 'opalhotel_apply_coupon_code',
	    				coupon: _coupon_code
	    			},
	    			beforeSend: function(){
	    				OpalHotelSite.reservation.beforeSend( _review );
	    			}
	    		}).always( function(){
	    			OpalHotelSite.reservation.afterSend( _review );
	    		}).done( function( res ){
	    			if ( res.status === false && typeof res.message !== 'undefined' ) {
	    				_self.opalhotel_modal({
			                tmpl: 'opalhotel-alert',
			                settings: {
			                	message: res.message
			                }
			            });
			            return false;
	    			}

	    			if ( typeof res.checkout_review !== 'undefined' ) {
	    				$( '.opalhotel-checkout-review' ).html( res.checkout_review );
	    			}

	    			if ( typeof res.reservation_review !== 'undefined' ) {
	    				$( '.opalhotel_check_availability .opalhotel-reservation-available-review' ).slideUp( 400, function(){
								$( this ).slideDown( 400, function(){
									$( this ).replaceWith( res.reservation_review );
								});
							});
	    			}
	    		} ).fail( function( jqXHR, textStatus ){
	    			_self.opalhotel_modal({
		                tmpl: 'opalhotel-alert',
		                settings: {
		                	message: textStatus
		                }
		            });
	    		});

	    		return false;

	    	},

	    	/* remove coupon */
	    	remove_coupon: function( e ) {
	    		e.preventDefault();
	    		var _self = $( this ),
	    			_coupon_code = _self.attr( 'data-code' ),
	    			_review = $( '.opalhotel-checkout-review' );

	    		$.ajax({
	    			url: OpalHotel.ajaxurl,
	    			type: 'POST',
	    			data: {
	    				action: 'opalhotel_remove_coupon_code',
	    				coupon: _coupon_code
	    			},
	    			beforeSend: function(){
	    				OpalHotelSite.reservation.beforeSend( _review );
	    			}
	    		}).always( function(){
	    			OpalHotelSite.reservation.afterSend( _review );
	    		}).done( function( res ){
	    			if ( res.status === false && typeof res.message !== 'undefined' ) {
	    				_self.opalhotel_modal({
			                tmpl: 'opalhotel-alert',
			                settings: {
			                	message: res.message
			                }
			            });
			            return false;
	    			}

	    			if ( typeof res.checkout_review !== 'undefined' ) {
	    				$( '.opalhotel-checkout-review' ).html( res.checkout_review );
	    			}

	    			if ( typeof res.reservation_review !== 'undefined' ) {
	    				$( '.opalhotel_check_availability .opalhotel-reservation-available-review' ).slideUp( 400, function(){
								$( this ).slideDown( 400, function(){
									$( this ).replaceWith( res.reservation_review );
								});
							});
	    			}
	    		} ).fail( function( jqXHR, textStatus ){
	    			_self.opalhotel_modal({
		                tmpl: 'opalhotel-alert',
		                settings: {
		                	message: textStatus
		                }
		            });
	    		});

	    	},

	    	/* select payment method */
	    	select_payment_method: function( e ) {
	    		e.preventDefault();
	    		var _self = $( this ),
					_desc = $( '.opalhotel_payment_gateways .description' );

				_desc.slideUp( 300 );
				_self.parents( 'li:first' ).find( '.description' ).slideDown( 300 );

	    	},

	    	/* focus checkout fields */
	    	focus: function() {
	    		var _input = $( '.opalhotel-checkout-form input, .opalhotel-checkout-form select' );
	    		for( var i = 0; i < _input.length; i++ ) {
	    			var __input = $( _input[i] );
	    			__input.focusout(function() {
	    				var _parent = $( this ).parents( '.opalhotel-form-group' );
	    				if ( _parent.find( '.required' ).length > 0 ) {
						    if ( $(this).val() === '' ) {
						    	$( this ).removeClass( 'validated' ).addClass( 'error' );
						    } else {
						    	$( this ).removeClass( 'error' ).addClass( 'validated' );
						    }
	    				}
				  	});
	    		}
	    	},

	    	/* submit checkout form function handler */
	    	place_reservation: function( e ) {
	    		e.preventDefault();
	    		var _self = $( this ),
	    			_form_data = OpalHotelSite.form_data( _self ),
	    			_input_error = _self.find( 'input.error, select.error' ),
	    			_wrapper = $( '.opalhotel-reservation-container' ),
	    			_error_message = $( '.opalhotel-error-messages' ),
	    			_review = $( '.opalhotel-reservation-available-review' );

	    		if ( _input_error.length > 0 ) {
	    			var _position = $( _input_error[0] ).parents( '.opalhotel-form-group:first' ).offset().top - $( _input_error[0] ).outerHeight();
	    			OpalHotelSite.checkout.scroll_top( _position );
	    			return false;
	    		}

	    		$.ajax({
	    			url: OpalHotel.ajaxurl,
	    			type: 'POST',
	    			data: _form_data,
	    			beforeSend: function()  {
	    				_error_message.slideUp(function(){
	    					$( this ).remove();
	    				});
	    				OpalHotelSite.reservation.beforeSend();
	    			}
	    		}).always( function() {
	    			/* disapper effect */
				    OpalHotelSite.reservation.afterSend();
			    }).done( function( res ) {
			    	if ( res.status === true ) {
			    		_review.slideUp(400, function(){
			    			$( this ).remove();
			    		});
			    		if ( typeof res.redirect !== 'undefined' ) {
			    			window.location.href = res.redirect;
			    		}

			    		if ( typeof res.reservation !== 'undefined' ) {
			    			_wrapper.replaceWith( res.reservation );
			    		}

			    	} else if( res.status === false ) {
			    		if ( typeof res.messages !== 'undefined' ) {
			    			var _form = $( '.opalhotel-checkout-form' );
			    			_form.prepend( res.messages );
			    			OpalHotelSite.checkout.scroll_top( $('.opalhotel-error-messages').offset().top  );
			    		}

			    		if ( typeof res.fields !== 'undefined' ) {
			    			for ( var i = 0; i < res.fields.length; i++ ) {
			    				_wrapper.find( 'input[name="opalhotel_'+ res.fields[i] +'"]' ).removeClass( 'validated' ).addClass( 'error' );
			    				_wrapper.find( 'input[name="credit-card\['+ res.fields[i] +'\]"]' ).removeClass( 'validated' ).addClass( 'error' );
			    			}
			    		}
			    	}
			    } ).fail( function( jqXHR, textStatus ) {
	    			_self.opalhotel_modal({
		                tmpl: 'opalhotel-alert',
		                settings: {
		                	message: textStatus
		                }
		            });
	    		});

	    	},

	    	/* scroll top show error message */
	    	scroll_top: function( _position ) {
	    		$( 'html, body' ).animate({ scrollTop: _position }, 400 );
	    	},

	    	/* validate payment fields */
	    	init_payment_validate: function() {
	    		$( '.credit-card-cc-number' ).payment( 'formatCardNumber' );
		        $( '.credit-card-cc-exp' ).payment( 'formatCardExpiry' );
		        $( '.credit-card-cc-cvc' ).payment( 'formatCardCVC' );
	    	}

	    },

	};

	$( document ).ready( function(){
		/* initialize*/
		OpalHotelSite.init();
	});

})(jQuery);

(function($){

    window.opalhotel_single_tour_book_form = function(){
        var form = $('.opalhotel-single-book-room'),
            input = form.find('.departure'),
            room_id = form.find( '.room-id' ).val();
            opalhotel_get_available_data( new Date() );

        function loader(){
            var html = [];
            html.push('<div class="opalhotel-loader-wrapper">');
            html.push('<div class="loader">');
            html.push('<div></div>');
            html.push('<div></div>');
            html.push('<div></div>');
            html.push('<div></div>');
            html.push('<div></div>');
            html.push('<div></div>');
            html.push('<div></div>');
            html.push('</div>');
            html.push('</div>');
            return html.join('');
        }

        var options = {
            dateFormat: OpalHotel.date_format,
            minDate: new Date(),
            maxDate: '+365D',
            numberOfMonths: 1,
            dayNamesMin: $.datepicker._defaults.dayNamesMin,
            firstDay: 7,
            beforeShowDay: function( date ) {
                if ( typeof OpalTour_Single_Data === 'undefined' ) {
                    return [true, 'available', OpalHotel.label.available];
                }
                var month = date.getMonth() + 1;
                if( date.getMonth() < 9 )
                    month = '0' + month;

                var days = date.getDate();
                if ( days < 10 ) {
                    days += '0' + days;
                }
                var date_month_year = opalhotel_format_date( date );

                if ( OpalTour_Single_Data.availableDates.hasOwnProperty( date_month_year ) === false ) {
                    return [ false, '', OpalHotel.label.available];
                }

                var data = OpalTour_Single_Data.availableDates[date_month_year];
                if ( Array.isArray( data ) || ( typeof data.available !== 'undefined' && data.available === true ) ) {
                    return [ true, 'available', OpalTour_Localize.label.available ];
                } else {
                    return [ false, 'unavailable', OpalTour_Localize.label.unavailable ];
                }
                return [ true, 'available', OpalTour_Localize.label.available ];
            },
            beforeShow: function( element ) {
                $( '#ui-datepicker-div' ).addClass( 'opalhotel-datepicker' );
            },
            afterShow: function() {
                $( '#ui-datepicker-div, #single-tour-departure' ).removeClass( 'opalhotel-datepicker' );
            },
            onChangeMonthYear: function( year, month, inst ) {
                var date = new Date( year, month );
                opalhotel_get_available_data( opalhotel_format_date( date ) );
                return true;
            },
            onSelect: function( date ) {
                var date = opalhotel_format_date( new Date( date ) );
                if ( OpalTour_Single_Data.availableDates.hasOwnProperty( date ) ) {
                    var data = OpalTour_Single_Data.availableDates[date];
                    if ( Array.isArray( data ) ) {
                        var row = input.parents('.form-row');
                        var html = [];
                        if ( form.find('.time-list').length == 0 ) {
                            html.push('<ul class="time-list">');
                        }
                        for ( var i = 0; i < data.length; i++ ) {
                            if ( i == 0 ) {
                                opalhotel_single_book_room_set_date( data[i].start, data[i].end );
                            }
                            html.push('<li><input type="radio" id="time-'+i+'" name="time" '+( i== 0 ? ' checked' : '' )+' onclick="opalhotel_single_book_room_set_date( \''+data[i].start+'\', \''+data[i].end+'\' ); opalhotel_single_book_tour_set_quantity( \''+data[i].adults+'\', \''+data[i].childrens+'\', \''+data[i].infants+'\' )" /><label for="time-'+i+'">' + OpalTour_Localize.label.from + ' ' + data[i].start + ' ' + OpalTour_Localize.label.to + ' ' + data[i].end + '</label></li>');
                        }
                        if ( form.find('.time-list').length == 0 ) {
                            html.push('</ul>');
                        }
                        html = html.join('');
                        if ( form.find('.time-list').length == 0 ){
                            row.append(html);
                        } else {
                            form.find('.time-list').html(html);
                        }
                    } else {
                        opalhotel_single_book_tour_set_quantity( data.adults, data.childrens );
                        opalhotel_single_book_room_set_date( data.start, data.end );
                    }
                }
            }
        };
        // init datepicker
        input.datepicker( options );

        function opalhotel_get_available_data( date ) {
            if ( typeof date === 'undefined' ) {
                date = new Date();
            }
            if ( ( date instanceof Date && ! isNaN( date.valueOf() ) ) ) {
                date = opalhotel_format_date( date );
            }
            $.ajax({
                url: OpalTour_Localize.ajaxurl,
                type: 'POST',
                async: false,
                data: {
                    date: date,
                    action: 'opalhotel_before_show_single_datepicker',
                    room_id: room_id,
                    nonce: OpalTour_Localize.nonces.change_month_year
                },
                beforeSend: function(){
                    $('.opalhotel-datepicker').append( loader() );
                }
            }).always(function(){
                $('.opalhotel-datepicker').find( '.opalhotel-loader-wrapper' ).remove();
            }).done(function(res){
                if ( typeof OpalTour_Single_Data.availableDates == 'undefined' ) {
                    OpalTour_Single_Data.availableDates = {};
                }
                OpalTour_Single_Data.availableDates = $.extend( {}, OpalTour_Single_Data.availableDates, res || {} );
            });
        }

        var opalhotel_single_book_room_set_date = window.opalhotel_single_book_room_set_date = function( start, end ) {
            if ( form.find( '.start' ).length == 0 ) {
                form.append( '<input type="hidden" name="start" class="start" value="'+start+'" />' );
                form.append( '<input type="hidden" name="end" class="end" value="'+end+'" />' );
            } else {
                form.find( '.start' ).val(start);
                form.find( '.end' ).val(end);
            }
        }
        var opalhotel_single_book_tour_set_quantity = window.opalhotel_single_book_tour_set_quantity = function( adultqty, childqty, infantqty ) {
            if ( adultqty > 0 ) {
                adults.show();
                adults.attr( 'max', adultqty );
                if ( adults.val() > adultqty ) {
                    adults.val( adultqty );
                }
            } else {
                adults.parents('.form-group').hide();
            }
            if ( childqty > 0 ) {
                childrens.show();
                childrens.attr( 'max', childqty );
                if ( childrens.val() > childqty ) {
                    childrens.val( childqty );
                }
            } else {
                childrens.parents('.form-group').hide();
            }
            if ( infantqty > 0 ) {
                infants.show();
                infants.attr( 'max', infantqty );
                if ( infants.val() > infantqty ) {
                    infants.val( infantqty );
                }
            } else {
                infants.parents('.form-group').hide();
            }
        }
    }

})(jQuery);

(function($) {

	OpalHotel = OpalHotel || {};

	// Model
	var BookRoomModel = Backbone.Model.extend({

		defaults: {
			room_id : null,
			nonce 	: null
		},

		initialize: function( data ) {
			this.data = data || this.defaults;
			_.each( data, function( value, name ){
				this.set( name, value );
			}, this );
		}

	});

	// View
	var BookRoomView = Backbone.View.extend({

		ajaxLoading: null,

		events: {
			'click .overlay' 						: '_close',
			'click .opalhotel-single-book-room .opalhotel-button-submit' 	: 'getAvailableData'
		},

		initialize: function( data ) {
			this.data = data;
			_.bindAll( this, 'render', '_close', 'getAvailableData', 'setHeight' );
			this.model = new BookRoomModel( data );
			this.template = wp.template('opalhotel-single-room-available');
			this.render();
		},

		render: function() {
			this.setElement( this.template( this.model.toJSON() ) );
			$('body').append(this.el);
			this.$el.addClass( 'active' );

			opalhotel_datepicker_init();

			$(window).resize(this.setHeight);
		},

		_close: function( e ) {
			e.preventDefault();
			var that = this;
			that.$el.removeClass( 'active' );
			var timeout = setTimeout(function(){
				that.remove();
				clearTimeout(timeout);
			}, 100);
			return false;
		},

		getAvailableData: function( e ) {
			e.preventDefault();
			var that = this;
			var _this = $( e.target );
			var form = _this.parents('.opalhotel-single-book-room'),
			 	data = form.serializeArray();

			if ( this.ajaxLoading && this.ajaxLoading.state() == 'pending' ) {
				this.ajaxLoading.abort();
				this.ajaxLoading = null;
			}
			this.ajaxLoading = $.ajax({
				url: OpalHotel.simpleAjaxUrl,
				type: 'POST',
				data: data,
				beforeSend: function() {
					that.$el.find('.opalhotel-available-form').slideUp( 100, function(){
						this.remove();
					});
					that.$el.find('.opalhotel-error-messages').slideUp( 100, function(){
						this.remove();
					});
					form.addClass( 'loading' );
					that.$el.find('.opalhotel-single-book-room .opalhotel-button-submit').append('<i class="fa fa-spinner fa-spin"></i>');
				}
			}).always(function(){
				form.removeClass( 'loading' );
				that.$el.find('.opalhotel-single-book-room .opalhotel-button-submit .fa').remove();
			}).done(function( html ){
				that.$el.find('.content').append( html );
				that.$el.find('.opalhotel-room-package-wrapper').addClass('active');

				that.setHeight();
			});

			return false;
		},

		setHeight: function() {
			var win_height = $( window ).height();
			this.$el.find('.opalhotel-room-modal').css({ 'max-height' : win_height - 70, 'overflow-y' : 'scroll' });
		}

	});

	$( document ).on( 'click', '.opalhotel-single-book-room', function( e ) {
		e.preventDefault();

		var _this = $( this ),
			id 		= _this.data( 'id' ),
			nonce 	= _this.data( 'nonce' );

		if ( id ) {
			new BookRoomView({ room_id : id });

		}

		return false;
	} );

})(jQuery);