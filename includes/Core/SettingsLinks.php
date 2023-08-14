<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Core;

use WpPromoGames\Environment\GlobalConfig;

/**
 * Adds settings links
 * on plugins list page
 */
class SettingsLinks
{
    /**
     * Initialize method
     *
     * @return void
     */
    public function init(): void
    {
        add_filter('plugin_action_links_' . GlobalConfig::baseName(), [$this, 'settingsLink']);
    }

    /**
     * Inject settings link to plugin block
     * on plugins list page
     *
     * @param  array $links from hook
     * @return array $liks with injected settings link
     */
    public function settingsLink(array $links): array
    {
        $link = '<a href="admin.php?page=wp_promo_games">Settings</a>';
        array_push($links, $link);

        return $links;
    }
}
