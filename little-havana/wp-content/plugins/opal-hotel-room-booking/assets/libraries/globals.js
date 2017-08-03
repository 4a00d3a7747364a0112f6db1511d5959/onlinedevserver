/*
* @Author: someone
* @Date:   2016-05-07 16:35:24
* @Last Modified by:   someone
* @Last Modified time: 2016-05-10 23:00:49
*/

'use strict';
// oaplhotel modal box
( function( $, Backbone, _ ){

    $.fn.opalhotel_modal = function( options ){

        var options = $.extend( {}, {
                tmpl        : '',
                settings    : {}
            }, options );

        if ( options.tmpl ) {
            new OpalHotelModal.view( options.tmpl, options.settings );
        }
    };

    var OpalHotelModal = {

        view: function( target, options ){
            var view = Backbone.View.extend({

                id      : 'opalhotel_backbone_modal',
                options : options,
                target  : target,

                // events handles
                events  : {
                    'click .opalhotel_button_close'     		: 'close',
                    'click .opalhotel_backbone_modal_overflow'  : 'close',
                    'click .opalhotel-button-submit'     		: 'submit'
                },

                // initialize
                initialize: function( data ){
                    this.render();
                },

                // render
                render: function(){
                    var template = wp.template( this.target );

                    template = template( this.options );

                    $( 'body' ).append( this.$el.html( template ) );

                    var _content = $( '.opalhotel_backbone_modal_content' ),
                        _content_width = _content.outerWidth(),
                        _content_height = _content.outerHeight();

                    _content.css({
                        'margin-top'    : '-' + _content_height / 2 + 'px',
                        'margin-left'   : '-' + _content_width / 2 + 'px'
                    });

                    $( document ).trigger( 'opalhotel_modal_open', [ this.target, _content.find( 'form' ) ] );
                },

                // submit
                submit: function(){
                    $( document ).trigger( 'opalhotel_submit_action', [ this.target, this.form_data() ] );

                    // close
                    this.close();

                    $( document ).trigger( 'opalhotel_submited_action', [ this.target, this.form_data() ] );

                    return false;
                },

                // close
                close: function() {

                    $( document ).trigger( 'opalhotel_close', [ this.target, this.form_data() ] );

                    this.$el.remove();

                    return false;
                },

                // form data
                form_data: function(){
                    var _data = $( this.$el ).find( 'form:first-child' ).serializeArray(),
                        data = {};
                    for( var i = 0; i < Object.keys( _data ).length; i++ ){
                        var _ob = _data[i];
                        if ( data.hasOwnProperty( _ob.name ) ) {
                            data[ _ob.name ] = $.makeArray( data[ _ob.name ] );
                            data[ _ob.name ].push( _ob.value );
                        } else {
                            data[ _ob.name ]    = _ob.value;
                        }
                    }
                    return data;
                }

            });

            return new view( options );
        },

    };

} )( jQuery, Backbone, _ );
// oaplhotel modal box

(function($){

    window.opalhotel_datepicker_init = function (){
        var inputs = $( '.opalhotel-has-datepicker' );
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
        /* each input datepicker */
        for ( var i = 0; i < inputs.length; i++ ) {
            var input = $( inputs[i] );

            var options = {
                    // showButtonPanel : true,
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
                };

            /* set min date */
            var mindate = input.attr( 'data-min-date' );
            if ( typeof mindate === 'undefined' || mindate == 'true' ) {
                options.minDate = tomorrow;
            }
            options.onSelect = function( date ){
                var _self = $( this ),
                    name = _self.attr( 'name' ),
                    _date = _self.datepicker( 'getDate' ),
                    // _timestamp = new Date( _date ).getTime() / 1000 - ( new Date().getTimezoneOffset() * 60 ),
                    end = _self.attr( 'data-end' ),
                    start = _self.attr( 'data-start' ),
                    wrap = _self.parents( '.opalhotel_datepick_wrap:first' );
                    var new_date = new Date( opalhotel_format_date( new Date( date ) ) ).getTime() / 1000;

                _self.parent().find( 'input[name="' + name + '_timestamp"]' ).remove();
                _self.parent().append( '<input type="hidden" name="' + name + '_timestamp" value="' + new_date + '" />' );

                var range = $( document ).triggerHandler( 'opalhotel_range_check_in_check_out', [ 1, today, tomorrow ] );

                if ( ! Number( range ) || ( range % 1 !== 0 ) ) { // valid integer
                    range = 1;
                }

                if ( typeof wrap !== 'undefined' ) {
                    if ( typeof end !== 'undefined' ) {
                        if ( _date ) {
                            _date.setDate( _date.getDate() + range );
                        }
                        var _end = wrap.find( '.' + end );
                        _end.datepicker( 'option', 'minDate', _date );
                        var end_date = _end.datepicker( 'getDate' );

                        if ( end_date ) {
                            var end_name = _end.attr( 'name' );
                            var new_date = new Date( opalhotel_format_date( new Date( end_date ) ) ).getTime() / 1000;
                            _end.parent().find( 'input[name="' + end_name + '_timestamp"]' ).remove();
                            _end.parent().append( '<input type="hidden" name="' + end_name + '_timestamp" value="' + new_date + '" />' );
                        }
                    }
                    if ( typeof start !== 'undefined' ) {
                        if ( _date ) {
                            _date.setDate( _date.getDate() - range );

                            var _start = wrap.find( '.' + start );
                            _start = _start.datepicker( 'getDate' );
                            _start = new Date( _start ).getTime();
                            var count_day = ( new Date( _date ).getTime() - _start ) / ( 24 * 60 * 60 * 1000 );

                            if ( count_day > 1 ) {
                                wrap.find( '.' + start ).datepicker( 'option', 'maxDate', _date );
                            }
                        }
                    }
                    $('td.ui-datepicker-current-day a.ui-state-default').removeClass('ui-state-active');
                }
                _calendar.datepicker( 'refresh' );

            };

            options.beforeShow = function(){
                $( '#ui-datepicker-div' ).addClass( 'opalhotel-datpicker' );
            };

            input.datepicker( options );
        }
    };

    window.opalhotel_format_date = function( date ) {
        var yyyy = date.getFullYear();
        var mm = date.getMonth() < 9 ? '0' + (date.getMonth() + 1) : (date.getMonth() + 1); // getMonth() is zero-based
        var dd  = date.getDate() < 10 ? '0' + date.getDate() : date.getDate();
        return yyyy + '-' + mm + '-' + dd;
    }

    $( document ).ready(function(){
        opalhotel_datepicker_init();
    });

})(jQuery);