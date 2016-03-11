Feature:
   List manufacturer with various filters
    
    Scenario: Find Manufacturer from ID
        When I send a GET request to "/v1/manufacturers/1"
        Then the response code should be 200
        And the response is json
        And the response should contain the properties:
            """
            id, name, is_verified, date_added, date_updated, status, code
            """ 

    Scenario Outline: Find manufacturers with pagination
        Given that I want to find "manufacturers"        
        When I send a GET request to "/v1/manufacturers?_limit=<limit>&_page=<page>"
        Then the response is json
        And the response code should be 200
        And the data has <number of results> results
        And the page index should be <page>

        Examples:
            |  limit  | page  | number of results |
            |  3     | 1       | 3                |
            |  3     | 2      | 1                 |

    Scenario: Add a new manufacturers
        Given that I want to add "manufacturers"
        When I send a POST request to "/v1/manufacturers" with body:
            """
                {
                    "manufacturer": {
                        "name": "TestName",
                        "code": "TestCode1212",
                        "date_added": "2015-05-07 09:38:04",
                        "is_verified": true,
                        "status": 1
                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/manufacturers\/\d+"

    Scenario: Update an existing manufacturer
        Given that I have a "manufacturer"
        And the "name" is "TestName"
        And the "code" is "TestCode"
        And the "listOrder" is "1"
        And the "date_added" is "2015-05-07 09:38:04"
        And the "is_verified" is "true"
        And the "sys_status" is "1"
        And the "name" already exists in database
        When I send a PUT request to "/v1/manufacturers/5" with body:
            """
                {
                    "manufacturer": {
                        "name": "TestName",
                        "code": "TestCode",
                        "date_added": "2015-05-07 09:38:04",
                        "is_verified": false,
                        "status": 0
                    }
                }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/manufacturers\/\d+"
        And the following fields should be updated:
            """
            is_verified, status
            """

    Scenario: Insert a manufacturer when does not exist
        Given that I have a "manufacturer"
        And the "name" is "TestName2"
        And the "code" is "TestCode2"
        And the "date_added" is "2015-05-07 09:38:04"
        And the "is_verified" is "true"
        And the "status" is "1"
        And the "name" does not exist in database
        When I send a PUT request to "/v1/manufacturers/37" with body:
            """
                {
                    "manufacturer": {
                        "name": "TestName2",
                        "code": "TestCode2",
                        "date_added": "2015-05-07 09:38:04",
                        "is_verified": true,
                        "status": 1
                    }
                }
            """                
        Then the response is empty
        And the response code should be 201
        And the response header Location matches "\/v1\/manufacturers\/\d+"

    Scenario: Update a manufacturer with Id
        Given that I have a "manufacturer"
        And the "id" is "4"
        And the id already exists in database
        When I send a PATCH request to "/v1/manufacturers/4" with body:
            """
                {
                    "manufacturer": {
                        "name": "newname"
                    }
                }
            """
        Then the response is empty
        And the response code should be 204
        And the response header Location matches "\/v1\/manufacturers\/\d+"
        And the following fields should be updated:
            """
            name
            """