Feature:
    Manage Wheelbase

    Scenario: Find Wheelbase from ID
        When I send a GET request to "/v1/wheelbases/1"
        Then the response code should be 200
        And the response is json

    Scenario Outline: Find Wheelbase with filters
        When I send a GET request to "/v1/wheelbases?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit  | page    | number of results |
        | 15     | 1         | 15                |
        | 15     | 2         | 15                |

    Scenario: Add a new Wheelbase
        Given that I want to add "wheelbase"
        When I send a POST request to "/v1/wheelbases" with body:
            """
                {
                    "wheelbase": {
                        "name": "acbdedsgsdaasdffasdfasdf",
                        "date_added": "2015-05-29T16:53:10+01:00",
                        "date_updated": "2015-05-29T16:53:10+01:00",
                        "status": 32,
                        "manufacturers": [1]

                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/wheelbases\/\d+"

    Scenario: Update an existing Wheelbase
        Given that I have a "wheelbase"
        And the "id" is "1"
        And the id already exists in database
        When I send a PATCH request to "/v1/wheelbases/1" with body:
            """
            {
                "wheelbase": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:53:10+01:00",
                    "date_updated": "2015-05-29T16:53:10+01:00",
                    "status": 32,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/wheelbases\/\d+"


    Scenario: Update an existing Wheelbase
        Given that I have a "wheelbase"
        And the "id" is "1"
        And the id already exists in database
        When I send a PUT request to "/v1/wheelbases/1" with body:
            """
            {
                "wheelbase": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:53:10+01:00",
                    "date_updated": "2015-05-29T16:53:10+01:00",
                    "status": 32,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/wheelbases\/\d+"

    Scenario: Insert a Wheelbase when does not exist
        Given that I have a "wheelbase"
        And the "id" is "99"
        And the "id" does not exist in database
        When I send a PUT request to "/v1/wheelbases/99" with body:
            """
            {
                "wheelbase": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T16:53:10+01:00",
                    "date_updated": "2015-05-29T16:53:10+01:00",
                    "status": 32,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 201
        And the response header Location matches "\/v1\/wheelbases\/\d+"

    Scenario Outline: Find wheelbase manufacturer codes with pagination
        When I send a GET request to "/v1/wheelbases/manufacturer-codes?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit | page | number of results |
        | 20    | 1     | 20                  |
        | 20    | 2     | 10                  |

