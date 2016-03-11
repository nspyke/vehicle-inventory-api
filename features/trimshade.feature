Feature:
    Manage TrimShade

    Scenario: Find TrimShade from ID
        When I send a GET request to "/v1/trim-shades/1"
        Then the response code should be 200
        And the response is json

    Scenario Outline: Find TrimShade with filters
        When I send a GET request to "/v1/trim-shades?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit  | page    | number of results |
        | 15     | 1         | 15                |
        | 15     | 2         | 15                |

    Scenario: Add a new TrimShade
        Given that I want to add "trim_shade"
        When I send a POST request to "/v1/trim-shades" with body:
            """
                {
                    "trimshade": {
                        "name": "acbdedsgsdaasdffasdfasdf",
                        "date_added": "2015-05-29T17:09:53+01:00",
                        "date_updated": "2015-05-29T17:09:53+01:00",
                        "is_verified": true,
                        "status": 38,
                        "trim": 1

                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/trim-shades\/\d+"

    Scenario: Update an existing TrimShade
        Given that I have a "trim_shade"
        And the "id" is "1"
        And the id already exists in database
        When I send a PATCH request to "/v1/trim-shades/1" with body:
            """
            {
                "trimshade": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T17:09:53+01:00",
                    "date_updated": "2015-05-29T17:09:53+01:00",
                    "is_verified": true,
                    "status": 38,
                    "trim": 1

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/trim-shades\/\d+"


    Scenario: Update an existing TrimShade
        Given that I have a "trim_shade"
        And the "id" is "1"
        And the id already exists in database
        When I send a PUT request to "/v1/trim-shades/1" with body:
            """
            {
                "trimshade": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T17:09:53+01:00",
                    "date_updated": "2015-05-29T17:09:53+01:00",
                    "is_verified": true,
                    "status": 38,
                    "trim": 1

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/trim-shades\/\d+"

    Scenario: Insert a TrimShade when does not exist
        Given that I have a "trim_shade"
        And the "id" is "99"
        And the "id" does not exist in database
        When I send a PUT request to "/v1/trim-shades/99" with body:
            """
            {
                "trimshade": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T17:09:53+01:00",
                    "date_updated": "2015-05-29T17:09:53+01:00",
                    "is_verified": true,
                    "status": 38,
                    "trim": 1

                }
            }
            """
        Then the response is empty
        And the response code should be 201
        And the response header Location matches "\/v1\/trim-shades\/\d+"

