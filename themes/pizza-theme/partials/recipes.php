<section class="menu" id="recipe">
    <div class="main-text" style="text-align: center;">
        <h2>Нашите рецепти</h2>
        <p>Ние избрахме за вас<br> най-екзотичните идеи от целият Апенински полуостров</p>
    </div>

    <div class="menu-content">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => 4,
            'paged' => $paged
        );
        $query = new WP_Query($args);
        $post_count = 0; // брояч за публикациите на текущата страница

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $post_count++; ?>

                <div class="row">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="default-image">
                    <?php endif; ?>
                    
                    <div class="menu-text">
                        <div class="menu-left">
                            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        </div>
                    </div>
                    <p><?php the_excerpt(); ?></p>
                </div>

            <?php endwhile;

            // Добавяне на празни елементи, ако публикациите са по-малко от 4
            for ($i = $post_count; $i < 4; $i++) : ?>
                <div class="row empty-row"></div>
            <?php endfor;

            // Странициране
            echo '<div class="pagination">';
            echo paginate_links(array(
                'total' => $query->max_num_pages,
                'current' => $paged,
                'format' => '?paged=%#%',
                'prev_text' => __('« Previous'),
                'next_text' => __('Next »'),
            ));
            echo '</div>';

        else : ?>
            <p>No recipes found.</p>
        <?php endif;

        wp_reset_postdata();
        ?>
    </div>
</section>
