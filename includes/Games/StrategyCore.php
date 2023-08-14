<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Games;

use WpPromoGames\Games\FlappyBirdStrategy;
use WpPromoGames\Games\RouletteStrategy;

/**
 * Game Strategy base class
 */
class StrategyCore
{
    private $strategy = null;

    /**
     * Construct
     *
     * @param string $strategySlug
     */
    function __construct(string $strategySlug)
    {
        switch ($strategySlug) {
            case 'flappy':
                $this->strategy = new FlappyBirdStrategy();
                break;
            case 'roulette':
                $this->strategy = new RouletteStrategy();
                break;
            default:
                throw new \InvalidArgumentException("$strategySlug - " . __('Unknown strategy', 'wp-promo-games'));
        }
    }

    /**
     * Returns current game Strategy name
     *
     * @return string
     */
    public function getStrategyName(): string
    {
        return $this->strategy->getName();
    }
}
