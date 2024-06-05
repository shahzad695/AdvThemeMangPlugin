<?php
$args = [
    'post_type' => 'testimonial',
    'post_status' => 'publish',
    'posts_per_page' => 5,
    'meta_query' =>
    [
        [
        'key' => '_advThemeMang_testimonial_options_metabox_key',
        'value' =>'s:8:"approved";s:1:"1";s:8:"featured";s:1:"1";',
        'compare' => 'LIKE',
         ],
     ]
];

$query = new WP_Query($args);
// var_dump($query);
// die();

if ($query->have_posts()) {
    echo '<div class="slideshow"><ul class="slideshow__slides">';
    while($query->have_posts()) {
        $query->the_post();
        $name = get_post_meta(get_the_ID(), '_advThemeMang_testimonial_options_metabox_key', true)['author_name'];
        echo '<li class="slideshow__slide"><div>'. get_the_content().'</div><div>'.$name.'</div></li>';
    }

    echo '</ul><button class="slideshow__button slideshow__button--prev">&lt;</ ><button class="slideshow__button slideshow__button--next">&gt;</button></div>';
}