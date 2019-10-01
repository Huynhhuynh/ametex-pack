<?php
/**
 * Static
 */

if( ! function_exists( 'apack_scripts' ) ) {
    /**
     * Enqueue scripts
     */
    function apack_scripts() {
        wp_enqueue_style( 'ametex-pack-css', APACK_URI . '/dist/ametex-pack.css', false, APACK_VER );
        wp_enqueue_script( 'ametex-pack-js', APACK_URI . '/dist/ametex-pack.js', ['jquery'], APACK_VER, true );
        wp_localize_script( 'ametex-pack-js', 'apack_php_object', apply_filters( 'apack/apack_php_object', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'lang' => [],
            ] ) );
    }

    add_action( 'wp_enqueue_scripts', 'apack_scripts', 50 );
}

if( ! function_exists( 'apack_make_variables_array' ) ) {
    /**
     *
     */
    function apack_make_variables_array( $data = [], $type ) {

        $result = [];
        foreach( $data as $index => $item ) {
            $slug = implode( '-', [ 'apack-' . $type, str_replace( ' ', '-', strtolower( $item['title'] ) ) ] );
            array_push( $result, [ "name" => "--{$slug}", "value" => $item['value'] ] );
        }

        return $result;
    }
}

if( ! function_exists( 'apack_elementor_scheme_variables' ) ) {
    /**
     * Elementor scheme variables
     *
     */
    function apack_elementor_scheme_variables() {

        if( ! defined( 'ELEMENTOR_VERSION' ) ) return;

        $schemes = Elementor\Plugin::$instance->schemes_manager->get_registered_schemes_data();
        $color = $schemes['color'];
        $typography = $schemes['typography'];
        $_colors = apack_make_variables_array( $color['items'], 'color' );
        $_fonts = apack_make_variables_array( $typography['items'], 'font' );

        ?>
        <style>
            :root {
                <?php foreach( $_colors as $index => $c ) : ?>
                <?php echo "{$c['name']}: {$c['value']};"; ?>
                <?php endforeach; ?>

                <?php foreach( $_fonts as $index => $f ) : ?>
                <?php echo "{$f['name']}: '{$f['value']['font_family']}';"; ?>
                <?php echo "{$f['name']}-weight: {$f['value']['font_weight']};"; ?>
                <?php endforeach; ?>
            }
        </style>
        <?php

    }

    add_action( 'wp_head', 'apack_elementor_scheme_variables', 6 );
}

if( ! function_exists( 'apack_scss_rendering' ) ) {
    /**
     * Scss rendering
     *
     * @return void
     */
    function apack_scss_rendering() {
        $dev_mode = carbon_get_theme_option( 'apack_dev_mode' );
        if( true != $dev_mode ) return;

        apack_scss_compiler(
            file_get_contents( APACK_DIR . '/src/main.scss' ),
            APACK_DIR . '/dist/ametex-pack.css',
            APACK_DIR . '/src/',
            'ScssPhp\ScssPhp\Formatter\Compressed',
            true
        );
    }

    add_action( 'init', 'apack_scss_rendering', 30 );
}
