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
class AccountTest extends \PHPUnit_Framework_TestCase
{

    public function testListAccounts()
    {
        $config = new Config(SERVER_URL, API_KEY, API_SECRET);

        $account = new Account($config);
        $result = $account->listAccounts();
        //var_dump($result);
        $this->assertFalse($result === null || empty($result));
    }
    
    public function testListAccountsByStatus()
    {
        $config = new Config(SERVER_URL, API_KEY, API_SECRET);

        $account = new Account($config);
        $result = $account->listAccounts(array("status" => Account::STATUS_ACTIVE));
        //var_dump($result);
        $this->assertFalse($result === null || empty($result));
    }    

    public function testCreateAccount()
    {
        $config = new Config(SERVER_URL, API_KEY, API_SECRET);

        $account = new Account($config);
        $result = $account->createAccount("sujai@lan.assistanz.com", 
                "passw0rd", "Sujai", "SD", "40 2nd Street", "Coimbatore", "1", "641029", "1", "9360251145");
        var_dump($result);
        echo $result[0];
        $this->assertFalse($result === null || empty($result));
    }

}
