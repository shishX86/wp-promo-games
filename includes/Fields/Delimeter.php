<?php

/**
 * Template for section title
 * 
 * @package WpPromoGames
 */

namespace WpPromoGames\Fields;

/**
 * Subheader Metabox field
 */
class Delimeter
{

    /**
     * Render generak metabox template
     *
     * @param $post - current post object
     * @return void
     */
    public static function render($fieldData): void
    {
        $width = isset( $fieldData['width']) ? 'style="width:' . $fieldData['width'] . '%"' : '';
        
        ob_start();

        ?>

            <div class="wppgs-fieldgroup" <?php echo $width ?>>
                <div class="wppgs-delimeter"></div>
            </div>

        <?php

        echo ob_get_clean();
    }
}
