<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Games;

use WpPromoGames\Interfaces\IStrategy;

/**
 * FlappyBird game core
 */
class FlappyBirdStrategy implements IStrategy
{
    private $name = 'flappyBird';

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
