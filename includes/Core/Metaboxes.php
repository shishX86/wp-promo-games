<?php

namespace WpPromoGames\Core;

use WpPromoGames\Metaboxes\GameMetabox;
use WpPromoGames\Environment\GlobalConfig;
use WpPromoGames\Metaboxes\LeaderboardMetabox;

/**
 * @package WpPromoGames
 */

/**
 * Class that register Metaboxes for custom post type
 */
class Metaboxes
{
    /**
     * Initialize method
     *
     * @return void
     */
    public function init(): void
    {
        add_action('add_meta_boxes', [$this,  'addMetaboxes']);
        add_action('save_post', [$this, 'saveMetaboxes']);
    }

    /**
     * Adds custom metaboxes
     *
     * @return void
     */
    public function addMetaboxes(): void
    {
        add_meta_box(
            'wppgs_meta',
            __("Game settings", 'wp-promo-games'),
            [$this, 'renderGameMetabox'],
            GlobalConfig::cptGame(),
            'normal',
            'default'
        );

        add_meta_box(
            'wppgs_meta',
            __("Leaderboard settings", 'wp-promo-games'),
            [$this, 'renderLeaderboardMetabox'],
            GlobalConfig::cptLeaderboard(),
            'normal',
            'default'
        );
    }

    /**
     * Renders game metabox template
     *
     * @param $post - current post item
     * @return void
     */
    public function renderGameMetabox($post): void
    {
        Shortcodes::showCurrent( GlobalConfig::gameShortcode(), $post);
        GameMetabox::render($post);
    }

    /**
     * Saves game metabox
     *
     * @param $postId - current post id
     * @return int|null - current post id
     */
    public function saveMetaboxes($postId)
    {
        GameMetabox::save($postId);
        LeaderboardMetabox::save($postId);
    }

    /**
     * Renders leaderboard metabox template
     *
     * @param $post - current post item
     * @return void
     */
    public function renderLeaderboardMetabox($post): void
    {
        Shortcodes::showCurrent( GlobalConfig::leaderboardShortcode(), $post);
        LeaderboardMetabox::render($post);
    }
}
