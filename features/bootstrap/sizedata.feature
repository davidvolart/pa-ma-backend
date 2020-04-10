Feature:Save child size Data

    Scenario: Save size data successfully
        Given a User with email "johnsmith@gmail.com" and password "jhon123"
        And User has logged in with email "johnsmith@gmail.com" and password "jhon123"
        When User insert "S" at shirt_size size data field
        And User insert "L" at pants_size size data field
        And User insert 32 at shoes_size size data field
        And Click save_size_data button
        Then size data has been saved

    Scenario: Save size data with invalid shirt_size length
        Given a User with email "max@gmail.com" and password "max123"
        And User has logged in with email "max@gmail.com" and password "max123"
        When User insert "xxxxxxxxxxxxxxxxxxxx" at shirt_size size data field
        And User insert "L" at pants_size size data field
        And User insert 32 at shoes_size size data field
        And Click save_size_data button
        Then size data has not been saved
