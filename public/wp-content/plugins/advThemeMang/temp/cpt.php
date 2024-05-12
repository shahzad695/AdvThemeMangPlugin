<div class="wrap">
    <h1>CPT Manager</h1>
    <?php settings_errors();?>

    <form method="post" action="options.php">
        <?php
settings_fields('cpt_manager_group');
do_settings_sections('advThemeMang_cpt');
submit_button();
?>
    </form>



</div>