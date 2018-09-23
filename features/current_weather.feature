Feature: Weather feature
  Scenario: Getting current weather for location
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/api/v1.0/current?lat=50.082961&lon=19.937348"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON should be equal to:
    """
    {
      "current_weather": {
        "general": 800,
        "temp": 287.15,
        "pressure": 1023,
        "humidity": 93
      }
    }
    """