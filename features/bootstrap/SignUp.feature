Feature:Sign Up

    Scenario: Attempt to Sign up with empty name
        When A User insert "" on name field
        And insert "jhon@gmail.com" on email field
        And insert 123 on password field
        And insert 123 on password confirmation
        Then User Jhon has not been signed up

    Scenario: Attempt to Sign up with invalid name type
        When A User insert 111 on name field
        And insert "jhon@gmail.com" on email field
        And insert 123 on password field
        And insert 123 on password confirmation
        Then User Jhon has not been signed up

    Scenario: Attempt to Sign up with empty email
        When A User insert Jhon on name field
        And insert "" on email field
        And insert 123 on password field
        And insert 123 on password confirmation
        Then User Jhon has not been signed up

    Scenario: Attempt to Sign up with invalid email type
        When A User insert Jhon on name field
        And insert "jhonemail" on email field
        And insert 123 on password field
        And insert 123 on password confirmation
        Then User Jhon has not been signed up

    Scenario: Attempt to Sign up with empty password
        When A User insert Jhon on name field
        And insert "jhon@gmail.com" on email field
        And insert "" on password field
        And insert 123 on password confirmation
        Then User Jhon has not been signed up

    Scenario: Attempt to Sign up with non-matching password and password confirmation
        When A User insert Jhon on name field
        And insert "jhon@gmail.com" on email field
        And insert 123 on password field
        And insert 127 on password confirmation
        Then User Jhon has not been signed up

    Scenario: Attempt to Sign up with correct parameters
        When A User insert Jhon on name field
        And insert "jhondoe@gmail.com" on email field
        And insert 123 on password field
        And insert 123 on password confirmation
        Then User Jhon has been signed up

    Scenario: Attempt to Sign up with duplicated email
        When A User insert Frank on name field
        And insert "jhon@gmail.com" on email field
        And insert 8972 on password field
        And insert 8972 on password confirmation
        Then User Frank has not been signed up
