<?php
namespace Apack_Elementer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor Featured Box Widget
 *
 */

class Apack_Elementor_Featured_Box extends Widget_Base {

    public function get_name() {
        return basename( __FILE__, '.php' );
    }

    public function get_title() {
        return __( 'Featured Box (Ametex Pack)', 'ametex-pack' );
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
            'image',
            [
                'label' => __( 'Featured Image', 'ametex-pack' ),
                'type' => Controls_Manager::MEDIA,
            ] );
        $this->add_control(
			'title',
			[
				'label' => __( 'Title', 'ametex-pack' ),
				'type' => Controls_Manager::TEXT,
                'default' => __( 'Featured Title Here.', 'ametex-pack' ),
                'separator' => 'before',
			] );
        $this->add_control(
			'description',
			[
				'label' => __( 'Description', 'ametex-pack' ),
				'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'Featured description here.', 'ametex-pack' ),
                'separator' => 'before',
			] );
        $this->add_control(
			'featured_image_shadow_color',
			[
				'label' => __( 'Featured Image Shadow Color', 'ametex-pack' ),
				'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .featured-icon .__icon' => 'box-shadow: 10px 10px 18px -8px {{VALUE}}'
                ],
			] );
        $this->add_control(
			'title_color',
			[
				'label' => __( 'Title Color', 'ametex-pack' ),
				'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .featured-entry .title' => 'color: {{VALUE}}'
                ],
			] );
        $this->add_control(
			'desc_color',
			[
				'label' => __( 'Description Color', 'ametex-pack' ),
				'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .featured-entry .desc' => 'color: {{VALUE}}'
                ],
			] );
        $this->add_control(
			'url',
			[
				'label' => __( 'URL', 'ametex-pack' ),
				'type' => Controls_Manager::URL,
                'separator' => 'before',
			] );
        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        //print_r( $settings['image'] ); # url / is_external / nofollow
        ?>
        <div class="apack-widget __e-featured-box" data-apack-hover-float-effect>
            <div class="__e-featured-box__inner">
                <div class="featured-icon">
                    <div class="__icon" data-float-item>
                        <img src="<?php echo $settings['image']['url']; ?>" alt="#">
                    </div>
                </div>
                <div class="featured-entry">
                    <h4 class="title"><?php echo $settings['title']; ?></h4>
                    <div class="desc">
                        <?php echo wpautop( $settings['description'] ) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <div class="apack-widget __e-featured-box">
            <div class="__e-featured-box__inner">
                <div class="featured-icon">
                    <div class="__icon">
                        <img src="{{ settings.image.url }}" alt="#">
                    </div>
                </div>
                <div class="featured-entry">
                    <h4 class="title">{{ settings.title }}</h4>
                    <div class="desc">
                        <p>{{ settings.description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

\Elementor\Plugin::instance()
    ->widgets_manager
    ->register_widget_type( new Apack_Elementor_Featured_Box() );
