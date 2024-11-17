<?php
function theme_pizza_enqueue_scripts() {
    // Зареждане на стиловете
    wp_enqueue_style('theme-pizza-style', get_stylesheet_uri());
    
    // Зареждане на JavaScript файла
    wp_enqueue_script('pizza-website-js', get_template_directory_uri() . '/js/Pizza website.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'theme_pizza_enqueue_scripts');

// Добавяне на поддръжка за миниатюрни изображения
add_theme_support('post-thumbnails');

// Задаване на размери по подразбиране за миниатюрните изображения (по избор)
add_image_size('menu-item-thumbnail', 300, 200, true);


// Регистриране на менюто
function theme_register_menus() {
    register_nav_menus(
        array(
            'primary_menu' => __('Основно меню', 'textdomain'),
        )
    );
}
add_action('after_setup_theme', 'theme_register_menus');


function add_menu_link_class($atts, $item, $args) {
    if (isset($args->link_class)) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

function add_menu_list_item_class($classes, $item, $args) {
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);

function custom_register_sidebars() {
    // Първи sidebar
    register_sidebar(array(
        'name'          => __('Sidebar 1', 'pizza'),
        'id'            => 'sidebar-1',
        'description'   => __('Това е първият sidebar.', 'pizza'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    // Втори sidebar
    register_sidebar(array(
        'name'          => __('Sidebar 2', 'pizza'),
        'id'            => 'sidebar-2',
        'description'   => __('Това е вторият sidebar.', 'pizza'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'custom_register_sidebars');

?>
