<?php
if (!defined('ABSPATH')) exit;  // if direct access

/*
 * Hooks that were missing from functions-layout-element.php: the layout builder
 * offered settings for these elements but nothing consumed them, and term_slug
 * did not render at all.
 */

add_action('wcps_layout_element_term_slug', 'wcps_layout_element_term_slug', 10);
function wcps_layout_element_term_slug($args)
{

    $term_id = isset($args['term_id']) ? (int) $args['term_id'] : (int) wcps_get_first_category_id();

    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $link_to = isset($elementData['link_to']) ? $elementData['link_to'] : '';

    $element_class = !empty($element_index) ? 'element-term_slug element-' . $element_index : 'element-term_slug';
    $term = get_term($term_id);
    $term_slug = isset($term->slug) ? $term->slug : '';
    $term_link = get_term_link($term_id);

    if (is_wp_error($term_link)) {
        $term_link = '';
    }

?>
    <div class="<?php echo esc_attr($element_class); ?>">
        <?php if ($link_to === 'none' || empty($term_link)) : ?>
            <?php echo esc_html($term_slug); ?>
        <?php else : ?>
            <a href="<?php echo esc_url($term_link); ?>"><?php echo esc_html($term_slug); ?></a>
        <?php endif; ?>
    </div>
<?php

}

add_action('wcps_layout_element_css_term_slug', 'wcps_layout_element_css_term_slug', 10);
function wcps_layout_element_css_term_slug($args)
{

    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $layout_id = isset($args['layout_id']) ? $args['layout_id'] : '';

    $color = isset($elementData['color']) ? $elementData['color'] : '';
    $font_size = isset($elementData['font_size']) ? $elementData['font_size'] : '';
    $font_family = isset($elementData['font_family']) ? $elementData['font_family'] : '';
    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';
    $text_align = isset($elementData['text_align']) ? sanitize_key($elementData['text_align']) : '';

?>
    <style>
        <?php echo esc_attr('.layout-' . $layout_id); ?><?php echo esc_attr(' .element-' . $element_index); ?> {
            <?php if (!empty($margin)) : ?>margin: <?php echo esc_attr($margin); ?>;
            <?php endif; ?><?php if (!empty($text_align)) : ?>text-align: <?php echo esc_attr($text_align); ?>;
            <?php endif; ?><?php if (!empty($color)) : ?>color: <?php echo esc_attr($color); ?>;
            <?php endif; ?><?php if (!empty($font_size)) : ?>font-size: <?php echo esc_attr($font_size); ?>;
            <?php endif; ?><?php if (!empty($font_family)) : ?>font-family: <?php echo esc_attr($font_family); ?>;
            <?php endif; ?>
        }

        <?php echo esc_attr('.layout-' . $layout_id); ?><?php echo esc_attr(' .element-' . $element_index . ' a'); ?> {
            <?php if (!empty($color)) : ?>color: <?php echo esc_attr($color); ?>;
            <?php endif; ?>
        }
    </style>
<?php
}

add_action('wcps_layout_element_css_term_thumb', 'wcps_layout_element_css_term_thumb', 10);
function wcps_layout_element_css_term_thumb($args)
{

    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $layout_id = isset($args['layout_id']) ? $args['layout_id'] : '';

    $thumb_height = isset($elementData['thumb_height']) ? $elementData['thumb_height'] : '';
    $thumb_height_large = isset($thumb_height['large']) ? $thumb_height['large'] : '';
    $thumb_height_medium = isset($thumb_height['medium']) ? $thumb_height['medium'] : '';
    $thumb_height_small = isset($thumb_height['small']) ? $thumb_height['small'] : '';

    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';

?>
    <style>
        <?php echo esc_attr('.layout-' . $layout_id); ?><?php echo esc_attr(' .element-' . $element_index); ?> {
            overflow: hidden;
            <?php if (!empty($margin)) : ?>margin: <?php echo esc_attr($margin); ?>;
            <?php endif; ?>
        }

        @media only screen and (min-width: 1024px) {
            <?php echo esc_attr('.layout-' . $layout_id); ?><?php echo esc_attr(' .element-' . $element_index); ?> {
                <?php if (!empty($thumb_height_large)) : ?>max-height: <?php echo esc_attr($thumb_height_large); ?>;
                <?php endif; ?>
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 1023px) {
            <?php echo esc_attr('.layout-' . $layout_id); ?><?php echo esc_attr(' .element-' . $element_index); ?> {
                <?php if (!empty($thumb_height_medium)) : ?>max-height: <?php echo esc_attr($thumb_height_medium); ?>;
                <?php endif; ?>
            }
        }

        @media only screen and (min-width: 0px) and (max-width: 767px) {
            <?php echo esc_attr('.layout-' . $layout_id); ?><?php echo esc_attr(' .element-' . $element_index); ?> {
                <?php if (!empty($thumb_height_small)) : ?>max-height: <?php echo esc_attr($thumb_height_small); ?>;
                <?php endif; ?>
            }
        }
    </style>
<?php
}

add_action('wcps_layout_element_css_wrapper_start', 'wcps_layout_element_css_wrapper_start', 10);
function wcps_layout_element_css_wrapper_start($args)
{

    $element_index = isset($args['element_index']) ? $args['element_index'] : '';
    $elementData = isset($args['elementData']) ? $args['elementData'] : array();
    $layout_id = isset($args['layout_id']) ? $args['layout_id'] : '';

    $margin = isset($elementData['margin']) ? $elementData['margin'] : '';
    $css_idle = isset($elementData['css_idle']) ? $elementData['css_idle'] : '';

    if (empty($margin) && empty($css_idle)) {
        return;
    }

?>
    <style>
        <?php echo esc_attr('.layout-' . $layout_id); ?><?php echo esc_attr(' .element-' . $element_index); ?> {
            <?php if (!empty($margin)) : ?>margin: <?php echo esc_attr($margin); ?>;
            <?php endif; ?>
        }
        <?php echo wp_strip_all_tags(str_replace('__ID__', 'layout-' . $layout_id, $css_idle)); ?>
    </style>
<?php
}
