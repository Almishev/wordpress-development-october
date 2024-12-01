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

// Add settings page in the admin menu
add_action('admin_menu', 'restaurant_booking_admin_menu');
function restaurant_booking_admin_menu() {
    add_menu_page(
        'Restaurant Booking Settings',
        'Restaurant Booking',
        'manage_options',
        'restaurant-booking-settings',
        'restaurant_booking_settings_page',
        'dashicons-admin-generic',
        7
    );


    add_submenu_page(
        'restaurant-booking-settings',
        'All Reservations',
        'All Reservations',
        'manage_options',
        'restaurant-all-reservations',
        'restaurant_booking_all_page'
    );
}

// Display the settings page
function restaurant_booking_settings_page() {
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


// Database setup
function restaurant_booking_install() {
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
register_activation_hook(__FILE__, 'restaurant_booking_install');

function restaurant_save_booking() {
    global $wpdb;

    // Get available tables for lunch and dinner
    $available_lunch_tables = get_option('restaurant_tables_lunch', 10);
    $available_dinner_tables = get_option('restaurant_tables_dinner', 10);

    // Get the booking data

    $meal = sanitize_text_field($_POST['meal']);
if ($meal !== 'lunch' && $meal !== 'dinner') {
    echo '<p>Моля, изберете обяд или вечеря.</p>';
    return;
}

    $date = sanitize_text_field($_POST['date']);

    
    $table_name = $wpdb->prefix . 'restaurant_bookings';
    $existing_reservations = $wpdb->get_var($wpdb->prepare(
        "SELECT COUNT(*) FROM $table_name WHERE date = %s AND meal = %s", 
        $date, $meal
    ));


    if ($meal == 'lunch' && $existing_reservations >= $available_lunch_tables) {
        echo '<p>Извиняваме се, но няма налични маси за обяд на тази дата.</p>';
        return;
    } elseif ($meal == 'dinner' && $existing_reservations >= $available_dinner_tables) {
        echo '<p>Извиняваме се, но няма налични маси за вечеря на тази дата.</p>';
        return;
    }

    
    $data = [
        'name' => sanitize_text_field($_POST['name']),
        'email' => sanitize_email($_POST['email']),
        'phone' => sanitize_text_field($_POST['phone']),
        'date' => $date,
        'meal' => $meal,
        'guests' => intval($_POST['guests']),
    ];

    $wpdb->insert($table_name, $data);
    echo '<p>Благодарим ви за вашата резервация!</p>';
}


function restaurant_booking_all_page() {
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

// Booking form shortcode
function restaurant_booking_shortcode() {
    global $wpdb;
    ob_start();

    $available_lunch_tables = get_option('restaurant_tables_lunch', 10);
    $available_dinner_tables = get_option('restaurant_tables_dinner', 10);
    ?>
    <div class="restaurant-booking-form">
        <form method="POST" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="restaurant_save_booking">
            
            <label for="name">Име:</label>
            <input type="text" name="name" required>
            
            <label for="email">Имейл:</label>
            <input type="email" name="email" required>
            
            <label for="phone">Телефон:</label>
            <input type="text" name="phone" required>
            
            <label for="date">Дата:</label>
            <input type="date" name="date" required>

            <label for="meal">Моля, изберете:</label>
<select id="meal" name="meal" required>
    <option value="" disabled selected>Изберете</option>
    <option value="lunch">Обяд</option>
    <option value="dinner">Вечеря</option>
</select>


            
            <p>
    <?php
    $meal = isset($_POST['meal']) ? sanitize_text_field($_POST['meal']) : '';
    $date = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : '';

    // Display table availability
    if ($meal == 'lunch') {
        $existing_reservations = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}restaurant_bookings WHERE date = %s AND meal = %s", 
            $date, 'lunch'
        ));
        if ($existing_reservations >= $available_lunch_tables) {
            echo 'Няма налични маси за обяд на избраната дата.';
        } else {
            echo 'Оставащи маси за обяд: ' . ($available_lunch_tables - $existing_reservations);
        }
    } elseif ($meal == 'dinner') {
        $existing_reservations = $wpdb->get_var($wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->prefix}restaurant_bookings WHERE date = %s AND meal = %s", 
            $date, 'dinner'
        ));
        if ($existing_reservations >= $available_dinner_tables) {
            echo 'Няма налични маси за вечеря на избраната дата.';
        } else {
            echo 'Оставащи маси за вечеря: ' . ($available_dinner_tables - $existing_reservations);
        }
    }
    ?>
</p>

            
            <label for="guests">Гости:</label>
            <input type="number" name="guests" required>
            
            <input type="submit" name="submit_booking" value="Резервирай" class="button">
        </form>
    </div>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_booking'])) {
        restaurant_save_booking();
        echo '<p>Благодарим ви за вашата резервация!</p>';
    }
    return ob_get_clean();
}
add_shortcode('restaurant_booking_form', 'restaurant_booking_shortcode');

// Enqueue styles
function restaurant_booking_enqueue_styles() {
    wp_enqueue_style(
        'restaurant-booking-style', 
        plugin_dir_url(__FILE__) . 'css/style.css', 
        array(),
        '1.0', 
        'all' 
    );
}
add_action('wp_enqueue_scripts', 'restaurant_booking_enqueue_styles');

// Handlers for logged-in and guest users
add_action('admin_post_restaurant_save_booking', 'restaurant_save_booking_handler');
add_action('admin_post_nopriv_restaurant_save_booking', 'restaurant_save_booking_handler');

function restaurant_save_booking_handler() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $is_booking_successful = restaurant_save_booking();

        if ($is_booking_successful) {
            wp_redirect(home_url('/thanks')); 
        } else {
            wp_redirect(home_url('/no-tables-available')); 
        }
        exit;
    }
}

