<?php
/**
 * Plugin Name:       ElPack Inator
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       ElPack is a set of widgets and controls that are made to improve experience on Elementor.
 * Version:           1.0.0
 * Requires at least: 5.5
 * Requires PHP:      7.2
 * Author:            CodeWatchers
 * Author URI:        https://codewatchers.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       elpack
 * Domain Path:       /languages
**/

namespace ElPackInator;

use ElPackInator\Classes\Actions;
use ElPackInator\Classes\Filters;

include_once( dirname( __FILE__ ) . '/classes/Actions.php' );
include_once( dirname( __FILE__ ) . '/classes/Filters.php' );
include_once( dirname( __FILE__ ) . '/classes/Render.php' );
include_once( dirname( __FILE__ ) . '/classes/Widget.php' );
include_once( dirname( __FILE__ ) . '/widgets/TestWidget.php' );

/**
 * Define the plugin route directory path
 */
define( 'ElPackInatorRoot', dirname( __FILE__ ) );

if ( ! defined( 'ABSPATH' ) ) exit;

final class Extension {
    const VERSION                       =   '1.0.0';
    const MINIMUM_ELEMENTOR_VERSION     =   '3.0.7';
    const MINIMUM_PHP_VERSION           =   '7.2';

    /**
     * @param Actions
     */
    protected $actions;

    /**
     * @param Filters
     */
    protected $filters;

    private static $_instance = null;

    public static function instance() {
        if ( self::$_instance === null ) {
            self::$_instance    =   new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        $this->actions      =   new Actions;
        $this->filters      =   new Filters;

        add_action( 'init', [ $this->actions, 'i18n' ]);
        add_action( 'plugins_loaded', [ $this->actions, 'init' ]);
    }

    public function includes() {}
}

Extension::instance();