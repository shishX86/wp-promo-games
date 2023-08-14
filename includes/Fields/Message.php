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
class Message
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
        $message = isset( $fieldData['message'] ) ? htmlspecialchars_decode( $fieldData['message'] ) : '';

        ob_start();

        ?>

            <div class="wppgs-fieldgroup" <?php echo $width ?>>
                <div class="wppgs-fieldgroupinner">
                    <div class="wppgs-message">
                        <?php echo $message ?>
                    </div>
                </div>
            </div>

        <?php

        echo ob_get_clean();
    }
}
