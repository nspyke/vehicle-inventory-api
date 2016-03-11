Feature:
    Manage Transmission

    Scenario: Find Transmission from ID
        When I send a GET request to "/v1/transmissions/1"
        Then the response code should be 200
        And the response is json

    Scenario Outline: Find Transmission with filters
        When I send a GET request to "/v1/transmissions?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit  | page    | number of results |
        | 15     | 1         | 15                |
        | 15     | 2         | 15                |

    Scenario: Add a new Transmission
        Given that I want to add "transmission"
        When I send a POST request to "/v1/transmissions" with body:
            """
                {
                    "transmission": {
                        "name": "acbdedsgsdaasdffasdfasdf",
                        "date_added": "2015-05-29T16:01:18+01:00",
                        "date_updated": "2015-05-29T16:01:18+01:00",
                        "is_verified": true,
                        "status": 76,
                        "manufacturers": [1]

                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/transmissions\/\d+"

    Scenario: Update an existing Transmission
        Given that I have a "transmission"
        And the "id" is "1"
        And the id already exists in database
        When I send a PATCH request to "/v1/transmissions/1" with body:
            """
            {
                "transmission": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:01:18+01:00",
                    "date_updated": "2015-05-29T16:01:18+01:00",
                    "is_verified": true,
                    "status": 76,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/transmissions\/\d+"


    Scenario: Update an existing Transmission
        Given that I have a "transmission"
        And the "id" is "1"
        And the id already exists in database
        When I send a PUT request to "/v1/transmissions/1" with body:
            """
            {
                "transmission": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:01:18+01:00",
                    "date_updated": "2015-05-29T16:01:18+01:00",
                    "is_verified": true,
                    "status": 76,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/transmissions\/\d+"

    Scenario: Insert a Transmission when does not exist
        Given that I have a "transmission"
        And the "id" is "99"
        And the "id" does not exist in database
        When I send a PUT request to "/v1/transmissions/99" with body:
            """
            {
                "transmission": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:01:18+01:00",
                    "date_updated": "2015-05-29T16:01:18+01:00",
                    "is_verified": true,
                    "status": 76,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 201
        And the response header Location matches "\/v1\/transmissions\/\d+"

    Scenario Outline: Find transmission manufacturer codes with pagination
        When I send a GET request to "/v1/transmissions/manufacturer-codes?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit | page | number of results |
        | 20    | 1     | 20                  |
        | 20    | 2     | 10                  |

