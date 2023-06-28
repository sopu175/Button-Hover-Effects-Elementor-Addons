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
 * Description:       Add creative button hover effects to Elementor page builder. Easily customize button name and effects with typography.
 * Version:           1.0.0
 * Author:            Saif
 * Author URI:        https://link.sopu.live
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       button-hover-effects-elementor
 * Domain Path:       /languages
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BUTTON_HOVER_VERSION', '1.0.1' );
define( 'BUTTON_HOVER_MINIMUM_ELEMENTOR_VERSION', '2.6.0' );
define( 'BUTTON_HOVER_PATH', plugin_dir_path( __FILE__ ) );
define( 'BUTTON_HOVER_URL', plugin_dir_url( __FILE__ ) );

require_once BUTTON_HOVER_PATH . 'includes/elementor-checker.php';


class Button_Hover_Effects_Elementor {

	private static $_instance = null;

	public static function get_instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	public function init() {

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', 'button_hover_addon_failed_load' );

			return;
		}

		if ( ! version_compare( ELEMENTOR_VERSION, BUTTON_HOVER_MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'button_hover_addon_failed_outofdate' ] );

			return;
		}

		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'includes' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		add_action( 'upgrader_process_complete', [ $this, 'wp_upe_upgrade_completed' ], 10, 2 );
		add_action( 'admin_enqueue_scripts', [ $this, 'button_hover_scripts' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', function () {
			wp_register_style( 'button_hover-editor-css', BUTTON_HOVER_URL . 'assets/admin.css' );
			wp_enqueue_style( 'button_hover-editor-css' );
		} );
		add_action( 'admin_init', [ $this, 'display_notice' ] );
		load_plugin_textdomain( 'button_hover-lang', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$widgets['e_image_hover_effects'] = [
			'conditions' => [ 'widgetType' => 'e_button_hover_effects' ],
			'fields'     => [
				[
					'field'       => 'button_hover_title',
					'type'        => __( 'Image Hover Effects : Title', 'button_hover-lang' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'button_hover_description',
					'type'        => __( 'Image Hover Effects : Description', 'button_hover-lang' ),
					'editor_type' => 'LINE'
				],
			],
		];

		return $widgets;
	}

	public function button_hover_scripts() {
		wp_enqueue_style( 'button_hover-css', BUTTON_HOVER_URL . 'assets/css/admin.css', array(), BUTTON_HOVER_VERSION, 'all' );
		wp_enqueue_script( 'button_hover-common', BUTTON_HOVER_URL . 'assets/js/admin.js', array( 'jquery' ), BUTTON_HOVER_VERSION, true );
	}

	public function display_notice() {

		if ( isset( $_GET['button_hover_dismiss'] ) && $_GET['button_hover_dismiss'] == 1 ) {
			add_option( 'button_hover_dismiss', true );
		}

		$upgrade = get_option( 'button_hover_upgraded' );
		$dismiss = get_option( 'button_hover_dismiss' );

		if ( ! get_option( 'button_hover-top-notice' ) ) {
			add_option( 'button_hover-top-notice', strtotime( current_time( 'mysql' ) ) );
		}
		if ( get_option( 'button_hover-top-notice' ) && get_option( 'button_hover-top-notice' ) != 0 ) {
			if ( get_option( 'button_hover-top-notice' ) < strtotime( '-3 days' ) ) { //if greater than 3 days
				add_action( 'admin_notices', array( $this, 'button_hover_top_admin_notice' ) );
				add_action( 'wp_ajax_button_hover_top_notice', array( $this, 'button_hover_top_notice_dismiss' ) );
			}
		}
	}

	public function button_hover_top_notice_dismiss() {
		update_option( 'button_hover-top-notice', '0' );
		exit();
	}

	/**
	 * Display a notice to rate the plugin and provide an upgrade option.
	 */
	public function button_hover_top_admin_notice() {
		?>
        <div class="button_hover-notice notice notice-success is-dismissible">
            <img class="button_hover-iconimg" src="<?php echo esc_url( BUTTON_HOVER_URL . 'assets/icon.png' ); ?>"
                 style="float:left;"/>
            <p style="width:80%;"><?php _e( 'Enjoying our <strong>Button Hover Effects - Elementor Addon?</strong> We hope you liked it! If you feel this plugin helped you, You can give us a 5-star rating!<br>It will motivate us to serve you more!', 'button_hover-lang' ); ?> </p>
            <a href="https://sopu.live" class="button button-primary" style="margin-right: 10px !important;"
               target="_blank"><?php _e( 'Rate the Plugin!', 'button_hover-lang' ); ?> &#11088;&#11088;&#11088;&#11088;&#11088;</a>
            <a href="https://sopu.live" class="button button-secondary"
               target="_blank"><?php _e( 'Go Pro', 'button_hover-lang' ); ?></a>
            <span class="button_hover-done"><?php _e( 'Already Done', 'button_hover-lang' ); ?></span>
        </div>
		<?php
	}

	/**
	 * Perform actions after a plugin upgrade is completed.
	 *
	 * @param object $upgrader_object The Upgrader object.
	 * @param array $options The upgrade options.
	 */
	public function wp_upe_upgrade_completed( $upgrader_object, $options ) {
		$our_plugin = plugin_basename( __FILE__ );

		if ( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
			foreach ( $options['plugins'] as $plugin ) {
				if ( $plugin == $our_plugin ) {
					add_option( 'button_hover_upgraded', true );
				}
			}
		}
	}


	public function register_widgets() {
		require_once( BUTTON_HOVER_PATH . 'includes/widgets.php' );
	}

	public function includes() {
		wp_enqueue_style( 'button_hover-front-style', BUTTON_HOVER_URL . 'assets/css/style.css', array(), BUTTON_HOVER_VERSION );
	}

}

Button_Hover_Effects_Elementor::get_instance();

?>