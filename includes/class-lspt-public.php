<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Admin Class
 *
 * Manage Admin Panel Class
 *
 * @package Woocommerce Category Discount
 * @since 1.0.0
 */
class LSPT_Public {

    public $model, $scripts;

    // Class constructor
    function __construct() {

        global $lspt_model;

        $this->model = $lspt_model;
    }

    function lspt_insert_lead(){

        $return['error'] = true;
        if( !empty( $_POST['name'] ) && !empty( $_POST['email'] ) ) {

            $name       = $this->model->lspt_escape_slashes_deep($_POST['name']);
            $email      = $this->model->lspt_escape_slashes_deep($_POST['email']);
            $phone      = $this->model->lspt_escape_slashes_deep($_POST['phone']);
            $message    = $this->model->lspt_escape_slashes_deep($_POST['message']);
            $post_args = array(
                                'post_title'    => $name,
                                'post_type'     => LSPT_POST_TYPE,
                                'post_status'   => 'private',
                                'post_content'  => $message
                              );

            $post_id = wp_insert_post( $post_args );

            update_post_meta( $post_id, LSPT_META_PREFIX.'email', $email );
            update_post_meta( $post_id, LSPT_META_PREFIX.'budget', $_POST['budget'] );
            update_post_meta( $post_id, LSPT_META_PREFIX.'phone', $phone );
            update_post_meta( $post_id, LSPT_META_PREFIX.'date', $_POST['date'] );
            update_post_meta( $post_id, LSPT_META_PREFIX.'time', $_POST['time'] );

            $return['success'] = __('Lead inserted successfully', 'lspt');
        }

        echo json_encode($return);
        exit;
    }

    /**
     * Adding Hooks
     *
     * @package Woocommerce Category Discount
     * @since 1.0.0
     */
    function add_hooks() {

        // Add action to change woocommerce price on single product page
        add_filter('wp_ajax_lspt_insert_lead', array($this, 'lspt_insert_lead'));
        add_filter('wp_ajax_nopriv_lspt_insert_lead', array($this, 'lspt_insert_lead'));
    }

}
