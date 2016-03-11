Feature:
    Manage Currency

    Scenario: Find Currency from ID
        When I send a GET request to "/v1/currencies/1"
        Then the response code should be 200
        And the response is json

    Scenario: Find Currency from ISO
        When I send a GET request to "/v1/currencies/GBP"
        Then the response code should be 200
        And the response is json

    Scenario Outline: Find Currency with filters
        When I send a GET request to "/v1/currencies?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit  | page    | number of results |
        | 15     | 1         | 15                |
        | 15     | 2         | 15                |



