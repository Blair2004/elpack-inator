<?php
namespace ElPackInator\Classes;

use Exception;

class Render {
    /**
     * define where is located the view 
     * directory
     * @param string $viewPath
     */
    private static $viewPath   =   ElPackInatorRoot . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR;

    /**
     * Load a view file and pass provided
     * that into it.
     */
    public static function view( $path, $data = [] )
    {
        extract( $data );

        /**
         * Check if the file exists before 
         * including that.
         */
        if ( file_exists( self::$viewPath . $path . '.php' ) ) {
            return include( self::$viewPath . $path . '.php' );
        }

        throw new Exception( sprintf( __( 'Unable to load the requested file "%s"', 'elpackinator' ), $path ) );
    }
}