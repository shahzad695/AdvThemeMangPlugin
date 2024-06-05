<?php
namespace Inc\WordPressAPIs\Callbacks;

class TestimonialCallbacks
{
    public function  advThemeMang_testimonial_options_metabox_callback( $post )
    {
        
        wp_nonce_field( 'advThemeMang_testimonial_options_metabox_nonce_id', 'advThemeMang_testimonial_options_metabox_nonce' );
        $testimonial_options = get_post_meta( $post->ID, '_advThemeMang_testimonial_options_metabox_key', true );

        $author_name = isset( $testimonial_options['author_name'] ) ? $testimonial_options['author_name'] : '';
        $author_email = isset( $testimonial_options['author_email'] ) ? $testimonial_options['author_email'] : '';
        $approved = isset( $testimonial_options['approved'] ) ? $testimonial_options['approved'] : false;
        $featured = isset( $testimonial_options['featured'] ) ? $testimonial_options['featured'] : false;
        
                 
       
        ?>
<p>
    <label for="advThemeMang_author_name">Author Name</label>
    <input type="text" name="advThemeMang_author_name" id="advThemeMang_author_name" value="<?php echo $author_name; ?>" />
</p>
<p>
    <label for="advThemeMang_author_email">Author Email</label>
    <input type="email" name="advThemeMang_author_email" id="advThemeMang_author_email" value="<?php echo $author_email; ?>" />
</p>
<div class="toggle">

    <strong>Approved</strong><input type="checkbox" id="advThemeMang_approved" name="advThemeMang_approved" value="1"
        class="toggle__checkbox_input" <?php echo $approved ? 'checked' : ''; ?> />
    <div class="toggle__background_container"><label for="advThemeMang_approved" class="toggle__label"></label></div>
</div>';
<div class="toggle">

    <strong>Featured</strong><input type="checkbox" id="advThemeMang_featured" name="advThemeMang_featured" value="1"
        class="toggle__checkbox_input" <?php echo $featured ? 'checked' : ''; ?> />
    <div class="toggle__background_container"><label for="advThemeMang_featured" class="toggle__label"></label></div>
</div>';


<?php
    }
  
}