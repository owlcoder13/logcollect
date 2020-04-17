<?php

namespace Owlcoder\LogCollect;

/**
 * Class send logs to log-collect.com service
 * Class LogCollect
 * @package App
 */
class LogCollect
{
    public $token;
    public $host = 'https://log-collect.com';

    /**
     * Token for site
     * LogCollect constructor.
     * @param $token
     * @param $host
     */
    public function __construct($token, $host = null)
    {
        $this->token = $token;

        if ($host != null) {
            $this->host = $host;
        }
    }

    /**
     * send error message to server
     * @param $message
     * @param null $trance
     */
    public function error($message, $trance = null)
    {
        $this->write('error', $message, $trance);
    }

    /**
     * Send info message to service
     * @param $message
     * @param null $trance
     */
    public function info($message, $trance = null)
    {
        $this->write('info', $message, $trance);
    }

    /**
     * Send warning info to service
     * @param $message
     * @param null $trance
     */
    public function warning($message, $trance = null)
    {
        $this->write('warning', $message, $trance);
    }

    /**
     * Send debug info to service
     * @param $message
     * @param null $trance
     */
    public function debug($message, $trance = null)
    {
        $this->write('debug', $message, $trance);
    }

    /**
     * Write log to server
     * @param $type
     * @param $message
     * @param null $trace
     */
    public function write($type, $message, $trace = null)
    {
        $this->postRequest([
            'type' => $type,
            'message' => $message,
            'trace' => $trace,
        ]);
    }

    /**
     * Send post request to api through file_get_contents
     * @param $data
     * @return false|string
     */
    private function postRequest($data)
    {
        $queryString = http_build_query($data);

        $opts = [
            'http' => [
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $queryString,
            ],
        ];

        $context = stream_context_create($opts);

        $url = $this->host . '/api/log/write/' . $this->token . '/';

        return file_get_contents($url,
            false,
            $context);
    }
}
