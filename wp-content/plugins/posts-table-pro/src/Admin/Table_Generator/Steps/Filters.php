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
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Util;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Content_Table;

/**
 * This step handles setup of filters for a table.
 */
class Filters extends Step {

	/**
	 * Get things started.
	 *
	 * @param boolean|object $plugin
	 */
	public function __construct( $plugin = false ) {
		parent::__construct( $plugin );

		$this->set_id( 'filters' );
		$this->set_name( __( 'Filters', 'posts-table-pro' ) );
		$this->set_title( __( 'Filters', 'posts-table-pro' ) );
		$this->set_description( __( 'Filters are displayed above the table, and help users to search and refine the %contentType%.', 'posts-table-pro' ) );
		$this->set_fields( $this->get_fields_list() );
	}

	/**
	 * List of fields for this spte.
	 *
	 * @return array
	 */
	public function get_fields_list() {

		$fields = [
			[
				'type'  => 'filters',
				'label' => __( 'Which filters do you want to display?', 'posts-table-pro' ),
				'name'  => 'filters',
				'value' => '',
			],
		];

		return $fields;
	}

	/**
	 * {@inheritdoc}
	 */
	public function get_data( $request ) {
		$table_id = $request->get_param( 'table_id' );

		$default_options = $this->get_generator()->get_default_options();

		$default_filters_mode = '';
		$default_filters      = '';

		if ( ! empty( $table_id ) ) {
			/** @var Content_Table $table */
			$table = ( new Query( $this->get_generator()->get_database_prefix() ) )->get_item( $table_id );

			return $this->send_success_response(
				[
					'table_id' => $table_id,
					'values'   => [
						'filter_mode' => $table->get_setting( 'filter_mode', $default_filters_mode ),
						'filters'     => $table->get_setting( 'filters', $default_filters ),
					],
				]
			);
		}

		return $this->send_success_response(
			[
				'values' => [
					'filter_mode' => $default_filters_mode,
					'filters'     => $default_filters,
				]
			]
		);
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

		$filters      = isset( $values['filters'] ) ? $values['filters'] : [];
		$filter_mode  = isset( $filters['mode'] ) ? $filters['mode'] : false;
		$filter_items = isset( $filters['items'] ) && $filter_mode === true ? $filters['items'] : [];

		if ( ! empty( $filter_items ) ) {
			$filter_items = Util::array_unset_recursive( $filter_items, 'id' );
			$filter_items = Util::array_unset_recursive( $filter_items, 'priority' );
		} else {
			$filter_mode = false;
		}

		/** @var Content_Table $table */
		$table          = ( new Query( $this->get_generator()->get_database_prefix() ) )->get_item( $table_id );
		$table_settings = $table->get_settings();

		$table_settings['filter_mode'] = $filter_mode;
		$table_settings['filters']     = $filter_items;

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
