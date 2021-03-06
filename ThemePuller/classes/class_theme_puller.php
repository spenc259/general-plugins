<?php

/**
 * Theme Puller
 */
class ThemePuller
{
    private static $instance;

    function __construct()
    {
        add_action( 'wp_loaded', array($this, 'theme_puller'));
        
    }

    /**
     * Instance loader
     * @since 1.0
     * @param string $file current file
     * @param string $version current version number
     * @return object $instance singleton instance of the class
     */
    public static function instance( $file='', $version = '1.0' )
    {
        if ( is_null(self::$instance) ) {
            self::$instance = new self( $file, $version);
        }

        return self::$instance;
    }


    function theme_puller()
    {
        $data = array();

        $data['post'] = $_POST;

        if (!isset($_POST['file_url'])) {
            return;
        }

        $url = $_POST['file_url'];
        $data['url'] = $url;

        // need to make dynamic
        $destination = '/Users/paul/Sites/wordpress/sat1/wp-content/themes/base.zip';
        $zipurl = '/Users/paul/Sites/wordpress/sat1/wp-content/themes/base.zip'; 
        $zipdestination = '/Users/paul/Sites/wordpress/sat1/wp-content/themes/'; 

        wp_send_json_success( $data );

        exit;
    }

    /**
     * recursively delete a directory
     * @author holger1 - php.net
     */
    public function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") $this->rrmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }
    }     
    
}
