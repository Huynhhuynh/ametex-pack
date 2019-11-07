<?php
namespace Apack_Elementer;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * Elementor loader
 *
 */
$GLOBALS['apack_elementor_widgets'] = [];

class Apack_Elementor {

    private static $_instance = null;

    public static function instance() {

        if( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        } else {
            return self::$_instance;
        }
    }

    public static function get_widgets() {
        global $apack_elementor_widgets;
        return $apack_elementor_widgets;
    }

    public static function style_rendering() {
        $dev_mode = apack_get_mode();
        if( true != $dev_mode ) {
            add_action( 'carbon_fields_theme_options_container_saved', [$this, 'render_scss_after_save_options'] );
            return;
        };

        $register_widgets = self::get_widgets();
        $scss_string = '';

        foreach( $register_widgets as $widget ) {
            if( ! isset( $widget['scss_file'] ) ) continue;
            if( ! file_exists( $widget['scss_file'] ) ) continue;

            $scss_string .= file_get_contents( $widget['scss_file'] );
        }

        apack_scss_compiler(
            $scss_string,
            APACK_DIR . '/dist/ametex-pack.elementor.css',
            APACK_DIR . '/src/',
            'ScssPhp\ScssPhp\Formatter\Compressed',
            true
        );
    }

    public static function render_scss_after_save_options() {

        $register_widgets = self::get_widgets();
        $scss_string = '';

        foreach( $register_widgets as $widget ) {
            if( ! isset( $widget['scss_file'] ) ) continue;
            if( ! file_exists( $widget['scss_file'] ) ) continue;

            $scss_string .= file_get_contents( $widget['scss_file'] );
        }

        apack_scss_compiler(
            $scss_string,
            APACK_DIR . '/dist/ametex-pack.elementor.css',
            APACK_DIR . '/src/',
            'ScssPhp\ScssPhp\Formatter\Compressed',
            true
        );
    }

    public function enqueue_scripts() {
        wp_enqueue_style( 'ametex-pack-elementor', APACK_URI . '/dist/ametex-pack.elementor.css', false, APACK_VER );
    }

    public function editor_enqueue_scripts() {
        if ( \Elementor\Plugin::$instance->preview->is_preview_mode() )
            wp_enqueue_script( 'ametex-pack-custom-elementor', APACK_URI . '/dist/ametex-pack.custom-elementor.js', ['jquery'], APACK_VER, true );
    }

    public function load_widget_options( $options ) {
        $register_widgets = self::get_widgets();

        $widgets = [];
        foreach( $register_widgets as $name => $item ) {
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
        $register_widgets = self::get_widgets();

        foreach( $register_widgets as $name => $item ) {

            if( ! is_file( $item['path_file'] ) ) continue;

            if( true == carbon_get_theme_option( $name ) )
                require( $item['path_file'] );
        }
    }

    public function __construct() {

        // Scss rendering
        add_action( 'init', [ $this, 'style_rendering' ] );

        // Editor enqueue scripts
        add_action( 'wp_enqueue_scripts', [ $this, 'editor_enqueue_scripts' ] );

        // Enqueue scripts
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

        // Elementor widget options
        add_action( 'apack/options', [ $this, 'load_widget_options' ] );

        // Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
    }
}

add_action( 'setup_theme', function() {
    global $apack_elementor_widgets;

    $widgets = [
        'apack_elementor_featured_box' => [
            'label' => __( 'Featured Box', 'ametex-pack' ),
            'description' => __( 'Widget display featured services.', 'ametex-pack' ),
            'active' => true,
            'path_file' => __DIR__ . '/elementor-widget/apack-elementor-featured-box.php',
            'scss_file' => APACK_DIR . '/src/elements/_featured-box.scss',
        ],
        'apack_elementor_video' => [
            'label' => __( 'Video', 'ametex-pack' ),
            'description' => __( 'Widget display video youtube, vimeo, video html5.', 'ametex-pack' ),
            'active' => true,
            'path_file' => __DIR__ . '/elementor-widget/apack-elementor-video.php',
            'scss_file' => APACK_DIR . '/src/elements/_video.scss',
        ],
        'apack_elementor_pricing_table' => [
            'label' => __( 'Pricing Table', 'ametex-pack' ),
            'description' => __( 'Present information about your prices and products in a format that’s easy to digest.', 'ametex-pack' ),
            'active' => false,
            'path_file' => __DIR__ . '/elementor-widget/apack-elementor-pricing-table.php',
            'scss_file' => APACK_DIR . '/src/elements/_pricing-table.scss',
        ]
    ];

    $apack_elementor_widgets = $widgets;
} );

add_action( 'setup_theme', function() {

    if( defined( 'ELEMENTOR_VERSION' ) ) {

        Apack_Elementor::instance();
    }
} );
