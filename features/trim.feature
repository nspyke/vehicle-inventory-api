Feature:
    Manage Trim

    Scenario: Find Trim from ID
        When I send a GET request to "/v1/trims/1"
        Then the response code should be 200
        And the response is json

    Scenario Outline: Find Trim with filters
        When I send a GET request to "/v1/trims?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit  | page    | number of results |
        | 15     | 1         | 15                |
        | 15     | 2         | 15                |

    Scenario: Add a new Trim
        Given that I want to add "trim"
        When I send a POST request to "/v1/trims" with body:
            """
                {
                    "trim": {
                        "name": "acbdedsgsdaasdffasdfasdf",
                        "date_added": "2015-05-29T16:58:38+01:00",
                        "date_updated": "2015-05-29T16:58:38+01:00",
                        "is_verified": 2,
                        "status": 79,
                        "manufacturers": [1]

                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/trims\/\d+"

    Scenario: Update an existing Trim
        Given that I have a "trim"
        And the "id" is "1"
        And the id already exists in database
        When I send a PATCH request to "/v1/trims/1" with body:
            """
            {
                "trim": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:58:38+01:00",
                    "date_updated": "2015-05-29T16:58:38+01:00",
                    "is_verified": 2,
                    "status": 79,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/trims\/\d+"


    Scenario: Update an existing Trim
        Given that I have a "trim"
        And the "id" is "1"
        And the id already exists in database
        When I send a PUT request to "/v1/trims/1" with body:
            """
            {
                "trim": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:58:38+01:00",
                    "date_updated": "2015-05-29T16:58:38+01:00",
                    "is_verified": 2,
                    "status": 79,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/trims\/\d+"

    Scenario: Insert a Trim when does not exist
        Given that I have a "trim"
        And the "id" is "99"
        And the "id" does not exist in database
        When I send a PUT request to "/v1/trims/99" with body:
            """
            {
                "trim": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:58:38+01:00",
                    "date_updated": "2015-05-29T16:58:38+01:00",
                    "is_verified": 2,
                    "status": 79,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 201
        And the response header Location matches "\/v1\/trims\/\d+"

    Scenario Outline: Find trim manufacturer codes with pagination
        When I send a GET request to "/v1/trims/manufacturer-codes?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit | page | number of results |
        | 20    | 1     | 20                  |
        | 20    | 2     | 10                  |

