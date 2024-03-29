## Ametex Pack
Elementor add-on for Ametex Theme

## Featured
* Synchronized schemes elementor (color, typography)
* Control elementor widgets panel via hook
* Elementor widgets base (Featured box, Pricing table, etc.)
* Support project post type (archive & single)
* Settings panel hook
* Support SCSS develop mode
* Options control include OwlCarousel 2
* Options control include Fancybox 3
* Custom single blog template
* Support Gutenberg editor
* Blog single multiple layout (Classic, Sticky Sidebar, Heading 2 columns)
* Blog archive grid layout
* Mobile menu friendly ([Video Preview](https://d.pr/free/v/mQr4Pb))

## Synchronized schemes elementor (color, typo)
[watch video](https://d.pr/free/v/7UK6qi)
```css
/**
 * Css variables using
 */
 :root {
    --apack-color-primary: ...;
    --apack-color-secondary: ...;
    --apack-color-text: ...;
    --apack-color-accent: ...;
    --apack-font-primary-headline: ...;
    --apack-font-primary-headline-weight: ...;
    --apack-font-secondary-headline: ...;
    --apack-font-secondary-headline-weight: ...;
    --apack-font-body-text: ...;
    --apack-font-body-text-weight: ...;
    --apack-font-accent-text: ...;
    --apack-font-accent-text-weight: ...;
 }
```

## CSS Variables hook
```php

# Font
add_filter( 'apack/css_variables/font', function( $data ) {
    ...
} );

# Color
add_filter( 'apack/css_variables/color', function( $data ) {
    ...
} );
```

## Register Widget Hook
```php
/**
 * file: your_theme/functions.php
 *
 */
 global $apack_elementor_widgets;

 $apack_elementor_widgets['apack_elementor_posts_slide'] = [
     'label' => __( 'Posts Slide', 'ametex-pack' ), // (require)
     'description' => __( 'Widget display posts slide.', 'ametex-pack' ), // (options)
     'icon' => '', // update late... (options)
     'active' => true, // autoload (options)
     'path_file' => __DIR__ . '/apack-elementor-posts-slide.php', // (require)
     'scss_file' => __DIR__ . '/apack-elementor-posts-slide.scss', // Need enable develop mode on general settings (option)
 ];

/**
 * file: apack-elementor-posts-slide.php
 */
<?php
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

## Control widget on setting panel
![Settings Preview](https://cdn-std.droplr.net/files/acc_472041/v7xIuE)
