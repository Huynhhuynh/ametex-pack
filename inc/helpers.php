<?php
use ScssPhp\ScssPhp\Compiler;

/**
 * Helpers
 *
 * @package Ametex Pack
 * @author Beplus
 */

if( ! function_exists( 'apack_scss_compiler' ) ) {
    /**
     * Scss Compiler
     *
     * @param string $in
     * @param string $out
     * @param string $import_path
     * @param string $formatter (default: ScssPhp\ScssPhp\Formatter\Compressed)
     * @param boolean $source_map (SOURCE_MAP_INLINE)
     *
     * @return void
     */
    function apack_scss_compiler( $scss_string, $out, $import_path = '', $formatter = 'ScssPhp\ScssPhp\Formatter\Compressed', $source_map = false ) {
        $scss = new Compiler();

        if( ! empty( $import_path ) ) $scss->setImportPaths( $import_path );
        if( ! empty( $formatter ) ) $scss->setFormatter( $formatter );
        if( true == $source_map ) $scss->setSourceMap( Compiler::SOURCE_MAP_INLINE );

        file_put_contents( $out, $scss->compile( apply_filters( 'apack/scss_compiler', $scss_string ) ) );
    }
}

if( ! function_exists( 'apack_get_mode' ) ) {
    /**
     * Get mode
     *
     */
    function apack_get_mode() {
        return carbon_get_theme_option( 'apack_dev_mode' );
    }
}

if( ! function_exists( 'apack_pagination' ) ) {
    /**
     * Pagination
     *
     */
    function apack_pagination() {
        global $wp_query;
        $big = 999999999; // need an unlikely integer

        $output = paginate_links( array(
        	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        	'format' => '?paged=%#%',
        	'current' => max( 1, get_query_var('paged') ),
        	'total' => $wp_query->max_num_pages,
            'prev_text' => '<i class="fa fa-angle-left"></i>',
            'next_text' => '<i class="fa fa-angle-right"></i>',
        ) );
        ?>
        <div class="apack-pagination-container">
            <nav class="bt-pagination" role="navigation">
                <?php echo $output; ?>
            </nav>
        </div>
        <?php
    }
}
