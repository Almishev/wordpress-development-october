<?php get_header(); ?>

<div class="category-header">
    <h1><?php single_cat_title(); ?></h1>
    <p><?php echo category_description(); ?></p> <!-- Описание на категорията -->
</div>

<div class="category-posts">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <div class="category-post-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                    </div>
                <?php endif; ?>

                <div class="post-info">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <span class="post-date"><?php echo get_the_date(); ?></span>
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>

        <!-- Странициране -->
        <div class="pagination">
            <?php
            echo paginate_links(array(
                'total' => $wp_query->max_num_pages,
                'prev_text' => __('« Previous'),
                'next_text' => __('Next »'),
            ));
            ?>
        </div>

    <?php else : ?>
        <p><?php _e('No posts found in this category.'); ?></p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
