<?php

namespace Fbs\Auction\Admin;

class AddFields{

    function __construct()
    {
        add_action('fbs_ap_add_fields', [$this, 'fields_in_panel'] );
        add_action('woocommerce_process_product_meta', [$this, 'save_fields'] );
    }

    /**
     * Add filds for admin panel
     *
     * @param [type] $post_id
     * @return void
     * @author Fazle Bari <fazlebarisn@gmail.com>
     * @since 1.0.0
     */
    public function fields_in_panel(){

        $args = [];

        $args[] = [
            'id'            => 'fbs_opening_price',
            'name'          => 'fbs_opening_price',
            'label'         =>  __( 'Opening Price', 'fbs-woocommerce-auction' ) . ' (' . get_woocommerce_currency_symbol() . ')',
            'class'         =>  'fbs_ap_input',
            'type'          =>  'text',
            'desc_tip'      =>  true,
            'description'   => 'Add the opining price',
            'data_type'     => 'price'
        ];
        $args[] = [
            'id'            => 'fbs_lowest_price',
            'name'          => 'fbs_lowest_price',
            'label'         =>  __( 'Lowest Price', 'fbs-woocommerce-auction' ) . ' (' . get_woocommerce_currency_symbol() . ')',
            'class'         =>  'fbs_ap_input',
            'type'          =>  'text',
            'desc_tip'      =>  true,
            'description'   => 'Add the lowest price',
            'data_type'     => 'price'
        ];
        $args[] = [
            'id'            => 'fbs_buynow_price',
            'name'          => 'fbs_buynow_price',
            'label'         =>  __( 'Buy Now Price', 'fbs-woocommerce-auction' ) . ' (' . get_woocommerce_currency_symbol() . ')',
            'class'         =>  'fbs_ap_input',
            'type'          =>  'text',
            'desc_tip'      =>  true,
            'description'   => 'Add buy now price',
            'data_type'     => 'price'
        ];
        $args[] = [
            'id'            => 'fbs_bid_closing_date',
            'name'          => 'fbs_bid_closing_date',
            'label'         =>  __( 'Bid Closing Date', 'fbs-woocommerce-auction' ),
            'placeholder'   => 'yyyy-mm-dd',
            // 'class'         =>  'fbs_ap_input',
            'type'          =>  'date',
            // 'desc_tip'      =>  true,
            // 'description'   => 'Cloose bid closing time',

        ];

        // if need to add more field or change field data, then we can use this filter hook
        $args = apply_filters('fbs_ap_panel_field_args', $args);
    
        // Loop though all fields and add at ones
        foreach( $args as $arg ){
            woocommerce_wp_text_input( $arg );
        }

        // add a select fropdown menu for product type
        woocommerce_wp_select( array(
            'id' => 'fbs_product_type',
            'label' => 'Product Type',
            'options' => array(
                'new' => 'New',
                'used' => 'Used',
            ),
        ) );

    }

    /**
     * Save all fields data
     *
     * @param [type] $post_id
     * @return void
     * @author Fazle Bari <fazlebarisn@gmail.com>
     * @since 1.0.0
     */
    public function save_fields( $post_id ){
        // Sanitize data before input
        $fbs_opening_price = isset( $_POST['fbs_opening_price'] ) ? sanitize_text_field( $_POST['fbs_opening_price'] ) : '';
        $fbs_lowest_price = isset( $_POST['fbs_lowest_price'] ) ? sanitize_text_field( $_POST['fbs_lowest_price'] ) : '';
        $fbs_buynow_price = isset( $_POST['fbs_buynow_price'] ) ? sanitize_text_field( $_POST['fbs_buynow_price'] ) : '';
        $fbs_bid_closing_date = isset( $_POST['fbs_bid_closing_date'] ) ? sanitize_text_field( $_POST['fbs_bid_closing_date'] ) : '';
        $fbs_product_type = isset( $_POST['fbs_product_type'] ) ? sanitize_text_field( $_POST['fbs_product_type'] ) : '';

        //Updating Here
        update_post_meta( $post_id, 'fbs_opening_price', esc_attr( $fbs_opening_price ) );
        update_post_meta( $post_id, 'fbs_lowest_price', esc_attr( $fbs_lowest_price ) );
        update_post_meta( $post_id, 'fbs_buynow_price', esc_attr( $fbs_buynow_price ) );
        update_post_meta( $post_id, 'fbs_bid_closing_date', esc_attr( $fbs_bid_closing_date ) );
        update_post_meta( $post_id, 'fbs_product_type', esc_attr( $fbs_product_type ) );
    }
}