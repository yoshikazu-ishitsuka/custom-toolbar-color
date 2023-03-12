<?php
/*
Plugin Name: Custom Toolbar Color
Version: 1.0.0
Plugin URI:
Description: Change the background color of the WordPress toolbar.
Author: yoshikazu0307
Licence: GPL v2 or later
Licence URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

if (!defined('ABSPATH')) exit;

add_action('admin_menu', 'custom_toolbar_color_menu');

add_action('admin_init', 'custom_toolbar_color_register_settings');

function custom_toolbar_color_menu()
{
    add_options_page('Custom Toolbar Color', 'Custom Toolbar Color', 'manage_options', 'custom-toolbar-color', 'custom_toolbar_color_settings_page');
}

function custom_toolbar_color_register_settings()
{
    register_setting('custom-toolbar-color-settings-group', 'custom_toolbar_color');
}

function custom_toolbar_color_settings_page()
{
?>
    <div class="wrap">
        <h2>Custom Toolbar Color</h2>
        <form method="post" action="options.php">
            <?php settings_fields('custom-toolbar-color-settings-group'); ?>
            <?php do_settings_sections('custom-toolbar-color-settings-group'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Toolbar Color</th>
                    <td><input type="text" name="custom_toolbar_color" value="<?php echo esc_attr(get_option('custom_toolbar_color')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php
}

function custom_toolbar_color()
{
    $toolbar_color = get_option('custom_toolbar_color');
    if (!empty($toolbar_color)) {
        echo '<style>
            #wpadminbar {
                background-color: ' . esc_attr($toolbar_color) . ' !important;
            }
        </style>';
    }
}
add_action('wp_head', 'custom_toolbar_color');
