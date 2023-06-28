<?php

if (!defined( 'ABSPATH')) {
    exit;
}

/**
 * Display an error message if Elementor is not installed or activated.
 */
function button_hover_addon_failed_load() {
	$screen = get_current_screen();

	if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
		return;
	}

	$plugin = 'elementor/elementor.php';

	if (button_hover_effect_elementor_installed()) {
		if (!current_user_can('activate_plugins')) {
			return;
		}

		$activation_url = wp_nonce_url('plugins.php?action=activate&plugin=' . $plugin . '&plugin_status=all&paged=1&s', 'activate-plugin_' . $plugin );

		$message = '<p><strong>Button Hover Effects Elementor Addon</strong> requires Elementor to be activated.</p>';
		$message .= '<p><a href="' . esc_url($activation_url) . '" class="button-primary">Activate Elementor</a></p>';
	} else {
		if (!current_user_can('install_plugins')) {
			return;
		}

		$install_url = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'), 'install-plugin_elementor');

		$message = '<p><strong>Button Hover Effects Elementor Addon</strong> requires Elementor to be installed and activated.</p>';
		$message .= '<p><a href="' . esc_url($install_url) . '" class="button-primary">Install Elementor</a></p>';
	}

	echo '<div class="notice notice-error"><p>' . wp_kses_post($message) . '</p></div>';
}

/**
 * Display an error message if Elementor is not updated to the required version.
 */
function button_hover_addon_failed_outofdate() {
	if (!current_user_can('update_plugins')) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url(self_admin_url('update.php?action=upgrade-plugin&plugin=') . $file_path, 'upgrade-plugin_' . $file_path);

	$message = '<p><strong>Button Hover Effects Elementor Addon</strong> does not work since you are using an older version of Elementor.</p>';
	$message .= '<p><a href="' . esc_url($upgrade_link) . '" class="button-primary">Update Elementor</a></p>';

	echo '<div class="notice notice-error">' . wp_kses_post($message) . '</div>';
}


function button_hover_effect_elementor_installed() {
    $file_path = 'elementor/elementor.php';
    $installed_plugins = get_plugins();

    return isset($installed_plugins[$file_path]);
}
