Feature:
    Manage Vehicles

    Scenario: Find Vehicle from vin
        When I send a GET request to "/v1/vehicles/vin/vin1234"
        Then the response code should be 200
        And the response is json
        And the response should contain the properties:
            """
            id, vin, doors, seats, manufacturer, drive, odometer
            """

    Scenario: Find Vehicle from ID
        When I send a GET request to "/v1/vehicles/1"
        Then the response code should be 200
        And the response is json
        And the response should contain the properties:
            """
            id, vin, doors, seats, manufacturer, drive, odometer
            """

    Scenario Outline: Find Vehicles with pagination
        When I send a GET request to "/v1/vehicles?_limit=<limit>&_page=<page>"
        Then the response code should be 200
        And the response is json
        And the data has <number of results> results
        And the page index should be <page>

        Examples:
            | limit  | page    | number of results |
            | 20     | 1          | 20                  |
            | 20     | 2         | 10                   |


    Scenario: Add a new vehicle
        Given that I want to add "vehicle"
        And the "vin" is "vin4321"
        And the "manufacturer" is "landrover"
        And the "model" is "defender 90"
        And the "engine" is "diesel"
        And the "transmission" is "manual"
        And the "variant" is "HSE"
        And the "bodystyle" is "5 door"
        And the "trim" is "Navy"
        And the "wheelbase" is "90"
        And the "vehicle_status" is "retail"
        And the "odometer" is "5000"
        And the "colour_exterior" is "Fuji White"
        When I send a POST request to "/v1/vehicles" with body:
            """
                {
                    "vehicle" : {
                        "vin": "vin4321",
                        "odometer": 5000,
                        "odometer_unit": "mi",
                        "manufacturer": 1,
                        "model": 1,
                        "engine": 1,
                        "transmission": 1,
                        "variant": 1,
                        "trim": 1,
                        "wheelbase": 1,
                        "colour_exterior": 1,
                        "status": 1
                    }
                }
            """

        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/vehicles\/\d+"

    Scenario: Update an existing vehicle
        Given that I have a "vehicle"
        And the "id" is "1"
        And the "manufacturer" is "Land Rover"
        And the "model" is "defender 90"
        And the "engine" is "diesel"
        And the "transmission" is "manual"
        And the "variant" is "HSE"
        And the "bodystyle" is "5 door"
        And the "trim" is "Navy"
        And the "wheelbase" is "90"
        And the "vehicle_status" is "retail"
        And the "odometer" is "9000"
        And the "colour_exterior" is "Fuji White"
        And the id already exists in database
        When I send a PUT request to "/v1/vehicles/1" with body:
            """
                {
                    "vehicle" : {
                        "vin": "vin1234",
                        "odometer": 9000,
                        "manufacturer": 2,
                        "model": 1,
                        "engine": 2,
                        "transmission": 3,
                        "variant": 2,
                        "trim": 3,
                        "wheelbase": 1,
                        "colour_exterior": 1,
                        "status": 1
                    }
                }
            """
        Then the response code should be 204
        And the response is empty
        And the response header Location matches "\/v1\/vehicles\/\d+"
        And the following fields should be updated:
            """
            odometer, manufacturer_id, engine_id, variant_id, transmission_id
            """

    Scenario: Insert a vehicle when does not exist
        Given that I have a "vehicle"
        And the "vin" is "vin5678"
        And the "manufacturer" is "Land Rover"
        And the "model" is "defender 90"
        And the "engine" is "diesel"
        And the "transmission" is "manual"
        And the "variant" is "HSE"
        And the "bodystyle" is "5 door"
        And the "trim" is "Navy"
        And the "wheelbase" is "90"
        And the "vehicle_status" is "retail"
        And the "odometer" is "5000"
        And the "colour_exterior" is "Fuji White"
        And the vin does not exist in database
        When I send a PUT request to "/v1/vehicles/99" with body:
            """
                {
                    "vehicle" : {
                        "vin": "vin5678",
                        "odometer": 5000,
                        "manufacturer": 1,
                        "model": 1,
                        "engine": 1,
                        "transmission": 1,
                        "variant": 1,
                        "trim": 1,
                        "wheelbase": 1,
                        "colour_exterior": 1,
                        "status": 1
                    }
                }
            """
        Then the response code should be 201
        And the response is empty
        And the response header Location matches "\/v1\/vehicles\/\d+"

    Scenario: Update a vehicle with Id
        Given that I have a "vehicle"
        And the "id" is "1"
        And the id already exists in database
        When I send a PATCH request to "/v1/vehicles/1" with body:
        """
                {
                    "vehicle" : {
                        "vin": "ABC12345678",
                        "odometer": 12000,
                        "manufacturer": 1,
                        "model": 2,
                        "engine": 1,
                        "transmission": 1,
                        "variant": 1,
                        "trim": 4,
                        "wheelbase": 2,
                        "colour_exterior": 2
                    }
                }
            """
        Then the response code should be 204
        And the response is empty
        And the response header Location matches "\/v1\/vehicles\/\d+"
        And the following fields should be updated:
            """
            vin, odometer, manufacturer_id, engine_id, variant_id, transmission_id, wheelbase_id, colour_exterior_id
            """