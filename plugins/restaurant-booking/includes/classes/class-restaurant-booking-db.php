<?php

class Restaurant_Booking_DB {

public static function install() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'restaurant_bookings';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        email text NOT NULL,
        phone text NOT NULL,
        date date NOT NULL,
        meal text NOT NULL,
        guests smallint NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

public static function get_existing_reservations($date, $meal) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'restaurant_bookings';
    return $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE date = %s AND meal = %s", 
        $date, $meal
    ));
}

public static function insert_booking($data) {
    global $wpdb;
    $table_name = $wpdb->prefix . 'restaurant_bookings';
    return $wpdb->insert($table_name, $data);
}
}
