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


function restaurant_booking_enqueue_styles() {
    wp_enqueue_style('restaurant-booking-style', plugin_dir_url(__FILE__) . 'includes/css/style.css');
}
add_action('wp_enqueue_scripts', 'restaurant_booking_enqueue_styles');

Restaurant_Booking_Settings::init();
Restaurant_Booking_DB::install();
Restaurant_Booking_Form::init();
Restaurant_Booking::handle_booking();
