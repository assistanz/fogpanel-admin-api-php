<?php

/*
 * Copyright (c) 2014, AssistanZ Networks
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
 * Provides API access to accounts. Provides list of accounts, signup,
 * get specific account info.
 *
 * @author Sujai SD <sujai@assistanz.com>
 */
class Account
{
    /**
     * The configuration to connect with the server.
     *
     * @var \AssistanZ\FogPanel\API\Admin\Request
     */
    private $request;

    /**
     * Initializes Account API with the specified configuration.
     *
     * @param \AssistanZ\FogPanel\API\Admin\Config $config
     */
    public function __construct(Config $config)
    {
        $this->request = new Request($config);
    }

    /**
     * Provides the list of accounts created in the system.
     *
     * @param array $filter         The filter criteria for tha accounts list.
     * @param int   $page           The page of the record list.
     * @param int   $recordsPerPage Count of records required per page.
     *
     * @return array List of accounts
     */
    public function getAccounts($filter = array(), $page = null, $recordsPerPage = null)
    {
        $params = array();
        if ($page) {
            $params["page"] = $page;
        }
        
        if ($recordsPerPage) {
            $params["recordsPerPage"] = $recordsPerPage;
        }
        
        return $this->request->get("/api/admin/account/listAccounts", $params);
    }

    /**
     * Creates a account with the following information.
     *
     * @param string $username
     * @param string $password
     * @param string $firstname
     * @param string $lastname
     * @param string $street
     * @param string $city
     * @param string $state
     * @param string $zip
     * @param string $country
     *
     * @return array Details of the created account
     */
    public function createAccount($username, $password, $firstname, $lastname,
            $street, $city, $state, $zip, $country) {
        return $this->request->get("/api/admin/account/createAccount", array(
                "username" => $username,
                "password" => $password,
                "firstname" => $firstname,
                "lastname" => $lastname,
                "street" => $street,
                "city" => $city,
                "state" => $state,
                "zip" => $zip,
                "country" => $country
            ));
    }

}
