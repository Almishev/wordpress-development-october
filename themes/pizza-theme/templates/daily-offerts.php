<?php
 /**
  * Template Name: Daily-offerts
  */

?>
<span id="h"></span>
<?php get_header(); ?>

<!-- daily menu section -->
<?php
    do_action('display_daily_menu');
?>

<!-- contact section -->
<?php
    get_template_part('partials/contact');
?>
<?php get_footer(); ?>