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
 * The API interface to use billing related functions, like invoice list,
 * current month usage etc.
 *
 * @author Sujai SD <sujai@assistanz.com>
 */
class Billing
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
     * Provides the list of invoices
     *
     * @param type $username
     * @param type $page
     * @param type $recordsPerPage
     *
     * @return array Array of invoices with invoice items.
     */
    public function getInvoice($filters = array(), $page = null, $recordsPerPage = null)
    {
        $allowedParams = array(
            'fromDate' => false, 
            'toDate' => false,
            'userName' => false
        );
        
        // Validate parameters
        foreach ($filters as $key => $value) {
            if (!isset($allowedParams[$key])) {
                throw new Exception("Invalid Param \'$key\'");
            }
        }
        
        $params = array();
        if ($page) {
            $params["page"] = $page;
        }
        
        if ($recordsPerPage) {
            $params["recordsPerPage"] = $recordsPerPage;
        }
        
        // Form the URL
        return $this->request->get("/api/admin/billing/getInvoice", array_merge($filters, $params));
    }

    /**
     * Provides the current month usage which is not yet added to invoice.
     *
     * @param string $username
     * @param int $page
     * @param int $recordsPerPage
     * 
     * @return array The details of each usage item.
     */
    public function getCurrentUsage($username = null, $page = null, $recordsPerPage = null)
    {
        $params = array();
        if ($username) {
            $params["userName"] = $username;
        }
        
        if ($page) {
            $params["page"] = $page;
        }
        
        if ($recordsPerPage) {
            $params["recordsPerPage"] = $recordsPerPage;
        }
        
        // Form the URL
        return $this->request->get("/api/admin/billing/currentUsage", $params);
    }

    /**
     * Provides list of payments made in specific period, by each account.
     *
     * @return array Payments made in specific period
     */
    public function getPayments()
    {
        // TODO
        return array();
    }

    /**
     * Adds a payment to the payment history.
     *
     * @return array The details of the added payment.
     */
    public function addPayment()
    {
        // TODO
        return array();
    }

}
