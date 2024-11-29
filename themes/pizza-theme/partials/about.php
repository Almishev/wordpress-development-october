<section class="about" id="about">
    <div class="about-img">
        <?php 
        $about_image = get_field('about_imagine');
        if ($about_image): ?>
            <img src="<?php echo esc_url($about_image['url']); ?>" alt="<?php echo esc_attr($about_image['alt']); ?>">
        <?php else: ?>
            <img src="<?php echo get_template_directory_uri(); ?>/img/overpizza.avif" alt="Default Image">
        <?php endif; ?>
    </div>

    <div class="about-text">
        <h2><?php echo esc_html(get_field('text-about') ?: 'Вкусна храна  за добро настроение'); ?></h2>
        <p><?php echo esc_html(get_field('text-area') ?: 'Тук ще откриете уютна атмосфера и приятелско обслужване.'); ?></p>
        <a href="tel:<?php echo esc_attr(get_field('phone') ?: '0877382224'); ?>" class="btn"><?php echo esc_html(get_field('phone') ?: '0877-382-224'); ?></a>
    </div>
</section>
