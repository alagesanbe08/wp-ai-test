<?php

namespace WAI\App\AIModels\TextToImage;
defined( 'ABSPATH' ) || exit;

interface TextToImage {

	public static function getUrl();

	public static function makeCall( $text );

	public static function handleResponse( $response );
}