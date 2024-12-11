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

function register_services_sidebar() {
    register_sidebar(array(
        'name'          => __('Services Sidebar', 'pizza'),
        'id'            => 'services-sidebar',
        'description'   => __('Sidebar за услуги', 'pizza'),
        'before_widget' => '<div class="services-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'register_services_sidebar');



function pizza_footer_customizer($wp_customize) {
    $wp_customize->add_section('pizza_footer_section', array(
        'title'    => __('Footer Settings', 'pizza-theme'),
        'priority' => 120,
    ));

    $wp_customize->add_setting('pizza_footer_text', array(
        'default'   => __('© Developed by PirinPixel', 'pizza-theme'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('pizza_footer_text_control', array(
        'label'    => __('Footer Text', 'pizza-theme'),
        'section'  => 'pizza_footer_section',
        'settings' => 'pizza_footer_text',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('pizza_facebook_url', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('pizza_facebook_url_control', array(
        'label'    => __('Facebook URL', 'pizza-theme'),
        'section'  => 'pizza_footer_section',
        'settings' => 'pizza_facebook_url',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('pizza_linkedin_url', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('pizza_linkedin_url_control', array(
        'label'    => __('LinkedIn URL', 'pizza-theme'),
        'section'  => 'pizza_footer_section',
        'settings' => 'pizza_linkedin_url',
        'type'     => 'url',
    ));

    $wp_customize->add_setting('pizza_instagram_url', array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('pizza_instagram_url_control', array(
        'label'    => __('Instagram URL', 'pizza-theme'),
        'section'  => 'pizza_footer_section',
        'settings' => 'pizza_instagram_url',
        'type'     => 'url',
    ));
    
    
    
}
add_action('customize_register', 'pizza_footer_customizer');

function load_boxicons() {
    wp_enqueue_style('boxicons', 'https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css', array(), null);
}
add_action('wp_enqueue_scripts', 'load_boxicons');


// Добавяне на персонализирани настройки за секцията "About" в Customizer
function custom_customize_register($wp_customize) {
    // Настройка за заглавие на секция "About"
    $wp_customize->add_section('about_section', array(
        'title'    => __('About Section', 'your-theme'),
        'priority' => 30,
    ));

    // Добавяне на поле за заглавие
    $wp_customize->add_setting('about_section_title', array(
        'default'   => 'The Delicious Food For a Good Mood',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('about_section_title', array(
        'label'    => __('About Section Title', 'your-theme'),
        'section'  => 'about_section',
        'type'     => 'text',
    ));

    // Добавяне на поле за текст в секция "About"
    $wp_customize->add_setting('about_section_text', array(
        'default'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque, ipsum?',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('about_section_text', array(
        'label'    => __('About Section Text', 'your-theme'),
        'section'  => 'about_section',
        'type'     => 'textarea',
    ));

    // Добавяне на поле за изображение
    $wp_customize->add_setting('about_section_image', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'about_section_image', array(
        'label'    => __('About Section Image', 'your-theme'),
        'section'  => 'about_section',
        'settings' => 'about_section_image',
    )));

    $wp_customize->add_setting('about_section_button_text', array(
        'default'   => '0877382224',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('about_section_button_text', array(
        'label'    => __('About Section Button Text', 'your-theme'),
        'section'  => 'about_section',
        'type'     => 'text',
    ));
}
add_action('customize_register', 'custom_customize_register');


function pizza_customize_register($wp_customize) {
    // Заглавие на секцията
    $wp_customize->add_section('pizza_home_section', array(
        'title' => __('Home Section', 'pizza'),
        'priority' => 30,
    ));

    // Заглавие
    $wp_customize->add_setting('pizza_home_title', array(
        'default' => 'Най-вкусната пица в града,само от пресни продукти!',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('pizza_home_title', array(
        'label' => __('Home Title', 'pizza'),
        'section' => 'pizza_home_section',
        'type' => 'text',
    ));

    
    $wp_customize->add_setting('pizza_home_description', array(
        'default' => 'Опитайте разликата! Нашите пици са изработени с грижа от най-качествени и пресни съставки. Всяка хапка е взрив от аромат и вкус.',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('pizza_home_description', array(
        'label' => __('Home Description', 'pizza'),
        'section' => 'pizza_home_section',
        'type' => 'textarea',
    ));

    
    $wp_customize->add_setting('pizza_home_phone', array(
        'default' => '0877-382-224',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('pizza_home_phone', array(
        'label' => __('Phone Number', 'pizza'),
        'section' => 'pizza_home_section',
        'type' => 'text',
    ));

    
    $wp_customize->add_setting('pizza_home_image', array(
        'default' => get_template_directory_uri() . '/img/home.png',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pizza_home_image', array(
        'label' => __('Home Image', 'pizza'),
        'section' => 'pizza_home_section',
        'settings' => 'pizza_home_image',
    )));

    
       $wp_customize->add_section('pizza_ingredients_section', array(
        'title' => __('Ingredients Section', 'pizza'),
        'priority' => 35,
    ));

    
    $wp_customize->add_setting('pizza_ingredients_title', array(
        'default' => 'Съставките, които правят разликата',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('pizza_ingredients_title', array(
        'label' => __('Ingredients Title', 'pizza'),
        'section' => 'pizza_ingredients_section',
        'type' => 'text',
    ));

    // Описание
    $wp_customize->add_setting('pizza_ingredients_description', array(
        'default' => 'Съставки, които разказват история. Всяка хапка е пътешествие през вкусовете на юго-запад.',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('pizza_ingredients_description', array(
        'label' => __('Ingredients Description', 'pizza'),
        'section' => 'pizza_ingredients_section',
        'type' => 'textarea',
    ));

    // Съставка 1
    $wp_customize->add_setting('pizza_ingredient_1_text', array(
        'default' => 'Нежно тесто, приготвено от отбрано брашно и кристална вода',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('pizza_ingredient_1_text', array(
        'label' => __('Ingredient 1 Text', 'pizza'),
        'section' => 'pizza_ingredients_section',
        'type' => 'text',
    ));
    $wp_customize->add_setting('pizza_ingredient_1_image', array(
        'default' => get_template_directory_uri() . '/img/b1.png',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pizza_ingredient_1_image', array(
        'label' => __('Ingredient 1 Image', 'pizza'),
        'section' => 'pizza_ingredients_section',
        'settings' => 'pizza_ingredient_1_image',
    )));

    // Съставка 2
    $wp_customize->add_setting('pizza_ingredient_2_text', array(
        'default' => 'Розови домати, от градината на местни фермери, със запазен вкус на българското.',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('pizza_ingredient_2_text', array(
        'label' => __('Ingredient 2 Text', 'pizza'),
        'section' => 'pizza_ingredients_section',
        'type' => 'text',
    ));
    $wp_customize->add_setting('pizza_ingredient_2_image', array(
        'default' => get_template_directory_uri() . '/img/b2.png',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pizza_ingredient_2_image', array(
        'label' => __('Ingredient 2 Image', 'pizza'),
        'section' => 'pizza_ingredients_section',
        'settings' => 'pizza_ingredient_2_image',
    )));

    // Съставка 3
    $wp_customize->add_setting('pizza_ingredient_3_text', array(
        'default' => 'Българско прясно сирене, внимателно обезбактеризирано за вас.',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('pizza_ingredient_3_text', array(
        'label' => __('Ingredient 3 Text', 'pizza'),
        'section' => 'pizza_ingredients_section',
        'type' => 'text',
    ));
    $wp_customize->add_setting('pizza_ingredient_3_image', array(
        'default' => get_template_directory_uri() . '/img/b3.png',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pizza_ingredient_3_image', array(
        'label' => __('Ingredient 3 Image', 'pizza'),
        'section' => 'pizza_ingredients_section',
        'settings' => 'pizza_ingredient_3_image',
    )));

    // Съставка 4
    $wp_customize->add_setting('pizza_ingredient_4_text', array(
        'default' => 'Свинско чоризо, от животни на фермерите в региона подбрано за вас, опитайте и оценете.',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('pizza_ingredient_4_text', array(
        'label' => __('Ingredient 4 Text', 'pizza'),
        'section' => 'pizza_ingredients_section',
        'type' => 'text',
    ));
    $wp_customize->add_setting('pizza_ingredient_4_image', array(
        'default' => get_template_directory_uri() . '/img/b4.png',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'pizza_ingredient_4_image', array(
        'label' => __('Ingredient 4 Image', 'pizza'),
        'section' => 'pizza_ingredients_section',
        'settings' => 'pizza_ingredient_4_image',
    )));
}
add_action('customize_register', 'pizza_customize_register');



function customize_phone_number($wp_customize) {
    $wp_customize->add_section('contact_section', array(
        'title' => __('Contact Information', 'theme_text_domain'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('phone_number', array(
        'default' => '+359877382224',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('phone_number', array(
        'label' => __('Phone Number', 'theme_text_domain'),
        'section' => 'contact_section',
        'settings' => 'phone_number',
        'type' => 'text',
    ));
}
add_action('customize_register', 'customize_phone_number');




?>
