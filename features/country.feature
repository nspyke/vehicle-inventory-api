Feature:
    Manage Country

    Scenario: Find Country from ID
        When I send a GET request to "/v1/countries/1"
        Then the response code should be 200
        And the response is json

    Scenario: Find Country from Iso code
        When I send a GET request to "/v1/countries/GB"
        Then the response code should be 200
        And the response is json

    Scenario Outline: Find Country with filters
        When I send a GET request to "/v1/countries?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

    Examples:
        | limit  | page    | number of results |
        | 15     | 1         | 15                |
        | 15     | 2         | 15                |



