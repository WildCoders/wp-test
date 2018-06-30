<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Register Post Type
 *
 * Handles to registers the Voucher 
 * post type
 * 
 * @package Lalit Shah - Practical Test
 * @since 1.0.0
 */
function lspt_register_post_type() {

    //register Woocommerce voucher templates post type
    $lspt_post_labels = array(
                        'name'                  => __( 'Customer', 'lspt' ),
                        'singular_name'         => __( 'Customer', 'lspt' ),
                        'add_new'               => _x( 'Add New', LSPT_POST_TYPE, 'lspt' ),
                        'add_new_item'          => sprintf( __( 'Add New %s' , 'lspt' ), __( 'Customer' , 'lspt' ) ),
                        'edit_item'             => sprintf( __( 'Edit %s' , 'lspt' ), __( 'Customer' , 'lspt' ) ),
                        'new_item'              => sprintf( __( 'New %s' , 'lspt' ), __( 'Customer' , 'lspt' ) ),
                        'all_items'             => sprintf( __( '%s' , 'lspt' ), __( 'Customers' , 'lspt' ) ),
                        'view_item'             => sprintf( __( 'View %s' , 'lspt' ), __( 'Customer' , 'lspt' ) ),
                        'search_items'          => sprintf( __( 'Search %a' , 'lspt' ), __( 'Customers' , 'lspt' ) ),
                        'not_found'             => sprintf( __( 'No %s Found' , 'lspt' ), __( 'Customers' , 'lspt' ) ),
                        'not_found_in_trash'    => sprintf( __( 'No %s Found In Trash' , 'lspt' ), __( 'Customers' , 'lspt' ) ),
                        'parent_item_colon'     => '',
                        'menu_name'             => __( 'Customers' , 'lspt' ),
                    );

    $lspt_post_args = array(
                        'labels'                => $lspt_post_labels,
                        'public'                => true,
                        'show_ui'               => true, 
                        'capability_type'       => 'post',
                        'publicly_queryable'    => false,
                        'exclude_from_search'   => true,
                        'map_meta_cap'          => true,
                        'show_in_menu'          => true,
                        'hierarchical'          => false,
                        'show_in_nav_menus'     => false,
                        'rewrite'               => false,
                        'query_var'             => false,
                        'supports'              => array('title', 'editor'),
                    );
    register_post_type( LSPT_POST_TYPE, $lspt_post_args );   
}

//register custom post type
// we need to keep priority 100, because we need to execute this init action after all other init action called.
add_action( 'init', 'lspt_register_post_type' );