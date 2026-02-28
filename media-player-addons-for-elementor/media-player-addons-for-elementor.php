<?php

/**
 * Plugin Name: Media Player Addons for Elementor – Audio and Video Widgets for Elementor
 * Plugin URI:  https://elementoraddons.org/media-player-addons/
 * Description: Collection of media players to plaback of various media files such as .mp3, .mp4, .flv, .m3u8, .ogg, YouTube, Vimeo and moe....
 * Version:     1.1.3
 * Author:      bPlugins LLC
 * Author URI:  https://bPlugins.com
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: media-player-addons-for-elementor
 * 
 */
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
// Exit if accessed directly
if ( function_exists( 'mpafe_fs' ) ) {
    mpafe_fs()->set_basename( false, __FILE__ );
} else {
    define( 'BMPA_VERSION', ( isset( $_SERVER['HTTP_HOST'] ) && 'localhost' === $_SERVER['HTTP_HOST'] ? time() : '1.1.3' ) );
    define( 'BMPA_DIR_URL', plugin_dir_url( __FILE__ ) );
    define( 'BMPA_DIR_PATH', plugin_dir_path( __FILE__ ) );
    define( 'MPAFE_HAS_PRO', plugin_basename( __FILE__ ) === "media-player-addons-for-elementor-pro/media-player-addons-for-elementor.php" );
    if ( !function_exists( 'mpafe_fs' ) ) {
        function mpafe_fs() {
            global $mpafe_fs;
            if ( !isset( $mpafe_fs ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $mpafe_fs = fs_dynamic_init( array(
                    'id'               => '20796',
                    'slug'             => 'media-player-addons-for-elementor',
                    'premium_slug'     => 'media-player-addons-for-elementor-pro',
                    'type'             => 'plugin',
                    'public_key'       => 'pk_83e08cd3a331120bb1ecaa8211496',
                    'is_premium'       => false,
                    'premium_suffix'   => 'Pro',
                    'has_addons'       => false,
                    'has_paid_plans'   => true,
                    'menu'             => array(
                        'slug'       => 'media-player-addons-for-elementor',
                        'first-path' => 'admin.php?page=media-player-addons-for-elementor',
                    ),
                    'is_live'          => true,
                    'is_org_compliant' => true,
                ) );
            }
            return $mpafe_fs;
        }

        // Init Freemius.
        mpafe_fs();
        // Signal that SDK was initiated.
        do_action( 'mpafe_fs_loaded' );
    }
    function mpafeIsPremium() {
        return ( MPAFE_HAS_PRO ? mpafe_fs()->can_use_premium_code() : false );
    }

    require_once 'functions.php';
    require_once 'BMPAAdminMenu.php';
    if ( MPAFE_HAS_PRO ) {
        require_once 'LicenseActivation.php';
    }
    require_once 'freemius-extend/index.php';
    FreemiusExtend::instance( mpafe_fs(), [
        'upgradeUrl' => admin_url( 'admin.php?page=media-player-addons-for-elementor#/pricing' ),
        'title'      => 'Unlock Pro features',
        'message'    => 'This control is available in Pro.',
        'confirm'    => 'Upgrade Now',
        'cancel'     => 'Maybe later',
    ] );
    /**
     * Main baddon wp Class
     *
     * The init class that runs the Hello World plugin.
     * Intended To make sure that the plugin's minimum requirements are met.
     *
     * You should only modify the constants to match your plugin's needs.
     *
     * Any custom code should go inside Plugin Class in the plugin.php file.
     */
    final class baddon_main_element {
        /**
         * Plugin Version
         *
         * @since 1.2.0
         * @var string The plugin version.
         */
        const VERSION = '1.1.3';

        /**
         * Minimum Elementor Version
         *
         * @since 1.2.0
         * @var string Minimum Elementor version required to run the plugin.
         */
        const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

        /**
         * Minimum PHP Version
         *
         * @since 1.2.0
         * @var string Minimum PHP version required to run the plugin.
         */
        const MINIMUM_PHP_VERSION = '7.0';

        /**
         * Constructor
         *
         * @since 1.0.0
         * @access public
         */
        public function __construct() {
            // Load translation
            add_action( 'init', array($this, 'i18n') );
            add_action( 'admin_enqueue_scripts', [$this, 'b_enqueue_admin_style_scripts'] );
            // register_activation_hook(__FILE__, [$this, 'deactivate_pro_version']);
            // Init Plugin
            add_action( 'plugins_loaded', array($this, 'init') );
            add_action( 'wp_ajax_allembed_install_plugin', [$this, 'b_allembed_install_plugin'] );
            add_action( 'wp_ajax_allembed_activate_plugin', [$this, 'b_allembed_activate_plugin'] );
        }

        function deactivate_pro_version() {
            if ( is_plugin_active( 'media-player-addons-pro/media-player-addons-pro.php' ) ) {
                deactivate_plugins( 'media-player-addons-pro/media-player-addons-pro.php' );
            }
        }

        /**
         * Load Textdomain
         *
         * Load plugin localization files.
         * Fired by `init` action hook.
         *
         * @since 1.2.0
         * @access public
         */
        public function i18n() {
            load_plugin_textdomain( 'media-player-addons-for-elementor', false, dirname( __FILE__ ) . "/languages" );
        }

        /**
         * Initialize the plugin
         *
         * Validates that Elementor is already loaded.
         * Checks for basic plugin requirements, if one check fail don't continue,
         * if all check have passed include the plugin class.
         *
         * Fired by `plugins_loaded` action hook.
         *
         * @since 1.2.0
         * @access public
         */
        public function init() {
            // Check if Elementor installed and activated
            if ( !did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', array($this, 'admin_notice_missing_main_plugin') );
                return;
            }
            // Check for required Elementor version
            if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
                add_action( 'admin_notices', array($this, 'admin_notice_minimum_elementor_version') );
                return;
            }
            // Check for required PHP version
            if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
                add_action( 'admin_notices', array($this, 'admin_notice_minimum_php_version') );
                return;
            }
            // Once we get here, We have passed all validation checks so we can safely include our plugin
            require_once 'plugin.php';
        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have Elementor installed or activated.
         *
         * @since 1.0.0
         * @access public
         */
        public function admin_notice_missing_main_plugin() {
            if ( isset( $_GET['activate'] ) ) {
                unset($_GET['activate']);
            }
            $plugin_file = 'elementor/elementor.php';
            // Elementor installed?
            $installed = file_exists( WP_PLUGIN_DIR . '/' . $plugin_file );
            // Elementor active?
            $active = is_plugin_active( $plugin_file );
            echo '<div class="notice notice-warning is-dismissible">';
            echo '<p>' . esc_html__( '"Media Player Addon" requires "Elementor" to be installed and activated.', 'allembed' ) . '</p>';
            if ( !$installed ) {
                echo '<p><button class="button button-primary" id="allembed-install-elementor">' . esc_html__( 'Install Elementor', 'allembed' ) . '</button></p>';
            } elseif ( !$active ) {
                echo '<p><button class="button button-primary" id="allembed-activate-elementor">' . esc_html__( 'Activate Elementor', 'allembed' ) . '</button></p>';
            }
            echo '</div>';
        }

        public function b_enqueue_admin_style_scripts() {
            wp_enqueue_script(
                'allembed-plugin-install',
                plugin_dir_url( __FILE__ ) . 'assets/js/plugin-install.js',
                ['jquery'],
                '1.0',
                true
            );
            wp_localize_script( 'allembed-plugin-install', 'allembedInstall', [
                'ajax_url' => admin_url( 'admin-ajax.php' ),
                'nonce'    => wp_create_nonce( 'allembed_install_plugin' ),
            ] );
        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have a minimum required Elementor version.
         *
         * @since 1.0.0
         * @access public
         */
        public function admin_notice_minimum_elementor_version() {
            if ( isset( $_GET['activate'] ) ) {
                unset($_GET['activate']);
            }
            $message = sprintf(
                /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
                esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'media-player-addons-for-elementor' ),
                '<strong>' . esc_html__( 'unlimited addon', 'media-player-addons-for-elementor' ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'media-player-addons-for-elementor' ) . '</strong>',
                self::MINIMUM_ELEMENTOR_VERSION
            );
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have a minimum required PHP version.
         *
         * @since 1.0.0
         * @access public
         */
        public function admin_notice_minimum_php_version() {
            if ( isset( $_GET['activate'] ) ) {
                unset($_GET['activate']);
            }
            $message = sprintf(
                /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
                esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'media-player-addons-for-elementor' ),
                '<strong>' . esc_html__( 'venus wp', 'media-player-addons-for-elementor' ) . '</strong>',
                '<strong>' . esc_html__( 'PHP', 'media-player-addons-for-elementor' ) . '</strong>',
                self::MINIMUM_PHP_VERSION
            );
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }

        public function b_allembed_install_plugin() {
            if ( !current_user_can( 'install_plugins' ) || !check_ajax_referer( 'allembed_install_plugin', 'nonce', false ) ) {
                wp_send_json_error( 'Unauthorized' );
            }
            include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
            include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
            include_once ABSPATH . 'wp-admin/includes/file.php';
            include_once ABSPATH . 'wp-admin/includes/misc.php';
            $plugin_slug = 'elementor';
            $api = plugins_api( 'plugin_information', [
                'slug'   => $plugin_slug,
                'fields' => [
                    'sections' => false,
                ],
            ] );
            if ( is_wp_error( $api ) ) {
                wp_send_json_error( $api->get_error_message() );
            }
            $upgrader = new Plugin_Upgrader(new Automatic_Upgrader_Skin());
            $result = $upgrader->install( $api->download_link );
            if ( is_wp_error( $result ) ) {
                wp_send_json_error( $result->get_error_message() );
            }
            wp_send_json_success( 'Elementor installed successfully! Please activate it.' );
        }

        public function b_allembed_activate_plugin() {
            if ( !current_user_can( 'activate_plugins' ) || !check_ajax_referer( 'allembed_install_plugin', 'nonce', false ) ) {
                wp_send_json_error( 'Unauthorized' );
            }
            include_once ABSPATH . 'wp-admin/includes/plugin.php';
            $plugin = 'elementor/elementor.php';
            $result = activate_plugin( $plugin );
            if ( is_wp_error( $result ) ) {
                wp_send_json_error( $result->get_error_message() );
            }
            wp_send_json_success( 'Elementor activated successfully!' );
        }

    }

    // Instantiate baddon_main_element.
    new baddon_main_element();
}