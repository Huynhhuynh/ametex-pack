/**
 * My Project javascript
 *
 * @package Ametex Pack
 * @author Beplus
 */

;( function( w, $ ) {
    'use strict';

    // my-project-masonry-grid

    var project_grid_masonry = function() {
        var elem = $( '.my-project-grid-masonry' );
        if( elem.length <= 0 ) return;

        elem.append( ['<div class="item-sizer"></div>', '<div class="item-gutter-sizer"></div>'] );
        var Grid = new w.BeGrid( {
    		El: elem[0],
    		Col: apack_myproject_php_object.myproject_archive_cols,
            Responsive: {
                1024: { Col: apack_myproject_php_object.myproject_archive_cols, Space: 24 },
                767: { Col: apack_myproject_php_object.myproject_archive_cols_tablet, Space: 24 },
                425: { Col: apack_myproject_php_object.myproject_archive_cols_mobile, Space: 24 }
            }
    	} );
    }

    /**
     * DOM Ready
     */
    $( function() {
        project_grid_masonry();
    } )

    /**
     * Browser load completed
     */
    $( w ).on( 'load', function() {

    } )

} )( window, jQuery )
