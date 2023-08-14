<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Core;

use WpPromoGames\Callbacks\MenuPagesCallbacks;
use WpPromoGames\Environment\AdminPagesConfig;

/**
 * Creates pages and subpages
 * in plugin menu
 */
class MenuPages
{
    protected $pages = [];
    protected $subpages = [];

    /**
     * Initialize method
     *
     * @return void
     */
    function init(): void
    {
        $this->pages = AdminPagesConfig::pagesConfig();
        $this->subpages = AdminPagesConfig::subpagesConfig(new MenuPagesCallbacks());

        if (!empty($this->pages)) {
            add_action('admin_menu', [$this, 'addAdminMenu']);
        }
    }

    /**
     * Admin menu filling by pages and subpages
     *
     * @return void
     */
    public function addAdminMenu(): void
    {
        foreach ($this->pages as $page) {
            add_menu_page(
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback'],
                $page['icon_url'],
                $page['position']
            );
        }

        foreach ($this->subpages as $page) {
            add_submenu_page(
                $page['parent_slug'],
                $page['page_title'],
                $page['menu_title'],
                $page['capability'],
                $page['menu_slug'],
                $page['callback'],
            );
        }
    }
}
