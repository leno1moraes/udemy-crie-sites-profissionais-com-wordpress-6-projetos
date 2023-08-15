<?php
/**
 * Customize Dropdown Taxonomies Select Control.
 *
 * @since 1.0.0
 *
 * @package Royale_News
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Customize dropdown dropdown taxonomies control.
 *
 * @since 1.0.0
 */
class Royale_News_Dropdown_Taxonomies_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $type = 'dropdown-taxonomies';

	/**
	 * The category taxonomy.
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	public $taxonomy = '';

	/**
	 * Get and set taxonomy.
	 *
	 * @since 1.0.0
	 *
	 * @param object $manager WP Customize Manager.
	 * @param string $id Control ID.
	 * @param array  $args An associative array containing arguments for the setting.
	 */
	public function __construct( $manager, $id, $args = array() ) {

		$our_taxonomy = 'category';

		if ( isset( $args['taxonomy'] ) ) {

			$taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );

			if ( true === $taxonomy_exist ) {
				$our_taxonomy = esc_attr( $args['taxonomy'] );
			}
		}

		$args['taxonomy'] = $our_taxonomy;

		$this->taxonomy = esc_attr( $our_taxonomy );

		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the the control.
	 *
	 * @since 1.0.0
	 */
	public function render_content() {

		$tax_args = array(
			'hierarchical' => 0,
			'taxonomy'     => $this->taxonomy,
		);

		$all_taxonomies = get_categories( $tax_args );
		?>
		<label>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<select <?php echo esc_attr( $this->link() ); ?>>
				<?php
				printf(
					'<option value="%s" %s>%s</option>',
					'',
					selected( $this->value(), '', false ),
					esc_html__( 'Select', 'royale-news' )
				);
				?>
				<?php
				if ( ! empty( $all_taxonomies ) ) {
					foreach ( $all_taxonomies as $key => $tax ) {

						printf(
							'<option value="%s" %s>%s</option>',
							esc_attr( $tax->term_id ),
							selected( $this->value(), $tax->term_id, false ),
							esc_html( $tax->name )
						);
					}
				}
				?>
			</select>
		</label>
		<?php
	}
}
