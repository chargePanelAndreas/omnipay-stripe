<?php

/**
 * Stripe Checkout Session Request.
 */

namespace Omnipay\Stripe\Message\Checkout;

use Money\Formatter\DecimalMoneyFormatter;

/**
 * Stripe Checkout Session Request
 *
 * @see \Omnipay\Stripe\Gateway
 * @link https://stripe.com/docs/api/checkout/sessions
 */
class PurchaseRequest extends AbstractRequest
{
    /**
     * Set the success url
     *
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function setSuccessUrl($value)
    {
        return $this->setParameter('success_url', $value);
    }

    /**
     * Get the success url
     *
     * @return string
     */
    public function getSuccessUrl()
    {
        return $this->getParameter('success_url');
    }
    /**
     * Set the cancel url
     *
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function setCancelUrl($value)
    {
        return $this->setParameter('cancel_url', $value);
    }

    /**
     * Get the success url
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->getParameter('cancel_url');
    }

    /**
     * Set the payment method types accepted url
     *
     * @param array $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function setPaymentMethodTypes($value)
    {
        return $this->setParameter('payment_method_types', $value);
    }

    /**
     * Get the success url
     *
     * @return string
     */
    public function getPaymentMethodTypes()
    {
        return $this->getParameter('payment_method_types');
    }

    /**
     * Set the payment method types accepted url
     *
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function setMode($value)
    {
        return $this->setParameter('mode', $value);
    }

    /**
     * Get the success url
     *
     * @return string
     */
    public function getMode()
    {
        return $this->getParameter('mode');
    }

    /**
     * Set the payment method types accepted url
     *
     * @param array $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function setLineItems($value)
    {
        return $this->setParameter('line_items', $value);
    }

    /**
     * Get the success url
     *
     * @return array
     */
    public function getLineItems()
    {
        return $this->getParameter('line_items');
    }

    /**
     * Set the payment method types accepted url
     *
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function setClientReferenceId($value)
    {
        return $this->setParameter('client_reference_id', $value);
    }

    /**
     * Get the success url
     *
     * @return string
     */
    public function getClientReferenceId()
    {
        return $this->getParameter('client_reference_id');
    }

    /**
     * Set the customer_creation parameter
     *
     * @param string $value
     *
     * @return \Omnipay\Common\Message\AbstractRequest|PurchaseRequest
     */
    public function setCustomerCreation($value)
    {
        return $this->setParameter('customer_creation', $value);
    }

    /**
     * Get the customer_creation parameter
     *
     * @return string
     */
    public function getCustomerCreation()
    {
        return $this->getParameter('customer_creation');
    }

    /**
     * @return mixed
     */
    public function getDestination()
    {
        return $this->getParameter('destination');
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setDestination($value)
    {
        return $this->setParameter('destination', $value);
    }


    /**
     * Connect only
     *
     * @return mixed
     */
    public function getTransferGroup()
    {
        return $this->getParameter('transferGroup');
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setTransferGroup($value)
    {
        return $this->setParameter('transferGroup', $value);
    }

    /**
     * Connect only
     *
     * @return mixed
     */
    public function getOnBehalfOf()
    {
        return $this->getParameter('onBehalfOf');
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setOnBehalfOf($value)
    {
        return $this->setParameter('onBehalfOf', $value);
    }


    /**
     * @return string
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getApplicationFee()
    {
        $money = $this->getMoney('applicationFee');

        if ($money !== null) {
            $moneyFormatter = new DecimalMoneyFormatter($this->getCurrencies());

            return $moneyFormatter->format($money);
        }

        return '';
    }

    /**
     * Get the payment amount as an integer.
     *
     * @return integer
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getApplicationFeeInteger()
    {
        $money = $this->getMoney('applicationFee');

        if ($money !== null) {
            return (integer) $money->getAmount();
        }

        return 0;
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setApplicationFee($value)
    {
        return $this->setParameter('applicationFee', $value);
    }

    /**
     * @return mixed
     */
    public function getStatementDescriptor()
    {
        return $this->getParameter('statementDescriptor');
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setStatementDescriptor($value)
    {
        $value = str_replace(array('<', '>', '"', '\''), '', $value);

        return $this->setParameter('statementDescriptor', $value);
    }

    /**
     * @return mixed
     */
    public function getStatementDescriptorSuffix()
    {
        return $this->getParameter('statementDescriptorSuffix');
    }

    /**
     * @param string $value
     *
     * @return AbstractRequest provides a fluent interface.
     */
    public function setStatementDescriptorSuffix($value)
    {
        $value = str_replace(array('<', '>', '"', '\''), '', $value);

        return $this->setParameter('statementDescriptorSuffix', $value);
    }


    public function getData()
    {
        $paymentIntentData = array();

        if ($this->getStatementDescriptor()) {
            $paymentIntentData['statement_descriptor'] = $this->getStatementDescriptor();
        }

        if ($this->getStatementDescriptorSuffix()) {
            $paymentIntentData['statement_descriptor_suffix'] = $this->getStatementDescriptorSuffix();
        }

        if ($this->getDestination()) {
            $paymentIntentData['transfer_data']['destination'] = $this->getDestination();
        }

        if ($this->getOnBehalfOf()) {
            $paymentIntentData['on_behalf_of'] = $this->getOnBehalfOf();
        }

        if ($this->getApplicationFee()) {
            $paymentIntentData['application_fee_amount'] = $this->getApplicationFeeInteger();
        }

        if ($this->getTransferGroup()) {
            $paymentIntentData['transfer_group'] = $this->getTransferGroup();
        }
        
        $data = array(
            'client_reference_id' => $this->getClientReferenceId(),
            'success_url' => $this->getSuccessUrl(),
            'cancel_url' => $this->getCancelUrl(),
            'payment_method_types' => $this->getPaymentMethodTypes(),
            'mode' => $this->getMode(),
            'customer_creation' => $this->getCustomerCreation(),
            'line_items' => $this->getLineItems()
        );

        if (!empty($paymentIntentData) && $this->getMode() !== 'setup') {
            $data['payment_intent_data'] = $paymentIntentData;
        }

        return $data;
    }

    public function getEndpoint()
    {
        return $this->endpoint.'/checkout/sessions';
    }
}
