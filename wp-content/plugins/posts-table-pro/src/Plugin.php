<?php

namespace Barn2\Plugin\Posts_Table_Pro;

use Barn2\Plugin\Posts_Table_Pro\Dependencies\Barn2\Table_Generator\Database\Table;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Plugin\Licensed_Plugin;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Plugin\Premium_Plugin;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Registerable;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Service_Provider;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Translatable;

/**
 * The main plugin class. Responsible for setting up to core plugin services.
 *
 * @package   Barn2\posts-table-pro
 * @author    Barn2 Plugins <support@barn2.com>
 * @license   GPL-3.0
 * @copyright Barn2 Media Ltd
 */
class Plugin extends Premium_Plugin implements Registerable, Translatable, Service_Provider, Licensed_Plugin {

	const NAME    = 'Posts Table Pro';
	const ITEM_ID = 8381;

	/**
	 * Constructs and initializes the plugin data.
	 *
	 * @param string $file    The path to the main plugin file.
	 * @param string $version The current plugin version.
	 */
	public function __construct( $file = null, $version = '1.0' ) {
		parent::__construct(
			[
				'id'                 => self::ITEM_ID,
				'name'               => self::NAME,
				'version'            => $version,
				'file'               => $file,
				'documentation_path' => 'kb-categories/posts-table-pro-kb/',
				'settings_path'      => 'admin.php?page=posts_table',
				'legacy_db_prefix'   => 'ptp'
			]
		);

		$this->add_service( 'plugin_setup', new Admin\Plugin_Setup( $this ), true );
	}

	/**
	 * Registers the plugin with WordPress.
	 */
	public function register() {
		parent::register();

		add_action( 'plugins_loaded', [ $this, 'add_services' ] );
		add_action( 'plugins_loaded', [ $this, 'maybe_upgrade' ] );
		add_action( 'init', [ $this, 'register_services' ] );
		add_action( 'init', [ $this, 'load_textdomain' ], 5 );
		add_action( 'widgets_init', [ $this, 'register_widgets' ] );
	}

	/**
	 * Get the list of services that the plugin requires.
	 *
	 * @return Service[] The list of services.
	 */
	public function add_services() {
		$this->add_service( 'table', new Table( 'ptp' ) );
		$this->add_service( 'admin', new Admin\Admin_Controller( $this ) );
		$this->add_service( 'settings_page', new Admin\Settings_Page( $this ) );
		$this->add_service( 'table_generator', new Admin\Table_Generator\Table_Generator( $this ) );

		if ( $this->has_valid_license() ) {
			$this->add_service( 'frontend_scripts', new Frontend_Scripts( $this ) );
			$this->add_service( 'ajax_handler', new Ajax_Handler() );
			$this->add_service( 'table_shortcode', new Table_Shortcode() );
			$this->add_service( 'search_handler', new Search_Handler() );
			$this->add_service( 'search_shortcode', new Search_Shortcode() );
			$this->add_service( 'theme_integration', new Integration\Theme_Integration() );
			$this->add_service( 'searchwp_integration',new Integration\SearchWP() );
			$this->add_service( 'facetwp_integration', new Integration\FacetWP() );
		}
	}

	/**
	 * Verify if it needs to upgrade the database.
	 *
	 * @return void
	 */
	public function maybe_upgrade() {
		$table = $this->get_service( 'table' );
		$table->maybe_upgrade();
	}

	/**
	 * Load the plugin's language files by calling load_plugin_textdomain.
	 *
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'posts-table-pro', false, $this->get_slug() . '/languages' );
	}

	/**
	 * Register Widgets.
	 */
	public function register_widgets() {
		if ( ! $this->get_license()->is_valid() ) {
			return;
		}

		register_widget( Search_Widget::class );
	}

}
