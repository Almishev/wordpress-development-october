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


// Функция за обработка на AJAX заявка
/*
function save_newsletter_subscription() {
    global $wpdb;

    // Получаваме името и имейла от AJAX заявката
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);

    // Записваме новия абонат в базата данни
    $wpdb->insert(
       'su_newsletter_subscribers',
        array(
            'name' => $name,
            'email' => $email,
            'subscribed_at' => current_time('mysql')
        )
    );

    wp_send_json_success(array('message' => 'Абонирането е успешно!'));
}

add_action('wp_ajax_save_newsletter_subscription', 'save_newsletter_subscription');
add_action('wp_ajax_nopriv_save_newsletter_subscription', 'save_newsletter_subscription');




// Добавяне на ново меню в админ панела
function add_newsletter_admin_menu() {
    add_menu_page(
        'Абонати на бюлетина', // Заглавие на страницата
        'Абонати на бюлетина', // Заглавие на менюто
        'manage_options', // Права за достъп
        'newsletter-subscribers', // Славата на страницата
        'display_newsletter_subscribers', // Функция за показване на съдържанието
        'dashicons-email-alt', // Икона на менюто
        30 // Позиция в менюто
    );
}
add_action('admin_menu', 'add_newsletter_admin_menu');

// Функция за показване на списък с абонати
function display_newsletter_subscribers() {
    global $wpdb;
    
    // Получаваме всички абонати от таблицата (използваме правилния синтаксис за името на таблицата)


    $subscribers = $wpdb->get_results("SELECT * FROM su_newsletter_subscribers");

    // Ако няма абонати
    if (empty($subscribers)) {
        echo '<div class="notice notice-warning is-dismissible"><p>Няма абонати.</p></div>';
        return;
    }

    // Показваме списъка с абонати в таблица
    echo '<div class="wrap">';
    echo '<h1 class="wp-heading-inline">Абонати на бюлетина</h1>';
    echo '<table class="wp-list-table widefat fixed striped table-view-list posts">';
    echo '<thead><tr><th>ID</th><th>Име</th><th>Имейл</th><th>Дата на абонамент</th></tr></thead>';
    echo '<tbody>';

    foreach ($subscribers as $subscriber) {
        echo '<tr>';
        echo '<td>' . esc_html($subscriber->id) . '</td>';
        echo '<td>' . esc_html($subscriber->name) . '</td>';
        echo '<td>' . esc_html($subscriber->email) . '</td>';
        echo '<td>' . esc_html($subscriber->subscribed_at) . '</td>';
        echo '</tr>';
    }

    echo '</tbody></table>';
    echo '</div>';
}


*/
?>
