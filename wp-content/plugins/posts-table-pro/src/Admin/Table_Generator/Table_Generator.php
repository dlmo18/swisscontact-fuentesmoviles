<?php
namespace Barn2\Plugin\Posts_Table_Pro\Admin\Table_Generator;

use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Block;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Plugin_Installer;
use Barn2\Plugin\Posts_Table_Pro\Admin\Table_Generator\Steps\Columns;
use Barn2\Plugin\Posts_Table_Pro\Admin\Table_Generator\Steps\Create;
use Barn2\Plugin\Posts_Table_Pro\Admin\Table_Generator\Steps\Filters;
use Barn2\Plugin\Posts_Table_Pro\Admin\Table_Generator\Steps\Performance;
use Barn2\Plugin\Posts_Table_Pro\Admin\Table_Generator\Steps\Refine;
use Barn2\Plugin\Posts_Table_Pro\Admin\Table_Generator\Steps\Sort;
use Barn2\Plugin\Posts_Table_Pro\Admin\Table_Generator\Steps\Welcome;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Table_Generator as Generator_Library;
use Barn2\Plugin\Posts_Table_Pro\Util\Columns_Util;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Plugin\Plugin;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Registerable;

/**
 * This class handles the registration of the table generator library.
 *
 * @package   Barn2\posts-table-pro
 * @author    Barn2 Plugins <support@barn2.com>
 * @license   GPL-3.0
 * @copyright Barn2 Media Ltd
 */
class Table_Generator implements Registerable {

	/**
	 * Instance of the plugin.
	 *
	 * @var Plugin
	 */
	protected $plugin;

	/**
	 * Get things started.
	 *
	 * @param Plugin $plugin
	 */
	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
	}

	/**
	 * Hook into WP.
	 *
	 * @return void
	 */
	public function register() {
		add_action( 'init', [ $this, 'init' ], 200 );
		add_filter( 'barn2_table_generator_table_settings', [ $this, 'change_table_settings' ], 10, 2 );
	}

	/**
	 * Init the table generator library.
	 *
	 * @return void
	 */
	public function init() {

		// Init library and steps.
		$generator = new Generator_Library(
			$this->plugin,
			'ptp',
			new Welcome(),
			new Create(),
			new Refine(),
			new Columns(),
			new Filters(),
			new Performance(),
			new Sort(),
		);

		// Setup paths to the library.
		$generator->set_library_path( plugin_dir_path( $this->plugin->get_file() ) . 'dependencies/barn2/table-generator/' );
		$generator->set_library_url( plugin_dir_url( $this->plugin->get_file() ) . 'dependencies/barn2/table-generator/' );

		// Grab options from the plugin.
		$generator->set_options_key( 'ptp_shortcode_defaults' );

		// Map certain options to different keys.
		$generator->set_options_mapping(
			[
				'content_type' => 'post_type',
				'lazyload'     => 'lazy_load',
				'cache'        => 'cache',
				'sortby'       => 'sort_by',
			]
		);

		// Setup certain fields to use the datastore of the react app.
		$generator->add_datastore_field( 'refine' );
		$generator->add_datastore_field( 'columns' );
		$generator->add_datastore_field( 'filters' );
		$generator->add_datastore_field( 'filter_mode' );
		$generator->add_datastore_field( 'sortby' );

		// Set the shortcode slug.
		$generator->set_shortcode( 'posts_table' );

		// Set the shortcode resolver.
		$generator->set_shortcode_resolver( \Barn2\Plugin\Posts_Table_Pro\Table_Shortcode::class );

		// Configure settings of the react app.
		$generator->config(
			[
				'utm_id'                 => 'ptp',
				'pluginInstallerPage'    => admin_url( 'admin.php?page=easy-post-types-fields-setup-wizard&action=add' ),
				'settingsPage'           => admin_url( 'admin.php?page=posts_table' ),
				'addPageURL'             => admin_url( 'admin.php?page=' . $this->plugin->get_slug() . '-table-generator-add-new' ),
				'listPageURL'            => admin_url( 'admin.php?page=' . $this->plugin->get_slug() . '-table-generator' ),
				'settingsPageURL'        => admin_url( 'admin.php?page=posts_table' ),
				'pageHeaderLinks'       => [
					'documentation' => [
						'title' => __( 'Documentation', 'posts-table-pro' ),
						'url'   => 'https://barn2.com/kb-categories/posts-table-pro-kb/',
					],
					'support'       => [
						'title' => __( 'Support', 'posts-table-pro' ),
						'url'   => 'https://barn2.com/support-center/',
					],
					'wizard'        => [
						'title' => __( 'Setup wizard', 'posts-table-pro' ),
						'url'   => admin_url( 'admin.php?page=' . $this->plugin->get_slug() . '-table-generator-add-new&wizard=1' ),
					]
				],
				'licenseStepTitle'       => sprintf( __( 'Welcome to %s', 'posts-table-pro' ), $this->plugin->get_name() ),
				'licenseStepDescription' => __( 'Create and display beautiful tables of your website content.', 'posts-table-pro' ),
				'indexDescription'       => sprintf(
					__( 'Create and manage your post tables on this page. Display them using the Post Table block or shortcode.', 'posts-table-pro' ),
					admin_url( 'admin.php?page=posts_table' )
				),
				'isPluginInstalled'      => Plugin_Installer::get_plugin_status( 'easy-post-types-fields/easy-post-types-fields.php' ),
			]
		);

		// Grab default columns.
		$generator->set_default_columns( Columns_Util::column_defaults() );

		// Setup how to resolve arguments for the tables.
		$generator->set_args_resolver( \Barn2\Plugin\Posts_Table_Pro\Table_Args::class );

		// Setup extra fields for the edit page.
		$generator->set_extra_fields( Table_Generator_Extras::class );

		// Backwards compatibility.
		$shortcode_class = new \Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Shortcode( 'posts_table_template', $generator );
		add_shortcode( 'posts_table_template', [ $shortcode_class, 'render_shortcode' ], 10, 1 );

		// Boot library.
		$generator->boot();

		// Initialize the Gutenberg block.
		$gutenberg_block = new Block( $generator );

		// Configure the block.
		$gutenberg_block->set_label( 'Post Table' );
		$gutenberg_block->set_instructions( __( 'Select a pre-saved posts table. Go to the Post Tables section of the Dashboard to create or edit your tables.', 'posts-table-pro' ) );
		$gutenberg_block->set_description( __( 'An interactive table of your posts, pages, or any custom post type.', 'posts-table-pro' ) );
		$gutenberg_block->set_options_doc_url( 'https://barn2.com/kb/posts-table-options/' );

		// Boot the block.
		$gutenberg_block->boot();
	}

	/**
	 * Change table settings.
	 * 
	 * @return array
	 */
	public function change_table_settings( $submitted_settings, $table_id ) {
		$submitted_settings['rows_per_page'] = $submitted_settings['rows_per_page'] === '0' ? '-1' : $submitted_settings['rows_per_page'];
		$submitted_settings['post_limit']    = $submitted_settings['post_limit'] === '0' ? '-1' : $submitted_settings['post_limit'];
		return $submitted_settings;
	}

}
