<div class="wrap">
    <h1>Custom Post Type Manager</h1>
    <?php settings_errors();?>
    <div class="tab">
        <ul class="tab__items">
            <li class="tab__item tab__item--active"><a class="tab__item_link tab__item_link--active link" href="tab-1"> Your Custom Post
                    Types</a>
            </li>
            <li class="tab__item"><a class="tab__item_link link" href="tab-2"> Add Custom Post Types</a></li>
            <li class="tab__item"><a class="tab__item_link link" href="tab-3"> Export</a></li>
        </ul>

        <section class="tab__main">
            <article class="tab__paine tab__paine--active" id="tab-1">
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
    <div class="table_grid__item">Edit/Delete</div>';

}

?>
                </div>
            </article>
            <article class="tab__paine" id="tab-2">
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