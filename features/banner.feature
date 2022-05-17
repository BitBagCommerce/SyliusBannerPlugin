@managing_banners
Feature: Adding a new banner
    In order to adding a new banner
    As an Administrator
    I want to add a banner

    Background:
        Given the store operates on a single channel in "United States"
        And I am logged in as an administrator
        And The store has section with code "TEST-SECTION"
        And The store has active ad with code "TEST-AD" and 100 priority and "test ad" name
        And I am on new banner page

    @ui
    Scenario: Adding a new banner
        When I fill form with "TEST-SECTION" section, "TEST-AD" ad, "en_US" and "100" priority
        And I add new image "ford.jpg" and fill alt as "test-alt" and link as "/homepage"
        And I submit form
        Then I should be notified that it has been successfully created
        And "TEST-AD" ad should has 1 banners

    @ui
    Scenario: Adding 2 banners to one ad
        When I fill form with "TEST-SECTION" section, "TEST-AD" ad, "en_US" and "100" priority
        And I add new image "ford.jpg" and fill alt as "test-alt" and link as "/homepage"
        And I submit form
        Then I should be notified that it has been successfully created
        And I am on new banner page
        And I fill form with "TEST-SECTION" section, "TEST-AD" ad, "en_US" and "150" priority
        And I add new image "troll.jpg" and fill alt as "test-alt" and link as "/homepage"
        And I submit form
        Then I should be notified that it has been successfully created
        And "TEST-AD" ad should has 2 banners
