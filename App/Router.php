<?php

namespace WAI\App;

use WAI\App\Controller\Common;

defined( 'ABSPATH' ) or die;

class Router {

	public static function init() {
		if ( is_admin() ) {
			add_action( 'admin_menu', [ Common::class, 'addMenu' ] );
			add_action( 'admin_enqueue_scripts', [ Common::class, 'adminScripts' ], 100 );
		}
		add_action( 'wp_ajax_wai_ai_call', [ Common::class, 'getAiRequest' ] );
	}
}