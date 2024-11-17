<?php get_header(); ?>

<!-- home section -->
<?php
    get_template_part('partials/home');
?>

<!-- contact section -->
<?php 
    get_template_part('partials/ingredients');
?>

<!-- about section -->
<?php
    get_template_part('partials/about');
?>

<!-- daily menu section -->
<?php
    do_action('display_daily_menu');
?>


<!-- Рецепти -->
<!-- Постове -->
<?php
    get_template_part('partials/recipes');
?>

<!-- contact section -->
<?php
    get_template_part('partials/contact');
?>

</main>

<?php get_footer(); ?>
