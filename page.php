<?php
if (!defined('ABSPATH')) exit;
get_header();
glc_breadcrumbs();
?>

<main>
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <div class="page-content">
            <?php the_content(); ?>
        </div>
        <?php
    endwhile;
    ?>
</main>

<?php get_footer(); ?>
