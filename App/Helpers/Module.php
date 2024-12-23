<?php

namespace WAI\App\Helpers;

use WAI\App\AIModels\TextToImage\BlackForestLabs;
use WAI\App\AIModels\TextToImage\Mann;
use WAI\App\AIModels\TextToImage\NtcAi;

defined( 'ABSPATH' ) || exit;

class Module {
	/**
	 * Map module and class.
	 *
	 * @var array[]
	 */
	private static $modules;

	/**
	 * Get modules data.
	 *
	 * @param string $module Module name.
	 * @param array|false $default Default value.
	 *
	 * @return array|false
	 */
	public static function getData( string $module, $default = false ) {
		if ( ! isset( self::$modules ) ) {
			self::$modules = (array) apply_filters( 'wai_modules', [
				'chat'          => self::getChatAi(),
				'text_to_image' => self::getTextToImage(),
			] );
		}

		return self::$modules[ $module ] ?? $default;
	}

	/**
	 * Returns respective module handler.
	 *
	 * @param string $module Module name.
	 * @param string $key Module key.
	 *
	 * @return object|false
	 */
	public static function getHandler( string $module, string $key ) {
		$modules = self::getData( $module );
		if ( empty( $modules ) || empty( $modules[ $key ]['handler'] ) ) {
			return false;
		}
		$handler_class = $modules[ $key ]['handler'];
		if ( ! class_exists( $handler_class ) ) {
			return false;
		}

		return new $handler_class();
	}

	/**
	 * Returns list of available rules.
	 *
	 * @return array
	 */
	private static function getChatAi(): array {
		return (array) apply_filters( 'wai_chat_ai', [
			'mistral_nemo' => [
				'label'       => __( 'Mistral Nemo', 'woo-discount-rules' ),
				'group'       => __( 'Chat', 'woo-discount-rules' ),
				'value'       => 'mistral_nemo',
				'description' => __( 'Useful to create chat AI', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\Chat\MistralNemoInstruct',
			]
		] );
	}

	/**
	 * Returns list of available filters.
	 *
	 * @return array
	 */
	private static function getTextToImage(): array {
		return (array) apply_filters( 'wai_text_to_image_ai', [
			'black_forest_labs'  => [
				'label'       => __( 'Black Forest Labs', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\BlackForestLabs',
				'url'         => BlackForestLabs::getUrl()
			],
			'mann'               => [
				'label'       => __( 'Mann', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\Mann',
				'url'         => Mann::getUrl()
			],
			'dark_fantasy'       => [
				'label'       => __( 'Dark Fantasy', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\NtcAi',
				'url'         => 'https://api-inference.huggingface.co/models/nerijs/dark-fantasy-movie-flux'
			],
			'ntc_ai'             => [
				'label'       => __( 'NTC ultra-realistic-illustration', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\NtcAi',
				'url'         => NtcAi::getUrl()
			],
			'ntc_cinematic'      => [
				'label'       => __( 'NTC cinematic', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\NtcAi',
				'url'         => 'https://api-inference.huggingface.co/models/ntc-ai/SDXL-LoRA-slider.cinematic-lighting'
			],
			'ntc_comic_art'      => [
				'label'       => __( 'NTC comic art', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\NtcAi',
				'url'         => 'https://api-inference.huggingface.co/models/ntc-ai/SDXL-LoRA-slider.2000s-indie-comic-art-style'
			],
			'ntc_raw'            => [
				'label'       => __( 'NTC Raw', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\NtcAi',
				'url'         => 'https://api-inference.huggingface.co/models/ntc-ai/SDXL-LoRA-slider.raw'
			],
			'ntc_anime'          => [
				'label'       => __( 'NTC Anime', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\NtcAi',
				'url'         => 'https://api-inference.huggingface.co/models/ntc-ai/SDXL-LoRA-slider.anime'
			],
			'ntc_micro_detail'   => [
				'label'       => __( 'NTC Micro Fine', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\NtcAi',
				'url'         => 'https://api-inference.huggingface.co/models/ntc-ai/SDXL-LoRA-slider.micro-details-fine-details-detailed'
			],
			'ntc_extreme_detail' => [
				'label'       => __( 'NTC Extreme Details', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\NtcAi',
				'url'         => 'https://api-inference.huggingface.co/models/ntc-ai/SDXL-LoRA-slider.extremely-detailed'
			],
			'ntc_slice_of_life'  => [
				'label'       => __( 'NTC Slice of Life', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\NtcAi',
				'url'         => 'https://api-inference.huggingface.co/models/ntc-ai/SDXL-LoRA-slider.slice-of-life'
			],
			'ntc_emotional'      => [
				'label'       => __( 'NTC Emotional', 'woo-discount-rules' ),
				'description' => __( 'Given text, ai will convert to image', 'woo-discount-rules' ),
				'handler'     => '\WAI\App\AIModels\TextToImage\NtcAi',
				'url'         => 'https://api-inference.huggingface.co/models/ntc-ai/SDXL-LoRA-slider.emotional'
			]
			//https://api-inference.huggingface.co/models/ntc-ai/SDXL-LoRA-slider.blacklight-photography
		] );
	}
}