# ametex-pack
Elementor add-on for Ametex Theme

#### Register Widget Hook
```php
# apack/elementor_register_widgets hook

/**
 * Exam: Register Posts Slide Widget
 *
 */
function register_posts_slide_widget( $widgets ) {
    array_push( $widgets, [
        'apack_elementor_posts_slide' => [
            'label' => __( 'Posts Slide', 'ametex-pack' ),
            'description' => __( 'Widget display posts slide.', 'ametex-pack' ),
            'active' => true, // autoload
            'path_file' => __DIR__ . '/apack-elementor-posts-slide.php',
        ],
        ] );

    return $widgets;
}
add_action( 'apack/elementor_register_widgets', 'register_posts_slide_widget' );

/**
 * file: apack-elementor-posts-slide.php
 */
 <?php
 namespace Apack_Elementer\Widgets;

 use Elementor\Widget_Base;
 use Elementor\Controls_Manager;

 /**
  * Elementor Featured Box Widget
  *
  */

 class Apack_Elementor_Posts_Slide extends Widget_Base {

     public function get_name() {
         return basename( __FILE__, '.php' );
     }

     public function get_title() {
         return __( 'Posts Slide', 'ametex-pack' );
     }

     public function get_icon() {

     }

     public function get_categories() {
 		return [ 'general' ];
 	}

     protected function _register_controls() {

     }

     protected function render() {

     }

     protected function _content_template() {

     }
 }

 \Elementor\Plugin::instance()
     ->widgets_manager
     ->register_widget_type( new Apack_Elementor_Posts_Slide() );

```

#### Synchronized schemes elementor (color, typo)
[watch video](https://d.pr/free/v/7UK6qi)
```css
/**
 * Css variables using
 */
 :root {
    --apack-color-primary: #8dcfc8;
    --apack-color-secondary: #565656;
    --apack-color-text: #50656e;
    --apack-color-accent: #dc5049;
    --apack-font-primary-headline: 'Josefin Sans';
    --apack-font-primary-headline-weight: 400;
    --apack-font-secondary-headline: 'Josefin Sans';
    --apack-font-secondary-headline-weight: 400;
    --apack-font-body-text: 'Prata';
    --apack-font-body-text-weight: 400;
    --apack-font-accent-text: 'Josefin Sans';
    --apack-font-accent-text-weight: 400;
 }
```
