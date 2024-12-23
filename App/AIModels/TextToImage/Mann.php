<?php

namespace WAI\App\AIModels\TextToImage;

use WAI\App\AIModels\Request;

defined( 'ABSPATH' ) || exit;

class Mann implements TextToImage {
	protected static $url = 'https://api-inference.huggingface.co/models/mann-e/Mann-E_Dreams';

	public static function makeCall( $text ) {
		$response = Request::post( self::$url, [
			'inputs' => $text
		], false );

		return self::handleResponse( $response );
	}

	public static function handleResponse( $response ) {
		if ( is_wp_error( $response ) ) {
			return [
				'success' => false,
				'data'    => [
					'message' => $response->get_error_message()
				]

			];
		}
		$file_name = 'Mann/mann.' . self::getImageExtension( $response );
		$file_path = WAI_PLUGIN_PATH . 'file/' . $file_name;
		file_put_contents( $file_path, $response );

		return [
			'success' => true,
			'data'    => [
				'content_type' => 'image',
				'content'      => WAI_PLUGIN_URL . 'file/' . $file_name,
			],

		];
	}

	public static function getImageExtension( $file_path ) {
		$image_info = getimagesize( $file_path );
		$mime_type  = $image_info['mime'];

		// Map MIME types to extensions
		$mime_to_extension = [
			'image/jpeg' => 'jpg',
			'image/png'  => 'png',
			'image/gif'  => 'gif',
			'image/bmp'  => 'bmp',
			'image/tiff' => 'tiff',
		];

		return isset( $mime_to_extension[ $mime_type ] ) ? $mime_to_extension[ $mime_type ] : 'png';
	}

	public static function getUrl() {
		return self::$url;
	}
}