<?php
namespace Apack_Elementer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor Post Slide Widget
 *
 */

class Apack_Elementor_Post_Slide extends Widget_Base {

    public function get_name() {
        return basename( __FILE__, '.php' );
    }

    public function get_title() {
        return __( 'Post Slide (Ametex Pack)', 'ametex-pack' );
    }

    // public function get_icon() {
    //     return '';
    // }

    public function get_categories() {
		return [ 'general' ];
	}

    protected function _register_controls() {
        $this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Query', 'ametex-pack' ),
			]
		);

        

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="apack-widget __e-post-slide">
            <div class="__e-post-slide__inner">

            </div>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <div class="apack-widget __e-post-slide">
            <div class="__e-post-slide__inner">

            </div>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()
    ->widgets_manager
    ->register_widget_type( new Apack_Elementor_Post_Slide() );
