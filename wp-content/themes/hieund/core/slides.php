<?php
/**
 * slides.php
 * Custom Post Type for Homepage Carousel Slides
 *
 * @package Wordpress
 * @subpackage lca-website
 * @author IE Agency - mb@ie
 * @since 0.1
 *
 * Defines a single carousel slide displayed on the Homepage Carousel.
 *
 * */

/**
 * Register a custom post-type for Carousel Slides
 *
 * @author IE Agency - mb@ie
 * @since 0.1
 * */
function hieund_slide_post_type() {

    // Post Type Labels
    $labels = array(
        'name' => _x('Carousel Slides', 'post type general name', 'lca-website'),
        'singular_name' => _x('Carousel Slide', 'post type singular name', 'lca-website'),
        'menu_name' => _x('Carousel Slides', 'admin menu', 'lca-website'),
        'name_admin_bar' => _x('Slides', 'add new on admin bar', 'lca-website'),
        'add_new' => _x('Add New', 'slide', 'lca-website'),
        'add_new_item' => __('Add New Slide', 'lca-website'),
        'new_item' => __('New Slide', 'lca-website'),
        'edit_item' => __('Edit Slide', 'lca-website'),
        'view_item' => __('View Slide', 'lca-website'),
        'all_items' => __('All Slides', 'lca-website'),
        'search_items' => __('Search Slides', 'lca-website'),
        'parent_item_colon' => __('Parent Slides:', 'lca-website'),
        'not_found' => __('No slides found.', 'lca-website'),
        'not_found_in_trash' => __('No slides found in Trash.', 'lca-website'),
    );


    // Remove front from rewrites.
    $rewrites = array('with_front' => true);


    // Main post-type arguments
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'taxonomies' => array(),
        'query_var' => true,
        'rewrite' => $rewrites,
        'capability_type' => 'post',
        'hierarchical' => false,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt')
    );


    // Register post-type with args  
    register_post_type('slides', $args);
}

// Hook into Init and register post type
add_action('init', 'hieund_slide_post_type', 2);

/**
 * Register the Meta Box and Save Actions for this post type
 *
 * @author IE Agency - mb@ie
 * @since 0.1
 * */
function hieund_slide_meta() {
    add_meta_box("slides", "Additional Information", "hieund_slide_box", "slides", "normal", "low");
    add_action('save_post', 'hieund_slide_save_meta');
}

// Hook into the admin_init action
add_action("admin_init", "hieund_slide_meta");

/**
 * Render the Meta Box to the screen
 *
 * @author IE Agency - mb@ie
 * @since 0.1
 * */
function hieund_slide_box() {
    global $post;
    $custom = get_post_custom($post->ID);

    // Render the form into the page.
    $btnText = get_post_meta($post->ID, 'button_text', true);
    echo '<label for="button_text">';
    _e('Button Text', 'myplugin_textdomain');
    echo '</label> ';
    echo '<input type="text" id="button_text" name="button_text" value="' . esc_attr($btnText) . '" size="25" /> <br />';
    //TODO - user link
    $btnLink = get_post_meta($post->ID, 'button_link', true);
    echo '<label for="button_link">';
    _e('Button Link', 'myplugin_textdomain');
    echo '</label> ';
    echo '<input type="text" id="button_link" name="button_link" value="' . esc_attr($btnLink) . '" size="25" />';
    ?>

    <?php
}

/**
 * Save the content in the Meta Box as Post Meta for the current post
 *
 * @author IE Agency - mb@ie
 * @since 0.1
 * */
function hieund_slide_save_meta() {
    global $post;

    // Prevent saving Post Meta on Autosaves.
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post->ID;
    }

    // Update Each Post Meta Key
    if($post){
        update_post_meta($post->ID, 'button_text', $_POST["button_text"]);
        update_post_meta($post->ID, 'button_link', $_POST["button_link"]);
    }
}
