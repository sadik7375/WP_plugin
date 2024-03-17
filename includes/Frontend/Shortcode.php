<?php



namespace  My\Plugin\Frontend;



class Shortcode {

    /**
     * Initializes the class
     */
    function __construct() {
        add_shortcode( 'wedevs-academy', [ $this, 'render_shortcode' ] );
    }

    /**
     * Shortcode handler class
     *
     * @param  array $atts
     * @param  string $content
     *
     * @return string
     */
    public function render_shortcode( $atts, $content = '' ) {
        return 'Hello from Shortcode';
    }
}