<?php
/*
 *  Last Modified: 6/29/21, 12:06 AM
 *  Copyright (c) 2021
 *  -created by Ariful Islam
 *  -All Rights Preserved By
 *  -If you have any query then knock me at
 *  arif98741@gmail.com
 *  See my profile @ https://github.com/arif98741
 */

namespace Xenon\LaravelBDSms\Provider;

use Xenon\LaravelBDSms\Handler\ParameterException;
use Xenon\LaravelBDSms\Handler\RenderException;
use Xenon\LaravelBDSms\Request;
use Xenon\LaravelBDSms\Sender;

class SmsQ extends AbstractProvider
{
    /**
     * SmsQ constructor.
     * @param Sender $sender
     */
    public function __construct(Sender $sender)
    {
        $this->senderObject = $sender;
    }

    /**
     * Send Request To Api and Send Message
     * @throws RenderException
     */
    public function sendRequest()
    {
        $number = $this->senderObject->getMobile();
        $text = $this->senderObject->getMessage();
        $config = $this->senderObject->getConfig();
        $queue = $this->senderObject->getQueue();

        $query = [
            'SenderId' => $config['sender_id'],
            'ApiKey' => $config['api_key'],
            'ClientId' => $config['client_id'],
            'Message' => $text,
            'MobileNumbers' => $number,
        ];

        $headers = [
            'Content-Type' => 'application/json'
        ];

        $requestObject = new Request('https://api.smsq.global/api/v2/SendSMS', $query, $queue);
        $requestObject->setHeaders($headers)->setContentTypeJson(true);
        $response = $requestObject->post();
        if ($queue) {
            return true;
        }

        $body = $response->getBody();
        $smsResult = $body->getContents();

        $data['number'] = $number;
        $data['message'] = $text;
        return $this->generateReport($smsResult, $data)->getContent();
    }

    /**
     * @throws ParameterException
     */
    public function errorException()
    {

        if (!array_key_exists('sender_id', $this->senderObject->getConfig())) {
            throw new ParameterException('sender_id key is absent in configuration');
        }

        if (!array_key_exists('api_key', $this->senderObject->getConfig())) {
            throw new ParameterException('api_key key is absent in configuration');
        }

        if (!array_key_exists('client_id', $this->senderObject->getConfig())) {
            throw new ParameterException('client_id key is absent in configuration');
        }

    }

}
