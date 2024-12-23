<?php

namespace WAI\App\AIModels\Chat;

use WAI\App\AIModels\Request;

defined( 'ABSPATH' ) or die;

class MistralNemoInstruct implements ChatInterface {
	public static $url = "https://api-inference.huggingface.co/models/mistralai/Mistral-Nemo-Instruct-2407/v1/chat/completions";

	public static function makeCall( $text ) {
		$response = Request::post( self::$url, [
			'model'      => 'mistralai/Mistral-Nemo-Instruct-2407',
			'messages'   => [ [ 'role' => 'user', 'content' => $text ] ],
			'max_tokens' => 500,
			'stream'     => false
		] );

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

		return [
			'success' => true,
			'data'    => [
				'content_type' => 'text',
				'content'      => $response['choices'][0]['message']['content']
			],

		];
	}
}