<?php
class Restaurant_Booking {

public static function handle_booking() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        // Проверка и обработка на "meal" и "date"
$meal = isset($_POST['meal']) ? sanitize_text_field($_POST['meal']) : '';  // Проверка за meal
$date = isset($_POST['date']) ? sanitize_text_field($_POST['date']) : '';  // Проверка за date

// След това използвайте тези променливи в SQL заявките или обработката

        $available_lunch_tables = get_option('restaurant_tables_lunch', 10);
        $available_dinner_tables = get_option('restaurant_tables_dinner', 10);

        if ($meal !== 'lunch' && $meal !== 'dinner') {
            echo '<p>Моля, изберете обяд или вечеря.</p>';
            return;
        }

        $existing_reservations = Restaurant_Booking_DB::get_existing_reservations($date, $meal);

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

        Restaurant_Booking_DB::insert_booking($data);
        echo '<p>Благодарим ви за вашата резервация!</p>';
    }
}
}
