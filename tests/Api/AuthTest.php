<?php

/*
 * This file is part of devhub.io.
 *
 * (c) DevelopHub <master@devhub.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class AuthTest extends TestCase
{
    public function testAuth()
    {
        $this->json('POST', '/v1/auth', ['email' => '', 'password' => ''])
            ->seeJsonStructure([
                'token'
            ]);
    }
}