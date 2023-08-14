<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Callbacks;

use WpPromoGames\Environment\GlobalConfig;

/**
 * Class MenuPagesCallbacks handles callbacks for
 * rendering templates for plugin pages
 */

class MenuPagesCallbacks
{
    /**
     * Template for Help page
     *
     * @return string
     */
    public function helpTemplate(): string
    {
        return require_once(GlobalConfig::pluginPath() . "/templates/Help.php");
    }

    /**
     * Template for Friends page
     *
     * @return string
     */
    public function friendsTemplate(): string
    {
        return require_once(GlobalConfig::pluginPath() . "/templates/Friends.php");
    }
}
