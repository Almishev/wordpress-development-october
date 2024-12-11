<?php
function pizza_theme_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'pizza_theme_child_enqueue_styles');






function pizza_theme_child_add_sidebar() {
    register_sidebar(array(
        'name'          => __('Child Sidebar', 'pizza-child'),
        'id'            => 'child-sidebar',
        'description'   => __('Sidebar, Дъщерната тема.', 'pizza-child'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'pizza_theme_child_add_sidebar');

?>