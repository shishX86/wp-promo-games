<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Environment;

/**
 * Global static config
 */
class GlobalConfig
{
    /**
     * Prevent using "new" operator
     */
    protected function __construct()
    {
    }
    
    /**
     * Plugin path
     *
     * @return string
     */
    public static function pluginPath(): string
    {
        return plugin_dir_path(dirname(__FILE__, 2));
    }

    /**
     * Plugin url
     *
     * @return string
     */
    public static function pluginUrl(): string
    {
        return plugin_dir_url(dirname(__FILE__, 2));
    }

    /**
     * Plugin base name
     *
     * @return string
     */
    public static function baseName(): string
    {
        return plugin_basename(dirname(__FILE__, 3)) . '/wp-promo-games.php';
    }

    /**
     * Custom post type name - for Game
     *
     * @return string
     */
    public static function cptGame(): string
    {
        return 'wppgs_game';
    }

    /**
     * Custom post type name - for Leaderboard
     *
     * @return string
     */
    public static function cptLeaderboard(): string
    {
        return 'wppgs_leaderboard';
    }

    /**
     * Returns shortcode name for game post type
     *
     * @return string - shortcode name
     */
    public static function gameShortcode(): string
    {
        return 'wppromogames';
    }

    /**
     * Returns shortcode name for leaderboard post type
     *
     * @return string
     */
    public static function leaderboardShortcode(): string
    {
        return 'wppromogames_leaders';
    }
}
