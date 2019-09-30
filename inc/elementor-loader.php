<?php
namespace Apack_Elementer;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Elementor loader
 *
 */

class Apack_Elementor {

    private static $_instance = null;

    public static function instance() {

        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        } else {
            return self::$_instance;
        }
    }

    public function load_widget_options( $options ) {
        global $apack_elementor_register_widgets;

        $widgets = [];
        foreach( $apack_elementor_register_widgets as $name => $item ) {
            $help_text = isset( $item['description'] ) ? $item['description'] : '';
            $default_value = isset( $item['active'] ) ? $item['active'] : false;

            array_push(
                $widgets,
                Field::make( 'checkbox', $name, $item['label'] )
                ->set_help_text( $help_text )
                ->set_default_value( $default_value )
                ->set_width( 30 )
            );
        }

        $options->add_tab( __( 'Elementor Widgets', 'emetex-pack' ), $widgets );
    }

    public function register_widgets() {
        global $apack_elementor_register_widgets;

        foreach( $apack_elementor_register_widgets as $name => $item ) {

            if( ! is_file( $item['path_file'] ) ) continue;

            if( true == carbon_get_theme_option( $name ) )
                require( $item['path_file'] );
        }
    }

    public function __construct() {

        // Elementor widget options
        add_action( 'apack/options', [ $this, 'load_widget_options' ] );

        // Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
    }
}

if( ! function_exists( 'apack_elementor_register_widgets' ) ) {
    /**
     *
     */
    function apack_elementor_register_widgets() {

        return apply_filters( 'apack/elementor_register_widgets', [
            'apack_elementor_featured_box' => [
                'label' => __( 'Featured Box', 'ametex-pack' ),
                'description' => __( 'Widget display featured services.', 'ametex-pack' ),
                'active' => true,
                'path_file' => __DIR__ . '/elementor-widget/apack-elementor-featured-box.php',
            ],
            ] );
    }
}


add_action( 'plugins_loaded', function() {

    if( defined( 'ELEMENTOR_VERSION' ) ) {
        $GLOBALS['apack_elementor_register_widgets'] = apack_elementor_register_widgets();
        Apack_Elementor::instance();
    }
} );
