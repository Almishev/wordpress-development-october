<?php

class Reservation {

    public function init() {
        register_activation_hook(__FILE__, array($this, 'create_reservation_table'));
        add_shortcode('reservation_form', array($this, 'reservation_form'));
        add_action('wp_ajax_save_reservation', array($this, 'save_reservation'));
        add_action('wp_ajax_nopriv_save_reservation', array($this, 'save_reservation'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
    }

    public function create_reservation_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'reservations';
        $charset_collate = $wpdb->get_charset_collate();

        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $sql = "CREATE TABLE IF NOT EXISTS $table_name (
                id INT NOT NULL AUTO_INCREMENT,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(255) NOT NULL,
                date DATE NOT NULL,
                meal ENUM('lunch', 'dinner') NOT NULL,
                arrival_time TIME NOT NULL,
                PRIMARY KEY (id)
            ) $charset_collate;";

            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
            dbDelta($sql);
        }
    }

    public function enqueue_scripts() {
        wp_enqueue_script('reservation-js', RESERVATION_PLUGIN_URL . 'js/reservation.js', array('jquery'), '1.0', true);
        wp_enqueue_style('reservation-css', RESERVATION_PLUGIN_URL . 'css/style.css');
    }

    public function reservation_form() {
        ob_start();

        global $wpdb;
        $table_name = $wpdb->prefix . 'reservations';
        $date = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : '';
        $meal = isset($_POST['meal']) ? sanitize_text_field($_POST['meal']) : '';

        $reserved_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE date = %s AND meal = %s", $date, $meal));
        $available_tables = get_option('restaurant_table_count') - $reserved_count;

        if ($available_tables > 0) {
            ?>
            <form id="reservation-form" method="POST">
                <?php wp_nonce_field('reservation_nonce_action', 'reservation_nonce_field'); ?>
                <label for="date">Изберете дата:</label><br>
                <input type="date" id="date" name="date" required><br><br>

                <label for="meal">Изберете хранене:</label><br>
                <select name="meal" id="meal">
                    <option value="lunch">Обяд</option>
                    <option value="dinner">Вечеря</option>
                </select><br><br>

                <label for="arrival_time">Час на пристигане:</label><br>
                <input type="time" id="arrival_time" name="arrival_time" required><br><br>
                <button type="submit">Резервирай маса</button>
            </form>
            <?php
        } else {
            echo '<p>Няма свободни места за избраната дата и час.</p>';
        }

        return ob_get_clean();
    }

    public function save_reservation() {
        if (!isset($_POST['reservation_nonce_field']) || !wp_verify_nonce($_POST['reservation_nonce_field'], 'reservation_nonce_action')) {
            wp_send_json_error(array('message' => 'Не е позволено!'));
        }

        global $wpdb;
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        $date = sanitize_text_field($_POST['date']);
        $meal = sanitize_text_field($_POST['meal']);
        $arrival_time = sanitize_text_field($_POST['arrival_time']);

        $table_name = $wpdb->prefix . 'reservations';
        $reserved_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE date = %s AND meal = %s", $date, $meal));

        $available_tables = get_option('restaurant_table_count') - $reserved_count;

        if ($available_tables > 0) {
            $wpdb->insert(
                $table_name,
                array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'date' => $date,
                    'meal' => $meal,
                    'arrival_time' => $arrival_time
                )
            );

            wp_send_json_success(array('message' => 'Резервацията е успешна!'));
        } else {
            wp_send_json_error(array('message' => 'Няма свободни места за избраната дата и тип хранене.'));
        }
    }
}

$reservation_plugin = new Reservation();
$reservation_plugin->init();

?>
