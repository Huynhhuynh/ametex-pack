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
