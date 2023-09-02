<?php
/*
 * Plugin Name: Mongu Trades LDMS
 * Plugin URI: https://mongutrades.com
 * Description: Mongu Trades Learner Data Management System is an online system used to manage Students data such as Years of Study, Programmes, Student Records, Exams, ID cards, Exam Admit Cards, Study Materials, Fees, Student Fee Payments, Institutional Income, Expenses, Noticeboard and much more. Please take time to explore it.
 * Version: 28.09.98
 * Author: Mbumwae S.M
 * Author URI: https://mongutrades.com
 * Text Domain: school-management
*/

defined( 'ABSPATH' ) || die();

if ( ! defined( 'WLSM_PLUGIN_URL' ) ) {
	define( 'WLSM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'WLSM_PLUGIN_DIR_PATH' ) ) {
	define( 'WLSM_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

define( 'WLSM_WEBLIZAR_PLUGIN_URL', 'https://weblizar.com/plugins/school-management/' );
define( 'WLSM_VERSION', '10.1.4' );

// include 'update-checker.php';

final class WLSM_School_Management {
	private static $instance = NULL;

	private function __construct() {
		$this->initialize_hooks();
		$this->setup_database();
		$this->activate_database(); // Automatically activate the database.
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function initialize_hooks() {
		if ( is_admin() ) {
			require_once WLSM_PLUGIN_DIR_PATH . 'admin/admin.php';
		}
		require_once WLSM_PLUGIN_DIR_PATH . 'public/public.php';
	}

	private function setup_database() {
		require_once WLSM_PLUGIN_DIR_PATH . 'admin/inc/WLSM_Database.php';
		register_activation_hook( __FILE__, array( 'WLSM_Database', 'activation' ) );
		register_deactivation_hook( __FILE__, array( 'WLSM_Database', 'deactivation' ) );
		register_uninstall_hook( __FILE__, array( 'WLSM_Database', 'uninstall' ) );
	}

	private function activate_database() {
		require_once WLSM_PLUGIN_DIR_PATH . 'admin/inc/WLSM_Database.php';
		WLSM_Database::activation();
	}
}

WLSM_School_Management::get_instance();
