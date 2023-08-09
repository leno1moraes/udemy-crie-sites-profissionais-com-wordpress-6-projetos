<?php
/**
 * Customizer: Sanitization Callbacks.
 *
 * This file demonstrates how to define sanitization callback functions for various data types.
 *
 * @package Royale_News
 */

/**
 * Checkbox sanitization callback example.
 *
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function royale_news_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true === $checked ) ? true : false );
}
/**
 * Number sanitization callback example.
 *
 * - Sanitization: number_absint
 * - Control: number
 *
 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
 * as an absolute integer (whole number, zero or greater).
 *
 * NOTE: absint() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
 * It is wrapped in a callback here merely for example purposes.
 *
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int Sanitized number; otherwise, the setting default.
 */
function royale_news_sanitize_number_absint( $number, $setting ) {

	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );

	// If the input is an absolute integer, return it; otherwise, return the default.
	return ( $number ? $number : $setting->default );
}

/**
 * Select sanitization callback example.
 *
 * - Sanitization: select
 * - Control: select, radio
 *
 * Sanitization callback for 'select' and 'radio' type controls. This callback sanitizes `$input`
 * as a slug, and then validates `$input` against the choices defined for the control.
 *
 * @see sanitize_key()               https://developer.wordpress.org/reference/functions/sanitize_key/
 * @see $wp_customize->get_control() https://developer.wordpress.org/reference/classes/wp_customize_manager/get_control/
 *
 * @param string               $input   Slug to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
 */
function royale_news_sanitize_select( $input, $setting ) {

	// Ensure input is a slug.
	$input = sanitize_key( $input );

	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;

	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}


if ( ! function_exists( 'royale_news_sanitize_choices' ) ) {
	/**
	 * Sanitization Function - Choices.
	 *
	 * @param string               $input   Slug to sanitize.
	 * @param WP_Customize_Setting $setting Setting instance.
	 * @return $input
	 */
	function royale_news_sanitize_choices( $input, $setting ) {

		if ( ! empty( $input ) ) {
			$input = array_map( 'absint', $input );
		}

		return $input;
	}
}


if ( ! function_exists( 'royale_news_sanitize_font' ) ) {
	/**
	 * Sanitizes font control value.
	 *
	 * @param string $value Setting value.
	 * @param object $setting Setting object.
	 * @return string
	 */
	function royale_news_sanitize_font( $value, $setting ) {

		$value = json_decode( $value, true );

		$sanitized_value = array();

		if (
			! isset( $value['source'] ) ||
			(
				'google' !== $value['source'] &&
				'websafe' !== $value['source']
			)
		) {
			return $setting->default;
		} else {
			$sanitized_value['source'] = sanitize_text_field( $value['source'] );
		}

		if ( ! isset( $value['font_family'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_family'] = sanitize_text_field( $value['font_family'] );
		}

		if ( ! isset( $value['font_variants'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_variants'] = sanitize_text_field( $value['font_variants'] );
		}

		if ( ! isset( $value['font_url'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_url'] = sanitize_text_field( $value['font_url'] );
		}

		if ( ! isset( $value['font_weight'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_weight'] = sanitize_text_field( $value['font_weight'] );
		}

		if ( isset( $value['font_sizes'] ) && ! empty( $value['font_sizes'] ) ) {

			foreach ( $value['font_sizes'] as $device => $device_value ) {

				if (
					'em' === $value['font_sizes'][ $device ]['unit'] ||
					'rem' === $value['font_sizes'][ $device ]['unit']
				) {
					$sanitized_value['font_sizes'][ $device ]['value'] = (float) $value['font_sizes'][ $device ]['value'];
				} else {
					$sanitized_value['font_sizes'][ $device ]['value'] = (int) $value['font_sizes'][ $device ]['value'];
				}

				$sanitized_value['font_sizes'][ $device ]['unit'] = sanitize_text_field( $value['font_sizes'][ $device ]['unit'] );
			}
		}

		if ( isset( $value['font_size'] ) ) {

			if (
				'em' === $value['font_size']['unit'] ||
				'rem' === $value['font_size']['unit']
			) {
				$sanitized_value['font_size']['value'] = (float) $value['font_size']['value'];
			} else {
				$sanitized_value['font_size']['value'] = (int) $value['font_size']['value'];
			}

			$sanitized_value['font_size']['unit'] = sanitize_text_field( $value['font_size']['unit'] );
		}

		if ( isset( $value['line_heights'] ) && ! empty( $value['line_heights'] ) ) {
			foreach ( $value['line_heights'] as $device => $device_value ) {
				$sanitized_value['line_heights'][ $device ] = (float) $value['line_heights'][ $device ];
			}
		}

		if ( isset( $value['line_height'] ) ) {
			$sanitized_value['line_height'] = (float) $value['line_height'];
		}

		if ( isset( $value['letter_spacings'] ) && ! empty( $value['letter_spacings'] ) ) {

			foreach ( $value['letter_spacings'] as $device => $device_value ) {

				if (
					'em' === $value['font_sizes'][ $device ]['unit'] ||
					'rem' === $value['font_sizes'][ $device ]['unit']
				) {
					$sanitized_value['letter_spacings'][ $device ]['value'] = (float) $value['letter_spacings'][ $device ]['value'];
				} else {
					$sanitized_value['letter_spacings'][ $device ]['value'] = (int) $value['letter_spacings'][ $device ]['value'];
				}

				$sanitized_value['letter_spacings'][ $device ]['unit'] = sanitize_text_field( $value['letter_spacings'][ $device ]['unit'] );
			}
		}

		if ( isset( $value['letter_spacing'] ) ) {
			if (
				'em' === $value['font_size']['unit'] ||
				'rem' === $value['font_size']['unit']
			) {
				$sanitized_value['letter_spacing']['value'] = (float) $value['letter_spacing']['value'];
			} else {
				$sanitized_value['letter_spacing']['value'] = (int) $value['letter_spacing']['value'];
			}

			$sanitized_value['letter_spacing']['unit'] = sanitize_text_field( $value['letter_spacing']['unit'] );
		}

		return ( ! empty( $sanitized_value ) ) ? wp_json_encode( $sanitized_value ) : $setting->value;
	}
}
