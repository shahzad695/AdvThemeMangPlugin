<div class="wrap">
    <h1>Admin Settings Page</h1>
    <?php settings_errors();?>
    <div class="tab">
        <ul class="tab__items">
            <li class="tab__item tab__item--active"><a class="tab__item_link tab__item_link--active link" href="tab-1"> Manage Settings</a>
            </li>
            <li class="tab__item"><a class="tab__item_link link" href="tab-2"> Updates</a></li>
            <li class="tab__item"><a class="tab__item_link link" href="tab-3"> About</a></li>
        </ul>

        <section class="tab__main">
            <article class="tab__paine tab__paine--active" id="tab-1">
                <form method="post" action="options.php">
                    <?php
                        settings_fields('admin_manager_group');
                        do_settings_sections('advThemeMang');
                        submit_button();
                    ?>
                </form>
            </article>
            <article class="tab__paine" id="tab-2">Updates</article>
            <article class="tab__paine" id="tab-3">about</article>
        </section>
    </div>

</div>