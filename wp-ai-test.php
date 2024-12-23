<?php
/**
 * Plugin Name: Ai Test
 * Plugin URI: https://www.wployalty.net
 * Description: Loyalty Rules and Referrals for WooCommerce. Turn your hard-earned sales into repeat purchases by rewarding your customers and building loyalty.
 * Version: 1.0.0
 * Author: Wployalty
 * Slug: wp-ai-test
 * Text Domain: wp-ai-test
 * Requires at least: 4.9.0
 * WC requires at least: 6.5
 * WC tested up to: 9.1
 * Contributors: Wployalty, Alagesan
 * Author URI: https://wployalty.net/
 * License: GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) or die;

//Define the plugin version
defined( 'WAI_PLUGIN_VERSION' ) or define( 'WAI_PLUGIN_VERSION', '1.2.13' );
// Define the plugin text domain
defined( 'WAI_TEXT_DOMAIN' ) or define( 'WAI_TEXT_DOMAIN', 'wp-ai-test' );
// Define the slug
defined( 'WAI_PLUGIN_SLUG' ) or define( 'WAI_PLUGIN_SLUG', 'wp-ai-test' );
// Define plugin path
defined( 'WAI_PLUGIN_PATH' ) or define( 'WAI_PLUGIN_PATH', str_replace( '\\', '/', __DIR__ ) . '/' );
// Define plugin URL
defined( 'WAI_PLUGIN_URL' ) or define( 'WAI_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
// Define plugin file
defined( 'WAI_PLUGIN_FILE' ) or define( 'WAI_PLUGIN_FILE', __FILE__ );
// Define plugin prefix
defined( 'WAI_PLUGIN_PREFIX' ) or define( 'WAI_PLUGIN_PREFIX', 'wai' );


// Autoload the vendor
if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	return;
} elseif ( ! class_exists( 'WAI\App\Router' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

if(!class_exists('WAI\App\Router')){
	return;
}

\WAI\App\Router::init();