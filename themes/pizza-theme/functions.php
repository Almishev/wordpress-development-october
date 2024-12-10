<?php

function pizza_theme_enqueue_scripts() {
    // Зареждане на стиловете
    wp_enqueue_style('theme-pizza-style', get_stylesheet_uri());

    // Зареждане на JS
    wp_enqueue_script('pizza-theme-scripts', get_template_directory_uri() . '/js/Pizza website.js', array('jquery'), null, true);

    // Локализиране на скрипта за AJAX
    wp_localize_script('pizza-theme-scripts', 'pizza_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'pizza_theme_enqueue_scripts');

// Добавяне на поддръжка за миниатюрни изображения
add_theme_support('post-thumbnails');

// Задаване на размери по подразбиране за миниатюрните изображения
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

// Регистрация на sidebar-и
function custom_register_sidebars() {
    register_sidebar(array(
        'name'          => __('Sidebar 1', 'pizza'),
        'id'            => 'sidebar-1',
        'description'   => __('Това е първият sidebar.', 'pizza'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

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
