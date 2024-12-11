<footer class="custom-footer">
    <div class="last-text">
        <p>
            <?php echo esc_html(get_theme_mod('pizza_footer_text', '© Developed by PirinPixel')); ?>
            <?php echo date('j F Y'); ?>
        </p>
        <div class="social-custum-icons" style="text-align: center;">
            <?php if (get_theme_mod('pizza_facebook_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('pizza_facebook_url')); ?>" target="_blank">
                    <i class='bx bxl-facebook'></i>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('pizza_instagram_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('pizza_instagram_url')); ?>" target="_blank">
                    <i class='bx bxl-instagram'></i>
                </a>
            <?php endif; ?>
            <?php if (get_theme_mod('pizza_linkedin_url')): ?>
                <a href="<?php echo esc_url(get_theme_mod('pizza_linkedin_url')); ?>" target="_blank">
                    <i class='bx bxl-linkedin'></i>
                </a>
            <?php endif; ?>
        </div>
    </div>

    
     <a href="#h" class="scroll-top">
        <i class='bx bx-up-arrow-alt' ></i>
    </a>
</footer>
