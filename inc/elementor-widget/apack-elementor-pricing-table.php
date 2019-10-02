<?php
namespace Apack_Elementer\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor Featured Box Widget
 *
 */

class Apack_Elementor_Pricing_Table extends Widget_Base {

    public function get_name() {
        return basename( __FILE__, '.php' );
    }

    public function get_title() {
        return __( 'Pricing Table (Ametex Pack)', 'ametex-pack' );
    }

    // public function get_icon() {
    //     return '';
    // }

    public function get_categories() {
		return [ 'general' ];
	}

    protected function _register_controls() {

        $content_default = '<ul>
            <li>Extra features</li>
            <li>Lifetime free support</li>
            <li>Upgrate options</li>
            <li>Full access</li>
        </ul>';

        $this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'ametex-pack' ),
                'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'list_plan_name',
            [
				'label' => __( 'Plan Name', 'ametex-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Basic' , 'ametex-pack' ),
			]
		);

        $repeater->add_control(
			'list_price',
            [
				'label' => __( 'Price', 'ametex-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '$10.00' , 'ametex-pack' ),
			]
		);

        $repeater->add_control(
			'list_content',
            [
				'label' => __( 'Content', 'ametex-pack' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => $content_default,
			]
		);

        $repeater->add_control(
			'list_color',
			[
				'label' => __( 'Color', 'ametex-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'border-top-color: {{VALUE}}',
                    '{{WRAPPER}} {{CURRENT_ITEM}} .heading .pricing' => 'color: {{VALUE}}',
				],
			]
		);

        $repeater->add_control(
			'list_button_title',
            [
				'label' => __( 'Button Title', 'ametex-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Choose Plan', 'ametex-pack' ),
			]
		);

        $repeater->add_control(
			'list_button_link',
            [
				'label' => __( 'Button Link', 'ametex-pack' ),
				'type' => Controls_Manager::URL,
			]
		);

        $this->add_control(
            'list',
            [
                'label' => __( 'Data', 'ametex-pack' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_plan_name' => 'Basic Pack',
                        'list_price' => '$10.00',
                        'list_content' => $content_default,
                        'list_color' => '',
                        'list_button_title' => 'Choose Plan',
                    ],
                    [
                        'list_plan_name' => 'Medium Pack',
                        'list_price' => '$20.00',
                        'list_content' => $content_default,
                        'list_color' => '',
                        'list_button_title' => 'Choose Plan',
                    ],
                    [
                        'list_plan_name' => 'Premium Pack',
                        'list_price' => '$50.00',
                        'list_content' => $content_default,
                        'list_color' => '',
                        'list_button_title' => 'Choose Plan',
                    ]
                ],
                'title_field' => '{{{list_plan_name}}}'
            ]
        );

        $this->add_control(
            'item_margin',
            [
                'label' => __( 'Margin', 'ametex-pack' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 20,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_responsive',
			[
				'label' => __( 'Responsive', 'ametex-pack' ),
			]
		);

        $this->add_control(
            'item_desktop',
            [
                'label' => __( 'Items on Desktop', 'ametex-pack' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );

        $this->add_control(
            'item_tablet',
            [
                'label' => __( 'Items on Tablet', 'ametex-pack' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 2,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_mobile',
            [
                'label' => __( 'Items on Mobile', 'ametex-pack' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if( count( $settings['list'] ) <= 0 ) return;

        ?>
        <div class="apack-widget __e-pricing-table">
            <div class="__e-pricing-table__inner">
                <div class="pricing-items __is-margin-<?php echo $settings['item_margin']; ?>"
                    data-apack-carousel
                    data-owl-margin="<?php echo $settings['item_margin']; ?>"
                    data-owl-items="<?php echo $settings['item_desktop']; ?>"
                    data-owl-items-tablet="<?php echo $settings['item_tablet']; ?>"
                    data-owl-items-mobile="<?php echo $settings['item_mobile']; ?>" >
                    <?php foreach( $settings['list'] as $index => $item ) : ?>
                    <div class="__item <?php echo 'elementor-repeater-item-' . $item['_id']; ?>">
                        <div class="heading">
                            <h4 class="pricing"><?php echo $item['list_price']; ?></h4>
                            <div class="plan">
                                <?php echo $item['list_plan_name']; ?>
                            </div>
                        </div>
                        <div class="entry">
                            <?php echo wpautop( $item['list_content'] ); ?>
                        </div>
                        <div class="action">
                            <a class="button-choose-plan"
                                href="<?php echo $item['list_button_link']['url'] ?>"
                                <?php echo ( $item['list_button_link']['is_external'] == true ) ? 'target="_blank"' : ''; ?> >
                                <?php echo $item['list_button_title'] ?>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function _content_template() {
        ?>
        <# if ( settings.list.length ) { #>
        <div class="apack-widget __e-pricing-table">
            <div class="__e-pricing-table__inner">
                <div class="pricing-items"
                    data-apack-carousel
                    data-owl-margin="{{ settings.item_margin }}"
                    data-owl-items="{{ settings.item_desktop }}"
                    data-owl-items-tablet="{{ settings.item_tablet }}"
                    data-owl-items-mobile="{{ settings.item_mobile }}" >
                    <# _.each( settings.list, function( item ) { #>
                    <div class="__item elementor-repeater-item-{{ item._id }}">
                        <div class="heading">
                            <h4 class="pricing">{{ item.list_price }}</h4>
                            <div class="plan">
                                {{ item.list_plan_name }}
                            </div>
                        </div>
                        <div class="entry">
                            {{{ item.list_content }}}
                        </div>
                        <div class="action">
                            <a class="button-choose-plan" href="{{ item.list_button_link.url }}">
                                {{ item.list_button_title }}
                            </a>
                        </div>
                    </div>
                    <# } ) #>
                </div>
            </div>
        </div>
        <# } #>
        <?php
    }
}

\Elementor\Plugin::instance()
    ->widgets_manager
    ->register_widget_type( new Apack_Elementor_Pricing_Table() );
