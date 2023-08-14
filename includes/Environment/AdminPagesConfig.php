<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Environment;

use WpPromoGames\Callbacks\MenuPagesCallbacks;

class AdminPagesConfig {
    /**
     * Returns admin menu pages
     *
     * @return array of admin menu pages
     */
    public static function pagesConfig(): array
    {  
        $output = [
            [
                'page_title'    => 'WP Promo Games Plugin',
                'menu_title'    => 'WP Promo Games',
                'capability'    => 'manage_options',
                'menu_slug'     => 'wp_promo_games_plugin',
                'callback'      =>  null,
                'icon_url'      => 'dashicons-games',
                'position'      => 110
            ]
        ];

        return $output;
    }

    /**
     * Returns admin menu subpages
     *
     * @param MenuPagesCallbacks $callbacks - class with callbaks implementation
     * @return array of admin menu subpages
     */
    public static function subpagesConfig(MenuPagesCallbacks $callbacks): array
    {  
        $output = [
            [
                'parent_slug'   => 'wp_promo_games_plugin',
                'page_title'    => __('Friends', 'wp-promo-games'),
                'menu_title'    => __('Friends', 'wp-promo-games'),
                'capability'    => 'manage_options',
                'menu_slug'     => 'wp_promo_games_friends',
                'callback'      => [$callbacks, 'friendsTemplate']
            ],
            [
                'parent_slug'   => 'wp_promo_games_plugin',
                'page_title'    => __('Help', 'wp-promo-games'),
                'menu_title'    => __('Help', 'wp-promo-games'),
                'capability'    => 'manage_options',
                'menu_slug'     => 'wp_promo_games_help',
                'callback'      => [$callbacks, 'helpTemplate']
            ]
        ];

        return $output;
    }
}