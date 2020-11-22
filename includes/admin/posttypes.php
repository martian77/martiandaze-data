<?php

namespace MD\Admin;

if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

/**
 * Allows for the addition of custom posttypes.
 */
class PostTypes {
    /**
     * Singleton instance of the plugin class.
     * @var MD\Admin\PostTypes
     */
    private static $_instance;

    private function __construct() {
        $this->createStudyNote();
    }

    private function createStudyNote() {
        $labels = array(
            'name'               => _x( 'Study Notes', 'post type general name', MD_TRANSLATE_DOMAIN ),
            'singular_name'      => _x( 'Study Note', 'post type singular name', MD_TRANSLATE_DOMAIN  ),
            'add_new'            => _x( 'Add New', 'study note', MD_TRANSLATE_DOMAIN  ),
            'add_new_item'       => __( 'Add New Study Note', MD_TRANSLATE_DOMAIN  ),
            'edit_item'          => __( 'Edit Study Note', MD_TRANSLATE_DOMAIN  ),
            'new_item'           => __( 'New Study Note', MD_TRANSLATE_DOMAIN  ),
            'all_items'          => __( 'All Study Notes', MD_TRANSLATE_DOMAIN  ),
            'view_item'          => __( 'View Study Note', MD_TRANSLATE_DOMAIN  ),
            'search_items'       => __( 'Search Study Notes', MD_TRANSLATE_DOMAIN  ),
            'not_found'          => __( 'No Study Notes found', MD_TRANSLATE_DOMAIN  ),
            'not_found_in_trash' => __( 'No Study Notes found in the Trash', MD_TRANSLATE_DOMAIN ),
            'parent_item_colon'  => ’,
            'menu_name'          => 'Study Notes'
        );
        $args = array(
            'labels'        => $labels,
            'description'   => 'Holds study notes',
            'public'        => true,
            'menu_position' => 5,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
            'has_archive'   => true,
        );
        register_post_type( 'studynote', $args );
    }

    /**
     * Static function that instantiates class and makes types.
     */
    public static function createPostTypes() {
        if ( ! self::$_instance instanceof self ) {
            self::$_instance = new self();
        }
    }
}
