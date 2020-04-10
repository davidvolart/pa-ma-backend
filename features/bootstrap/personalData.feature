Feature:Save child Personal Data

    Scenario: Save personal data successfully
        Given a User with email "amilie@gmail.com" and password "amilie123"
        And User has logged in with email "amilie@gmail.com" and password "amilie123"
        When User insert "amilie" at name personal data field
        And User insert "123456G" at id personal data field
        And User insert "19/12/2020" at birthdate personal data field
        And Click save_personal_data button
        Then personal data has been saved

    Scenario: Attempt to save personal data without required field name
        Given a User with email "amie@gmail.com" and password "amie123"
        And User has logged in with email "amie@gmail.com" and password "amie123"
        When User insert "" at name personal data field
        And Click save_personal_data button
        Then personal data has not been saved

    Scenario: Attempt to save personal data with invalid bithdate type
        Given a User with email "jay@gmail.com" and password "jay123"
        And User has logged in with email "jay@gmail.com" and password "jay123"
        When User insert "jay" at name personal data field
        And User insert "1997/12/09" at birthdate personal data field
        And Click save_personal_data button
        Then personal data has not been saved due to bad request
