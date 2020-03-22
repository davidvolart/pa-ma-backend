<?php

use App\User;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Hook\Scope\AfterScenarioScope;
use Behat\Behat\Hook\Scope\BeforeScenarioScope;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Illuminate\Contracts\Http\Kernel;
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

    private $response;

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
     * @When A User insert :name on name field
     */
    public function aUserWithNameX($name)
    {
        $this->name = $name;
    }

    /**
     * @When insert :email_address on email field
     */
    public function withEmailX($email_address)
    {
        $this->email = $email_address;
    }

    /**
     * @When insert :password_confirmation on password confirmation
     */
    public function passwordConfirmationX($confirmation_password)
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

    /**
     * @Then User :user_name has not been signed up
     */
    public function userXHasNotBeenSignedUp($user_name)
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
        $response->assertStatus(422);
    }

    /**
     * @Given a User with email :email and password :password
     */
    public function aUserWithEmailXAndPasswordX($email,$password)
    {
        $user = factory(User::class)->create([
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        $user->save();
    }

    /**
     * @When user insert :email on email field
     */
    public function userInsertXOnEmailField($email)
    {
        $this->email = $email;
    }

    /**
     * @When insert :password on password field
     */
    public function XOnPasswordField($password)
    {
        $this->password = $password;
    }

    /**
     * @When click log_in button
     */
    public function ClickLogInButton()
    {
        $this->response = $this->withHeaders([
                                           'Content-Type' => 'application/json',
                                           'X-Requested-With' => 'XMLHttpRequest',
                                       ])->json('POST', 'api/auth/login',
                                                [
                                                    'email'                  => $this->email,
                                                    'password'              => $this->password,
                                                ]);
    }

    /**
     * @Then User :user is logged in
     */
    public function UserXIsLoggedIn()
    {
        $this->response->assertStatus(200);
    }

    /**
     * @Then User :user is not logged in
     */
    public function UserXIsNotLoggedIn()
    {
        $this->response->assertStatus(401);
    }
}
