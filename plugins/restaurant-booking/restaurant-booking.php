<?php
/**
 * Plugin Name: Restaurant Booking
 * Plugin URI: https://pirinpixel.com/
 * Description: A simple restaurant booking plugin.
 * Version: 1.1
 * Author: Anton Almishev
 * Author URI: https://pirinpixel.com/about
 * License: Lesson for SoftUni
 */

 if (!defined('ABSPATH')) {
    exit;
}

// Включване на класовете
require_once plugin_dir_path(__FILE__) . 'includes/classes/class-restaurant-booking-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/classes/class-restaurant-booking-db.php';
require_once plugin_dir_path(__FILE__) . 'includes/classes/class-restaurant-booking.php';
require_once plugin_dir_path(__FILE__) . 'includes/classes/class-restaurant-booking-form.php';


function restaurant_booking_create_pages() {
    
    $page_thanks = get_page_by_title('Thanks');
    $page_no_tables = get_page_by_title('No Tables Available');
    

    if (!$page_thanks) {
        $thanks_page = array(
            'post_title'    => 'Thanks',
            'post_content'  => 'Thank you for your booking! We look forward to serving you.',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1, 
        );
        wp_insert_post($thanks_page);
    }


    if (!$page_no_tables) {
        $no_tables_page = array(
            'post_title'    => 'No Tables Available',
            'post_content'  => 'Unfortunately, there are no tables available for your requested time. Please try again later.',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_author'   => 1, 
        );
        wp_insert_post($no_tables_page);
    }
}

register_activation_hook(__FILE__, 'restaurant_booking_create_pages');


function restaurant_booking_enqueue_styles() {
    wp_enqueue_style('restaurant-booking-style', plugin_dir_url(__FILE__) . 'includes/css/style.css');
    wp_enqueue_script('restaurant-booking-script', plugin_dir_url(__FILE__) . 'includes/js/scripts.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'restaurant_booking_enqueue_styles');


Restaurant_Booking_Settings::init();
Restaurant_Booking_DB::install();
Restaurant_Booking_Form::init();
Restaurant_Booking::handle_booking();
