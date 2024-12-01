<?php

class Restaurant_Booking_Settings {

public static function init() {
    add_action('admin_menu', array(__CLASS__, 'add_admin_menu'));
}

public static function add_admin_menu() {
    add_menu_page(
        'Restaurant Booking Settings',
        'Restaurant Booking',
        'manage_options',
        'restaurant-booking-settings',
        array(__CLASS__, 'settings_page'),
        'dashicons-admin-generic',
        7
    );
    add_submenu_page(
        'restaurant-booking-settings',
        'All Reservations',
        'All Reservations',
        'manage_options',
        'restaurant-all-reservations',
        array(__CLASS__, 'all_reservations_page')
    );
}

public static function settings_page() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        update_option('restaurant_tables_lunch', intval($_POST['lunch_tables']));
        update_option('restaurant_tables_dinner', intval($_POST['dinner_tables']));
    }

    $lunch_tables = get_option('restaurant_tables_lunch', 10);
    $dinner_tables = get_option('restaurant_tables_dinner', 10);
    ?>
    <div class="wrap">
        <h1>Restaurant Booking Settings</h1>
        <form method="POST">
            <label for="lunch_tables">Available tables for Lunch:</label>
            <input type="number" name="lunch_tables" value="<?php echo $lunch_tables; ?>" required><br><br>
            <label for="dinner_tables">Available tables for Dinner:</label>
            <input type="number" name="dinner_tables" value="<?php echo $dinner_tables; ?>" required><br><br>
            <input type="submit" value="Save Settings" class="button">
        </form>
    </div>
    <?php
}

public static function all_reservations_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'restaurant_bookings';
    $bookings = $wpdb->get_results("SELECT * FROM $table_name");
    ?>
    <div class="wrap">
        <h1>All Reservations</h1>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Meal</th>
                    <th>Guests</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo esc_html($booking->id); ?></td>
                        <td><?php echo esc_html($booking->name); ?></td>
                        <td><?php echo esc_html($booking->email); ?></td>
                        <td><?php echo esc_html($booking->phone); ?></td>
                        <td><?php echo esc_html($booking->date); ?></td>
                        <td><?php echo esc_html($booking->meal); ?></td>
                        <td><?php echo esc_html($booking->guests); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
}
}
