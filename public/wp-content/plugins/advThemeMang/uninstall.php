<?php
if(!defined('WP_UNINSTALL_PLUGIN')){
    die;
}

// $books = get_posts(['post_type' => 'book','numberposts' => -1]);

// foreach($bookPost as $book) {
//     wp_delete_post($book->ID, true);
// }

global $wpdb;

$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'book'");
$wpdb->query("DELETE FROM wp_post_meta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships  WHERE object_id NOT IN (SELECT id FROM wp_posts)");