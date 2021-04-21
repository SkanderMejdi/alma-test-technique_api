Feature:
    I can use and pay my basket

    Scenario: I want to know the differents payment option
        When I want to check my different payment option for my basket
        Then I see my payment option

    Scenario: I want to create a payment for a basket
        When I want to create a payment for my basket
        Then I see my payment information
