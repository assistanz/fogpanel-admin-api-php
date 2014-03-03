<?php

/*
 * Copyright (c) 2014, AssistanZ Networks.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, this
 *   list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice,
 *   this list of conditions and the following disclaimer in the documentation
 *   and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace AssistanZ\FogPanel\API\Admin;

/**
 * Common API Request Builder.
 *
 * @author Sujai SD <sujai@assistanz.com>
 */
class RequestTest
{
    /**
     * The configuration to connect with the server.
     *
     * @var \AssistanZ\FogPanel\API\Admin\Config
     */
    private $config;

    /**
     * Initializes Request with the specified configuration.
     *
     * @param \AssistanZ\FogPanel\API\Admin\Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * Creates the API Request Payload with security signature and API Key
     *
     * @param array $params
     *
     * @return string Query String with API Key and Signature.
     */
    private function createSignature($params = array())
    {
        $queryString = http_build_query($params);
        $signature = md5(base64_encode($queryString) . $this->config->getApiSecret());
//        return $queryString . "&apiKey=" . $this->config->getApiKey() . "&signature=" . $signature;
        return $signature;
    }

    /**
     * Request URL including server and URI
     *
     * @param type $apiURI
     *
     * @return string RequestURL
     */
    private function getRequestRUL($apiURI)
    {
        return $this->config->getUrl() . $apiURI;
    }

    private function prepareRequest($params = array())
    {
        $signature = $this->createSignature($params);
        $params["apiKey"] = $this->config->getApiKey();
        $params["signature"] = $signature;
    }

    public function get($apiURI, $params = array())
    {
        $url = $this->getRequestRUL($apiURI);
        $params = $this->prepareRequest($params);
        $curl = new \Curl();
        $response = $curl->get($url, $params);

        return json_decode($response->body, true);
    }

    public function post($apiURI, $params = array())
    {
        $url = $this->getRequestRUL($apiURI);
        $params = $this->prepareRequest($params);
        $curl = new \Curl();
        $response = $curl->post($url, $params);

        return json_decode($response->body, true);
    }
}
