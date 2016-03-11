Feature:
    Manage Equipment
        
    Scenario: Find Equipment from ID
        When I send a GET request to "/v1/equipment/1"
        Then the response code should be 200
        And the response is json
        And the response should contain the properties:
            """
            id, name, date_added, date_updated, status, equipment_type
            """         

    Scenario Outline: Find Equipment with pagination
        When I send a GET request to "/v1/equipment?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

        Examples:
            | limit  | page    | number of results |
            | 15     | 1         | 15                |
            | 15     | 2         | 15                |

    Scenario Outline: Find Equipment with manufacturer code
        When I send a GET request to "/v1/equipment?manufacturerCodes=<manufacturer_code_id>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results

        Examples:
            | manufacturer_code_id  | number of results |
            | 1                        | 1                 |
            | 2                        | 1                 |
            

    Scenario: Add a new equipment
        Given that I want to add "equipment"
        When I send a POST request to "/v1/equipment" with body:
            """
                {
                    "equipment": {
                        "name": "test equipment",
                        "manufacturers": [1],
                        "equipment_type": 2,
                        "date_added": "2015-05-07 11:33:01",
                        "date_updated": "2015-05-07 11:33:01",
                        "is_verified": true,
                        "status": 5
                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/equipment\/\d+"
   

    Scenario: Update an existing equipment
        Given that I have a "equipment"
        And the "name" is "test equipment"
        And the "name" already exists in database
        When I send a PUT request to "/v1/equipment/31" with body:
            """
                {
                    "equipment": {
                        "name": "test equipment",
                        "manufacturers": [1],
                        "equipment_type": 2,
                        "is_verified": false,
                        "status": 1
                    }
                }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/equipment\/\d+"
        And the following fields should be updated:
            """
            is_verified, status
            """

    Scenario: Insert a equipment when does not exist
        Given that I have a "equipment"
        And the "name" is "test equipment 2"
        And the "name" does not exist in database
        When I send a PUT request to "/v1/equipment/32" with body:
             """
                {
                    "equipment": {
                        "name": "test equipment 2",
                        "manufacturers": [1],
                        "equipment_type": 2,
                        "is_verified": true,
                        "status": 1
                    }
                }
            """           
        Then the response is empty
        And the response code should be 201
        And the response header Location matches "\/v1\/equipment\/\d+"

    Scenario: Update a equipment with Id
        Given that I have a "equipment"
        And the "id" is "31"
        And the id already exists in database
        When I send a PATCH request to "/v1/equipment/31" with body:
            """
                {
                    "equipment": {
                        "is_verified": true,
                        "status": 5
                    }
                }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/equipment\/\d+"
        And the following fields should be updated:
            """
            is_verified, status
            """

    Scenario Outline: Find equipment manufacturer codes with pagination
        When I send a GET request to "/v1/equipment/manufacturer-codes?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit | page | number of results |
        | 20    | 1     | 20                  |
        | 20    | 2     | 10                  |

