<?php
if (! defined('ABSPATH')) exit;  // if direct access


add_action('wcps_layout_metabox_content_custom_scripts', 'wcps_layout_metabox_content_custom_scripts');

if (!function_exists('wcps_layout_metabox_content_custom_scripts')) {
    function wcps_layout_metabox_content_custom_scripts($post_id)
    {


        $settings_tabs_field = new settings_tabs_field();
        $custom_scripts = get_post_meta($post_id, 'custom_scripts', true);
        $layout_options = get_post_meta($post_id, 'layout_options', true);


        $custom_css = isset($custom_scripts['custom_css']) ? $custom_scripts['custom_css'] : '';
        $custom_js = isset($custom_scripts['custom_js']) ? $custom_scripts['custom_js'] : '';
        $layout_preview_img = isset($layout_options['layout_preview_img']) ? $layout_options['layout_preview_img'] : '';





?>
        <div class="section">
            <div class="section-title"><?php echo esc_html__('Custom scripts', 'woocommerce-products-slider'); ?></div>
            <p class="description section-description"><?php echo esc_html__('Write custom scripts to override CSS and scripts.', 'woocommerce-products-slider'); ?></p>


            <?php
            $args = array(
                'id'        => 'custom_css',
                'parent'        => 'custom_scripts',
                'title'        => __('Custom CSS', 'woocommerce-products-slider'),
/* translators: Post ID */
                'details'    =>   sprintf(__('Write custom CSS to override default style, do not use <code>&lt;style>&lt;/style></code> tag. use <code>__ID__</code> to replace by layout id <code>layout-%s</code>.', 'woocommerce-products-slider'), $post_id),
                'type'        => 'scripts_css',
                'value'        => $custom_css,
                'default'        => '',
                'placeholder'        => '',
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'        => 'custom_js',
                'parent'        => 'custom_scripts',
                'title'        => __('Custom JS', 'woocommerce-products-slider'),
                'details'    => __('Write custom JS to override default style, do not use <code>&lt;script>&lt;/script></code> tag.', 'woocommerce-products-slider'),
                'type'        => 'scripts_js',
                'value'        => $custom_js,
                'default'        => '',
                'placeholder'        => '',
            );

            $settings_tabs_field->generate_field($args);

            $args = array(
                'id'        => 'layout_preview_img',
                'parent'        => 'layout_options',
                'title'        => __('Preview image', 'woocommerce-products-slider'),
                'details'    => __('Set layout preview image.', 'woocommerce-products-slider'),
                'type'        => 'media_url',
                'value'        => $layout_preview_img,
                'default'        => '',
                'placeholder'        => '',
            );

            $settings_tabs_field->generate_field($args);





            ?>
        </div>
    <?php


    }
}








add_action('wcps_layout_metabox_content_layout_builder', 'wcps_layout_metabox_content_layout_builder');

if (!function_exists('wcps_layout_metabox_content_layout_builder')) {

    function wcps_layout_metabox_content_layout_builder($post_id)
    {


        $settings_tabs_field = new settings_tabs_field();

        $layout_elements_data = get_post_meta($post_id, 'layout_elements_data', true);

        //echo '<pre>'.var_export($layout_elements_data, true).'</pre>';

    ?>
        <div class="section">
            <div class="section-title"><?php echo esc_html__('Layout builder', 'woocommerce-products-slider'); ?></div>
            <p class="description section-description"><?php echo esc_html__('Customize layout settings.', 'woocommerce-products-slider'); ?></p>

            <?php
            $layout_elements['wrapper_start'] = array('name' => __('Wrapper start', 'woocommerce-products-slider'));
            $layout_elements['wrapper_end'] = array('name' => __('Wrapper end', 'woocommerce-products-slider'));
            $layout_elements['custom_text'] = array('name' => __('Custom text', 'woocommerce-products-slider'));


            $layout_elements['thumbnail'] = array('name' => __('Thumbnail', 'woocommerce-products-slider'));
            $layout_elements['post_title'] = array('name' => __('Post Title', 'woocommerce-products-slider'));
            $layout_elements['content'] = array('name' => __('Content', 'woocommerce-products-slider'));
            $layout_elements['product_category'] = array('name' => __('Product Category', 'woocommerce-products-slider'));
            $layout_elements['product_tag'] = array('name' => __('Product Tag', 'woocommerce-products-slider'));
            $layout_elements['sale_count'] = array('name' => __('Sale Count', 'woocommerce-products-slider'));
            $layout_elements['featured_mark'] = array('name' => __('Featured', 'woocommerce-products-slider'));
            $layout_elements['on_sale_mark'] = array('name' => __('On sale', 'woocommerce-products-slider'));
            $layout_elements['add_to_cart'] = array('name' => __('Add to cart', 'woocommerce-products-slider'));
            $layout_elements['rating'] = array('name' => __('Rating', 'woocommerce-products-slider'));
            $layout_elements['product_price'] = array('name' => __('Price', 'woocommerce-products-slider'));
            $layout_elements['product_id'] = array('name' => __('Product ID', 'woocommerce-products-slider'));

            $layout_elements['term_title'] = array('name' => __('Term title', 'woocommerce-products-slider'));
            $layout_elements['term_thumb'] = array('name' => __('Term thumbnail', 'woocommerce-products-slider'));
            $layout_elements['term_description'] = array('name' => __('Term description', 'woocommerce-products-slider'));
            $layout_elements['term_slug'] = array('name' => __('Term slug', 'woocommerce-products-slider'));
            $layout_elements['term_post_count'] = array('name' => __('Term post count', 'woocommerce-products-slider'));

            $layout_elements['order_date'] = array('name' => __('Order date', 'woocommerce-products-slider'));
            $layout_elements['order_customer_name'] = array('name' => __('Order customer name', 'woocommerce-products-slider'));
            $layout_elements['order_customer_thumb'] = array('name' => __('Order customer thumbnail', 'woocommerce-products-slider'));
            $layout_elements['order_country'] = array('name' => __('Order country', 'woocommerce-products-slider'));
            $layout_elements['order_payment_method'] = array('name' => __('Order payment method', 'woocommerce-products-slider'));
            $layout_elements['order_total'] = array('name' => __('Order total', 'woocommerce-products-slider'));
            $layout_elements['order_items'] = array('name' => __('Order items', 'woocommerce-products-slider'));
            $layout_elements['order_discount_total'] = array('name' => __('Order discount total', 'woocommerce-products-slider'));



            $layout_elements = apply_filters('wcps_layout_elements', $layout_elements);


            $layout_elements_option = array();

            if (!empty($layout_elements))
                foreach ($layout_elements as $elementIndex => $element):

                    ob_start();

                    do_action('wcps_layout_elements_option_' . $elementIndex);

                    $layout_elements_option[$elementIndex] = ob_get_clean();

                endforeach;

            /*
             * The builder script and styles are printed directly, outside the
             * custom_html field. field_custom_html() runs its markup through
             * wp_kses(), which strips <script> and <style> tags and leaves their
             * contents behind as visible text, breaking the layout builder.
             */
            $layout_builder_js = 'jQuery(document).ready(function($) {'
                . 'var layout_elements_option = ' . wp_json_encode($layout_elements_option, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) . ';'
                . '$(document).on("click", ".layout-tags span", function() {'
                . 'var tag_id = $(this).data("tag-id");'
                . 'var input_name = $(this).data("input-name");'
                . 'var id = $.now();'
                . 'var tag_options_html = layout_elements_option[tag_id];'
                . 'if (typeof tag_options_html === "undefined") { return; }'
                . 'var res = tag_options_html.replace(/{input_name}/g, input_name + "[" + id + "]");'
                . '$(this).parent().parent().children(".elements").append(res);'
                . '});'
                // Inline onclick handlers on saved elements are stripped by wp_kses(); handle them here.
                . '$(document).on("click", ".layout-builder .element-title .remove", function() {'
                . '$(this).closest(".item").remove();'
                . '});'
                . '$(document).on("click", ".layout-builder textarea[readonly], .layout-builder code", function() {'
                . 'if (typeof this.select === "function") { this.select(); }'
                . '});'
                . '});';

            if (function_exists('wp_print_inline_script_tag')) {
                wp_print_inline_script_tag($layout_builder_js);
            } else {
                echo '<script>' . $layout_builder_js . '</script>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Built from json-encoded data and static code.
            }

            ?>
            <style>
                .layout-builder {}

                .layout-tags {
                    margin-bottom: 20px;
                    position: sticky;
                    top: 32px;
                    z-index: 999;
                    background: #fff;
                    padding: 5px 5px;
                    border-bottom: 1px solid #ddd;
                    max-height: 70px;
                    overflow-y: scroll;
                }

                .layout-tags span {
                    background: #ddd;
                    padding: 4px 10px;
                    display: inline-block;
                    margin: 2px 2px;
                    border-radius: 3px;
                    border: 1px solid #b9b9b9;
                    cursor: pointer;
                }

                .layout-tags span:hover {
                    background: #b9b9b9;

                }
            </style>
            <?php

            ob_start();

            ?>

            <div class="layout-builder">
                <div class="layout-tags">
                    <?php

                    if (!empty($layout_elements))
                        foreach ($layout_elements as $elementIndex => $element):
                            $element_name = isset($element['name']) ? $element['name'] : '';
                    ?>
                        <span data-input-name="layout_elements_data" data-tag-id="<?php echo esc_attr($elementIndex); ?>"><?php echo esc_html($element_name); ?></span>
                    <?php

                        endforeach;

                    ?>
                </div>

                <div class="elements expandable sortable">

                    <?php

                    if (!empty($layout_elements_data)):
                        foreach ($layout_elements_data as $index => $item_data) {
                            foreach ($item_data as $elementIndex => $element_data) {

                                $args = array('input_name' => 'layout_elements_data[' . $index . ']', 'element_data' => $element_data, 'index' => $index);
                                do_action('wcps_layout_elements_option_' . $elementIndex, $args);
                            }
                        }
                    else:
                    ?>
                        <div class="empty-element">
                            <?php
                            /* translators: %s is Icon HTML */
                            echo sprintf(esc_html__('%s Click to add tags.', 'woocommerce-products-slider'), '<i class="far fa-hand-point-up"></i>') ?>
                        </div>
                    <?php
                    endif;

                    ?>

                </div>


            </div>

            <?php

            $html = ob_get_clean();


            $args = array(
                'id'        => 'layout_builder',
                //'parent'		=> '',
                'title'        => __('Layout elements', 'woocommerce-products-slider'),
                'details'    => __('Customize layout elements.', 'woocommerce-products-slider'),
                'type'        => 'custom_html',
                'html'        => $html,
                'default'        => '',
            );

            $settings_tabs_field->generate_field($args);


            ob_start();



            $item_layout_id = get_the_id();
            $args['layout_id'] = $item_layout_id;

            ?>
            <div class="layout-preview">

                <div class="elements-wrapper layout-<?php echo esc_attr($item_layout_id); ?>">
                    <?php
                    if (!empty($layout_elements_data))
                        foreach ($layout_elements_data as $elementGroupIndex => $elementGroupData) {
                            foreach ($elementGroupData as $elementIndex => $elementData) {




                                $args['product_id'] = wcps_get_first_product_id();
                                $args['elementData'] = $elementData;
                                $args['element_index'] = $elementGroupIndex;




                                do_action('wcps_layout_element_' . $elementIndex, $args);
                            }
                        }

                    //echo '<pre>'.var_export($args, true).'</pre>';

                    ?>
                </div>







            </div>

            <?php

            if (!empty($layout_elements_data))
                foreach ($layout_elements_data as $elementGroupIndex => $elementGroupData) {
                    foreach ($elementGroupData as $elementIndex => $elementData) {


                        $args['elementData'] = $elementData;
                        $args['element_index'] = $elementGroupIndex;

                        //echo $elementIndex;
                        do_action('wcps_layout_element_css_' . $elementIndex, $args);
                    }
                }

            $html = ob_get_clean();

            $args = array(
                'id'        => 'layout_preview',
                //'parent'		=> '',
                'title'        => __('Layout preview', 'woocommerce-products-slider'),
                'details'    => __('Layout preview', 'woocommerce-products-slider'),
                'type'        => 'custom_html',
                'html'        => $html,
                'default'        => '',
            );

            $settings_tabs_field->generate_field($args);

            // Printed outside the custom_html field: wp_kses() would strip the <style> tag.
            $custom_scripts = get_post_meta($item_layout_id, 'custom_scripts', true);
            $custom_css = isset($custom_scripts['custom_css']) ? $custom_scripts['custom_css'] : '';

            ?>
            <style>
                .layout-preview {
                    background: url(<?php echo esc_url(wcps_plugin_url); ?>assets/admin/css/tile.png);
                    padding: 20px;
                }

                .layout-preview .elements-wrapper {
                    width: 400px;
                    overflow: hidden;
                    margin: 0 auto;
                }

                .layout-preview img {
                    width: 100%;
                    height: auto;
                }

                <?php
                echo wp_strip_all_tags(str_replace('__ID__', 'layout-' . $item_layout_id, $custom_css));
                ?>
            </style>
            <?php



            ?>
        </div>
<?php


    }
}











add_action('wcps_layout_metabox_save', 'wcps_layout_metabox_save');

function wcps_layout_metabox_save($job_id)
{

    $layout_options = isset($_POST['layout_options']) ? wcps_recursive_sanitize_arr(wp_unslash($_POST['layout_options'])) : '';
    update_post_meta($job_id, 'layout_options', $layout_options);

    $layout_elements_data = isset($_POST['layout_elements_data']) ? wcps_recursive_sanitize_arr(wp_unslash($_POST['layout_elements_data'])) : '';
    update_post_meta($job_id, 'layout_elements_data', $layout_elements_data);

    $custom_scripts = isset($_POST['custom_scripts']) ? wcps_recursive_sanitize_arr(wp_unslash($_POST['custom_scripts'])) : '';
    update_post_meta($job_id, 'custom_scripts', $custom_scripts);
}
