<?php
 /**
  * Template Name: Homepage
  */

?>

<?php get_header(); ?>

<!-- home section -->
 
<?php
    get_template_part('partials/home');
?>

<!-- contact section -->
<?php 
    get_template_part('partials/ingredients');
?>


<!-- contact section -->
<?php
    get_template_part('partials/contact');
?>

</main>

<?php get_footer(); ?>
