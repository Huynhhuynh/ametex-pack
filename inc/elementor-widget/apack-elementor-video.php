<?php
namespace Apack_Elementer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor Featured Box Widget
 *
 */

class Apack_Elementor_Video extends Widget_Base {

    public function get_name() {
        return basename( __FILE__, '.php' );
    }

    public function get_title() {
        return __( 'Video (Ametex Pack)', 'ametex-pack' );
    }

    // public function get_icon() {
    //     return '';
    // }

    public function get_categories() {
		return [ 'general' ];
	}

    protected function _register_controls() {
        $this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ametex-pack' ),
                'type' => Controls_Manager::TEXT,
                'description' => __( 'YouTube/Vimeo link, or link to video file (mp4 is recommended).', 'ametex-pack' )
			]
		);
        $this->add_control(
            'video_link',
            [
                'label' => __( 'Video Link', 'ametex-pack' )
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="apack-widget __e-video">
            <div class="__e-video__inner">

            </div>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <div class="apack-widget __e-video">
            <div class="__e-video__inner">

            </div>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()
    ->widgets_manager
    ->register_widget_type( new Apack_Elementor_Featured_Box() );
