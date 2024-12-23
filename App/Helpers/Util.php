<?php

namespace WAI\App\Helpers;
defined( 'ABSPATH' ) || exit;

class Util {
	public static function isSecurityValid( string $nonce_name = '' ): bool {
		$wdr_nonce = Input::get( 'wai_nonce', '' );
		if ( ! self::verifyNonce( $wdr_nonce, $nonce_name ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Verify nonce.
	 *
	 * @param string $nonce Nonce.
	 * @param string $action Action.
	 *
	 * @return bool
	 */
	public static function verifyNonce( string $nonce, string $action = '' ): bool {
		if ( empty( $nonce ) || empty( $action ) ) {
			return false;
		}

		return wp_verify_nonce( $nonce, $action );
	}

	/**
	 * Check method exists or not in object.
	 *
	 * @param object|string $object_or_class An object instance or a class name
	 * @param string $method Method name
	 *
	 * @return bool
	 */
	public static function isMethodExists( $object_or_class, $method ): bool {
		return ( is_object( $object_or_class ) || is_string( $object_or_class ) ) && method_exists( $object_or_class, $method );
	}

	/**
	 * render template.
	 *
	 * @param string $file File path.
	 * @param array $data Template data.
	 * @param bool $display Display or not.
	 *
	 * @return string|void
	 */
	public static function renderTemplate( string $file, array $data = [], bool $display = true ) {
		$content = '';
		if ( file_exists( $file ) ) {
			ob_start();
			extract( $data );
			include $file;
			$content = ob_get_clean();
		}
		if ( $display ) {
			echo $content;
		} else {
			return $content;
		}
	}
}