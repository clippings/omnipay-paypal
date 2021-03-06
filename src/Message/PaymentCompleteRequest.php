<?php

namespace Omnipay\PaypalRest\Message;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class PaymentCompleteRequest extends AbstractPaypalRequest
{
    /**
     * @return string
     */
    public function getEndpoint()
    {
        $this->validate('transactionReference');

        return "/payments/payment/{$this->getTransactionReference()}/execute";
    }

    /**
     * @return string
     */
    public function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * @return string
     */
    public function getPayerId()
    {
        return $this->getParameter('payerId');
    }

    /**
     * @param string $value
     */
    public function setPayerId($value)
    {
        return $this->setParameter('payerId', $value);
    }

    /**
     * @param  mixed           $data
     * @return PaymentResponse
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendHttpRequest($data);

        return $this->response = new PaymentResponse(
            $this,
            $httpResponse->json(),
            $httpResponse->getStatusCode()
        );
    }

    /**
     * @return array
     */
    public function getData()
    {
        $this->validate('payerId');

        return array(
            'payer_id' => $this->getPayerId(),
        );
    }
}
