<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://sopu.live
 * @since             1.0.0
 * @package           Button_Hover_Effects_Elementor
 *
 * @wordpress-plugin
 * Plugin Name:       Button Hover Effects Elementor Addons
 * Plugin URI:        https://sopu.live
 * Description:       Add creative button hover effects to Elementor page builder. Easily customize button name and effects with intuitive interface.
 * Version:           1.0.0
 * Author:            Saif
 * Author URI:        https://sopu.live
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       button-hover-effects-elementor
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
define( 'BUTTON_HOVER_EFFECTS_ELEMENTOR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-button-hover-effects-elementor-activator.php
 */
function activate_button_hover_effects_elementor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-button-hover-effects-elementor-activator.php';
	Button_Hover_Effects_Elementor_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-button-hover-effects-elementor-deactivator.php
 */
function deactivate_button_hover_effects_elementor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-button-hover-effects-elementor-deactivator.php';
	Button_Hover_Effects_Elementor_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_button_hover_effects_elementor' );
register_deactivation_hook( __FILE__, 'deactivate_button_hover_effects_elementor' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-button-hover-effects-elementor.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_button_hover_effects_elementor() {

	$plugin = new Button_Hover_Effects_Elementor();
	$plugin->run();

}
run_button_hover_effects_elementor();
