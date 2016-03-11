Feature:
    Manage Variant

    Scenario: Find Variant from ID
        When I send a GET request to "/v1/variants/1"
        Then the response code should be 200
        And the response is json

    Scenario Outline: Find Variant with filters
        When I send a GET request to "/v1/variants?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit  | page    | number of results |
        | 15     | 1         | 15                |
        | 15     | 2         | 15                |

    Scenario: Add a new Variant
        Given that I want to add "variant"
        When I send a POST request to "/v1/variants" with body:
            """
                {
                    "variant": {
                        "name": "acbdedsgsdaasdffasdfasdf",
                        "date_added": "2015-05-29T15:39:40+01:00",
                        "date_updated": "2015-05-29T15:39:40+01:00",
                        "is_verified": true,
                        "status": 30,
                        "models": [1],
                        "manufacturers": [1]

                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/variants\/\d+"

    Scenario: Update an existing Variant
        Given that I have a "variant"
        And the "id" is "1"
        And the id already exists in database
        When I send a PATCH request to "/v1/variants/1" with body:
            """
            {
                "variant": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T15:39:40+01:00",
                    "date_updated": "2015-05-29T15:39:40+01:00",
                    "is_verified": true,
                    "status": 30,
                    "models": [1],
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/variants\/\d+"


    Scenario: Update an existing Variant
        Given that I have a "variant"
        And the "id" is "1"
        And the id already exists in database
        When I send a PUT request to "/v1/variants/1" with body:
            """
            {
                "variant": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T15:39:40+01:00",
                    "date_updated": "2015-05-29T15:39:40+01:00",
                    "is_verified": true,
                    "status": 30,
                    "models": [1],
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/variants\/\d+"

    Scenario: Insert a Variant when does not exist
        Given that I have a "variant"
        And the "id" is "99"
        And the "id" does not exist in database
        When I send a PUT request to "/v1/variants/99" with body:
            """
            {
                "variant": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T15:39:40+01:00",
                    "date_updated": "2015-05-29T15:39:40+01:00",
                    "is_verified": true,
                    "status": 30,
                    "models": [1],
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 201
        And the response header Location matches "\/v1\/variants\/\d+"

    Scenario Outline: Find variant manufacturer codes with pagination
        When I send a GET request to "/v1/variants/manufacturer-codes?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit | page | number of results |
        | 20    | 1     | 20                  |
        | 20    | 2     | 10                  |

