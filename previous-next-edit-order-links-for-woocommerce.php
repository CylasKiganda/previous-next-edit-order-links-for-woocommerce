<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://fmh
 * @since             1.0.0
 * @package           Previous_Next_Edit_Order_Links_For_Woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Previous Next Edit Order Links for Woocommerce
 * Plugin URI:        https://dev.dev
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Belo
 * Author URI:        https://fmh
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       previous-next-edit-order-links-for-woocommerce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PREVIOUS_NEXT_EDIT_ORDER_LINKS_FOR_WOOCOMMERCE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-previous-next-edit-order-links-for-woocommerce-activator.php
 */
function activate_previous_next_edit_order_links_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-previous-next-edit-order-links-for-woocommerce-activator.php';
	Previous_Next_Edit_Order_Links_For_Woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-previous-next-edit-order-links-for-woocommerce-deactivator.php
 */
function deactivate_previous_next_edit_order_links_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-previous-next-edit-order-links-for-woocommerce-deactivator.php';
	Previous_Next_Edit_Order_Links_For_Woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_previous_next_edit_order_links_for_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_previous_next_edit_order_links_for_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-previous-next-edit-order-links-for-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_previous_next_edit_order_links_for_woocommerce() {

	$plugin = new Previous_Next_Edit_Order_Links_For_Woocommerce();
	$plugin->run();

}
run_previous_next_edit_order_links_for_woocommerce();
