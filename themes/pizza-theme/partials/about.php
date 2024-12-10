<section class="about" id="about">
    <div class="about-img">
        <?php if (get_theme_mod('about_section_image')) : ?>
            <img src="<?php echo esc_url(get_theme_mod('about_section_image')); ?>" alt="About Image">
        <?php else: ?>
            <img src="<?php echo get_template_directory_uri(); ?>/img/a.png" alt="Пицария за вас">
        <?php endif; ?>
    </div>

    <div class="about-text">
        <h2><?php echo esc_html(get_theme_mod('about_section_title', 'The Delicious Food For a Good Mood')); ?></h2>
        <p><?php echo esc_html(get_theme_mod('about_section_text', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, ipsum?')); ?></p>
        <a href="<?php echo esc_url(get_theme_mod('about_section_button_link', 'tel:+359877382224')); ?>" class="btn">
            <?php echo esc_html(get_theme_mod('about_section_button_text', '0877382224')); ?>
        </a>
    </div>
</section>
