<?php

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Interfaces;

/**
 * Game Strategy Interface
 */
interface IStrategy
{
    /**
     * Returns current game slug
     *
     * @return string
     */
    public function getName(): string;
}
