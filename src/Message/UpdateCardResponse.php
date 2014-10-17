<?php

namespace Omnipay\PaypalRest\Message;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class UpdateCardResponse extends AbstractResponse
{
    /**
     * Return true if state is "ok"
     *
     * @return boolean
     */
    public function isSuccessful()
    {
        return (parent::isSuccessful()
            and isset($this->data['state'])
            and $this->data['state'] === 'ok');
    }
}
