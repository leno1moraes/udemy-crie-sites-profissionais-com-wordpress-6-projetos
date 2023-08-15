<?php
/**
 * Customize Dropdown Multiple Select Control.
 *
 * @since 1.0.0
 *
 * @package Royale_News
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Class Royale_News_Dropdown_Multiple_Chooser
 *
 * @since 1.0.0
 */
class Royale_News_Dropdown_Multiple_Chooser extends WP_Customize_Control {
	/**
	 * The type of control being rendered.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $type = 'dropdown_multiple_chooser';

	/**
	 * Render the the control.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {

		$default_values = ( $this->value() ) ? $this->value() : array();

		$choices = $this->choices;
		?>
		<label>
			<span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>

			<?php
			if ( $this->description ) {
				?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
				<?php
			}
			?>
			<select multiple="multiple" class="hs-chosen-select" <?php $this->link(); ?>>
				<?php
				if ( $choices ) {
					foreach ( $choices as $value => $label ) {
						$selected = '';
						if ( is_array( $default_values ) && array_key_exists( $value, $default_values ) ) {
							$selected = 'selected';
						} else {
							$selected = ( $default_values === $value ) ? 'selected' : '';
						}
						?>
						<option
							value="<?php echo esc_attr( $value ); ?>"
							<?php echo $selected; // phpcs:ignore ?>
						><?php echo esc_html( $label ); ?></option>
						<?php
					}
				}
				?>
			</select>
		</label>
		<?php
	}
}
