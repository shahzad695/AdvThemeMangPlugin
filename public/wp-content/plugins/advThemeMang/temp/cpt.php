<div class="wrap">
    <h1>Custom Post Type Manager</h1>
    <?php settings_errors();
// if (isset($_POST['edit-post'])) {
//     var_dump($_POST);
//     die();
// }
echo isset($_POST['edit-post']) ? $_POST['edit-post'] : '';?>
    <div class="tab">
        <ul class="tab__items">
            <li class="tab__item tab__item--active"><a class=" tab__item_link link
            <?php echo isset($_POST['edit-post']) ? '' : 'tab__item_link--active '; ?> " href="tab-1"> Your Custom Post
                    Types</a>
            </li>
            <li class="tab__item "><a class="tab__item_link link <?php echo isset($_POST['edit-post']) ? 'tab__item_link--active' : ''; ?>"
                    href="tab-2"> Add Custom Post Types</a></li>
            <li class="tab__item"><a class="tab__item_link link" href="tab-3"> Export</a></li>
        </ul>

        <section class="tab__main">
            <article class="tab__paine <?php echo isset($_POST['edit-post']) ? '' : 'tab__paine--active'; ?>" id="tab-1">
                <?php
$post_types = get_option('advThemeMang_cpt') ?: array();?>
                <div class="table_grid">
                    <div class="table_grid__item">CPT ID</div>
                    <div class="table_grid__item">Singular Name</div>
                    <div class="table_grid__item">Plural Name</div>
                    <div class="table_grid__item">Public</div>
                    <div class="table_grid__item">Archieve</div>
                    <div class="table_grid__item">Actions</div>

                    <?php foreach ($post_types as $post_type) {
    $public = (isset($post_type['public']) ? "True" : "False");
    $has_archive = (isset($post_type['has_archive']) ? "True" : "False");
    echo '<div class="table_grid__item">' . $post_type['post_type'] . '</div>
    <div class="table_grid__item">' . $post_type['singular_name'] . '</div>
    <div class="table_grid__item">' . $post_type['plural_name'] . '</div>
    <div class="table_grid__item">' . $public . '</div>
    <div class="table_grid__item">' . $has_archive . '</div>
    <div class="table_grid__item"><a class="link" href="#">';

    echo '  <form class="table_grid__delete-form "method="post" action="#">';
    echo ' <input type="hidden" name="edit-post" value="' . $post_type['post_type'] . '" />';

    settings_fields('cpt_manager_group');
    submit_button('Edit', 'primary small table_grid__btn', 'submit', false);
    echo '</form>';

    echo '  <form class="table_grid__delete-form "method="post" action="options.php">';
    echo ' <input type="hidden" name="remove" value="' . $post_type['post_type'] . '" />';

    settings_fields('cpt_manager_group');

    submit_button('Delete', 'delete small table_grid__btn', 'submit', false, [
        'onclick' => 'return confirm("Are you sure you want to delete this post type data will not be deleted?")',
    ]);

    echo '</form></a></div>';

}

?>
                </div>
            </article>
            <article class="tab__paine <?php echo isset($_POST['edit-post']) ? 'tab__paine--active' : ''; ?>" id="tab-2">
                <form method="post" action="options.php">
                    <?php
settings_fields('cpt_manager_group');
do_settings_sections('advThemeMang_cpt');
submit_button();
?>
                </form>
            </article>

            <article class="tab__paine" id="tab-3">
                <h3>
                    Export Your Custom Post types
                </h3>
                <?php foreach ($post_types as $post_type) {
    $public = (isset($post_type['public']) ? "True" : "False");
    $has_archive = (isset($post_type['has_archive']) ? "True" : "False");?>

                <h3> <?php echo $post_type['post_type'] ?> </h3>
                <pre class="prettyprint">class Voila {
                    function custom_post_type_product() {

$labels = array(
    'name'                  => _x( '<?php echo $post_type['post_type'] ?>', 'Post Type General Name', 'text_domain' ),
    'singular_name'         => _x( '<?php echo $post_type['singular_name'] ?>', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'             => __( '<?php echo $post_type['plural_name'] ?>', 'text_domain' ),
    'name_admin_bar'        => __( '<?php echo $post_type['singular_name'] ?>', 'text_domain' ),
    'archives'              => __( '<?php echo $post_type['singular_name'] ?> Archives', 'text_domain' ),
    'attributes'            => __( '<?php echo $post_type['singular_name'] ?> Attributes', 'text_domain' ),
    'parent_item_colon'     => __( 'Parent <?php echo $post_type['singular_name'] ?>:', 'text_domain' ),
    'all_items'             => __( 'All <?php echo $post_type['plural_name'] ?>', 'text_domain' ),
    'add_new_item'          => __( 'Add New <?php echo $post_type['singular_name'] ?>', 'text_domain' ),
    'add_new'               => __( 'Add New', 'text_domain' ),
    'new_item'              => __( 'New <?php echo $post_type['singular_name'] ?>', 'text_domain' ),
    'edit_item'             => __( 'Edit <?php echo $post_type['singular_name'] ?>', 'text_domain' ),
    'update_item'           => __( 'Update <?php echo $post_type['singular_name'] ?>', 'text_domain' ),
    'view_item'             => __( 'View <?php echo $post_type['singular_name'] ?>', 'text_domain' ),
    'view_items'            => __( 'View <?php echo $post_type['plural_name'] ?>', 'text_domain' ),
    'search_items'          => __( 'Search <?php echo $post_type['singular_name'] ?>', 'text_domain' ),
    'not_found'             => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
    'featured_image'        => __( 'Featured Image', 'text_domain' ),
    'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
    'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
    'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
    'insert_into_item'      => __( 'Insert into <?php echo $post_type['singular_name'] ?>', 'text_domain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this <?php echo $post_type['singular_name'] ?>', 'text_domain' ),
    'items_list'            => __( '<?php echo $post_type['plural_name'] ?> list', 'text_domain' ),
    'items_list_navigation' => __( '<?php echo $post_type['plural_name'] ?> list navigation', 'text_domain' ),
    'filter_items_list'     => __( 'Filter <?php echo $post_type['plural_name'] ?> list', 'text_domain' ),
);
$args = array(
    'label'                 => __( '<?php echo $post_type['singular_name'] ?>', 'text_domain' ),
    'description'           => __( '<?php echo $post_type['singular_name'] ?> Description', 'text_domain' ),
    'labels'                => $labels,
    'supports'              => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'comments', 'revisions', 'page-attributes' ),
    'hierarchical'          => false,
    'public'                => true,
    'show_ui'               => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
    'show_in_rest'          => true,
);
register_post_type( '<?php echo $post_type['singular_name'] ?>', $args );

}
add_action( 'init', 'custom_post_type_product', 0 )
}</pre>
                <?php
}?>
            </article>
        </section>
    </div>

</div>