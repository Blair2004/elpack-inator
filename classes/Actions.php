<?php
namespace ElPackInator\Classes;

use ElPackInator\Extension;

/**
 * handle all actions for ElPackInator
 * @package ElPackInator
 */
class Actions {
    /**
     * Let's load the localization.
     * @return void
     */
    public function i18n() 
    {
        load_plugin_textdomain( 'elpackinator' );
    }

    /**
     * Let's initialize elpackinator
     * this goes by checking if Elementor is enabled
     * @param null
     */
    public function init() {
        if ( ! did_action( 'elementor/loaded' ) ) {
            return add_action( 'admin_notices', [ $this, 'notices_elementor_missing' ] );
        }

        // Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, Extension::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			return add_action( 'admin_notices', [ $this, 'incorrect_elementor_version' ] );
        }
        
        // Check for required PHP version
		if ( version_compare( PHP_VERSION, Extension::MINIMUM_PHP_VERSION, '<' ) ) {
			return add_action( 'admin_notices', [ $this, 'invalid_php_version' ] );
        }
        
        // Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );
    }

    /**
     * Let's warn the user ELementor is missing
     * @return void
     */
    public function notices_elementor_missing()
    {
        $message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elpackinator' ),
			'<strong>' . esc_html__( 'ElPack-Inator', 'elpackinator' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elpackinator' ) . '</strong>'
        );
        
        Render::view( 'notices/admin-notice', compact( 'message' ) );
    }
    
    /**
     * Let's warn the user invalid 
     * Elementor version is used
     * @return void
     */
    public function incorrect_elementor_version()
    {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elpackinator' ),
			'<strong>' . esc_html__( 'ElPack-Inator', 'elpackinator' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elpackinator' ) . '</strong>',
            Extension::MINIMUM_ELEMENTOR_VERSION
        );
        
        Render::view( 'notices/admin-notice', compact( 'message' ) );
    }

    /**
     * Let's warn the user ELementor is missing
     * @return void
     */
    public function invalid_php_version()
    {
        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elpackinator' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elpackinator' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elpackinator' ) . '</strong>',
			Extension::MINIMUM_PHP_VERSION
		);
        
        Render::view( 'notices/admin-notice', compact( 'message' ) );
    }

    public function init_widgets()
    {
        
    }
}