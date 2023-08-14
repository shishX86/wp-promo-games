<?php
/**
* ////////////
*   Example 
* ////////////
*
* public static function generalGameConfig(): array
*   {  
*       $basename = 'wppgs_general_metabox';*
*       $output = [
*           'basename' => $basename,
*           'config' => [
*               [
*                   'type' => 'section_title',
*                   'label' => 'Общие параметры'
*               ],
*               [
*                   'id' => 'test1',
*                   'type' => 'label',
*                   'label' => 'Заголовок игры',
*                   'name' => $basename . '_test1'
*               ],
*               [
*                   'id' => 'test2',
*                   'type' => 'color_picker',
*                   'label' => 'Цвет фона',
*                   'name' => $basename . '_test2'
*               ],
*               [
*                   'type' => 'section_title',
*                   'label' => 'Дополнительные параметры'
*               ],
*               [
*                   'id' => 'test5',
*                   'type' => 'image',
*                   'label' => 'Картинка',
*                   'btntxt' => 'Upload image',
*                   'name' => $basename . '_test5'
*               ],
*               [
*                   'id' => 'test6',
*                   'type' => 'select',
*                   'label' => 'Картинка',
*                   'data' => ['Значение 1', 'Значение 2', 'Значение 3'],
*                   'name' => $basename . '_test6'
*               ],
*               [
*                   'id' => 'test7',
*                   'type' => 'toggleswitch',
*                   'label' => 'Переключатель',
*                   'name' => $basename . '_test7'
*               ],
*               [
*                   'id' => 'test8',
*                   'type' => 'wysiwyg',
*                   'label' => 'Wysiwyg',
*                   'name' => $basename . '_test8'
*               ],
*               [
*                   'id' => 'test9',
*                   'type' => 'numeric',
*                   'label' => 'Numeric',
*                   'name' => $basename . '_test9',
*                   'placeholder' => 'Insert integer',
*                   'min' => 0,
*                   'max' =>  100
*               ],
*           ]
*       ];*
*       return $output;
*   }
* 
*/

/**
 * @package WpPromoGames
 */

namespace WpPromoGames\Environment;

class GameFieldsConfig {

    public static $basename = 'wppgs_general_metabox';
    public static $gameSelectName  = 'g_game_type';

    /**
     * Returns general game metabox config array
     *
     * @return string
     */
    public static function generalGameConfig(): array
    {  
        $basename = self::$basename;

        $output = [
            'basename' => $basename,
            'config' => [
                [
                    'id' => 'section_1',
                    'type' => 'section_title',
                    'label' => __('CANVAS', 'wp-promo-games'),
                ],
                [
                    'id' => 'g_height_ratio',
                    'name' => $basename . '_g_height_ratio',
                    'type' => 'numeric',
                    'label' => __('Height ratio', 'wp-promo-games'),
                    'placeholder' => __('4, for example', 'wp-promo-games'),
                    'min' => 1,
                    'width' => '33.333333'
                ],
                [
                    'id' => 'g_width_ratio',
                    'name' => $basename . '_g_width_ratio',
                    'type' => 'numeric',
                    'label' => __('Width ratio', 'wp-promo-games'),
                    'placeholder' => '3, for example',
                    'min' => 1,
                    'width' => '33.333333'
                ],
                [
                    'id' => 'message_1',
                    'type' => 'message',
                    'message' => __('Width and height calculates dynamically. All you need is set aspect ratio (for example 4:3) and controll game size by container width', 'wp-promo-games')
                ],
                [
                    'id' => 'delimeter_1',
                    'type' => 'delimeter'
                ],

                //BUTTONS
                [
                    'id' => 'section_2',
                    'type' => 'section_title',
                    'label' => __('BUTTONS', 'wp-promo-games')
                ],
                [
                    'id' => 'g_btns_bg',
                    'name' => $basename . '_g_btns_bg',
                    'type' => 'color_picker',
                    'label' => __('Background color', 'wp-promo-games'),
                    'width' => '33.333333'
                ],
                [
                    'id' => 'g_btns_color',
                    'name' => $basename . '_g_btns_color',
                    'type' => 'color_picker',
                    'label' => __('Text color', 'wp-promo-games'),
                    'width' => '33.333333'
                ],
                [
                    'id' => 'g_btns_radius',
                    'name' => $basename . '_g_btns_radius',
                    'type' => 'numeric',
                    'label' => __('Border radius', 'wp-promo-games'),
                    'placeholder' => __('Insert integer', 'wp-promo-games'),
                    'min' => 0,
                    'width' => '33.333333'
                ],
                [
                    'id' => 'delimeter_2',
                    'type' => 'delimeter'
                ],

                //START SCREEN
                [
                    'id' => 'section_3',
                    'type' => 'section_title',
                    'label' => __('START SCREEN CONTENT', 'wp-promo-games'),
                ],
                [
                    'id' => 'startscreen_content',
                    'type' => 'wysiwyg',
                    'label' => '',
                    'name' => $basename . '_startscreen_content'
                ],
                [
                    'id' => 'delimeter_3',
                    'type' => 'delimeter'
                ],

                //GAME MECHANIKS
                [
                    'id' => 'section_4',
                    'type' => 'section_title',
                    'label' => __('GAME MECHANIKS', 'wp-promo-games'),
                ],
                [
                    'id' => self::$gameSelectName,
                    'name' => $basename . '_' . self::$gameSelectName,
                    'type' => 'ajax_select',
                    'label' => __('Game type', 'wp-promo-games'),
                    'width' => '100',
                    'action' => 'wppgsGetRelatedMetabox',
                    'html_cont' => 'js-game-strategy-cont',
                    'select_class' => 'js-game-strategy-select',
                    'data' => [
                        [
                            'label' => 'flappybird',
                            'value' => 1
                        ],
                        [
                            'label' => 'roulette',
                            'value' => 2
                        ],
                    ]
                ],
            ]
        ];

        return $output;
    }

    public static function concreteGameConfig(int $index): array
    {
        $output = [];
        $basename = self::$basename;

        //TODO: Add in help! Use 'ajax_field' => true if you do not need to show field 
        //because it loads by ajax in special container

        switch ($index) {
            
            //FLAPPY BIRD MECHANIKS
            case 1: 
                $output = [
                    [
                        'id' => 'section_5',
                        'type' => 'section_title',
                        'label' => __('FLAPPY BIRD MECHANIKS', 'wp-promo-games'),
                        'ajax_field' => true
                    ],
                    [
                        'id' => 'g1_test',
                        'name' => $basename . '_g1_test',
                        'type' => 'numeric',
                        'label' => __('FLAPPY Test field', 'wp-promo-games'),
                        'placeholder' => __('Insert integer', 'wp-promo-games'),
                        'min' => 0,
                        'width' => '33.333333',
                        'ajax_field' => true
                    ],
                    [
                        'id' => 'delimeter_4',
                        'type' => 'delimeter',
                        'ajax_field' => true
                    ],
                ];
                break;

            //ROULETTE MECHANIKS
            case 2: 
                $output = [
                    [
                        'id' => 'section_6',
                        'type' => 'section_title',
                        'label' => __('ROULETTE MECHANIKS', 'wp-promo-games'),
                        'ajax_field' => true
                    ],
                    [
                        'id' => 'g2_test',
                        'name' => $basename . '_g2_test',
                        'type' => 'numeric',
                        'label' => __('ROULETTE Test field', 'wp-promo-games'),
                        'placeholder' => __('Insert integer', 'wp-promo-games'),
                        'min' => 0,
                        'width' => '33.333333',
                        'ajax_field' => true
                    ],
                    [
                        'id' => 'delimeter_5',
                        'type' => 'delimeter',
                        'ajax_field' => true
                    ],
                ];
                break;

            default:
                throw new \Exception( __('Unknown game type', 'wp-promo-games'));
        }

        return $output;
    }
}