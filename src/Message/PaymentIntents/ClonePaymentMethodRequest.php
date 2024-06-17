<?php

/**
 * Stripe Create Payment Method Request.
 */
namespace Omnipay\Stripe\Message\PaymentIntents;

/**
 * Clone a payment method to a connected Stripe account.
 *
 * @see \Omnipay\Stripe\Message\PaymentIntents\AttachPaymentMethodRequest
 * @see \Omnipay\Stripe\Message\PaymentIntents\DetachPaymentMethodRequest
 * @see \Omnipay\Stripe\Message\PaymentIntents\UpdatePaymentMethodRequest
 * @link https://docs.stripe.com/payments/payment-methods/connect?lang=php#cloning-payment-methods
 */
class ClonePaymentMethodRequest extends AbstractRequest
{
    /**
     * @inheritdoc
     */
    public function getData()
    {
        $data = [];

        $this->validate('customerReference', 'paymentMethod');

        $data['payment_method'] = $this->getPaymentMethod();
        $data['customer'] = $this->getCustomerReference();
        
        return $data;
    }

    /**
     * @inheritdoc
     */
    public function getEndpoint()
    {
        return $this->endpoint.'/payment_methods';
    }

    /**
     * @inheritdoc
     */
    protected function createResponse($data, $headers = [])
    {
        return $this->response = new Response($this, $data, $headers);
    }
}
