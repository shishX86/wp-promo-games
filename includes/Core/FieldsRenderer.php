<?php

/**
 * Template for Wysiwyg
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Core;

use WpPromoGames\Fields\Image;
use WpPromoGames\Fields\Label;
use WpPromoGames\Fields\Select;
use WpPromoGames\Fields\Message;
use WpPromoGames\Fields\Numeric;
use WpPromoGames\Fields\Wysiwyg;
use WpPromoGames\Fields\Repeater;
use WpPromoGames\Fields\Delimeter;
use WpPromoGames\Fields\AjaxSelect;
use WpPromoGames\Fields\ColorPicker;
use WpPromoGames\Fields\SectionTitle;
use WpPromoGames\Fields\SwitchToggle;

/**
 * Wysiwyg Metabox field
 */
class FieldsRenderer
{

    /**
     * Render generak metabox template
     *
     * @param $post - current post object
     * @return void
     */
    public static function renderFields($fieldSet) {
        foreach( $fieldSet as $fieldData ) {
            if( isset($fieldData['ajax_field']) && !wp_doing_ajax() ) continue;

            switch( $fieldData['type'] ) {
                case 'label':
                    Label::render($fieldData);
                    break;
                case 'numeric':
                    Numeric::render($fieldData);
                    break;
                case 'color_picker':
                    ColorPicker::render($fieldData);
                    break;
                case 'section_title':
                    SectionTitle::render($fieldData);
                    break;
                case 'message':
                    Message::render($fieldData);
                    break;
                case 'image':
                    Image::render($fieldData);
                    break;
                case 'select':
                    Select::render($fieldData);
                    break;
                case 'toggleswitch':
                    SwitchToggle::render($fieldData);
                    break;
                case 'wysiwyg':
                    Wysiwyg::render($fieldData);
                    break;
                case 'delimeter':
                    Delimeter::render($fieldData);
                    break;
                case 'ajax_select':
                    AjaxSelect::render($fieldData);
                    break;
                case 'repeater':
                    Repeater::render($fieldData);
                    break;
                default:
                    throw new \Exception( __('Unknown type:', 'wp-promo-games') . ' ' . $fieldData['type']);
            }
        }
    }
}
