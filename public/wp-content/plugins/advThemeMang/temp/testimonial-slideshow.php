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
    echo '<ul>';
    while($query->have_posts()) {
        $query->the_post();
        echo '<li>'.get_the_title().'<p>'.get_the_content().'</p></li>';
    }

    echo '</ul>';
}