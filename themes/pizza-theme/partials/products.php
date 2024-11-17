<section class="menu" id="menu">
    <div class="main-text" style="text-align: center">
    <h2>Звездите за денят</h2>
    <p>Нашите дневни предложения<br> които готвачът подбра за вас</p>
    </div>

    <div class="menu-content">
        <?php
        $args = array(
            'post_type' => 'pizza_item',
            'posts_per_page' => -1
        );
        $menu_items = new WP_Query($args);

        if ($menu_items->have_posts()) :
            while ($menu_items->have_posts()) : $menu_items->the_post();
        ?>
                                <div class="row">
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('pizza-thumbnail', array('alt' => get_the_title())); ?>
        </a>
    <?php endif; ?>
    <div class="menu-text">
        <div class="menu-left">
            <h4>
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h4>
        </div>
        <div class="menu-right">
            <h5>
                <a href="<?php the_permalink(); ?>">
                    <?php echo get_post_meta(get_the_ID(), '_price', true); ?> лв.
                </a>
            </h5>
        </div>
    </div>
    <p>
        <a href="<?php the_permalink(); ?>">
            <?php echo get_post_meta(get_the_ID(), '_description', true); ?>
        </a>
    </p>
    <div class="star">
        <a href="<?php the_permalink(); ?>"><i class='bx bxs-star'></i></a>
        <a href="<?php the_permalink(); ?>"><i class='bx bxs-star'></i></a>
        <a href="<?php the_permalink(); ?>"><i class='bx bxs-star'></i></a>
        <a href="<?php the_permalink(); ?>"><i class='bx bxs-star'></i></a>
        <a href="<?php the_permalink(); ?>"><i class='bx bxs-star'></i></a>
    </div>
</div>



        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>