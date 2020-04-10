Feature:Add vaccines

    Scenario: Save vaccine data successfully
        Given a User with email "frankie@gmail.com" and password "frankie123"
        And User has logged in with email "frankie@gmail.com" and password "frankie123"
        When User insert "Covid-19" at name vaccine data field
        And User insert "19/12/2020" at date vaccine data field
        And Click add_vaccine button
        Then vaccine data has been saved

    Scenario: Attempt to save vaccine without name
        Given a User with email "albina@gmail.com" and password "albina123"
        And User has logged in with email "albina@gmail.com" and password "albina123"
        And User insert "19/12/2020" at date vaccine data field
        And Click add_vaccine button
        Then vaccine data has not been saved

    Scenario: Attempt to save vaccine without date
        Given a User with email "adrienne@gmail.com" and password "adrienne123"
        And User has logged in with email "adrienne@gmail.com" and password "adrienne123"
        When User insert "Covid-19" at name vaccine data field
        And Click add_vaccine button
        Then vaccine data has not been saved

