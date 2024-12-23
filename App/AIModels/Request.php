<?php

namespace WAI\App\AIModels;
defined( 'ABSPATH' ) or die;

class Request {
	public static function post( $url, $data, $decode = true ) {
		if ( empty( $url ) || empty( $data ) ) {
			return false;
		}
		$options = [
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => "",
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_BINARYTRANSFER => true,
			CURLOPT_CUSTOMREQUEST  => "POST",
			CURLOPT_POSTFIELDS     => json_encode( $data ),
			CURLOPT_HTTPHEADER     => [
				"Authorization: Bearer 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",
				"Content-Type: application/json"
			]
		];


		$curl = curl_init();
		curl_setopt_array( $curl, $options );
		$response = curl_exec( $curl );
		$err      = curl_error( $curl );

		curl_close( $curl );

		if ( $err ) {
			return new \WP_Error( '400', $err );
		}
		echo "<pre>";
		print_r( $response );
		exit;

		return $decode ? json_decode( $response, true ) : $response;
	}
}