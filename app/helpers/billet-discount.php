<?php
/**
 * Add billet discount
 *
 * @since 1.0.2
 * @return float
 */

use WcGetnet\Entities\WcGetnet_Settings as Settings_Entity;

function add_billet_discount() {
    $payment_method = WC()->session->get( 'chosen_payment_method' );

    if ( 'getnet-billet' === $payment_method ) {
        $billet_settings = Settings_Entity::getBilletSettings();
        $discount_name   = isset( $billet_settings['discount_name'] ) ? $billet_settings['discount_name'] : __( 'Desconto Getnet' );
        $discount_value  = isset( $billet_settings['discount_amount'] ) ? $billet_settings['discount_amount'] : '';
        $amount          = (float) str_replace( ',', '.', $discount_value );

        if ( !$amount ) {
            return;
        }

        $billet_fee = ( WC()->cart->subtotal / 100 ) * $amount;

        if ( $billet_fee > 0 ) {
            WC()->cart->add_fee( $discount_name, -$billet_fee, true );
        }   
    }
}