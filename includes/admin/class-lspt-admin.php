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
class LSPT_Admin {

    public $model, $scripts;

    // Class constructor
    function __construct() {

        global $lspt_model;

        $this->model = $lspt_model;
    }

    public function lspt_create_taxonomy(){

        // Add new "Discount Categories" taxonomy to Product post type
        register_taxonomy_for_object_type('lspt_category', LSPT_POST_TYPE);

        // Register taxonomy
        register_taxonomy('lspt_category', LSPT_POST_TYPE, array(
            'hierarchical' => true,
            'public' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            // This array of options controls the labels displayed in the WordPress Admin UI
            'labels' => array(
                'name' => _x('Categories', 'woocatdisc'),
                'singular_name' => _x('Category', 'woocatdisc'),
                'search_items' => __('Search Category', 'woocatdisc'),
                'all_items' => __('All Categories', 'woocatdisc'),
                'parent_item' => __('Parent Category', 'woocatdisc'),
                'parent_item_colon' => __('Parent Category:', 'woocatdisc'),
                'edit_item' => __('Edit Category', 'woocatdisc'),
                'update_item' => __('Update Category', 'woocatdisc'),
                'add_new_item' => __('Add New Category', 'woocatdisc'),
                'new_item_name' => __('New Category Name', 'woocatdisc'),
                'menu_name' => __('Categories', 'woocatdisc'),
                'not_found' => __('No Category found', 'woocatdisc')
            ),
            // Control the slugs used for this taxonomy
            'rewrite' => array(
                'slug' => 'lspt_category',
                'with_front' => false,
                'hierarchical' => true
            ),
        ));

        // Add new "Discount Categories" taxonomy to Product post type
        register_taxonomy_for_object_type('lspt_tag', LSPT_POST_TYPE);

        // Register taxonomy
        register_taxonomy('lspt_tag', LSPT_POST_TYPE, array(
            'hierarchical' => false,
            'public' => false,
            'show_ui' => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud' => true,
            // This array of options controls the labels displayed in the WordPress Admin UI
            'labels' => array(
                'name' => _x('Tags', 'woocatdisc'),
                'singular_name' => _x('Category', 'woocatdisc'),
                'search_items' => __('Search Tag', 'woocatdisc'),
                'all_items' => __('All Tags', 'woocatdisc'),
                'parent_item' => __('Parent Tag', 'woocatdisc'),
                'parent_item_colon' => __('Parent Tag:', 'woocatdisc'),
                'edit_item' => __('Edit Tag', 'woocatdisc'),
                'update_item' => __('Update Tag', 'woocatdisc'),
                'add_new_item' => __('Add New Tag', 'woocatdisc'),
                'new_item_name' => __('New Tag Name', 'woocatdisc'),
                'menu_name' => __('Tags', 'woocatdisc'),
                'not_found' => __('No Tag found', 'woocatdisc')
            ),
            // Control the slugs used for this taxonomy
            'rewrite' => array(
                'slug' => 'lspt_tag',
                'with_front' => false,
                'hierarchical' => true
            ),
        ));
    }

    /**
     * Add action to remove default category metabox
     *
     * @package EDD Ultimate Discounts
     * @since 1.0.0
     */
    public function lspt_meta_box() {

        // Add metabox for our needs
        add_meta_box('lspt_metabox', __('Custom Data', 'eddultdisc'), array($this, 'lspt_metabox_html'), LSPT_POST_TYPE, 'normal', 'high');
    }

    public function lspt_metabox_html(){
        
        include( LSPT_ADMIN_DIR . '/forms/lspt-metabox-html.php' );
    }

    public function lspt_save_metadata($post_id){

        global $post_type;

        $post_type_object = get_post_type_object($post_type);

        // Check for which post type we need to add the meta box
        $pages = array(LSPT_POST_TYPE);

        if (( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )                // Check Autosave
                || (!isset($_POST['post_ID']) || $post_id != $_POST['post_ID'] )        // Check Revision
                || (!in_array($post_type, $pages) )              // Check if current post type is supported.
                || (!current_user_can($post_type_object->cap->edit_post, $post_id) )) {       // Check permission
            return $post_id;
        }

        $email  = $this->model->lspt_escape_slashes_deep($_POST['lspt_lead_email']);
        $phone  = $this->model->lspt_escape_slashes_deep($_POST['lspt_lead_phone_number']);
        $budget = $this->model->lspt_escape_slashes_deep($_POST['lspt_lead_budget']);
        $date   = $this->model->lspt_escape_slashes_deep($_POST['lspt_lead_date']);
        $time   = $this->model->lspt_escape_slashes_deep($_POST['lspt_lead_time']);

        update_post_meta( $post_id, LSPT_META_PREFIX.'email', $email );
        update_post_meta( $post_id, LSPT_META_PREFIX.'budget', $budget );
        update_post_meta( $post_id, LSPT_META_PREFIX.'phone', $phone );
        update_post_meta( $post_id, LSPT_META_PREFIX.'date', $date );
        update_post_meta( $post_id, LSPT_META_PREFIX.'time', $time );
    }

    /**
     * Adding Hooks
     *
     * @package Woocommerce Category Discount
     * @since 1.0.0
     */
    function add_hooks() {

        // Add custom taxonomy under woocommerce
        add_action('init', array($this, 'lspt_create_taxonomy'), 0);

        // Add action to remove category metabox
        add_action('admin_menu', array($this, 'lspt_meta_box'));

        //saving voucher meta on update or publish voucher template post type
        add_action('save_post', array($this, 'lspt_save_metadata'));
    }

}

?>