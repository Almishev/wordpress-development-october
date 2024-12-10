<section class="home" id="home">

    <div class="home-text">
		
        <h1><span><?php echo esc_html(get_theme_mod('pizza_home_title', 'Най-вкусната пица в града,само от пресни продукти!')); ?></span></h1>
        <p><?php echo esc_html(get_theme_mod('pizza_home_description', 'Опитайте разликата! Нашите пици са изработени с грижа от най-качествени и пресни съставки. Всяка хапка е взрив от аромат и вкус.')); ?></p>
        <a href="tel:<?php echo esc_html(get_theme_mod('pizza_home_phone', '0877-382-224')); ?>" class="btn"><?php echo esc_html(get_theme_mod('pizza_home_phone', '0877-382-224')); ?></a>
    </div>

    <div class="home-img">
        <img src="<?php echo esc_url(get_theme_mod('pizza_home_image', get_template_directory_uri() . '/img/home.png')); ?>" alt="home">
    </div>
</section>
