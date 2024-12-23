<?php

namespace WAI\App\AIModels\Chat;
defined( 'ABSPATH' ) || exit;

interface ChatInterface {
	public static function makeCall( $text );

	public static function handleResponse( $response );
}