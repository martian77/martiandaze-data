<?php

namespace MD\Admin;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Create any taxonomies required.
 */
class Taxonomies {

    /**
     * Singleton instance of the plugin class.
     * @var MD\Admin\Taxonomies
     */
    private static $_instance;

    private function __construct() {
        $this->createStudyNoteTaxonomies();
    }

    /**
     * Creates taxonomies used for the study note post type.
     */
    private function createStudyNoteTaxonomies() {
        // Categories
        $catLabels = [
            'name' => _x( 'Study Categories', 'taxonomy general name', MD_TRANSLATE_DOMAIN ),
            'singular_name' => _x( 'Study Category', 'taxonomy singular name', MD_TRANSLATE_DOMAIN ),
            'search_items' =>  __( 'Search Study Categories', MD_TRANSLATE_DOMAIN ),
            'all_items' => __( 'All Study Categories', MD_TRANSLATE_DOMAIN ),
            'parent_item' => __( 'Parent Study Category', MD_TRANSLATE_DOMAIN ),
            'parent_item_colon' => __( 'Parent Study Category:', MD_TRANSLATE_DOMAIN ),
            'edit_item' => __( 'Edit Study Category', MD_TRANSLATE_DOMAIN ),
            'update_item' => __( 'Update Study Category', MD_TRANSLATE_DOMAIN ),
            'add_new_item' => __( 'Add New Study Category', MD_TRANSLATE_DOMAIN ),
            'new_item_name' => __( 'New Study Category Name', MD_TRANSLATE_DOMAIN ),
            'menu_name' => __( 'Study Categories', MD_TRANSLATE_DOMAIN ),
        ];
        $rewrite = [
          'slug' => 'studycategory', // This controls the base slug that will display before each term
          'with_front' => false, // Don't display the category base before "/locations/"
          'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
        ];
        $args = [
            'labels' => $catLabels,
            'description' => __( 'Categories for Study Notes', MD_TRANSLATE_DOMAIN ),
            'public' => true,
            'show_ui' => true,
            'hierarchical' => true,
            'rewrite' => $rewrite,
        ];
        register_taxonomy('studynotecat', 'studynote', $args);
    }

    /**
     * Static function that instantiates class and makes types.
     */
    public static function createTaxonomies() {
        if ( ! self::$_instance instanceof self ) {
            self::$_instance = new self();
        }
    }
}
