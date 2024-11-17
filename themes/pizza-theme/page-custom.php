<?php
/*
Template Name: Custom Page
*/
get_header(); ?>

<main>
    <div class="custom-page-content">
        <h2><?php the_title(); ?></h2>
        <div class="post-content">
            <?php
            if (have_posts()) : while (have_posts()) : the_post();
                the_content();
            endwhile; endif;
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>

