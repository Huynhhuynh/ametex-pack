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

    w.apack.mouse_hover_float_effect = function( $el, params ) {
        this.params = $.extend( {
            target: '.float-item',
            radio: .1,
        }, params );

        var self = this;

        var _calc_pos = function( mouseX, mouseY ) {
            return {
                x: Math.floor( mouseX - ($el.offset().left + ($el.innerWidth() / 2)) ),
                y: Math.floor( mouseY - ($el.offset().top + ($el.innerHeight() / 2)) ),
            }
        }

        $el.find( this.params.target ).on( {
            'animate' ( e, mouseX, mouseY ) {
                var item = $( this );
                var mouse_pos = _calc_pos( mouseX, mouseY );

                item.css( {
                    'transform': `translate(${mouse_pos.x * self.params.radio}px, ${mouse_pos.y * self.params.radio}px)`,
                    '-webkit-transform': `translate(${mouse_pos.x * self.params.radio}px, ${mouse_pos.y * self.params.radio}px)`,
                    'box-shadow': `${mouse_pos.x * .2 * -1}px ${mouse_pos.y * .2 * -1}px 18px -8px ${ item.css( 'box-shadow' ).replace( /^.*(rgba?\([^)]+\)).*$/,'$1' ) }`,
                } )
            }
        } )

        $el.on( {
            'mousemove' (e) {
                $el.find( self.params.target ).trigger( 'animate', [e.pageX, e.pageY] );
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

    w.apack.apply_mouse_hover_float_effect = function() {
        var elem = $( '[data-apack-hover-float-effect]' );

        elem.each( function() {
            new w.apack.mouse_hover_float_effect( $( this ), {
                target: '[data-float-item]',
            } )
        } )

    }

    w.apack.owlcarousel = function( elem, opts ) {
        elem.addClass( 'owl-carousel owl-theme' );

        var args = $.extend( {
            items: 3,
            loop: false,
            margin: 20,
            nav: false,
            dots: true,
            responsive: {
                0: {
                    items: 1,
                },
                480: {
                    items: 2,
                },
                768: {
                    items: 3,
                }
            }
        }, opts );

        if( typeof elem.data( 'owl-dots' ) != 'undefined' ) {
            args.dots = parseInt( elem.data( 'owl-dots' ) );
        }

        if( typeof elem.data( 'owl-nav' ) != 'undefined' ) {
            args.nav = parseInt( elem.data( 'owl-nav' ) );
        }

        if( typeof elem.data( 'owl-margin' ) != 'undefined' ) {
            args.margin = parseInt( elem.data( 'owl-margin' ) );
        }

        if( typeof elem.data( 'owl-loop' ) != 'undefined' ) {
            args.loop = parseInt( elem.data( 'owl-loop' ) );
        }

        if( typeof elem.data( 'owl-items' ) != 'undefined' ) {
            args.items = parseInt( elem.data( 'owl-items' ) );
            args.responsive[768].items = parseInt( elem.data( 'owl-items' ) );
        }

        if( typeof elem.data( 'owl-items-tablet' ) != 'undefined' ) {
            args.responsive[480].items = parseInt( elem.data( 'owl-items-tablet' ) );
        }

        if( typeof elem.data( 'owl-items-mobile' ) != 'undefined' ) {
            args.responsive[0].items = parseInt( elem.data( 'owl-items-mobile' ) );
        }

        return elem.owlCarousel( args );
    }

    w.apack.apply_carousel = function() {
        var elem = $( '[data-apack-carousel]' );

        elem.each( function() {
            var self = $( this );
            if( self.data( 'apack-apply-carousel' ) == true ) return;
            var owl = w.apack.owlcarousel( self );
            self.data( 'apack-apply-carousel', true );
        } )
    }

    w.apack.apply_lazyload = function() {
        var elem = $( '[data-apack-image-lazy]' );

        $.each( elem, function() {
            var image = $( this );
            var image_final_src = image.data( 'image-final' );

            image
                .removeAttr( 'srcset' )
                .removeAttr( 'sizes' )
                .removeAttr( 'data-apack-image-lazy' )
                .removeAttr( 'data-image-final' );

            var image_shadow = new Image();
            image_shadow.onload = function() {
                image.attr( 'src', image_final_src );
            }
            image_shadow.src = image_final_src;
        } )
    }

    w.apack.sharing = function() {

        $( 'body' ).on( 'click', '.apack-share-container a', function( e ) {
            e.preventDefault();
            var url = this.href;
            var settings = 'location=yes,height=570,width=520,scrollbars=yes,status=yes';

            w.open( url, '_blank', settings );
        } )
    }

    /**
     * DOM Ready
     */
    $( function() {
        w.apack.sharing();
    } )

    /**
     * Browser load completed
     */
    $( w ).on( 'load', function() {
        w.apack.apply_mouse_hover_float_effect();
        w.apack.apply_carousel();
        w.apack.apply_lazyload();
    } )
} )( window, jQuery )
