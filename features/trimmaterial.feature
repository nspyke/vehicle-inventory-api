Feature:
    Manage TrimMaterial

    Scenario: Find TrimMaterial from ID
        When I send a GET request to "/v1/trim-materials/1"
        Then the response code should be 200
        And the response is json

    Scenario Outline: Find TrimMaterial with filters
        When I send a GET request to "/v1/trim-materials?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit  | page    | number of results |
        | 15     | 1         | 15                |
        | 15     | 2         | 15                |

    Scenario: Add a new TrimMaterial
        Given that I want to add "trim_material"
        When I send a POST request to "/v1/trim-materials" with body:
            """
                {
                    "trimmaterial": {
                        "name": "acbdedsgsdaasdffasdfasdf",
                        "date_added": "2015-05-29T17:03:28+01:00",
                        "date_updated": "2015-05-29T17:03:28+01:00",
                        "status": 73,
                        "manufacturers": [1]

                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/trim-materials\/\d+"

    Scenario: Update an existing TrimMaterial
        Given that I have a "trim_material"
        And the "id" is "1"
        And the id already exists in database
        When I send a PATCH request to "/v1/trim-materials/1" with body:
            """
            {
                "trimmaterial": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T17:03:28+01:00",
                    "date_updated": "2015-05-29T17:03:28+01:00",
                    "status": 73,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/trim-materials\/\d+"


    Scenario: Update an existing TrimMaterial
        Given that I have a "trim_material"
        And the "id" is "1"
        And the id already exists in database
        When I send a PUT request to "/v1/trim-materials/1" with body:
            """
            {
                "trimmaterial": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T17:03:28+01:00",
                    "date_updated": "2015-05-29T17:03:28+01:00",
                    "status": 73,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/trim-materials\/\d+"

    Scenario: Insert a TrimMaterial when does not exist
        Given that I have a "trim_material"
        And the "id" is "99"
        And the "id" does not exist in database
        When I send a PUT request to "/v1/trim-materials/99" with body:
            """
            {
                "trimmaterial": {
                    "name": "acbdedsgsdaasdffasdfasdf",
                    "date_added": "2015-05-29T17:03:28+01:00",
                    "date_updated": "2015-05-29T17:03:28+01:00",
                    "status": 73,
                    "manufacturers": [1]

                }
            }
            """
        Then the response is empty
        And the response code should be 201
        And the response header Location matches "\/v1\/trim-materials\/\d+"

    Scenario Outline: Find trim material manufacturer codes with pagination
        When I send a GET request to "/v1/trim-materials/manufacturer-codes?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit | page | number of results |
        | 20    | 1     | 20                  |
        | 20    | 2     | 10                  |

