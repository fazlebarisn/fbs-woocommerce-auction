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
            'id'        =>'fbs_ap_price',
            'name'      => 'fbs_ap_price',
            'label'     =>  __( 'Price', 'fbs-woocommerce-auction' ),
            'class'     =>  'fbs_ap_input',
            'type'      =>  'text',
            // 'desc_tip'  =>  true,
            'description'=> 'Price',
            // 'data_type' => 'decimal'
        ];

        // if need to add more field or change field data, then we can use this filter hook
        $args = apply_filters('fbs_ap_panel_field_args', $args);
    
        // Loop though all fields and add at ones
        foreach( $args as $arg ){
            woocommerce_wp_text_input( $arg );
        }

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
    
        $fbs_ap_price = $_POST['fbs_ap_price'] ?? false;
        
        //Updating Here
        update_post_meta( $post_id, 'fbs_ap_price', esc_attr( $fbs_ap_price ) );
    }
}