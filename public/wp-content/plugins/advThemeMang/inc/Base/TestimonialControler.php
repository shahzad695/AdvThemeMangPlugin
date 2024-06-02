<?php
namespace Inc\Base;
use Inc\WordPressAPIs\Callbacks\TestimonialCallbacks;
use Inc\WordPressAPIs\Callbacks\AdminCallbacks;
use Inc\WordPressAPIs\SettingsAPI;



class TestimonialControler
{
    public $settingsAPI;
    public $admin_callbacks;
    public $testimonial_callbacks;
    public $subpages = [];
    public function register()
    {
        $checkbox = get_option('advThemeMang');
        $checked = isset($checkbox['testimonial_manager']) ? ($checkbox['testimonial_manager'] ? true : false) : false;
        

        if (!$checked) {
            return;
        }
        $this->settingsAPI = new SettingsAPI();
        $this->admin_callbacks = new AdminCallbacks();
        $this->testimonial_callbacks = new TestimonialCallbacks();
        
        add_action('init', [$this, 'registerTestimonial']);
        add_action('add_meta_boxes', [$this, 'addMetaBoxes']);
        add_action('save_post', [$this, 'save_author_metabox']);
        add_action('manage_testimonial_posts_columns', [$this, 'addTestimonialColumns']);
    
        add_action('manage_testimonial_posts_custom_column', [$this, 'manageTestimonialColumns'], 10, 2);
        add_filter('manage_edit-testimonial_sortable_columns', [$this, 'makeTestimonialSortable']);
        $this->subpageGenrator();
        add_shortcode('testimonial_form', [$this,'testimonalForm']);
        add_action('wp_ajax_testimonial_form_submit', [$this, 'testimonialAjaxFormSubmit']);
        add_action('wp_ajax_nopriv_testimonial_form_submit', [$this, 'testimonialAjaxFormSubmit']);
        add_shortcode('testimonial_slide_Show', [$this,'testimonalSlideshow']);

    }

    public function testimonalSlideshow(){
        ob_start();
        echo '<link rel="stylesheet" href="'.advThemeMang_PLUGIN_URL .'assets/final-assets/slider.css"></link>';
        require_once advThemeMang_PLUGIN_PATH . 'temp/testimonial-slideshow.php';
        echo '<script src="'.advThemeMang_PLUGIN_URL .'assets/final-assets/slider.js"></script>';
        return ob_get_clean();
    }

    public function testimonialAjaxFormSubmit(){
       
   
        if(!'DOING_AJAX'||!check_ajax_referer('testimonial_nonce', 'nonce')){
            
            return $this->resetStatus('failure');
        }
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
      
        $data = [
            'author_name' => $name,
            'author_email' =>$email,
            'approved' => 0,
            'featured' =>  0,
        ];

        $post =[
            'post_title' => 'Testimonial from'.$name.'',
            'post_content' => $message,
            'post_status' => 'publish',
            'post_type' => 'testimonial',
            'meta_input' => [
                '_advThemeMang_testimonial_options_metabox_key' => $data
            ]
            ];

       $post_id = wp_insert_post($post);
       $result;

       if($post_id){
        return $this->resetStatus('success');
       }else{
        return $this->resetStatus('failure');
    }
       
       wp_die();

    }
    public function resetStatus($status) {
        $result =[
            'status' => $status,
        ];
        wp_send_json($result);
        wp_die();
    }
    public function testimonalForm(){
        ob_start();
        echo '<link rel="stylesheet" href="'.advThemeMang_PLUGIN_URL .'assets/final-assets/form.css"></link>';
        require_once advThemeMang_PLUGIN_PATH . 'temp/testimonial-form.php';
        echo '<script src="'.advThemeMang_PLUGIN_URL .'assets/final-assets/form.js"></script>';
        return ob_get_clean();
    }

    public function subpageGenrator(){
        $this->subpages =[[
        'parent_slug' => 'edit.php?post_type=testimonial',
        'page_title' => 'Testimonial Shortcodes',
        'menu_title' => 'Shortcodes',
        'capability' => 'manage_options',
        'menu_slug' => 'advThemeMang_testimonials_shortcodes',
        'call_back' => array($this->admin_callbacks, 'testimonalShortcodes'),
        ]];

        $this->settingsAPI->addSubPages($this->subpages)->register();
        
    }

    public function registerTestimonial()
    {
            $labels = array(
                'name'                  => _x( 'Testimonials', 'Post type general name', 'advance-theme-manager' ),
                'singular_name'         => _x( 'Testimonial', 'Post type singular name', 'advance-theme-manager' ),
                'menu_name'             => _x( 'Testimonials', 'Admin Menu text', 'advance-theme-manager' ),
                'name_admin_bar'        => _x( 'Testimonial', 'Add New on Toolbar', 'advance-theme-manager' ),
                'add_new'               => __( 'Add New Testimonial', 'advance-theme-manager' ),
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
                'show_in_rest'       => false, // Enable Gutenberg editor
            );
        
            register_post_type( 'testimonial', $args );
        }
        


        public function addMetaBoxes()
        {
            add_meta_box( 'advThemeMang_testimonial_options_metabox', 'Testimonial Options', [$this->testimonial_callbacks, 'advThemeMang_testimonial_options_metabox_callback'], 'Testimonial', 'normal', 'default' );
        }
       

     
        public function save_author_metabox( $post_id )
        {
            
            
            if ( ! isset( $_POST['advThemeMang_testimonial_options_metabox_nonce'] ) || ! wp_verify_nonce( $_POST['advThemeMang_testimonial_options_metabox_nonce'], 'advThemeMang_testimonial_options_metabox_nonce_id' ) ) {
                return;
            }
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
            }
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
            if ( isset( $_POST['advThemeMang_testimonial_options_metabox'] ) ) {
                return;
            }
            $data = [
                'author_name' => sanitize_text_field($_POST['advThemeMang_author_name']),
                'author_email' =>sanitize_text_field( $_POST['advThemeMang_author_email']),
                'approved' => isset($_POST['advThemeMang_approved']) ? $_POST['advThemeMang_approved'] : 0,
                'featured' => isset($_POST['advThemeMang_featured']) ? $_POST['advThemeMang_featured'] : 0,
            ];
            update_post_meta( $post_id, '_advThemeMang_testimonial_options_metabox_key', $data);
        }

        public function addTestimonialColumns( $columns)
        {
            
            $title =$columns['title'];
            $category =$columns['categories'];
            $tags=$columns['tags'];
            $date=$columns['date'];
            unset($columns['title'],$columns['tags'],$columns['date'],$columns['categories']);
            $columns['name']='Author Name';
            $columns['title']=$title;
            $columns['Approved']='Approved';
            $columns['Featured']='Featured';
            $columns['date']=$date;
            return $columns;

        }
        public function manageTestimonialColumns($column,$post_id){
           
            $testimonial_options = get_post_meta( $post_id, '_advThemeMang_testimonial_options_metabox_key', true );

            $author_name = isset( $testimonial_options['author_name'] ) ? $testimonial_options['author_name'] : '';
            $author_email = isset( $testimonial_options['author_email'] ) ? $testimonial_options['author_email'] : '';
            $approved = isset( $testimonial_options['approved'] ) ? $testimonial_options['approved'] : false;
            $featured = isset( $testimonial_options['featured'] ) ? $testimonial_options['featured'] : false;

            switch ($column) {
                case 'name':
                    echo '<strong>'.$author_name.'</strong><br/><a href="mailto:'.$author_email.'">'.$author_email.'</a>';
                    break;
                case 'Approved':
                    echo $approved ? 'Yes' : 'No';
                    break;
                case 'Featured':
                    echo $featured ? 'Yes' : 'No';
                    break;
            }
        }
        public function makeTestimonialSortable($columns){

            $columns['name']='Author Name';
            $columns['Approved']='Approved';
            $columns['Featured']='Featured';
            return $columns;
        }
    }