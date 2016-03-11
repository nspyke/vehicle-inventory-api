Feature:
    Manage Engine

    Scenario: Find Engine from ID
        When I send a GET request to "/v1/engines/1"
        Then the response code should be 200
        And the response is json

    Scenario Outline: Find Engine with filters
        When I send a GET request to "/v1/engines?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit  | page    | number of results |
        | 15     | 1         | 15                |
        | 15     | 2         | 15                |

    Scenario: Add a new Engine
        Given that I want to add "engine"
        When I send a POST request to "/v1/engines" with body:
            """
                {
                    "engine": {
                        "name": "acbdedsgsdaasdffasdfasdf",
                        "cylinders": 4,
                        "valves": 100,
                        "bhp": 18,
                        "turbo": 44,
                        "supercharger": 67,
                        "date_added": "2015-05-29T15:09:38+01:00",
                        "date_updated": "2015-05-29T15:09:38+01:00",
                        "is_verified": 1,
                        "status": 68,
                        "fuel": 1,
                        "manufacturers": [1],
                        "models": [1]

                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/engines\/\d+"

    Scenario: Update an existing Engine
        Given that I have a "engine"
        And the "id" is "1"
        And the id already exists in database
        When I send a PATCH request to "/v1/engines/1" with body:
            """
            {
                "engine": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "cylinders": 4,
                    "valves": 100,
                    "bhp": 18,
                    "turbo": 44,
                    "supercharger": 67,
                    "date_added": "2015-05-29T15:09:38+01:00",
                    "date_updated": "2015-05-29T15:09:38+01:00",
                    "is_verified": 1,
                    "status": 68,
                    "fuel": 1,
                    "manufacturers": [1],
                    "models": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/engines\/\d+"


    Scenario: Update an existing Engine
        Given that I have a "engine"
        And the "id" is "1"
        And the id already exists in database
        When I send a PUT request to "/v1/engines/1" with body:
            """
            {
                "engine": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "cylinders": 4,
                    "valves": 100,
                    "bhp": 18,
                    "turbo": 44,
                    "supercharger": 67,
                    "date_added": "2015-05-29T15:09:38+01:00",
                    "date_updated": "2015-05-29T15:09:38+01:00",
                    "is_verified": 1,
                    "status": 68,
                    "fuel": 1,
                    "manufacturers": [1],
                    "models": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/engines\/\d+"

    Scenario: Insert a Engine when does not exist
        Given that I have a "engine"
        And the "id" is "99"
        And the "id" does not exist in database
        When I send a PUT request to "/v1/engines/99" with body:
            """
            {
                "engine": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "cylinders": 4,
                    "valves": 100,
                    "bhp": 18,
                    "turbo": 44,
                    "supercharger": 67,
                    "date_added": "2015-05-29T15:09:38+01:00",
                    "date_updated": "2015-05-29T15:09:38+01:00",
                    "is_verified": 1,
                    "status": 68,
                    "fuel": 1,
                    "manufacturers": [1],
                    "models": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 201
        And the response header Location matches "\/v1\/engines\/\d+"

    Scenario Outline: Find engine manufacturer codes with pagination
        When I send a GET request to "/v1/engines/manufacturer-codes?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit | page | number of results |
        | 20    | 1     | 20                  |
        | 20    | 2     | 10                  |


