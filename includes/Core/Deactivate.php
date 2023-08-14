<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Core;

/**
 * Deactivation WpPromoGames plugin class
 * It handles deactivate hook
 */
class Deactivate
{
    /**
     * Static method 
     * It executes when plugin is deactivating
     *
     * @return void
     */
    public static function exec(): void
    {
        flush_rewrite_rules();
    }
}
