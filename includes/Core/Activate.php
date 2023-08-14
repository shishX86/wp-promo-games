<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Core;

/**
 * Activation WpPromoGames plugin class
 * It handles activate hook
 */
class Activate
{
    /**
     * Static method 
     * It executes when plugin is activating
     *
     * @return void
     */
    public static function exec(): void
    {
        flush_rewrite_rules();
    }
}
