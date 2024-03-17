<?php
/**
 * Plugin Name: My Plugin2
 * Description: This is a test Plugin
 * Version: 1.0
 * Author: sadik
 * Author URI: www.triomindsolution.com
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/*
 * class create
 */
final class my_plugin2{

    const version = '1.0';

    private function __construct()
    {
        $this->define_constants();

        register_activation_hook(__FILE__,[$this,'activate']);

        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /*
     * initializes a singleton instance
     */
    public static function init()
    {
        static $instance = null;

        if (!$instance)
        {
            $instance = new self();
        }

        return $instance;
    }

    public function define_constants() {
        define( 'my_plugin2_VERSION', self::version );
        define( 'my_plugin2_FILE', __FILE__ );
        define( 'my_plugin2_PATH', __DIR__ );
        define( 'my_plugin2_URL', plugins_url( '', my_plugin2_FILE ) );
        define( 'my_plugin2_ASSETS', my_plugin2_URL . '/assets' );
    }

    public function init_plugin() {
        if ( is_admin() ) {
            new My\Plugin\Admin();
        } else {
            new My\Plugin\Frontend();
        }
    }

    public function activate() {
        $installed = get_option( 'my_plugin2_installed' );

        if ( ! $installed ) {
            update_option( 'my_plugin2_installed', time() );
        }

        update_option( 'my_plugin2_version', my_plugin2_VERSION );
    }
}

/**
 * Initializes the main plugin
 */
function my_plugin2_init()
{
    return my_plugin2::init();
}

my_plugin2_init();
