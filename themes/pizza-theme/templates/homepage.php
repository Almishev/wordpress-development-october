<?php
 /**
  * Template Name: Homepage
  */

?>
<span id="h"></span>
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


<?php get_footer(); ?>
