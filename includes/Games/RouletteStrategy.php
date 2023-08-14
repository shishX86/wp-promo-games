<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Games;

use WpPromoGames\Interfaces\IStrategy;

/**
 * Roulette game core
 */
class RouletteStrategy implements IStrategy
{
    private $name = 'Roulette';

    /**
     * Game slug
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
