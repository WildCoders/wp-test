<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Scripts Class
 *
 * Handles adding scripts and styles
 * on needed pages
 *
 * @package Woocommerce Category Discount
 * @since 1.0.0
 */
class LSPT_Scripts {

    public function __construct() {
        
    }

    /**
     * Enqueue Scripts
     * 
     * Handles to enqueue script on 
     * needed pages
     * 
     * @package Woocommerce Category Discount
     * @since 1.0.0
     */
    public function lspt_lead_gen_form_scripts() {

        // Get global variable
        global $post;

        // Get current screen
        $post_content = $post->post_content;

        if ( has_shortcode( $post_content, 'lspt_customer_form' ) ) {

            // Register Script
            wp_enqueue_script('lspt_shortcode_scripts', LSPT_INC_URL . '/js/lspt-shortcode-scripts.js', array('jquery'));

            wp_localize_script('lspt_shortcode_scripts', 'LSPT', array(
                'ajaxurl' => admin_url('admin-ajax.php', ( is_ssl() ? 'https' : 'http')),
            ));
        }
    }

    /**
     * Enqueue Styles
     * 
     * Handles to enqueue styles on 
     * needed pages
     * 
     * @package Woocommerce Category Discount
     * @since 1.0.0
     */
    public function lspt_lead_gen_form_styles($hook_suffix) {

        // Get global variable
        global $post;

        // Get current screen
        $post_content = $post->post_content;

        if ( has_shortcode( $post_content, 'lspt_customer_form' ) ) {

            // Register style
            wp_enqueue_style('lspt_shortcode_styles', LSPT_INC_URL . '/css/lspt-shortcode-styles.css', array());
        }
    }

    /**
     * Adding Hooks
     *
     * Adding proper hoocks for the scripts.
     *
     * @package Woocommerce Category Discount
     * @since 1.0.0
     */
    public function add_hooks() {

        // Add scripts for custom taxonomy page and product page
        add_action('wp_enqueue_scripts', array($this, 'lspt_lead_gen_form_scripts'));

        // Add styles for custom taxonomy page and product page
        add_action('wp_enqueue_scripts', array($this, 'lspt_lead_gen_form_styles'));
    }

}
