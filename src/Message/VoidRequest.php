<?php

namespace Omnipay\PaypalRest\Message;

use Omnipay\Common\Item;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class VoidRequest extends AbstractPaypalRequest
{
    /**
     * @return string
     */
    public function getEndpoint()
    {
        $this->validate('purchaseId');

        return '/payments/authorization/'.$this->getPurchaseId().'/void';
    }

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
     * @param  mixed $data
     * @return Omnipay\PaypalRest\Message\VoidResponse
     */
    public function sendData($data)
    {
        $httpResponse = $this->sendHttpRequest($data);

        return $this->response = new VoidResponse(
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
        return array();
    }
}
