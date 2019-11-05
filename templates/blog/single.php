<?php
/**
 * Blog single template
 *
 */

$template = carbon_get_post_meta( get_the_ID(), 'apack_blog_single_template' );
?>
<?php get_header(); ?>
    <?php /* Start the Loop */
    while ( have_posts() ) : ?> 
        <?php  the_post(); ?>

        <?php
        /**
         * apack/blog/single_before hook.
         *
         */
        do_action( 'apack/blog/single_before', $template );
        ?>

    	<div class="apack-blog-main">
            <div class="apack-blog-container-width">
                <div class="blog-main__inner">
                    <?php
                    /**
                     * apack/blog/single_content hooks.
                     *
                     */
                    do_action( 'apack/blog/single_content', $template );
                    ?>
                </div>
            </div>
        </div>

    <?php
    /**
     * apack/blog/single_after hook.
     *
     */
    do_action( 'apack/blog/single_after', $template );
    ?>

    <?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
