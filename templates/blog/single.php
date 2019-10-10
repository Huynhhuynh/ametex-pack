<?php
/**
 * Blog single template
 *
 */

?>
<?php get_header(); ?>
    <?php /* Start the Loop */
    while ( have_posts() ) : ?>
        <?php  the_post(); ?>

        <?php
        /**
         * apack/blog/single_before hook.
         *
         * @see apack_blog_heading_bar - 20
         */
        do_action( 'apack/blog/single_before' );
        ?>

    	<div class="apack-blog-main">
            <div class="apack-blog-container-width">
                <div class="blog-main__inner">
                    <?php
                    /**
                     * apack/blog/single_content hooks.
                     *
                     * @see apack_blog_content - 20
                     * @see apack_blog_related - 24
                     * @see apack_comment_template - 28
                     */
                    do_action( 'apack/blog/single_content' );
                    ?>
                </div>
            </div>
        </div>

    <?php
    /**
     * apack/blog/single_after hook.
     *
     */
    do_action( 'apack/blog/single_after' );
    ?>

    <?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
