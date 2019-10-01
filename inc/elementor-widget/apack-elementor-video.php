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
			]
		);
        $this->add_control(
            'video_link',
            [
                'label' => __( 'Video Link', 'ametex-pack' ),
                'type' => Controls_Manager::TEXT,
                'description' => __( 'YouTube/Vimeo link, or link to video file (mp4 is recommended).', 'ametex-pack' )
            ]
        );
        $this->add_control(
            'caption',
            [
                'label' => __( 'Caption', 'ametex-pack' ),
                'type' => Controls_Manager::TEXTAREA,
                'description' => __( 'Video caption', 'ametex-pack' )
            ]
        );
        $this->add_control(
            'image_preview',
            [
                'label' => __( 'Image Preview', 'ametex-pack' ),
                'type' => Controls_Manager::MEDIA,
                'description' => __( 'This cover image video.', 'ametex-pack' ),
            ]
        );
        $this->add_control(
            'button_play_color',
            [
                'label' => __( 'Button Play Color', 'ametex-pack' ),
                'type' => Controls_Manager::COLOR,
                'description' => __( 'Select button play color.', 'ametex-pack' ),
                'selectors' => [
                    '{{WRAPPER}} a.button-play-video' => 'background: {{VALUE}}',
                ]
            ]
        );
        $this->add_control(
            'button_play_color_hover',
            [
                'label' => __( 'Button Play Color Hover', 'ametex-pack' ),
                'type' => Controls_Manager::COLOR,
                'description' => __( 'Select button play color hover.', 'ametex-pack' ),
                'default' => '#222222',
                'selectors' => [
                    '{{WRAPPER}} a.button-play-video:hover' => 'background: {{VALUE}}',
                ]
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="apack-widget __e-video">
            <div class="__e-video__inner">
                <div class="video-cover-image" data-apack-hover-float-effect>
                    <div class="__decor-layer"></div>
                    <img src="<?php echo $settings['image_preview']['url']; ?>" alt="#">
                    <div class="button-play-wrap" data-float-item>
                        <a data-fancybox href="<?php echo $settings['video_link'] ?>" class="button-play-video" data-caption="<?php echo $settings['caption']; ?>">
                            <span class="__icon">
                                <svg x="0px" y="0px" viewBox="0 0 124.512 124.512" style="enable-background:new 0 0 124.512 124.512;" xml:space="preserve"> <g> <path d="M113.956,57.006l-97.4-56.2c-4-2.3-9,0.6-9,5.2v112.5c0,4.6,5,7.5,9,5.2l97.4-56.2 C117.956,65.105,117.956,59.306,113.956,57.006z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <div class="apack-widget __e-video">
            <div class="__e-video__inner">
                <div class="video-cover-image">
                    <img src="{{settings.image_preview.url}}" alt="#">
                    <div class="button-play-wrap">
                        <a data-fancybox href="{{settings.video_link}}" class="button-play-video" data-caption="{{settings.caption}}">
                            <span class="__icon">
                                <svg x="0px" y="0px" viewBox="0 0 124.512 124.512" style="enable-background:new 0 0 124.512 124.512;" xml:space="preserve"> <g> <path d="M113.956,57.006l-97.4-56.2c-4-2.3-9,0.6-9,5.2v112.5c0,4.6,5,7.5,9,5.2l97.4-56.2 C117.956,65.105,117.956,59.306,113.956,57.006z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()
    ->widgets_manager
    ->register_widget_type( new Apack_Elementor_Video() );
