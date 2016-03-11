Feature:
    Manage Bodystyles

    Scenario: Find Bodystyle from ID
        When I send a GET request to "/v1/bodystyles/1"
        Then the response code should be 200
        And the response is json
        And the response should contain the properties:
            """
            id, name, date_added, date_updated, status
            """

    Scenario: PUT an existing bodystyle
        Given that I have a "bodystyle"
        And the "id" is "1"
        And the id already exists in database
        When I send a PUT request to "/v1/bodystyles/1" with body:
            """
                {
                    "bodystyle" : {
                        "name": "demo2",
                        "is_verified": 1,
                        "status": 1

                    }
                }
            """
        Then the response code should be 204
        And the response is empty
        And the response header Location matches "\/v1\/bodystyles\/\d+"

    Scenario: PATCH an existing bodystyle
        Given that I have a "bodystyle"
        And the "id" is "5"
        And the id already exists in database
        When I send a PATCH request to "/v1/bodystyles/5" with body:
        """
                {
                    "bodystyle" : {
                        "name": "demo5",
                        "is_verified": true
                    }
                }
            """
        Then the response code should be 204
        And the response is empty
        And the response header Location matches "\/v1\/bodystyles\/\d+"
        And the following fields should be updated:
            """
            name, is_verified
            """


    Scenario: Add a new bodystyle
        Given that I want to add "bodystyle"
        When I send a POST request to "/v1/bodystyles" with body:
            """
                {
                    "bodystyle" : {
                        "name": "demo2",
                        "is_verified": true,
                        "status": 1
                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/bodystyles\/\d+"

    Scenario Outline: Find bodystyle with pagination
        When I send a GET request to "/v1/bodystyles?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit | page | number of results |
        | 20    | 1      | 20                 |
        | 20    | 2      | 11                 |

    Scenario Outline: Find bodystyle manufacturer codes with pagination
        When I send a GET request to "/v1/bodystyles/manufacturer-codes?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit | page | number of results |
        | 20    | 1     | 20                  |
        | 20    | 2     | 10                  |


