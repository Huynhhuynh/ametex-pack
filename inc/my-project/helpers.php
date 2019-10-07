<?php
/**
 * Helpers
 *
 */

if( ! function_exists( 'apack_myproject_custom_archive_template' ) ) {
    /**
     * Custom archive template
     *
     */
    function apack_myproject_custom_archive_template( $archive_template ) {
        global $post;

        if ( is_post_type_archive ( 'my-project' ) ) {
              $archive_template = APACK_DIR . '/templates/my-project/archive.php';
        }

        return $archive_template;
    }
}

if( ! function_exists( 'apack_myproject_archive_grid_class_style' ) ) {
    /**
     *
     */
    function apack_myproject_archive_grid_class_style() {
        return 'my-project-' . carbon_get_theme_option( 'apack_project_archive_grid_style' );
    }
}

if( ! function_exists( 'apack_myproject_loop' ) ) {
    /**
     *
     */
    function apack_myproject_loop() {

        if ( have_posts() ) {
            echo '<div class="my-project-list '. apack_myproject_archive_grid_class_style() .'">';

        	while ( have_posts() ) {
        		the_post();
                load_template( APACK_DIR . '/templates/my-project/loop-item.php', false );
        	}

            echo '</div>';
        }
    }
}

if( ! function_exists( 'apack_myproject_archive_heading' ) ) {
    /**
     * Archive heading
     *
     */
    function apack_myproject_archive_heading() {

        ?>
        <div class="myproject-heading-container">
            <h2 class="title"><?php echo carbon_get_theme_option( 'apack_myproject_archive_heading_title' ); ?></h2>
            <div class="desc">
                <?php echo wpautop( carbon_get_theme_option( 'apack_myproject_archive_heading_desc' ) ); ?>
            </div>
        </div>
        <?php
    }
}

if( ! function_exists( 'apack_myproject_custom_single_template' ) ) {
    /**
     * Custom single template
     *
     */
    function apack_myproject_custom_single_template( $single_template ) {
        global $post;

    	if ( 'my-project' === $post->post_type ) {
    		$single_template = APACK_DIR . '/templates/my-project/single.php';
    	}

    	return $single_template;
    }
}

if( ! function_exists( 'apack_myproject_single_content' ) ) {
    /**
     * Single content
     */
    function apack_myproject_single_content() {
        load_template( APACK_DIR . '/templates/my-project/single-content.php' );
    }
}

if( ! function_exists( 'apack_myproject_increase_view_post' ) ) {
    /**
     * Increase view post
     *
     */
    function apack_myproject_increase_view_post() {
        global $post;

        if( ! is_singular( 'my-project' ) ) return;
        $old = get_post_meta( $post->ID, '_post-views', true );
        $count = empty( $old ) ? 1 : $old;

        update_post_meta( $post->ID, '_post-views', $count + 1 );
    }
}

if( ! function_exists( 'apack_myproject_single_media' ) ) {
    /**
     *
     */
    function apack_myproject_single_media() {
        global $post;
        the_post_thumbnail( 'full' );
    }
}

if( ! function_exists( 'apack_myproject_single_nav' ) ) {
    /**
     * Single Nav
     */
    function apack_myproject_single_nav() {
        global $post;
        $prev_post = get_previous_post();
        $next_post = get_next_post();
        ?>
        <div class="myproject-single-nav-container">
            <?php if( $prev_post ) : ?>
                <a class="prev-nav" href="<?php echo get_the_permalink( $prev_post->ID ); ?>" rel="nofollow">
                    <span class="__icon">
                        <?php echo apack_svg_icon( 'prev_arrow' ); ?>
                    </span>
                    <span class="__title"><?php echo get_the_title( $prev_post->ID ); ?></span>
                </a>
            <?php endif; ?>

            <a class="archive-nav" href="">
                <span class="__icon">
                    <?php echo apack_svg_icon( 'menu_square' ); ?>
                </span>
            </a>

            <?php if( $next_post ) : ?>
                <a class="next-nav" href="<?php echo get_the_permalink( $next_post->ID ); ?>" rel="nofollow">
                    <span class="__icon">
                        <?php echo apack_svg_icon( 'next_arrow' ); ?>
                    </span>
                    <span class="__title"><?php echo get_the_title( $next_post->ID ); ?></span>
                </a>
            <?php endif; ?>
        </div>
        <?php
    }
}
