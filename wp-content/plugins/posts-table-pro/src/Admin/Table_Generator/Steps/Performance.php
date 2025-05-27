<?php
/**
 * @package   Barn2\posts-table-pro
 * @author    Barn2 Plugins <support@barn2.com>
 * @license   GPL-3.0
 * @copyright Barn2 Media Ltd
 */

 namespace Barn2\Plugin\Posts_Table_Pro\Admin\Table_Generator\Steps;

use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Database\Query;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Step;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Content_Table;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Util as Lib_Util;
use Barn2\Plugin\Posts_Table_Pro\Util\Options;

/**
 * The performance step handles caching options for the table.
 */
class Performance extends Step {

	/**
	 * Get things started.
	 *
	 * @param boolean|object $plugin
	 */
	public function __construct( $plugin = false ) {
		parent::__construct( $plugin );

		$this->set_id( 'performance' );
		$this->set_name( __( 'Performance', 'posts-table-pro' ) );
		$this->set_title( __( 'Performance', 'posts-table-pro' ) );
		$this->set_description( __( 'Optimize your table load times.', 'posts-table-pro' ) );
		$this->set_fields( $this->get_fields_list() );
	}

	/**
	 * List of fields for this step.
	 *
	 * @return array
	 */
	public function get_fields_list() {

		$page = $_GET['page'] ?? '';

		$default_options = Options::get_shortcode_options();

		$fields = [
			[
				'type'  => 'heading',
				'label' => __( 'Lazy load', 'posts-table-pro' ),
				'tag'   => 'h2'
			],
			[
				'type'        => 'checkbox',
				'label'       => $page === 'posts-table-pro-table-generator-add-new' ? __( 'Load table one page at a time', 'posts-table-pro' ) : __( 'Lazy load', 'posts-table-pro' ),
				'name'        => 'lazyload',
				'desc'        => __( 'Load table one page at a time', 'posts-table-pro' ),
				'description' => __( 'Enable this if the table will contain a large number of %contentType%.', 'posts-table-pro' ) . '<br>' .
								sprintf(
									/* translators: 1: link to help article, 2: end of help link */
									__( 'Lazy load has %1$ssome limitations%2$s for the search, sorting and filters.', 'posts-table-pro' ),
									Lib_Util::format_link_open( Lib_Util::barn2_url( 'kb/posts-table-lazy-load/' ), true ),
									'</a>'
								),
				'checked'     => $default_options['lazy_load'] ?? false
			],
		];

		return $fields;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_data( $request ) {
		$table_id = $request->get_param( 'table_id' );

		if ( ! empty( $table_id ) ) {
			/** @var Content_Table $table */
			$table = ( new Query( $this->get_generator()->get_database_prefix() ) )->get_item( $table_id );

			$default_options = $this->get_generator()->get_default_options();

			$lazy_load_default = isset( $default_options['lazy_load'] ) ? $default_options['lazy_load'] : false;

			return $this->send_success_response(
				[
					'table_id' => $table_id,
					'values'   => [
						'lazyload' => $table->get_setting( 'lazyload', $lazy_load_default ),
					],
				]
			);
		}

		return $this->send_success_response();
	}

	/**
	 * {@inheritdoc}
	 */
	public function save_data( $request ) {

		$values   = $this->get_submitted_values( $request );
		$table_id = $request->get_param( 'table_id' );

		if ( empty( $table_id ) ) {
			return $this->send_error_response(
				[
					'message' => __( 'The table_id parameter is missing.', 'posts-table-pro' )
				]
			);
		}

		/** @var Content_Table $table */
		$table          = ( new Query( $this->get_generator()->get_database_prefix() ) )->get_item( $table_id );
		$table_settings = $table->get_settings();

		$table_settings['lazyload'] = isset( $values['lazyload'] ) && $values['lazyload'] === true;

		$updated_table = ( new Query( $this->get_generator()->get_database_prefix() ) )->update_item(
			$table_id,
			[
				'settings' => wp_json_encode( $table_settings )
			]
		);

		return $this->send_success_response(
			[
				'table_id' => $table_id
			]
		);
	}

}
