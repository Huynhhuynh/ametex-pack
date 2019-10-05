<?php
/**
 * My Project archive template
 *
 */
?>
<?php get_header(); ?>

	<?php do_action( 'apack/my_project/archive_before' ); ?>

	<div class="my-project-main">
        <div class="my-project-container-width">
            <div class="my-project-main__inner">
                <?php
                /**
                 * apack/my_project/archive_content hooks.
                 *
                 * @see apack_myproject_loop - 20
                 * @see apack_myproject_pagination - 22
                 */
                do_action( 'apack/my_project/archive_content' );
                ?>
            </div>
        </div>
    </div>

	<?php do_action( 'apack/my_project/archive_footer' ); ?>

<?php get_footer(); ?>
