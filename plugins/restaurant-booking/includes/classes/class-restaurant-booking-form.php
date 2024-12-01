<?php

class Restaurant_Booking_Form {

    public static function init() {
        add_shortcode('restaurant_booking_form', array(__CLASS__, 'display_booking_form'));
    }

    public static function display_booking_form() {
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

                    if ($meal == 'lunch') {
                        $existing_reservations = Restaurant_Booking_DB::get_existing_reservations($date, 'lunch');
                        if ($existing_reservations >= $available_lunch_tables) {
                            echo 'Няма налични маси за обяд на тази дата.';
                        }
                    } elseif ($meal == 'dinner') {
                        $existing_reservations = Restaurant_Booking_DB::get_existing_reservations($date, 'dinner');
                        if ($existing_reservations >= $available_dinner_tables) {
                            echo 'Няма налични маси за вечеря на тази дата.';
                        }
                    }
                    ?>
                </p>
                <label for="guests">Брой гости:</label>
                <input type="number" name="guests" required>
                <input type="submit" value="Резервирай">
            </form>
        </div>
        <?php
        return ob_get_clean();
    }
}
