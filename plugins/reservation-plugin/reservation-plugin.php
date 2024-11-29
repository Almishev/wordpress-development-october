<?php
/*
Plugin Name: Reservations for a Restaurant
Description: Plugin for making reservations.
Version: 1.0
Author: Pirin Pixel
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define('RESERVATION_PLUGIN_URL', plugin_dir_url( __FILE__ ));

require_once plugin_dir_path( __FILE__ ) . 'class-reservation.php';

function reservation_plugin_init() {
    $reservation = new Reservation();
    $reservation->init();
}

add_action( 'init', 'reservation_plugin_init' );

// Добавяне на nonce към формата за резервации
function add_reservation_nonce() {
    ?>
    <input type="hidden" id="reservation_nonce_field" name="reservation_nonce_field" value="<?php echo wp_create_nonce( 'reservation_nonce' ); ?>" />
    <?php
}

add_action( 'wp_footer', 'add_reservation_nonce' );

// Добавяне на настройките и менюто за резервации
function reservation_plugin_menu() {
    // Основната страница за настройки
    add_menu_page(
        'Настройки на резервации',        // Заглавие на страницата
        'Резервации',                     // Заглавие на менюто
        'manage_options',                 // Права за достъп
        'reservation_plugin',             // Slug
        'reservation_plugin_settings_page', // Функцията за показване на страницата
        'dashicons-calendar-alt'          // Иконка на менюто (Dashicons)
    );

    // Подменю за таблица с резервации
    add_submenu_page(
        'reservation_plugin',             // Родителския елемент
        'Таблица с резервации',          // Заглавие на страницата
        'Резервации',                    // Заглавие на подменюто
        'manage_options',                 // Права за достъп
        'reservation_table',              // Slug на подменюто
        'reservation_plugin_reservation_table' // Функцията за показване на таблицата
    );
}

add_action( 'admin_menu', 'reservation_plugin_menu' );

// Функцията за показване на таблицата с резервации
function reservation_plugin_reservation_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'reservations';
    
    // Извличаме всички резервации от базата данни
    $reservations = $wpdb->get_results( "SELECT * FROM $table_name" );
    
    echo '<div class="wrap"><h1>Таблица с резервации</h1>';
    
    if ($reservations) {
        echo '<table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>Име</th>
                        <th>Имейл</th>
                        <th>Телефон</th>
                        <th>Дата</th>
                        <th>Час на пристигане</th>
                        <th>Хранене</th>
                    </tr>
                </thead>
                <tbody>';
                
        foreach ($reservations as $reservation) {
            echo '<tr>
                    <td>' . esc_html($reservation->name) . '</td>
                    <td>' . esc_html($reservation->email) . '</td>
                    <td>' . esc_html($reservation->phone) . '</td>
                    <td>' . esc_html($reservation->date) . '</td>
                    <td>' . esc_html($reservation->arrival_time) . '</td>
                    <td>' . esc_html($reservation->meal) . '</td>
                  </tr>';
        }

        echo '</tbody></table>';
    } else {
        echo '<p>Няма резервации.</p>';
    }

    echo '</div>';
}
?>
