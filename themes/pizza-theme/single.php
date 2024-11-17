<?php get_header(); ?>

<div class="single-post">
    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>
        
            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('medium'); ?>
                </div>
            <?php endif; ?>

            <h1><?php the_title(); ?></h1>
            
            <div class="post-meta">
                <span>Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?></span>
                <span> | Category: 
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        foreach ($categories as $category) {
                            echo '<b><a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a> </b>';
                        }
                    }
                    ?>
                </span>
            </div>

            <div class="post-content">
                <?php the_content(); ?>
            </div>
        <?php endwhile;
    endif;
    ?>
    <div style="text-align: center;">
    <?php comments_template(); ?>
    </div>
</div>

<?php get_footer(); ?>
