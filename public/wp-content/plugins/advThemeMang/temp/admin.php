<div class="wrap">
    <h1>Admin Settings Page</h1>
    <?php settings_errors(); ?>
    <section class="tab">
        <ul class="tab__items">
            <li class="tab__item tab__item--active"><a class="link" href="tab-1"> Manage Settings</a></li>
            <li class="tab__item"><a class="link" href="tab-2"> Updates</a></li>
            <li class="tab__item"><a class="link" href="tab-3"> About</a></li>
        </ul>
    </section>
    <section class="tab__main">
        <article class="tab__paine tab__paine--active" id="tab-1">
            <form method="post" action="options.php">
                <?php 
            settings_fields('admin_Settings_group');
            do_settings_sections('advThemeMang');
            submit_button();
        ?>
        </article>
        <article class="tab__paine tab__paine--active" id="tab-2">Updates</article>
        <article class="tab__paine tab__paine--active" id="tab-3">about</article>
    </section>


</div>