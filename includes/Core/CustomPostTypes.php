<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Core;

use WpPromoGames\Environment\GlobalConfig;

/**
 * Registering custom post types 
 */
class CustomPostTypes
{
    /**
     * Initilize method
     *
     * @return void
     */
    public function init(): void
    {
        add_action('init', [$this, 'registerPostTypes']);
    }

    /**
     * Registering post types
     *
     * @return void
     */
    public function registerPostTypes(): void
    {
        $this->registerGames();
        $this->registerLeaderboards();
    }

    /**
     * Register Game post type
     *
     * @return void
     */
    private function registerGames(): void
    {
        //TODO translation!
        $labels = [
            "name" => __("Promo Games", 'wp-promo-games'),
            "singular_name" => __("Game", 'wp-promo-games'),
            "menu_name" => __("Promo Games", 'wp-promo-games'),
            "all_items" => __("Promo Games", 'wp-promo-games'),
            "add_new" => __("Add new", 'wp-promo-games'),
            "add_new_item" => __("Add new Game", 'wp-promo-games'),
            "edit_item" => __("Edit Game", 'wp-promo-games'),
            "new_item" => __("New Game", 'wp-promo-games'),
            "view_item" => __("View Game", 'wp-promo-games'),
            "view_items" => __("View Games", 'wp-promo-games'),
            "search_items" => __("Search Games", 'wp-promo-games'),
            "not_found" => __("No Games found", 'wp-promo-games'),
            "not_found_in_trash" => __("No Games found in trash", 'wp-promo-games'),
            "parent" => __("Parent Game:", 'wp-promo-games'),
            "featured_image" => __("Featured image for this Game", 'wp-promo-games'),
            "set_featured_image" => __("Set featured image for this Game", 'wp-promo-games'),
            "remove_featured_image" => __("Remove featured image for this Game", 'wp-promo-games'),
            "use_featured_image" => __("Use as featured image for this Game", 'wp-promo-games'),
            "archives" => __("Game archives", 'wp-promo-games'),
            "insert_into_item" => __("Insert into Game", 'wp-promo-games'),
            "uploaded_to_this_item" => __("Upload to this Game", 'wp-promo-games'),
            "filter_items_list" => __("Filter Promo Games", 'wp-promo-games'),
            "items_list_navigation" => __("Promo Games navigation", 'wp-promo-games'),
            "items_list" => __("Promo Games", 'wp-promo-games'),
            "attributes" => __("Promo Games attributes", 'wp-promo-games'),
            "name_admin_bar" => __("Game", 'wp-promo-games'),
            "item_published" => __("Game published", 'wp-promo-games'),
            "item_published_privately" => __("Game published privately.", 'wp-promo-games'),
            "item_reverted_to_draft" => __("Game reverted to draft.", 'wp-promo-games'),
            "item_scheduled" => __("Game scheduled", 'wp-promo-games'),
            "item_updated" => __("Game updated.", 'wp-promo-games'),
            "parent_item_colon" => __("Parent Game:", 'wp-promo-games'),
        ];

        $args = [
            "label" => __("Promo Games", 'wp-promo-games'),
            "labels" => $labels,
            "description" => __("Used by WP Promo Games Plugin", 'wp-promo-games'),
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => GlobalConfig::cptGame(),
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "has_archive" => false,
            "show_in_menu" => 'wp_promo_games_plugin',
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => false,
            "query_var" => true,
            "supports" => ["title"],
            "show_in_graphql" => false,
        ];

        register_post_type(GlobalConfig::cptGame(), $args);
    }

    /**
     * Register Leaderboard post type
     *
     * @return void
     */
    private function registerLeaderboards(): void
    {
        $labels = [
            "name" => __("Leaderboards", 'wp-promo-games'),
            "singular_name" => __("Leaderboard", 'wp-promo-games'),
            "menu_name" => __("Leaderboards", 'wp-promo-games'),
            "all_items" => __("Leaderboards", 'wp-promo-games'),
            "add_new" => __("Add new", 'wp-promo-games'),
            "add_new_item" => __("Add new Leaderboard", 'wp-promo-games'),
            "edit_item" => __("Edit Leaderboard", 'wp-promo-games'),
            "new_item" => __("New Leaderboard", 'wp-promo-games'),
            "view_item" => __("View Leaderboard", 'wp-promo-games'),
            "view_items" => __("View Leaderboards", 'wp-promo-games'),
            "search_items" => __("Search Leaderboards", 'wp-promo-games'),
            "not_found" => __("No Leaderboards found", 'wp-promo-games'),
            "not_found_in_trash" => __("No Leaderboards found in trash", 'wp-promo-games'),
            "parent" => __("Parent Leaderboard:", 'wp-promo-games'),
            "featured_image" => __("Featured image for this Leaderboard", 'wp-promo-games'),
            "set_featured_image" => __("Set featured image for this Leaderboard", 'wp-promo-games'),
            "remove_featured_image" => __("Remove featured image for this Leaderboard", 'wp-promo-games'),
            "use_featured_image" => __("Use as featured image for this Leaderboard",'wp-promo-games'),
            "archives" => __("Leaderboard archives", 'wp-promo-games'),
            "insert_into_item" => __("Insert into Leaderboard", 'wp-promo-games'),
            "uploaded_to_this_item" => __("Upload to this Leaderboard", 'wp-promo-games'),
            "filter_items_list" => __("Filter Leaderboards list", 'wp-promo-games'),
            "items_list_navigation" => __("Leaderboards list navigation", 'wp-promo-games'),
            "items_list" => __("Leaderboards list", 'wp-promo-games'),
            "attributes" => __("Leaderboards attributes", 'wp-promo-games'),
            "name_admin_bar" => __("Leaderboard", 'wp-promo-games'),
            "item_published" => __("Leaderboard published", 'wp-promo-games'),
            "item_published_privately" => __("Leaderboard published privately.", 'wp-promo-games'),
            "item_reverted_to_draft" => __("Leaderboard reverted to draft.", 'wp-promo-games'),
            "item_scheduled" => __("Leaderboard scheduled", 'wp-promo-games'),
            "item_updated" => __("Leaderboard updated.", 'wp-promo-games'),
            "parent_item_colon" => __("Parent Leaderboard:", 'wp-promo-games'),
        ];

        $args = [
            "label" => __("Leaderboards", 'wp-promo-games'),
            "labels" => $labels,
            "description" => __("Leader boards post type for WP Promo Games Plugin", 'wp-promo-games'),
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => GlobalConfig::cptLeaderboard(),
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "has_archive" => false,
            "show_in_menu" => 'wp_promo_games_plugin',
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => false,
            "query_var" => true,
            "supports" => ["title"],
            "show_in_graphql" => false,
        ];

        register_post_type(GlobalConfig::cptLeaderboard(), $args);
    }
}
