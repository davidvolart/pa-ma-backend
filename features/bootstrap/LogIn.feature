Feature:Log in

    Scenario: Log in successfully
        Given a User with email "jhon@gmail.com" and password "jhon123"
        When user insert "jhon@gmail.com" on email field
        And insert "jhon123" on password field
        And click log_in button
        Then User Jhon is logged in

    Scenario: Attempt to login with invalid credentials
        Given a User with email "jhon@hotmail.com" and password 123
        When user insert "jhonv@hotmail.com" on email field
        And insert 456 on password field
        And click log_in button
        Then User Jhon is not logged in
