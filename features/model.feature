Feature:
    Manage Models

    Scenario: Find models
        When  I send a GET request to "/v1/models"
        Then  the response is json
        And   the response code should be 200
        And   the response is a collection of models with all their properties:
            """
            id,
            manufacturer,
            model_group,
            name,
            date_added,
            date_updated,
            is_verified,
            status
            """


    Scenario Outline: Find models with pagination
        When  I send a GET request to "/v1/models?_limit=<limit>&_page=<page>"
        Then  the response is json
        And   the response code should be 200
        And   the response is a collection of models with all their properties:
            """
            id,
            manufacturer,
            model_group,
            name,
            date_added,
            date_updated,
            is_verified,
            status
            """
        And   the data has <number of results> results
        And   the page index should be <page>
    Examples:
        | limit | page | number of results |
        | 20    | 1      | 20                |
        | 20    | 2     | 10                 |


    Scenario: Add a new model
        Given that I want to add "model"
        When I send a POST request to "/v1/models" with body:
            """
            {
                "model" : {
                  "name": "superaldskf",
                  "manufacturer": 1,
                  "model_group": 1,
                  "is_verified": true,
                  "status": 1
                }
            }
            """
        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/models\/\d+"


    Scenario: Add a new model via PUT when does not exist
        Given that I want to add "model"
        When I send a PUT request to "/v1/models/99" with body:
            """
                {
                    "model" : {
                      "name": "HIHIHI",
                      "manufacturer": 2,
                       "model_group": 1,
                      "is_verified": true,
                      "status": 1
                    }
                }
            """
        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/models\/\d+"

    Scenario: Update an existing model
        Given that I have a "model"
        And the "id" is "1"
        And the "name" is "thefirstevermodel"
        And the "manufacturer" is "Jaguar"
        And the "is_verified" is "true"
        And the id already exists in database
        When I send a PUT request to "/v1/models/1" with body:
            """
            {
                "model" : {
                  "name": "HIHIHI",
                  "manufacturer": 2,
                 "model_group": 1,
                  "is_verified": true,
                  "status": 1
                }
            }
            """
        Then the response code should be 204
        And the response is empty
        And the response header Location matches "\/v1\/models\/\d+"
        And the following fields should be updated:
            """
            name
            """

    Scenario: Update an existing model (ungreedy)
        Given that I have a "model"
        And the "id" is "1"
        And the "name" is "HIHIHI"
        And the id already exists in database
        When I send a PATCH request to "/v1/models/1" with body:
            """
              {
                  "model" : {
                      "name": "thisischanged3"
                  }
              }
            """
        Then the response code should be 204
        And the response is empty
        And the response header Location matches "\/v1\/models\/\d+"
        And the following fields should be updated:
            """
            name
            """