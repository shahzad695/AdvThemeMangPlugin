<div class="wrap">
    <h1>Custom Taxonomies Manager</h1>
    <?php settings_errors();?>
    <div class="tab">
        <ul class="tab__items">
            <li class="tab__item tab__item--active"><a class=" tab__item_link link
            <?php echo isset($_POST['edit-taxonomy']) ? '' : 'tab__item_link--active '; ?> " href="tab-1"> Your Custom Taxonomies</a>
            </li>
            <li class="tab__item "><a
                    class="tab__item_link link <?php echo isset($_POST['edit-taxonomy']) ? 'tab__item_link--active' : ''; ?>" href="tab-2">
                    Add Custom Taxonomies</a></li>
            <li class="tab__item"><a class="tab__item_link link" href="tab-3"> Export</a></li>
        </ul>

        <section class="tab__main">
            <article class="tab__paine <?php echo isset($_POST['edit-taxonomy']) ? '' : 'tab__paine--active'; ?>" id="tab-1">
                <?php
$taxonomies = get_option('advThemeMang_tax') ?: array();?>
                <div class="table_grid">
                    <div class="table_grid__item">Taxonomy ID</div>
                    <div class="table_grid__item">Singular Name</div>
                    <div class="table_grid__item">Plural Name</div>
                    <div class="table_grid__item">Public</div>
                    <div class="table_grid__item">Hierarchical</div>
                    <div class="table_grid__item">Actions</div>

                    <?php foreach ($taxonomies as $taxonomy) {
    $public = (isset($taxonomy['public']) ? "True" : "False");
    $hierarchical = (isset($taxonomy['hierarchical']) ? "True" : "False");
    echo '<div class="table_grid__item">' . $taxonomy['taxonomy'] . '</div>
    <div class="table_grid__item">' . $taxonomy['singular_name'] . '</div>
    <div class="table_grid__item">' . $taxonomy['plural_name'] . '</div>
    <div class="table_grid__item">' . $public . '</div>
    <div class="table_grid__item">' . $hierarchical . '</div>
    <div class="table_grid__item"><a class="link" href="#">';

    echo '  <form class="table_grid__delete-form "method="post" action="#">';
    echo ' <input type="hidden" name="edit-taxonomy" value="' . $taxonomy['taxonomy'] . '" />';

    settings_fields('tax_manager_group');
    submit_button('Edit', 'primary small table_grid__btn', 'submit', false);
    echo '</form>';

    echo '  <form class="table_grid__delete-form "method="post" action="options.php">';
    echo ' <input type="hidden" name="remove" value="' . $taxonomy['taxonomy'] . '" />';

    settings_fields('tax_manager_group');

    submit_button('Delete', 'delete small table_grid__btn', 'submit', false, [
        'onclick' => 'return confirm("Are you sure you want to delete this post type data will not be deleted?")',
    ]);

    echo '</form></a></div>';

}

?>
                </div>
            </article>
            <article class="tab__paine <?php echo isset($_POST['edit-taxonomy']) ? 'tab__paine--active' : ''; ?>" id="tab-2">
                <form method="post" action="options.php">
                    <?php
settings_fields('tax_manager_group');
do_settings_sections('advThemeMang_tax');
submit_button();
?>
                </form>
            </article>

            <article class="tab__paine" id="tab-3">
                <h3>
                    Export Your Custom Taxonomies
                </h3>
                <?php foreach ($taxonomies as $taxonomy) {
    $public = (isset($taxonomy['public']) ? "True" : "False");
    $hierarchical = (isset($taxonomy['hierarchical']) ? "True" : "False");?>

                <h3> <?php echo $taxonomy['taxonomy'] ?> </h3>
                <pre class="prettyprint">class Voila {


            $labels = array(
                'name' => _x('' . $taxonomy_name . '', 'Taxonomy General Name', 'text_domain'),
                'singular_name' => _x('' . $taxonomy_name . '', 'Taxonomy Singular Name', 'text_domain'),
                'menu_name' => __('' . $singular . '', 'text_domain'),
                'all_items' => __('All ' . $taxonomy_name . '', 'text_domain'),
                'parent_item' => __('Parent ' . $singular . '', 'text_domain'),
                'parent_item_colon' => __('Parent ' . $singular . ':', 'text_domain'),
                'new_item_name' => __('New ' . $singular . ' Name', 'text_domain'),
                'add_new_item' => __('Add New ' . $singular . '', 'text_domain'),
                'edit_item' => __('Edit ' . $singular . '', 'text_domain'),
                'update_item' => __('Update ' . $singular . '', 'text_domain'),
                'view_item' => __('View ' . $singular . '', 'text_domain'),
                'separate_items_with_commas' => __('Separate ' . $taxonomy_name . ' with commas', 'text_domain'),
                'add_or_remove_items' => __('Add or remove ' . $taxonomy_name . '', 'text_domain'),
                'choose_from_most_used' => __('Choose from the most used', 'text_domain'),
                'popular_items' => __('Popular ' . $taxonomy_name . '', 'text_domain'),
                'search_items' => __('Search ' . $taxonomy_name . '', 'text_domain'),
                'not_found' => __('Not Found', 'text_domain'),
                'no_terms' => __('No ' . $taxonomy_name . '', 'text_domain'),
                'items_list' => __('' . $taxonomy_name . ' list', 'text_domain'),
                'items_list_navigation' => __('' . $taxonomy_name . ' list navigation', 'text_domain'),
            );
            $rewrite = array(
                'slug' => '' . $singular . '',
                'with_front' => true,
                'hierarchical' => false,
            );
            $args = array(
                'labels' => $labels,
                'hierarchical' => $hierarchical,
                'public' => $public,
                'show_ui' => true,
                'show_admin_column' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'rewrite' => $rewrite,
            );
            register_taxonomy('' . $singular . '', array('post'), $args);



}</pre>
                <?php
}?>
            </article>
        </section>
    </div>

</div>