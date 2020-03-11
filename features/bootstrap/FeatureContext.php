<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\Framework\TestCase;
use Tests\Feature\ApiHttpTestCase;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends ApiHttpTestCase implements Context
{
    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $email;

    /**
     * @var
     */
    private $password;

    /**
     * @var
     */
    private $confirmation_password;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        parent::setUp();
    }

    /**
     * @When A User with name :name
     */
    public function aUserWithName($name)
    {
        $this->name = $name;
    }

    /**
     * @When with email :email_address
     */
    public function withEmail($email_address)
    {
        $this->email = $email_address;
    }

    /**
     * @When password :password
     */
    public function password($password)
    {
        $this->password = $password;
    }

    /**
     * @When password confirmation :password_confirmation
     */
    public function passwordConfirmation($confirmation_password)
    {
        $this->confirmation_password = $confirmation_password;
    }

    /**
     * @Then User :user_name has been signed up
     */
    public function userXHasBeenSignedUp($user_name)
    {
        $response = $this->withHeaders([
                                           'Content-Type' => 'application/json',
                                           'X-Requested-With' => 'XMLHttpRequest',
                                       ])->json('POST', 'api/auth/signup',
                                                [
                                                    'name'                  => $this->name,
                                                    'password'              => $this->password,
                                                    'password_confirmation' => $this->confirmation_password,
                                                    'email'                 => $this->email,
                                                    'partner_email'         => 'david@gmail.com'
                                                ]);
        $response->assertStatus(201);
    }
}
