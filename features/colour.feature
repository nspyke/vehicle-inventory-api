Feature:
    Manage Colour

    Scenario: Find Colour from ID
        When I send a GET request to "/v1/colours/1"
        Then the response code should be 200
        And the response is json

    Scenario Outline: Find Colour with filters
        When I send a GET request to "/v1/colours?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit  | page    | number of results |
        | 15     | 1         | 15                |
        | 15     | 2         | 15                |

    Scenario: Add a new Colour
        Given that I want to add "colour"
        When I send a POST request to "/v1/colours" with body:
            """
                {
                    "colour": {
                        "name": "acbdedsgsdaasdffasdfasdf",
                        "date_added": "2015-05-29T16:30:40+01:00",
                        "date_updated": "2015-05-29T16:30:40+01:00",
                        "status": 4,
                        "manufacturers": [1]

                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/colours\/\d+"

    Scenario: Update an existing Colour
        Given that I have a "colour"
        And the "id" is "1"
        And the id already exists in database
        When I send a PATCH request to "/v1/colours/1" with body:
            """
            {
                "colour": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:30:40+01:00",
                    "date_updated": "2015-05-29T16:30:40+01:00",
                    "status": 4,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/colours\/\d+"


    Scenario: Update an existing Colour
        Given that I have a "colour"
        And the "id" is "1"
        And the id already exists in database
        When I send a PUT request to "/v1/colours/1" with body:
            """
            {
                "colour": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:30:40+01:00",
                    "date_updated": "2015-05-29T16:30:40+01:00",
                    "status": 4,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/colours\/\d+"

    Scenario: Insert a Colour when does not exist
        Given that I have a "colour"
        And the "id" is "99"
        And the "id" does not exist in database
        When I send a PUT request to "/v1/colours/99" with body:
            """
            {
                "colour": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:30:40+01:00",
                    "date_updated": "2015-05-29T16:30:40+01:00",
                    "status": 4,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 201
        And the response header Location matches "\/v1\/colours\/\d+"

    Scenario Outline: Find colour manufacturer codes with pagination
        When I send a GET request to "/v1/colours/manufacturer-codes?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit | page | number of results |
        | 20    | 1     | 20                  |
        | 20    | 2     | 10                  |

