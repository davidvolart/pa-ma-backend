Feature:Sign Up

    Scenario: Root Test
        When A User with name David
        And with email "davidvolart1997@gmail.com"
        And password 123
        And password confirmation 123
        Then User David has been signed up
