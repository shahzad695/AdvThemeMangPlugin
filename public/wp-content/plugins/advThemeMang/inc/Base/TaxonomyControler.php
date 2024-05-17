<?php
namespace Inc\Base;

use Inc\WordPressAPIs\Callbacks\AdminCallbacks;
use Inc\WordPressAPIs\Callbacks\TaxonomyCallbacks;
use Inc\WordPressAPIs\SettingsAPI;

class TaxonomyControler
{

    public $settingsAPI;
    public $settings;
    public $sctions;
    public $fields;
    public $admin_callbacks;
    public $taxonomies = array();
    public $subpages = array();
    function register()
    {
        $checkbox = get_option('advThemeMang');
        $checked = isset($checkbox['taxonomy_manager']) ? ($checkbox['taxonomy_manager'] ? true : false) : false;
        if (!$checked) {
            return;
        }
        $this->settingsAPI = new SettingsAPI();
        $this->admin_callbacks = new AdminCallbacks();
        $this->taxonomy_callbacks = new TaxonomyCallbacks();

        $this->storeTaxonomy();
        $this->subpageGenrator();
        if (!empty($this->taxonomies)) {
            add_action('init', [$this, 'registerTaxonomy']);
        }

    }
    function subpageGenrator()
    {
        $this->subpages = [
            [
                'parent_slug' => 'advThemeMang',
                'page_title' => 'Taxonomy Manager',
                'menu_title' => 'Taxonomy',
                'capability' => 'manage_options',
                'menu_slug' => 'advThemeMang_tax',
                'call_back' => array($this->admin_callbacks, 'taxonomyManager'),
            ]];

        $this->settings = [[
            'option_group' => 'tax_manager_group',
            'option_name' => 'advThemeMang_tax',
            'callback' => array($this->taxonomy_callbacks, 'TaxInputSanitizer'),
        ]];

        $this->sections = [[
            'id' => 'admin_tax_section',
            'title' => 'Taxonomy Manager',
            'callback' => array($this->taxonomy_callbacks, 'TaxSectionManager'),
            'page' => 'advThemeMang_tax',
        ]];

        $this->fields = [[
            'id' => 'taxonomy',
            'title' => 'Taxonomy ID',
            'callback' => array($this->taxonomy_callbacks, 'TaxTextFieldManager'),
            'page' => 'advThemeMang_tax',
            'section' => 'admin_tax_section',
            'args' => [
                'label_for' => 'taxonomy',
                'option_name' => 'advThemeMang_tax',
                'placeholder' => 'eg.Generes',
            ]],
            [
                'id' => 'singular_name',
                'title' => 'Singular Name',
                'callback' => array($this->taxonomy_callbacks, 'TaxTextFieldManager'),
                'page' => 'advThemeMang_tax',
                'section' => 'admin_tax_section',
                'args' => [
                    'label_for' => 'singular_name',
                    'option_name' => 'advThemeMang_tax',
                    'placeholder' => 'eg.Product',
                ]],
            [
                'id' => 'plural_name',
                'title' => 'Plural Name',
                'callback' => array($this->taxonomy_callbacks, 'TaxTextFieldManager'),
                'page' => 'advThemeMang_tax',
                'section' => 'admin_tax_section',
                'args' => [
                    'label_for' => 'plural_name',
                    'option_name' => 'advThemeMang_tax',
                    'placeholder' => 'eg.Products',
                ]],
            [
                'id' => 'hierarchical',
                'title' => 'Hierarchical',
                'callback' => array($this->taxonomy_callbacks, 'TaxCheckboxManager'),
                'page' => 'advThemeMang_tax',
                'section' => 'admin_tax_section',
                'args' => [
                    'label_for' => 'hierarchical',
                    'class' => 'toggle__checkbox_input',
                    'option_name' => 'advThemeMang_tax',
                ]],
            [
                'id' => 'public',
                'title' => 'Public',
                'callback' => array($this->taxonomy_callbacks, 'TaxCheckboxManager'),
                'page' => 'advThemeMang_tax',
                'section' => 'admin_tax_section',
                'args' => [
                    'label_for' => 'public',
                    'class' => 'toggle__checkbox_input',
                    'option_name' => 'advThemeMang_tax',
                ]],
        ];
        $this->settingsAPI->setSettings($this->settings);
        $this->settingsAPI->setSections($this->sections);
        $this->settingsAPI->setFields($this->fields);
        $this->settingsAPI->addSubpages($this->subpages)->register();

    }

    function storeTaxonomy()
    {

        $custom_taxonomies = get_option('advThemeMang_tax') ?: array();

        foreach ($custom_taxonomies as $taxonomy) {
            // var_dump($taxonomy);

            $this->taxonomies[] = [

                'taxonomy' => $taxonomy['taxonomy'],
                'singular_name' => $taxonomy['singular_name'],
                'public' => (isset($taxonomy['public']) ? true : false),
                'hierarchical' => (isset($taxonomy['hierarchical']) ? true : false),

            ];

        }
        // var_dump($this->taxonomies);
        // die();
    }

    function registerTaxonomy()
    {
        foreach ($this->taxonomies as $taxonomy) {
            var_dump($taxonomy['singular_name']);

            $taxonomy_name = $taxonomy['taxonomy'];
            $singular = $taxonomy['singular_name'];
            $public = $taxonomy['public'];
            $hierarchical = $taxonomy['hierarchical'];

            // Register Custom Taxonomy

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

        }
    }

}