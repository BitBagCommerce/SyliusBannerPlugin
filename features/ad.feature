@managing_ad
Feature: Adding a new ad
    In order to adding a new ad
    As an Administrator
    I want to add a ad

    Background:
        Given the store operates on a single channel in "United States"
        And I am logged in as an administrator
        When I am on new ad page

    @ui
    Scenario: Adding a new ad
        When I create a new ad with data "new ad" "true" "2022-04-21T09:16:00" "2023-04-21T09:16:00" "100" "NEW-AD"
        Then I should be notified that it has been successfully created

    @ui
    Scenario: Adding a new ad with duplicated code
        When I create a new ad with data "new ad" "true" "2022-04-21T09:16:00" "2023-04-21T09:16:00" "100" "NEW-AD"
        Then I should be notified that it has been successfully created
        And I am on new ad page
        When I create a new ad with data "new ad" "true" "2022-04-21T09:16:00" "2023-04-21T09:16:00" "100" "NEW-AD"
        Then I should see error about not unique code

    @ui
    Scenario: Adding a new ad with start date bigger than end date
        When I create a new ad with data "new ad" "true" "2023-04-21T09:16:00" "2022-04-21T09:16:00" "100" "NEW-AD"
        Then I should see error about wrong date
