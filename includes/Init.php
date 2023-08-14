<?php

/**
 * This is start poin of WpPromoGames plugin.
 * This class register and perform
 * all used classes and initialize them.
 * 
 * Class is final and not extensible.
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames;

use WpPromoGames\Games\StrategyCore;

/**
 * Initialize plugin entry point
 */
final class Init
{
    /**
     * Contain all required classes of services
     *
     * @return array Of Services
     */
    public static function getServices(): array
    {
        return [
            //core
            Core\Enqueue::class,
            Core\SettingsLinks::class,
            Core\Shortcodes::class,
            Core\CustomPostTypes::class,
            //pages
            Core\MenuPages::class,
            Core\Metaboxes::class,
            Core\Ajax::class,
        ];
    }


    /**
     * Perform register for required classes of services
     *
     * @return void
     */
    public static function registerServices(): void
    {
        foreach (self::getServices() as $class) {
            $services = self::instantiate($class);

            if (method_exists($services, 'init')) {
                $services->init();
            }
        }
    }


    /**
     * Register games strategies
     *
     * @return void
     */
    public static function setStrategies(): void
    {
        $coreStrategy = new StrategyCore('roulette');
    }


    /**
     * invoke register of required classes of services
     *
     * @param  string $class Class name to instantiate
     * @return class Service class instance
     */
    private static function instantiate(string $class)
    {
        $service = new $class();

        return $service;
    }
}
