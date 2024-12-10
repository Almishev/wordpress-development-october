<?php
/**
 * Plugin Name: Дневни преложения
 * Plugin URI: https://pirinpixel.com
 * Description: Плъгин за управление на пици като продукти в менюто.
 * Version: 1.0
 * Author: Антон Алмишев
 * Author URI: https://pirinpixel.com
 * License: GPL2
 */



// Регистриране на персонализиран тип запис за пици
function create_pizza_post_type() {
    register_post_type( 'pizza_item', 
        array(
            'labels' => array(
                'name' => 'Продукти Пици',
                'singular_name' => 'Продукт Пица',
                'add_new' => 'Добави нова',
                'add_new_item' => 'Добави нов продукт',
                'edit_item' => 'Редактирай продукт',
                'new_item' => 'Нов продукт',
                'view_item' => 'Прегледай продукта',
                'search_items' => 'Търси продукти',
                'not_found' => 'Не са намерени продукти',
                'not_found_in_trash' => 'Не са намерени продукти в кошчето',
                'parent_item_colon' => '',
                'all_items' => 'Всички продукти',
                'archives' => 'Архив на продуктите',
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'menu_position' => 5,
            'menu_icon' => 'dashicons-food',
            'show_in_rest' => true,
        )
    );
}
add_action( 'init', 'create_pizza_post_type' );

// Регистриране на мета полета за пиците (цена, описание)
function add_pizza_item_meta_box() {
    add_meta_box( 'pizza_item_details', 'Детайли на продукта', 'display_pizza_item_details', 'pizza_item', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'add_pizza_item_meta_box' );

// Извеждаме полетата за цена и описание
function display_pizza_item_details( $post ) {
    if ( $post->post_type != 'pizza_item' ) return;

    // Извличаме съществуващите стойности на полетата
    $price = get_post_meta( $post->ID, '_price', true );
    $description = get_post_meta( $post->ID, '_description', true );

    // Полета за цена и описание
    echo '<label for="price">Цена:</label>';
    echo '<input type="text" name="price" value="' . esc_attr( $price ) . '" class="widefat" />';

    echo '<label for="description">Описание:</label>';
    echo '<textarea name="description" class="widefat">' . esc_textarea( $description ) . '</textarea>';
}

// Записваме данните от персонализираните полета само за 'pizza_item'
function save_pizza_item_meta( $post_id ) {
    if ( get_post_type( $post_id ) != 'pizza_item' ) return;

    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    // Обновяване на цената
    if ( isset( $_POST['price'] ) ) {
        update_post_meta( $post_id, '_price', sanitize_text_field( $_POST['price'] ) );
    }

    // Обновяване на описанието
    if ( isset( $_POST['description'] ) ) {
        update_post_meta( $post_id, '_description', sanitize_textarea_field( $_POST['description'] ) );
    }
}
add_action( 'save_post', 'save_pizza_item_meta' );

// Добавяне на поддръжка за миниатюрни изображения
add_theme_support('post-thumbnails', array( 'pizza_item' ) );

// Задаване на размер за миниатюрите
add_image_size( 'pizza-thumbnail', 200, 150, true );

// Зареждане на CSS и JavaScript (ако е необходимо)
function pizza_menu_enqueue_scripts() {
    wp_enqueue_style('pizza-menu-style', plugin_dir_url( __FILE__ ) . 'css/style.css');
    wp_enqueue_script('pizza-menu-js', plugin_dir_url( __FILE__ ) . 'js/pizza-menu.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'pizza_menu_enqueue_scripts');


function pizza_daily_menu_section() {
    ?>
    <section class="menu" id="menu">
        <div class="main-text" style="text-align: center">
            <h2>Звездите за денят</h2>
            <p>Нашите дневни предложения<br> които готвачът подбра за вас</p>
        </div>

        <div class="menu-content">
            <?php
            $args = array(
                'post_type' => 'pizza_item',
                'posts_per_page' => -1
            );
            $menu_items = new WP_Query($args);

            if ($menu_items->have_posts()) :
                while ($menu_items->have_posts()) : $menu_items->the_post();
            ?>
                <div class="row">
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('pizza-thumbnail', array('alt' => get_the_title())); ?>
                        </a>
                    <?php endif; ?>
                    <div class="menu-text">
                        <div class="menu-left">
                            <h4>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h4>
                        </div>
                        <div class="menu-right">
                            <h5>
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo get_post_meta(get_the_ID(), '_price', true); ?> лв.
                                </a>
                            </h5>
                        </div>
                    </div>
                    <p>
                        <a href="<?php the_permalink(); ?>">
                            <?php echo get_post_meta(get_the_ID(), '_description', true); ?>
                        </a>
                    </p>
                    <div class="star">
                        <a href="<?php the_permalink(); ?>"><i class='bx bxs-star'></i></a>
                        <a href="<?php the_permalink(); ?>"><i class='bx bxs-star'></i></a>
                        <a href="<?php the_permalink(); ?>"><i class='bx bxs-star'></i></a>
                        <a href="<?php the_permalink(); ?>"><i class='bx bxs-star'></i></a>
                        <a href="<?php the_permalink(); ?>"><i class='bx bxs-star'></i></a>
                    </div>
                </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </section>
    <?php
}

// Хук за вмъкване на секцията "Daily Menu" в WordPress
add_action('display_daily_menu', 'pizza_daily_menu_section');
