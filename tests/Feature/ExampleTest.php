<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;

class ExampleTest extends ApiHttpTestCase
{
    //Todo: make a constant and generate random email and password

    public function setUp() :void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    /**
     * A sign Up test
     *
     * @return void
     */
    public function testSignUp()
    {
        $response = $this->withHeaders([
                                           'Content-Type' => 'application/json',
                                           'X-Requested-With' => 'XMLHttpRequest',
                                       ])->json('POST', 'api/auth/signup',
                                                [
                                                    'name'                  => 'david',
                                                    'password'              => '123123',
                                                    'password_confirmation' => '123123',
                                                    'email'                 => 'davidvolart@gmail.com',
                                                    'partner_email'         => 'david@gmail.com'
                                                ]);

        $response->assertStatus(201);
    }

    public function testSignUpForDuplicatedUser()
    {
        $response = $this->withHeaders([
                                           'Content-Type' => 'application/json',
                                           'X-Requested-With' => 'XMLHttpRequest',
                                       ])->json('POST', 'api/auth/signup',
                                                [
                                                    'name'                  => 'david',
                                                    'password'              => '123123',
                                                    'password_confirmation' => '123123',
                                                    'email'                 => 'davidvolart@gmail.com',
                                                    'partner_email'         => 'david@gmail.com'
                                                ]);

        $response->assertStatus(422);
    }
}
