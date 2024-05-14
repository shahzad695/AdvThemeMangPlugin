<div class="wrap">
    <h1>Custom Post Type Manager</h1>
    <?php settings_errors();
if (isset($_POST['edit_post'])) {
    var_dump($_POST);
    die();
}
// isset($_POST['edit-post']) ? var_dump($_POST['edit-post']) : '';
// die();
?>
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

            <article class="tab__paine" id="tab-3">Export</article>
        </section>
    </div>

</div>