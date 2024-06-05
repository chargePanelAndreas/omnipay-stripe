<?php

/**
 * Stripe Checkout Session Request.
 */

namespace Omnipay\Stripe\Message\Checkout;

/**
 * Stripe Checkout Session Request
 *
 * @see \Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api/checkout/sessions
 */
class AuthorizeRequest extends PurchaseRequest
{
    public function getData()
    {
        $data = parent::getData();

        $paymentIntentData = $data['payment_intent_data'] ?? [];
        
        /**
         * @see https://docs.stripe.com/api/checkout/sessions/create#create_checkout_session-payment_intent_data-capture_method
         * 
         * You will use PaymentIntents\CaptureRequest to capture and process a previously created authorization.
         */
        $paymentIntentData['capture_method'] =  'manual';
        
        $data['payment_intent_data'] = $paymentIntentData;

        return $data;
    }
}
