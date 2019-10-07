<?php
/**
 * My Project archive template
 *
 */
?>
<?php get_header(); ?>

    <?php do_action( 'apack/my_project/single_before' ); ?>

	<div class="my-project-main">
        <div class="my-project-container-width">
            <div class="my-project-main__inner">
                <?php
                /**
                 * apack/my_project/single_content hooks.
                 *
                 * @see apack_myproject_single_nav - 18
                 * @see apack_myproject_single_content - 20
                 * @see apack_comment_template - 26
                 */
                do_action( 'apack/my_project/single_content' );
                ?>
            </div>
        </div>
    </div>

    <?php
    /**
     * apack/my_project/single_after hook.
     *
     */
    do_action( 'apack/my_project/single_after' );
    ?>

<?php get_footer(); ?>
