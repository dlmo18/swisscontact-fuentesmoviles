<?php
namespace Barn2\Plugin\Posts_Table_Pro\Admin;

use Barn2\Plugin\Posts_Table_Pro\Util\Util;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Registerable;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Service;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Conditional;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Util as Lib_Util;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Service_Container;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Plugin\Plugin;
use Barn2\Plugin\Posts_Table_Pro\Dependencies\Lib\Plugin\Admin\Admin_Links;

/**
 * Handles general admin functions, such as adding links to our settings page in the Plugins menu.
 *
 * @package   Barn2\posts-table-pro
 * @author    Barn2 Plugins <support@barn2.com>
 * @license   GPL-3.0
 * @copyright Barn2 Media Ltd
 */
class Admin_Controller implements Registerable, Service, Conditional {

	use Service_Container;

	private $plugin;

	public function __construct( Plugin $plugin ) {
		$this->plugin = $plugin;
		$this->add_services();
	}

	public function is_required() {
		return Lib_Util::is_admin();
	}

	public function register() {
		$this->register_services();
		add_action( 'admin_enqueue_scripts', [ $this, 'load_settings_page_scripts' ] );
	}

	public function add_services() {
		$this->add_service( 'admin_links', new Admin_Links( $this->plugin ) );
		$this->add_service( 'page_list', new Page_List() );
		$this->add_service( 'tiny_mce', new TinyMCE() );
	}

	public function load_settings_page_scripts( $hook ) {
		if ( $hook === 'toplevel_page_posts-table-pro-table-generator' ) {
			wp_enqueue_script( 'barn2-tiptip' );
			wp_enqueue_style( 'barn2-tooltip' );
		}

		if ( $hook === 'post-tables_page_posts_table' ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'ptp-admin', Util::get_asset_url( 'css/admin/admin.css' ), [], $this->plugin->get_version() );
			wp_enqueue_script( 'ptp-admin', Util::get_asset_url( "js/admin/posts-table-pro-admin.js" ), [ 'jquery', 'wp-color-picker' ], $this->plugin->get_version(), true );
		}
	}

}
