<?php

// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

/**
 * Model Class
 * 
 * Handles generic plugin functionality.
 * 
 * @package Woocommerce Category Discount
 * @since 1.0.0
 */
class LSPT_Model {

    public function __construct() {
        
    }

    /**
     * Escape Tags & Strip Slashes From Array
     * 
     * @package Woocommerce Category Discount
     * @since 1.0.0
     */
    public function lspt_escape_slashes_deep($data = array(), $flag = false, $limited = false) {

        if ($flag != true) {
            $data = $this->lspt_nohtml_kses($data);
        } else {
            if ($limited == true) {
                $data = wp_kses_post($data);
            }
        }

        $data = esc_attr(stripslashes_deep($data));

        return $data;
    }

    /**
     * Strip Html Tags
     * 
     * It will sanitize text input (strip html tags, and escape characters)
     * 
     * @package Woocommerce Category Discount
     * @since 1.0.0
     */
    public function lspt_nohtml_kses($data = array()) {

        if (is_array($data)) {
            $data = array_map(array($this, 'wcd_nohtml_kses'), $data);
        } elseif (is_string($data)) {
            $data = wp_filter_nohtml_kses($data);
        }

        return $data;
    }
}

?>