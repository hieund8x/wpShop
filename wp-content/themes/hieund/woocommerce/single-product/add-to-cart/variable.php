<?php
/**
 * Variable product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product, $post;
?>

<?php do_action('woocommerce_before_add_to_cart_form'); ?>

<form class="variations_form cart" method="post" enctype='multipart/form-data' data-product_id="<?php echo $post->ID; ?>" data-product_variations="<?php echo esc_attr( json_encode( $available_variations ) ) ?>">
    <table class="variations" cellspacing="0">
        <tbody>
        <?php $loop = 0; foreach ( $attributes as $name => $options ) : $loop++; ?>
            <tr>
                <td class="label"><label for="<?php echo sanitize_title($name); ?>"><?php echo wc_attribute_label( $name ); ?></label></td>
                <td class="value"><select id="<?php echo esc_attr( sanitize_title($name) ); ?>" name="attribute_<?php echo sanitize_title($name); ?>">
                        <option value=""><?php echo __( 'Choose an option', 'woocommerce' ) ?>&hellip;</option>
                        <?php
                        if ( is_array( $options ) ) {

                            if ( empty( $_POST ) )
                                $selected_value = ( isset( $selected_attributes[ sanitize_title( $name ) ] ) ) ? $selected_attributes[ sanitize_title( $name ) ] : '';
                            else
                                $selected_value = isset( $_POST[ 'attribute_' . sanitize_title( $name ) ] ) ? $_POST[ 'attribute_' . sanitize_title( $name ) ] : '';

                            // Get terms if this is a taxonomy - ordered
                            if ( taxonomy_exists( $name ) ) {

                                $orderby = wc_attribute_orderby( $name );

                                switch ( $orderby ) {
                                    case 'name' :
                                        $args = array( 'orderby' => 'name', 'hide_empty' => false, 'menu_order' => false );
                                        break;
                                    case 'id' :
                                        $args = array( 'orderby' => 'id', 'order' => 'ASC', 'menu_order' => false );
                                        break;
                                    case 'menu_order' :
                                        $args = array( 'menu_order' => 'ASC' );
                                        break;
                                }

                                $terms = get_terms( $name, $args );

                                foreach ( $terms as $term ) {
                                    if ( ! in_array( $term->slug, $options ) )
                                        continue;

                                    echo '<option value="' . esc_attr( $term->slug ) . '" ' . selected( $selected_value, $term->slug, false ) . '>' . apply_filters( 'woocommerce_variation_option_name', $term->name ) . '</option>';
                                }
                            } else {

                                foreach ( $options as $option ) {
                                    echo '<option value="' . esc_attr( sanitize_title( $option ) ) . '" ' . selected( sanitize_title( $selected_value ), sanitize_title( $option ), false ) . '>' . esc_html( apply_filters( 'woocommerce_variation_option_name', $option ) ) . '</option>';
                                }

                            }
                        }
                        ?>
                    </select></td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>

    <?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

    <div class="single_variation_wrap" style="display:none;">

        <?php do_action( 'woocommerce_before_single_variation' ); ?>

        <div class="variations_button group">
            <input type="hidden" name="variation_id" value="" />
            <table class="variations" cellspacing="0">
                <tr>
                    <td class="label"><label><?php _e( 'Quantity', 'yit' ) ?></label></td>
                    <td class="value"><?php woocommerce_quantity_input(); ?></td>
                </tr>
            </table>
            <?php do_action('woocommerce_before_add_to_cart_button'); ?>
            <button type="submit" class="single_add_to_cart_button button alt"><?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'woocommerce' ), $product->product_type); ?></button>
        </div>

        <input type="hidden" name="add-to-cart" value="<?php echo $product->id; ?>" />
        <input type="hidden" name="product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
        <input type="hidden" name="variation_id" value="" />

        <div class="clear"></div>

        <div class="single_variation"></div>

        <a class="reset_variations" href="#reset"><?php _e( 'Clear selection', 'woocommerce' ) ?></a>

        <?php do_action( 'woocommerce_after_single_variation' ); ?>
    </div>

    <?php do_action('woocommerce_after_add_to_cart_button'); ?>

</form>

<?php do_action('woocommerce_after_add_to_cart_form'); ?>
