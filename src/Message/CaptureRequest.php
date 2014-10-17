<?php

namespace Omnipay\PaypalRest\Message;

use Omnipay\Common\Item;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class CaptureRequest extends AbstractPaypalRequest
{
    /**
     * Requires "purchaseId" parameter
     *
     * @return string
     */
    public function getEndpoint()
    {
        $this->validate('purchaseId');

        return "/payments/authorization/{$this->getPurchaseId()}/capture";
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
    public function getPurchaseId()
    {
        return $this->getParameter('purchaseId');
    }

    /**
     * @param string $value
     */
    public function setPurchaseId($value)
    {
        return $this->setParameter('purchaseId', $value);
    }

    /**
     * @return string
     */
    public function getIsFinalCapture()
    {
        return $this->getParameter('isFinalCapture');
    }

    /**
     * @param string $value
     */
    public function setIsFinalCapture($value)
    {
        return $this->setParameter('isFinalCapture', $value);
    }

    /**
     * @param  mixed $data
     * @return Omnipay\PaypalRest\Message\CaptureResponse
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendHttpRequest($data);

        return $this->response = new CaptureResponse(
            $this,
            $httpResponse->json(),
            $httpResponse->getStatusCode()
        );
    }

    /**
     * Requires "amount" and "currency" parameters
     *
     * @return array
     */
    public function getData()
    {
        $this->validate('amount', 'currency');

        $data = array(
            'amount' => array(
                'total' => $this->getAmount(),
                'currency' => $this->getCurrency(),
            )
        );

        if ($this->getIsFinalCapture()) {
            $data['is_final_capture'] = true;
        }

        return $data;
    }
}
