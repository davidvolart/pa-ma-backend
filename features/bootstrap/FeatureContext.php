<?php

use App\Child;
use App\User;
use Behat\Behat\Context\Context;
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

    private $access_token;

    private $personal_data_parameters = [
        "name"               => null,
        "id"                 => null,
        "health_care_number" => null,
        "birthdate"          => null,
    ];

    private $size_data_parameters = [
        'shirt_size' => null,
        'weight'     => null,
        'dress_size' => null,
        'pants_size' => null,
        'height'     => null,
        'shoes_size' => null
    ];

    private $vaccine_data_parameters = [
        'name' => null,
        'date' => null
    ];

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
     * @Given a User with email :email and password :password
     */
    public function aUserWithEmailXAndPasswordX($email, $password)
    {
        $child = new Child();
        $child->name = 'childNameTest';
        $child->save();

        $user = factory(User::class)->create([
                                                 'email'    => $email,
                                                 'password' => bcrypt($password),
                                                 'child_id' => $child->id,
                                             ]);
        $user->save();
    }

    /**
     * @Given User has logged in with email :email and password :password
     */
    public function UserHasLoggedInWithEmailXAndPasswordX($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
        $this->ClickLogInButton();
    }

    /**
     * @When User insert :value at :personal_data_field personal data field
     */
    public function UserInsertXOnXField($personal_data_field, $value)
    {
        $this->personal_data_parameters[$personal_data_field] = $value;
    }

    /**
     * @When User insert :value at :size_data_field size data field
     */
    public function UserInsertXAtXSizeDataField($value, $size_data_field)
    {
        $this->size_data_parameters[$size_data_field] = $value;
    }

    /**
     * @When User insert :value at :vaccine_data_field vaccine data field
     */
    public function UserInsertXAtXVaccineDataField($value, $vaccine_data_field)
    {
        $this->vaccine_data_parameters[$vaccine_data_field] = $value;
    }

    /**
     * @When Click add_vaccine button
     */
    public function clickAddVaccineButton()
    {
        $parameters = $this->getNonNullParameters($this->vaccine_data_parameters);

        $this->response = $this->withHeaders([
                                                 'Authorization'    => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOTJhMTE0ODViNDU0NTY1NmQ0ZTAzNjJkZTkyNmU5MzEzMjI0NTU0ZTQ5ZGQzZGM4M2E2MGI1MDViOTg2YTJmMDQ1ZGM5MTY0N2Y4Y2I2NzgiLCJpYXQiOjE1ODU3Mzg0MjMsIm5iZiI6MTU4NTczODQyMywiZXhwIjoxNjE3Mjc0NDIzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.hzj-JTEGxHtGzt8NovSNbDLEaOmYEyojwXKfrOg8n5QYUkDoo_4NYfNBulTSXEdYn139zEdq12lc9OKW1r0vwCtdZjpWqbmTbpL0vKs9LE0k7p_EkTp3vTNUJjSFX3o6kbF1vxEdg3krrvZRrMse-nAFaf3qvP7d2JHwh4mcVenQs-_c1U2Zr20bdxLWRE36yIG7ERoP9uNt43IQBC5W6C8mTRhezgy74wcXHN2VFNXDrkAssEd8gUYG4OFIcpukU6QU8CNAy4ptBn20-VhYNCf7VN-iAn-D0hGno21UWVKpg6tWB17XsX70SEv3gZnAQdQIC9sO5F9JQHHHg5Bzou-pAcSrneC8AxffR6G0TtHHEl8wOnezw-FmT_mY1Es_wf0qr1I9-JfzF_5TLqRH3rHRTSJjXItqXL3audJkoFJNoU6JzQ4Emrwg1AQUiuHQ4H_hHOblXWTS2nlY8rTxHjfa1fH7ty_5_WXAdahR8Jlu_nk-OhwlbFgCMCmR4Y_U6nzB-fdZ5oXOx6eHR7cgLI6NKBtAq9_pjAwoeqe_6lelQquvxkGeE0Ah4j4PgILjP2HmhGi53GlS7QIIjUZG6U6kAKzQ8vPbfdRBuoj779TWzASrBIRlNajG-MjO4va2cJMFRs82PT_0zRHpcToYs7Az6FWZiqIGN6u8Lt_4HVU',
                                                 'Content-Type'     => 'application/json',
                                                 'X-Requested-With' => 'XMLHttpRequest',
                                             ])->json('POST', 'api/vaccine', $parameters);
    }

    /**
     * @When Click save_size_data button
     */
    public function clickSaveSizeData()
    {
        $parameters = $this->getNonNullParameters($this->size_data_parameters);

        $this->response = $this->withHeaders([
                                                 'Authorization'    => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOTJhMTE0ODViNDU0NTY1NmQ0ZTAzNjJkZTkyNmU5MzEzMjI0NTU0ZTQ5ZGQzZGM4M2E2MGI1MDViOTg2YTJmMDQ1ZGM5MTY0N2Y4Y2I2NzgiLCJpYXQiOjE1ODU3Mzg0MjMsIm5iZiI6MTU4NTczODQyMywiZXhwIjoxNjE3Mjc0NDIzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.hzj-JTEGxHtGzt8NovSNbDLEaOmYEyojwXKfrOg8n5QYUkDoo_4NYfNBulTSXEdYn139zEdq12lc9OKW1r0vwCtdZjpWqbmTbpL0vKs9LE0k7p_EkTp3vTNUJjSFX3o6kbF1vxEdg3krrvZRrMse-nAFaf3qvP7d2JHwh4mcVenQs-_c1U2Zr20bdxLWRE36yIG7ERoP9uNt43IQBC5W6C8mTRhezgy74wcXHN2VFNXDrkAssEd8gUYG4OFIcpukU6QU8CNAy4ptBn20-VhYNCf7VN-iAn-D0hGno21UWVKpg6tWB17XsX70SEv3gZnAQdQIC9sO5F9JQHHHg5Bzou-pAcSrneC8AxffR6G0TtHHEl8wOnezw-FmT_mY1Es_wf0qr1I9-JfzF_5TLqRH3rHRTSJjXItqXL3audJkoFJNoU6JzQ4Emrwg1AQUiuHQ4H_hHOblXWTS2nlY8rTxHjfa1fH7ty_5_WXAdahR8Jlu_nk-OhwlbFgCMCmR4Y_U6nzB-fdZ5oXOx6eHR7cgLI6NKBtAq9_pjAwoeqe_6lelQquvxkGeE0Ah4j4PgILjP2HmhGi53GlS7QIIjUZG6U6kAKzQ8vPbfdRBuoj779TWzASrBIRlNajG-MjO4va2cJMFRs82PT_0zRHpcToYs7Az6FWZiqIGN6u8Lt_4HVU',
                                                 'Content-Type'     => 'application/json',
                                                 'X-Requested-With' => 'XMLHttpRequest',
                                             ])->json('POST', 'api/sizedata', $parameters);
    }

    /**
     * @When Click save_personal_data button
     */
    public function clickSavePersonalDataButton()
    {
        $parameters = $this->getNonNullParameters($this->personal_data_parameters);

        $this->response = $this->withHeaders([
                                                 'Authorization'    => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOTJhMTE0ODViNDU0NTY1NmQ0ZTAzNjJkZTkyNmU5MzEzMjI0NTU0ZTQ5ZGQzZGM4M2E2MGI1MDViOTg2YTJmMDQ1ZGM5MTY0N2Y4Y2I2NzgiLCJpYXQiOjE1ODU3Mzg0MjMsIm5iZiI6MTU4NTczODQyMywiZXhwIjoxNjE3Mjc0NDIzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.hzj-JTEGxHtGzt8NovSNbDLEaOmYEyojwXKfrOg8n5QYUkDoo_4NYfNBulTSXEdYn139zEdq12lc9OKW1r0vwCtdZjpWqbmTbpL0vKs9LE0k7p_EkTp3vTNUJjSFX3o6kbF1vxEdg3krrvZRrMse-nAFaf3qvP7d2JHwh4mcVenQs-_c1U2Zr20bdxLWRE36yIG7ERoP9uNt43IQBC5W6C8mTRhezgy74wcXHN2VFNXDrkAssEd8gUYG4OFIcpukU6QU8CNAy4ptBn20-VhYNCf7VN-iAn-D0hGno21UWVKpg6tWB17XsX70SEv3gZnAQdQIC9sO5F9JQHHHg5Bzou-pAcSrneC8AxffR6G0TtHHEl8wOnezw-FmT_mY1Es_wf0qr1I9-JfzF_5TLqRH3rHRTSJjXItqXL3audJkoFJNoU6JzQ4Emrwg1AQUiuHQ4H_hHOblXWTS2nlY8rTxHjfa1fH7ty_5_WXAdahR8Jlu_nk-OhwlbFgCMCmR4Y_U6nzB-fdZ5oXOx6eHR7cgLI6NKBtAq9_pjAwoeqe_6lelQquvxkGeE0Ah4j4PgILjP2HmhGi53GlS7QIIjUZG6U6kAKzQ8vPbfdRBuoj779TWzASrBIRlNajG-MjO4va2cJMFRs82PT_0zRHpcToYs7Az6FWZiqIGN6u8Lt_4HVU',
                                                 'Content-Type'     => 'application/json',
                                                 'X-Requested-With' => 'XMLHttpRequest',
                                             ])->json('POST', 'api/personaldata', $parameters);
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
        $this->response = $this->withHeaders([
                                                 'Content-Type'     => 'application/json',
                                                 'X-Requested-With' => 'XMLHttpRequest',
                                             ])->json('POST', 'api/auth/signup',
                                                      [
                                                          'name'                  => $this->name,
                                                          'password'              => $this->password,
                                                          'password_confirmation' => $this->confirmation_password,
                                                          'email'                 => $this->email,
                                                          'partner_email'         => 'david@gmail.com'
                                                      ]);
        $this->response->assertStatus(201);
    }

    /**
     * @Then User :user_name has not been signed up
     */
    public function userXHasNotBeenSignedUp($user_name)
    {
        $this->response = $this->withHeaders([
                                                 'Content-Type'     => 'application/json',
                                                 'X-Requested-With' => 'XMLHttpRequest',
                                             ])->json('POST', 'api/auth/signup',
                                                      [
                                                          'name'                  => $this->name,
                                                          'password'              => $this->password,
                                                          'password_confirmation' => $this->confirmation_password,
                                                          'email'                 => $this->email,
                                                          'partner_email'         => 'david@gmail.com'
                                                      ]);
        $this->response->assertStatus(422);
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
                                                 'Content-Type'     => 'application/json',
                                                 'X-Requested-With' => 'XMLHttpRequest',
                                             ])->json('POST', 'api/auth/login',
                                                      [
                                                          'email'    => $this->email,
                                                          'password' => $this->password,
                                                      ]);

        if($this->response->getStatusCode() == 200){
            $this->access_token = $this->response->original['access_token'];
        }
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

    /**
     * @Then personal data has been saved
     */
    public function personalDataHasBeenSaved()
    {
        $this->response->assertStatus(200);
    }

    /**
     * @Then personal data has not been saved
     */
    public function personalDataHasNotBeenSaved()
    {
        $this->response->assertStatus(422);
    }

    /**
     * @Then personal data has not been saved due to bad request
     */
    public function personalDataHasNotBeenSavedDueToBadRequest()
    {
        $this->response->assertStatus(400);
    }

    /**
     * @Then size data has been saved
     */
    public function sizeDataHasBeenSaved()
    {
        $this->response->assertStatus(200);
    }

    /**
     * @Then size data has not been saved
     */
    public function sizeDataHasNotBeenSaved()
    {
        $this->response->assertStatus(422);
    }

    /**
     * @Then vaccine data has been saved
     */
    public function vaccineDataHasBeenSaved()
    {
        $this->response->assertStatus(201);
    }

    /**
     * @Then vaccine data has not been saved
     */
    public function vaccineDataHasNotBeenSaved()
    {
        $this->response->assertStatus(422);
    }

    private function getNonNullParameters($parameters)
    {
        $data = [];
        foreach ($parameters as $parameter => $value) {
            if (!is_null($value)) {
                $data[$parameter] = $value;
            }
        }
        return $data;
    }
}
