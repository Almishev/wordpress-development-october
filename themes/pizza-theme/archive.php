<?php get_header(); ?>

<div class="archive-header">
    <h1>
        <?php 
        if (is_category()) {
            single_cat_title();
        } elseif (is_tag()) {
            single_tag_title();
        } elseif (is_author()) {
            the_archive_title();
        } elseif (is_date()) {
            echo 'Archives for ' . get_the_date('F Y');
        } else {
            echo 'Archives';
        }
        ?>
    </h1>
</div>

<!-- Показване на архивирани публикации -->
<section class="archive-posts">
    <?php if (have_posts()) : ?>
        <div class="posts-list">
            <?php while (have_posts()) : the_post(); ?>
                <div class="post-item">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p><?php the_excerpt(); ?></p>
                </div>
            <?php endwhile; ?>
        </div>

        <!-- Странициране -->
        <div class="pagination">
            <?php 
            echo paginate_links();
            ?>
        </div>

    <?php else : ?>
        <p>No posts found.</p>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
