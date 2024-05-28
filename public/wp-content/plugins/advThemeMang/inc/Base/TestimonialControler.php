<?php
namespace Inc\Base;



class TestimonialControler
{



    function register()
    {
        $checkbox = get_option('advThemeMang');
        $checked = isset($checkbox['testimonial_manager']) ? ($checkbox['testimonial_manager'] ? true : false) : false;
        

        if (!$checked) {
            return;
        }
        // var_dump('testimonial ran');
        // die();
        add_action('init', [$this, 'registerTestimonial']);

    }
    function registerTestimonial()
    {
        
            // Register Custom Testimonial
            $labels = array(
                'name'                  => _x( 'Testimonials', 'Post type general name', 'advance-theme-manager' ),
                'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'advance-theme-manager' ),
                'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'advance-theme-manager' ),
                'name_admin_bar'        => _x( 'Testimonial', 'Add New on Toolbar', 'advance-theme-manager' ),
                'add_new'               => __( 'Add New', 'advance-theme-manager' ),
                'add_new_item'          => __( 'Add New Testimonial', 'advance-theme-manager' ),
                'new_item'              => __( 'New Testimonial', 'advance-theme-manager' ),
                'edit_item'             => __( 'Edit Testimonial', 'advance-theme-manager' ),
                'view_item'             => __( 'View Testimonial', 'advance-theme-manager' ),
                'all_items'             => __( 'All Testimonials', 'advance-theme-manager' ),
                'search_items'          => __( 'Search Testimonials', 'advance-theme-manager' ),
                'parent_item_colon'     => __( 'Parent Testimonials:', 'advance-theme-manager' ),
                'not_found'             => __( 'No Testimonials found.', 'advance-theme-manager' ),
                'not_found_in_trash'    => __( 'No Testimonials found in Trash.', 'advance-theme-manager' ),
                'featured_image'        => _x( 'Testimonial Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'advance-theme-manager' ),
                'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'advance-theme-manager' ),
                'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'advance-theme-manager' ),
                'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'advance-theme-manager' ),
                'archives'              => _x( 'Testimonial archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'advance-theme-manager' ),
                'insert_into_item'      => _x( 'Insert into Testimonial', 'Overrides the “Insert into post”/”page” phrase (used when inserting media into a post). Added in 4.4', 'advance-theme-manager' ),
                'uploaded_to_this_item' => _x( 'Uploaded to this Testimonial', 'Overrides the “Uploaded to this post”/”page” phrase (used when viewing media attached to a post). Added in 4.4', 'advance-theme-manager' ),
                'filter_items_list'     => _x( 'Filter Testimonials list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'advance-theme-manager' ),
                'items_list_navigation' => _x( 'Testimonials list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'advance-theme-manager' ),
                'items_list'            => _x( 'Testimonials list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'advance-theme-manager' ),
            );
        
            $args = array(
                'labels'             => $labels,
                'public'             => true,
                'publicly_queryable' => false,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'query_var'          => false,
                'rewrite'            => array( 'slug' => 'Testimonial' ),
                'capability_type'    => 'post',
                'has_archive'        => false,
                'hierarchical'       => false,
                'menu_position'      => null,
                'menu_icon'          => 'dashicons-testimonial',
                'supports'           => array( 'title', 'editor' ),
                'taxonomies'         => array( 'category', 'post_tag' ),
                'show_in_rest'       => false, // Enable Gutenberg editor
            );
        
            register_post_type( 'Testimonial', $args );
        }
        


}