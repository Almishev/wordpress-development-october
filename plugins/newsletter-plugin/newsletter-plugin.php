<?php
/**
 * Plugin Name: Newsletter Plugin
 * Description: Collecting emails for email marketing plugin.
 * Version: 1.0
 * Author: Pirin Pixel
 */

// Зареждане на AJAX и JavaScript
function newsletter_enqueue_scripts() {
    wp_enqueue_script('newsletter-scripts', plugin_dir_url(__FILE__) . 'newsletter.js', array('jquery'), null, true);
    wp_localize_script('newsletter-scripts', 'newsletter_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'newsletter_enqueue_scripts');

// Обработка на AJAX заявката
function save_newsletter_subscription() {
    global $wpdb;

    // Получаваме името и имейла от AJAX заявката
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);

    // Проверка дали вече съществува този имейл
    $table_name = $wpdb->prefix . 'newsletter_subscribers';
    $existing = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $table_name WHERE email = %s", $email));

    if ($existing > 0) {
        wp_send_json_error(array('message' => 'Този имейл вече е абониран.'));
    } else {
        // Записваме новия абонат в базата данни
        $wpdb->insert(
            $table_name,
            array(
                'name' => $name,
                'email' => $email,
                'subscribed_at' => current_time('mysql')
            )
        );
        wp_send_json_success(array('message' => 'Благодарим ви за абонамента!'));
    }
}
add_action('wp_ajax_save_newsletter_subscription', 'save_newsletter_subscription');
add_action('wp_ajax_nopriv_save_newsletter_subscription', 'save_newsletter_subscription');

// Създаване на таблицата в базата данни
function create_newsletter_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            email varchar(100) NOT NULL,
            subscribed_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }
}
register_activation_hook(__FILE__, 'create_newsletter_table');

// Административна страница
function add_newsletter_admin_menu() {
    add_menu_page(
        'Абонати на бюлетина',
        'Абонати',
        'manage_options',
        'newsletter-subscribers',
        'display_newsletter_subscribers',
        'dashicons-email-alt',
        30
    );
}
add_action('admin_menu', 'add_newsletter_admin_menu');

function display_newsletter_subscribers() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'newsletter_subscribers';

    $subscribers = $wpdb->get_results("SELECT * FROM $table_name");

    echo '<div class="wrap"><h1>Абонати</h1>';
    if (empty($subscribers)) {
        echo '<p>Няма абонати.</p>';
        return;
    }

    echo '<table class="widefat fixed"><thead><tr><th>ID</th><th>Име</th><th>Имейл</th><th>Дата</th></tr></thead><tbody>';
    foreach ($subscribers as $subscriber) {
        echo '<tr>';
        echo '<td>' . esc_html($subscriber->id) . '</td>';
        echo '<td>' . esc_html($subscriber->name) . '</td>';
        echo '<td>' . esc_html($subscriber->email) . '</td>';
        echo '<td>' . esc_html($subscriber->subscribed_at) . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table></div>';
}


// Създаване на shortcode за формата
function newsletter_subscription_form_shortcode() {
    ob_start();
    ?>
    <form id="email-form" method="POST">
        <label for="name">Име:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Имейл:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Абонирай се</button>
        <p id="response-message" style="color: green; margin-top: 10px;"></p>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('newsletter_form', 'newsletter_subscription_form_shortcode');


// Зареждане на CSS стилове
function newsletter_enqueue_styles() {
    wp_enqueue_style('newsletter-styles', plugin_dir_url(__FILE__) . 'newsletter.css');
}
add_action('wp_enqueue_scripts', 'newsletter_enqueue_styles');


?>


