<?php

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Shortcodes Class
 * 
 * Handles shortcodes functionality of plugin
 * 
 * @package Lalit Shah - Practical Test
 * @since 1.0.0
 */
class LSPT_Shortcodes {

    function __construct(){

    }

    public function lspt_customer_form( $atts = '' ){

        $default_atts = array(
                                'label_name'            => __('Name', 'lspt'),
                                'label_phone'           => __('Phone Number', 'lspt'),
                                'label_email'           => __('Email Address', 'lspt'),
                                'label_budget'          => __('Desired Budget', 'lspt'),
                                'label_message'         => __('Message', 'lspt'),
                                'label_save'            => __('Save', 'lspt'),
                                'max_length_name'       => '',
                                'max_length_phone'      => '',
                                'max_length_email'      => '',
                                'max_length_budget'     => '',
                                'max_length_message'    => '',
                                'rows_message'          => 5,
                                'cols_message'          => 30
                            );

        extract( shortcode_atts( $default_atts, $atts ) );

        include( LSPT_INC_DIR . '/templates/lspt-lead-gen-form.php' );
    }

    /**
     * Adding Hooks
     * 
     * Adding proper hoocks for the shortcodes.
     * 
     * @package WooCommerce - PDF Vouchers
     * @since 1.0.0
     */
    public function add_hooks() {

        add_shortcode( 'lspt_customer_form', array( $this, 'lspt_customer_form' ) ); // for voucher code title
    }
}