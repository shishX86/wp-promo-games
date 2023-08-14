<?php

namespace WpPromoGames\Environment;

class LeaderboardFieldsConfig {

    public static $basename = 'wppgs_leaderboard_metabox';

    /**
     * Returns general game metabox config array
     *
     * @return string
     */
    public static function getConfig(): array
    {  
        $basename = self::$basename;

        $output = [
            'basename' => $basename,
            'config' => [
                [
                    'id' => 'lb_section_1',
                    'type' => 'section_title',
                    'label' => __('GENERAL', 'wp-promo-games'),
                ],
                [
                    'id' => 'lb_results_count',
                    'name' => $basename . '_lb_results_count',
                    'type' => 'numeric',
                    'label' => __('Results count', 'wp-promo-games'),
                    'placeholder' => __('10, for example', 'wp-promo-games'),
                    'min' => 1,
                    'width' => '33.333333',
                    'used_for' => 'leaderboard_counter'
                ],
                [
                    'id' => 'lb_game_select',
                    'type' => 'select',
                    'label' => __('Select game', 'wp-promo-games'),
                    'name' => $basename . '_lb_game_select',
                    'width' => '50',
                    'data' => [
                        'source' => [
                            'post_type' => GlobalConfig::cptGame()
                        ]
                    ]
                ],
                [
                    'id' => 'lb_section_2',
                    'type' => 'section_title',
                    'label' => __('SELECT COLUMNS', 'wp-promo-games'),
                ],
                [
                    'id' => 'lb_columns',
                    'type' => 'repeater',
                    'width' => '100',
                    'template' => [
                        [
                            'id' => 'lb_columns_name',
                            'name' => $basename . '_lb_columns_name[]',
                            'type' => 'label',
                            'label' => __('Column name', 'wp-promo-games'),
                            'placeholder' => __('Insert column name', 'wp-promo-games'),
                            'min' => 1,
                            'width' => '50',
                            'used_for' => 'leaderboard_data'
                        ],
                        [
                            'id' => 'lb_columns_select',
                            'type' => 'select',
                            'label' => __('Column data', 'wp-promo-games'),
                            'name' => $basename . '_lb_columns_select[]',
                            'width' => '50',
                            'used_for' => 'leaderboard_colunms',
                            'data' => [
                                [
                                    'label' => __('Position', 'wp-promo-games'),
                                    'value' => 1
                                ],
                                [
                                    'label' => __('Score', 'wp-promo-games'),
                                    'value' => 2
                                ],
                                [
                                    'label' => __('Email', 'wp-promo-games'),
                                    'value' => 3
                                ],
                                [
                                    'label' => __('Price', 'wp-promo-games'),
                                    'value' => 4
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        return $output;
    }
}