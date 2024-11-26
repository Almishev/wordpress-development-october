<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php bloginfo('name'); ?> - <?php wp_title(); ?></title>

	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	<link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
	<script src="https://unpkg.com/scrollreveal"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

	<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

	<?php wp_head(); ?>
</head>

<body>

<main>
   <!-- header section -->
<header>
		<!-- <a href="#" class="logo">Food<span>Fun</span></a> -->
		                           
		<a href="<?php echo home_url(); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt="logo"></a>
		                           
        <ul class="navbar" style="margin-bottom: 20px; display: flex !important; justify-content: center !important; align-items: center !important;">

		  
        <?php
wp_nav_menu(array(
    'theme_location' => 'primary_menu',
    'container' => false,
    'items_wrap' => '<ul class="navbar" style="margin-bottom: 20px; display: flex !important; justify-content: center; align-items: center;">%3$s</ul>',
    'depth' => 1,
    'menu_class' => 'menu-items',
    'link_class' => 'menu-item-link'
));
?>

       </ul>


		<div class="h-icons">
			<ul class="navbar">
			  <li><a href="tel:+359877382224"  style="color: black;">0877382224</a></li>
			</ul>
			<div class="bx bx-menu" id="menu-icon"></div>
		</div>

	</header>


    