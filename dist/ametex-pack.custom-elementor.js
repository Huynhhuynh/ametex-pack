/**
 * @package Ametex Pack
 *
 * @since 1.0.0
 * @author Beplus
 */

;( function( w, $ ) {
    'use strict';

    var update_variable_color_css = function( colors ) {
        if( ! colors ) return;

        $.each( colors.color.items, function( index, item ) {
            var name = `--apack-color-${item.title.toLowerCase().replace(/ /g, '-')}`;
            document.body.style.setProperty( name, item.value );
        } )
    }

    var update_variable_typography_css = function( typographies ) {
        if( ! typographies ) return;

        $.each( typographies.typography.items, function( index, item ) {
            var font_family = `--apack-font-${item.title.toLowerCase().replace(/ /g, '-')}`;
            document.body.style.setProperty( font_family, item.value.font_family );
            document.body.style.setProperty( `${font_family}-weight`, item.value.font_weight );
        } )
    }

    var on_change_schemes = function() {
        var targetNode = document.getElementById('elementor-style-scheme');
        var config = { attributes: true, childList: true, subtree: true };
        var callback = function(mutationsList, observer) {
            for(var mutation of mutationsList) {
                if (mutation.type === 'childList') {
                    update_variable_color_css( window.elementor.schemes.getSchemes('color') );
                    update_variable_typography_css( window.elementor.schemes.getSchemes('typography') );
                }
            }
        };

        var observer = new MutationObserver( callback );
        observer.observe(targetNode, config);
    }

    var elementor_hooks = function() {
        on_change_schemes();
    }

    var elementor_frontend_init = function() {
        w.elementorFrontend.hooks.addAction( 'frontend/element_ready/apack-elementor-pricing-table.default', function( $scope, $ ) {
            // console.log( $scope );
            // w.apack.apply_carousel();
            w.apack.owlcarousel( $scope.find( '[data-apack-carousel]' ) );
        } )
    }

    $( w ).on( 'load', function() {
        setTimeout( function() {
            elementor_hooks();
            elementor_frontend_init();
        }, 1 )
    } )
} )( window, jQuery )
