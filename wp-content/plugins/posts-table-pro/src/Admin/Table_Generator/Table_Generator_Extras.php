<?php
namespace Barn2\Plugin\Posts_Table_Pro\Admin\Table_Generator;

use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Routes\Extra_Fields;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Util;

/**
 * Setup the list of extra fields for the table generator's edit page.
 */
class Table_Generator_Extras extends Extra_Fields {

    /**
	 * {@inheritdoc}
	 */
    public function get_extra_fields() {
		return [
			[
				'type'        => 'number',
				'label'       => __( '%s per page', 'posts-table-pro' ),
				'name'        => 'rows_per_page',
				'min'         => '-1',
				'style'       => [
					'width' => '100px'
				],
			],
			[
				'type'        => 'number',
				'label'       => __( '%s limit', 'posts-table-pro' ),
				'description' => __( 'The maximum number of %contentType% in one table.', 'posts-table-pro' ),
				'name'        => 'post_limit',
				'min'         => '-1',
				'style'       => [
					'width' => '100px'
				],
			],
			[
				'type'        => 'checkbox',
				'label'       => __( 'Search box', 'posts-table-pro' ),
				'desc'        => __( 'Display a search box above your post tables', 'posts-table-pro' ),
				'name'        => 'search_box',
			],
			[
				'type'        => 'text',
				'label'       => __( 'Button text', 'posts-table-pro' ),
				'description' => sprintf( __( 'If your table uses the "button" column. <a href="%s" target="_blank">Read more</a>', 'posts-table-pro' ), 'https://barn2.com/kb/posts-table-button-column' ),
				'name'        => 'button_text',
			],
		];
	}

}