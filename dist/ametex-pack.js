/**
 * @package Ametex Pack
 *
 * @since 1.0.0
 * @author Beplus
 */

;( function( w, $ ) {
    'use strict';

    w.apack = {
        calc_distance ( elem, mouseX, mouseY ) {
            return Math.floor(Math.sqrt(Math.pow(mouseX - (elem.offset().left+(elem.width()/2)), 2) + Math.pow(mouseY - (elem.offset().top+(elem.height()/2)), 2)));
        },
    };

    var mouse_hover_float_effect = function( $el, params ) {
        this.params = $.extend( {
            target: '.float-item',
            radio: .1,
        }, params );

        var self = this;

        var _calc_pos = function( elem, mouseX, mouseY ) {
            return {
                // x: Math.floor( mouseX - (elem.offset().left + (elem.innerWidth() / 2)) ),
                // y: Math.floor( mouseY - (elem.offset().top + (elem.innerHeight() / 2)) ),
                x: Math.floor( mouseX - ($el.offset().left + ($el.innerWidth() / 2)) ),
                y: Math.floor( mouseY - ($el.offset().top + ($el.innerHeight() / 2)) ),
            }
        }

        $el.find( this.params.target ).on( {
            'animate' ( e, mouseX, mouseY ) {
                var item = $( this );
                var mouse_pos = _calc_pos( item, mouseX, mouseY );

                item.css( {
                    'transform': `translate(${mouse_pos.x * self.params.radio}px, ${mouse_pos.y * self.params.radio}px)`,
                    '-webkit-transform': `translate(${mouse_pos.x * self.params.radio}px, ${mouse_pos.y * self.params.radio}px)`,
                    'box-shadow': `${mouse_pos.x * .2 * -1}px ${mouse_pos.y * .2 * -1}px 18px -8px ${ item.css( 'box-shadow' ).replace( /^.*(rgba?\([^)]+\)).*$/,'$1' ) }`,
                } )
            }
        } )

        $el.on( {
            'mousemove' (e) {
                $el.find( self.params.target ).trigger( 'animate', [e.clientX, e.clientY] );
            },
            'mouseout' (e) {
                $el.find( self.params.target ).css( {
                    'transform': '',
                    '-webkit-transform': '',
                    'box-shadow': '',
                } );
            },
        } )
    }

    var apply_mouse_hover_float_effect = function() {
        var elem = $( '[data-apack-hover-float-effect]' );

        elem.each( function() {
            new mouse_hover_float_effect( $( this ), {
                target: '[data-float-item]',
            } )
        } )

    }

    /**
     * DOM Ready
     */
    $( function() {
        apply_mouse_hover_float_effect();
    } )

    /**
     * Browser load completed
     */
    $( w ).on( 'load', function() {

    } )
} )( window, jQuery )
