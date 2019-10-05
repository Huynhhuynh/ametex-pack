<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

/**
 * My Project
 *
 * @package Elementor Pack
 * @author Beplus
 */

class Apack_My_Project {

    protected static $_instance;

    public static function instance() {
        if( self::$_instance == null ) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public function _inc() {
        require( __DIR__ . '/helpers.php' );
        require( __DIR__ . '/hooks.php' );
    }

    public function style_rendering() {
        $dev_mode = $dev_mode = apack_get_mode();
        if( true != $dev_mode ) return;

        apack_scss_compiler(
            file_get_contents( APACK_DIR . '/src/my-project/my-project.scss' ),
            APACK_DIR . '/dist/ametex-pack.my-project.css',
            APACK_DIR . '/src/my-project/',
            'ScssPhp\ScssPhp\Formatter\Compressed',
            true
        );
    }

    public function scripts() {

        wp_enqueue_style( 'apack-myproject', APACK_URI . '/dist/ametex-pack.my-project.css', false, APACK_VER );
        wp_enqueue_script( 'apack-myproject', APACK_URI . '/dist/ametex-pack.my-project.js', ['jquery', 'ametex-pack-js'], APACK_VER, true );
        wp_localize_script( 'apack-myproject', 'apack_myproject_php_object', apply_filters( 'apack/myproject_php_object', [
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'myproject_archive_cols' => (int) carbon_get_theme_option( 'apack_project_archive_grid_cols' ),
            'myproject_archive_cols_tablet' => (int) carbon_get_theme_option( 'apack_project_archive_grid_cols_tablet' ),
            'myproject_archive_cols_mobile' => (int) carbon_get_theme_option( 'apack_project_archive_grid_cols_mobile' ),
            'lang' => []
            ] ) );
    }

    protected static function icon() {
        $svg = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 592.813 592.814" style="enable-background:new 0 0 592.813 592.814;" xml:space="preserve"> <g> <path d="M589.173,356.232l-104.756,198.26c-5.125,9.858-19.653,20.285-30.872,20.285l-420.096,0.077 c-8.875,0-17.384-3.518-23.655-9.794C3.523,558.783,0,550.283,0,541.405l0.068-326.209c0-18.448,14.955-33.417,33.405-33.435 l30.715-0.029v28.496H43.639c-4.022,0-7.885,1.596-10.731,4.442c-2.843,2.846-4.442,6.706-4.442,10.731l0.03,305.796 c0,8.388,6.797,15.173,15.176,15.173h21.045l99.28-200.836c5.609-11.219,16.208-20.286,27.411-20.286h243.14l0.083-80.823 c15.876,1.472,28.406,14.641,28.406,30.893v49.931H574.55C587.719,325.384,598.808,338.406,589.173,356.232z M83.558,445.272 c-0.907-99.969,0-399.884,0-399.884c0-15.132,12.306-27.429,27.423-27.429h219.614c3.518,0,6.874,1.472,9.251,4.061l71,77.141 c2.128,2.323,3.321,5.364,3.321,8.515v199.839h-23.034V124.932c0-3.159-2.565-5.725-5.728-5.725h-54.343 c-6.36,0-11.532-5.163-11.532-11.511V46.721c0-3.16-2.565-5.725-5.728-5.725H110.995c-2.423,0-4.395,1.971-4.395,4.392v374.739 l-17.626,35.66C88.975,455.781,83.649,455.391,83.558,445.272z M342.588,96.182H376.8l-34.212-37.188V96.182z M355.065,142.667 H142.813c-7.82,0-14.168,6.354-14.168,14.174c0,7.814,6.354,14.171,14.168,14.171h212.258c7.82,0,14.187-6.362,14.187-14.171 C369.245,149.027,362.88,142.667,355.065,142.667z M369.245,239.376c0-7.814-6.359-14.162-14.18-14.162H142.813 c-7.82,0-14.168,6.36-14.168,14.162c0,7.814,6.354,14.162,14.168,14.162h212.258C362.88,253.539,369.245,247.19,369.245,239.376z M128.636,322.47c0,7.813,6.357,14.162,14.171,14.162h5.089c8.958-24.967,31.164-28.324,31.164-28.324h-36.253 C135.005,308.308,128.636,314.656,128.636,322.47z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg>';
        return apply_filters( 'apack/my_project_icon', 'data:image/svg+xml;base64,' . base64_encode( $svg ) );
    }

    public function register_post_type() {

        $labels = array(
            'name'                  => _x( 'My Projects', 'Post type general name', 'ametex-pack' ),
            'singular_name'         => _x( 'Project', 'Post type singular name', 'ametex-pack' ),
            'menu_name'             => _x( 'Projects', 'Admin Menu text', 'ametex-pack' ),
            'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'ametex-pack' ),
            'add_new'               => __( 'Add New', 'ametex-pack' ),
            'add_new_item'          => __( 'Add New Project', 'ametex-pack' ),
            'new_item'              => __( 'New Project', 'ametex-pack' ),
            'edit_item'             => __( 'Edit Project', 'ametex-pack' ),
            'view_item'             => __( 'View Project', 'ametex-pack' ),
            'all_items'             => __( 'All Projects', 'ametex-pack' ),
            'search_items'          => __( 'Search Projects', 'ametex-pack' ),
            'parent_item_colon'     => __( 'Parent Projects:', 'ametex-pack' ),
            'not_found'             => __( 'No projects found.', 'ametex-pack' ),
            'not_found_in_trash'    => __( 'No projects found in Trash.', 'ametex-pack' ),
            'featured_image'        => _x( 'Project Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'ametex-pack' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'ametex-pack' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'ametex-pack' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'ametex-pack' ),
            'archives'              => _x( 'Project archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'ametex-pack' ),
            'insert_into_item'      => _x( 'Insert into project', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'ametex-pack' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this project', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'ametex-pack' ),
            'filter_items_list'     => _x( 'Filter projects list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'ametex-pack' ),
            'items_list_navigation' => _x( 'Projects list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'ametex-pack' ),
            'items_list'            => _x( 'Projects list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'ametex-pack' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'my-project' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'          => self::icon(),
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );

        register_post_type( 'my-project', $args );

        register_taxonomy( 'my-project-cat', 'my-project', [
            'hierarchical'          => false,
    		'labels'                => [
                'name'                       => _x( 'Categories', 'taxonomy general name', 'ametex-pack' ),
        		'singular_name'              => _x( 'Category', 'taxonomy singular name', 'ametex-pack' ),
        		'search_items'               => __( 'Search Categories', 'ametex-pack' ),
        		'popular_items'              => __( 'Popular Categories', 'ametex-pack' ),
        		'all_items'                  => __( 'All Categories', 'ametex-pack' ),
        		'parent_item'                => null,
        		'parent_item_colon'          => null,
        		'edit_item'                  => __( 'Edit Category', 'ametex-pack' ),
        		'update_item'                => __( 'Update Category', 'ametex-pack' ),
        		'add_new_item'               => __( 'Add New Category', 'ametex-pack' ),
        		'new_item_name'              => __( 'New Category Name', 'ametex-pack' ),
        		'separate_items_with_commas' => __( 'Separate Categories with commas', 'ametex-pack' ),
        		'add_or_remove_items'        => __( 'Add or remove Categories', 'ametex-pack' ),
        		'choose_from_most_used'      => __( 'Choose from the most used Categories', 'ametex-pack' ),
        		'not_found'                  => __( 'No Categories found.', 'ametex-pack' ),
        		'menu_name'                  => __( 'Categories', 'ametex-pack' ),
            ],
    		'show_ui'               => true,
    		'show_admin_column'     => true,
    		'update_count_callback' => '_update_post_term_count',
    		'query_var'             => true,
    		'rewrite'               => array( 'slug' => 'my-project-cat' ),
            ] );

        register_taxonomy( 'my-project-tag', 'my-project', [
            'hierarchical'          => false,
    		'labels'                => [
                'name'                       => _x( 'Tags', 'taxonomy general name', 'ametex-pack' ),
        		'singular_name'              => _x( 'Tag', 'taxonomy singular name', 'ametex-pack' ),
        		'search_items'               => __( 'Search Tags', 'ametex-pack' ),
        		'popular_items'              => __( 'Popular Tags', 'ametex-pack' ),
        		'all_items'                  => __( 'All Tags', 'ametex-pack' ),
        		'parent_item'                => null,
        		'parent_item_colon'          => null,
        		'edit_item'                  => __( 'Edit Tag', 'ametex-pack' ),
        		'update_item'                => __( 'Update Tag', 'ametex-pack' ),
        		'add_new_item'               => __( 'Add New Tag', 'ametex-pack' ),
        		'new_item_name'              => __( 'New Tag Name', 'ametex-pack' ),
        		'separate_items_with_commas' => __( 'Separate Tags with commas', 'ametex-pack' ),
        		'add_or_remove_items'        => __( 'Add or remove Tags', 'ametex-pack' ),
        		'choose_from_most_used'      => __( 'Choose from the most used Tags', 'ametex-pack' ),
        		'not_found'                  => __( 'No Tags found.', 'ametex-pack' ),
        		'menu_name'                  => __( 'Tags', 'ametex-pack' ),
            ],
    		'show_ui'               => true,
    		'show_admin_column'     => true,
    		'update_count_callback' => '_update_post_term_count',
    		'query_var'             => true,
    		'rewrite'               => array( 'slug' => 'my-project-tag' ),
            ] );
    }

    public function options( $settings ) {

        $settings->add_tab( __( 'Project Settings', 'ametex-pack' ), apply_filters( 'apack/options/tab_project_settings', [
            Field::make( 'checkbox', 'apack_project_enable', __( 'Enable Projects post type', 'ametex-pack' ) )
                ->set_help_text( __( 'Display your company or personal Portfolio/Gallery items', 'ametex-pack' ) ),
            Field::make( 'text', 'apack_myproject_content_width', __( 'Content With', 'ametex-pack' ) )
                ->set_attribute( 'type', 'number' )
                ->set_default_value( 1140 ),
            Field::make( 'text', 'apack_myproject_archive_heading_title', __( 'Archive Title', 'ametex-pack' ) )
                ->set_default_value( __( 'Visiting Our Projects', 'ametex-pack' ) ),
            Field::make( 'textarea', 'apack_myproject_archive_heading_desc', __( 'Archive Decriptions', 'ametex-pack' ) )
                ->set_default_value( __( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries', 'ametex-pack' ) ),
            Field::make( 'select', 'apack_project_archive_grid_style', __( 'Archive Grid Style', 'ametex-pack' ) )
                ->set_options( [
                    'grid-classic' => __( 'Grid Classic', 'ametex-pack' ),
                    'grid-masonry' => __( 'Grid Masonry', 'ametex-pack' ),
                    ] )
                ->set_default_value( 'grid-classic' ),
            Field::make( 'select', 'apack_project_archive_grid_cols', __( 'Archive Grid Columns', 'ametex-pack' ) )
                ->set_options( [
                    '3' => __( '3 Columns', 'ametex-pack' ),
                    '4' => __( '4 Columns', 'ametex-pack' ),
                    '5' => __( '5 Columns', 'ametex-pack' ),
                    ] )
                ->set_default_value( '3' )
                ->set_width( 30 ),
            Field::make( 'select', 'apack_project_archive_grid_cols_tablet', __( 'Archive Grid Columns (Tablet)', 'ametex-pack' ) )
                ->set_options( [
                    '2' => __( '2 Columns', 'ametex-pack' ),
                    '3' => __( '3 Columns', 'ametex-pack' ),
                    ] )
                ->set_default_value( '2' )
                ->set_width( 30 ),
            Field::make( 'select', 'apack_project_archive_grid_cols_mobile', __( 'Archive Grid Columns (Mobile)', 'ametex-pack' ) )
                ->set_options( [
                    '1' => __( '1 Column', 'ametex-pack' ),
                    '2' => __( '2 Columns', 'ametex-pack' ),
                    ] )
                ->set_default_value( '1' )
                ->set_width( 30 ),
            ] ) );
    }

    public function _init() {
        $enable = carbon_get_theme_option( 'apack_project_enable' );
        if( true != $enable ) return;

        $this->style_rendering();
        $this->register_post_type();
        add_action( 'wp_enqueue_scripts', [ $this, 'scripts' ] );
    }

    public function define_css_variables() {
        ?>
        <style>
            :root {
                --apack-myproject-content-width: <?php echo carbon_get_theme_option( 'apack_myproject_content_width' ); ?>px;
                --apack-myproject-archive-cols: <?php echo carbon_get_theme_option( 'apack_project_archive_grid_cols' ); ?>;
                --apack-myproject-archive-cols-tablet: <?php echo carbon_get_theme_option( 'apack_project_archive_grid_cols_tablet' ); ?>;
                --apack-myproject-archive-cols-mobile: <?php echo carbon_get_theme_option( 'apack_project_archive_grid_cols_mobile' ); ?>;
            }
        </style>
        <?php
    }

    public function __construct() {
        $this->_inc();

        add_action( 'apack/options', [ $this, 'options' ], 30 );
        add_action( 'wp_head', [ $this, 'define_css_variables' ], 6 );
        add_action( 'init', [ $this, '_init' ] );
    }
}

return Apack_My_Project::instance();
