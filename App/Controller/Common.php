<?php

namespace WAI\App\Controller;

use WAI\App\Helpers\Input;
use WAI\App\Helpers\Module;
use WAI\App\Helpers\Util;

defined( 'ABSPATH' ) or die;

class Common {
	public static function addMenu() {
		add_menu_page( __( 'WP AI', 'wp-loyalty-rules' ), __( 'WP AI', 'wp-loyalty-rules' ),
			'manage_options',
			WAI_PLUGIN_SLUG, [
				self::class,
				'managePage'
			], 'dashicons-megaphone', 57 );
	}

	public static function adminScripts() {

		if ( $_REQUEST['page'] != WAI_PLUGIN_SLUG ) {
			return;
		}
		remove_all_actions( 'admin_notices' );
		wp_enqueue_script( WAI_PLUGIN_SLUG . '-main', WAI_PLUGIN_URL . 'Assets/Admin/Js/main.js', [ 'jquery' ], '1.0.0' );

		/*End Admin React */
		$localize = [
			'home_url'     => get_home_url(),
			'admin_url'    => admin_url(),
			'plugin_url'   => WAI_PLUGIN_URL,
			'ajax_url'     => admin_url( 'admin-ajax.php' ),
			'wai_ai_nonce' => wp_create_nonce( 'wai-ai-nonce' ),
			'api_token'    => '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'
		];
		wp_localize_script( WAI_PLUGIN_SLUG . '-main', 'wai_localize_data', $localize );
	}

	public static function getAiRequest() {
		if ( ! Util::isSecurityValid( 'wai-ai-nonce' ) ) {
			wp_send_json_error( [ 'message' => __( 'Basic validation failed', 'wp-loyalty-rules' ) ] );
		}
		$model = Input::get( 'model' );
		if ( empty( $model ) ) {
			wp_send_json_error( [ 'message' => __( 'Invalid Model', 'wp-loyalty-rules' ) ] );
		}
		$type = Input::get( 'type' );
		if ( empty( $type ) ) {
			wp_send_json_error( [ 'message' => __( 'Invalid Type', 'wp-loyalty-rules' ) ] );
		}
		$content = Input::get( 'content' );
		if ( empty( $content ) ) {
			wp_send_json_error( [ 'message' => __( 'Invalid Content', 'wp-loyalty-rules' ) ] );
		}
		$handler = Module::getHandler( $model, $type );

		if ( Util::isMethodExists( $handler, 'makeCall' ) ) {
			$response = $handler->makeCall( $content );
			wp_send_json( $response );
		}
		wp_send_json_error( [ 'message' => __( 'Invalid request', 'wp-loyalty-rules' ) ] );
	}

	public static function managePage() {
		$path = WAI_PLUGIN_PATH . 'App/Views/view.php';
		Util::renderTemplate( $path, [
			'ai_list' => Module::getData( 'text_to_image' )
		] );
	}

}