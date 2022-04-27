@managing_sections
Feature: Adding a new section
    In order to adding a new banner to ad and section
    As an Administrator
    I want to add a section

    Background:
        Given the store operates on a single channel in "United States"
        And I am logged in as an administrator
        When I am on new section page

    @ui
    Scenario: Adding a new section
        And I create a new section with data "new section" "NEW-SECTION" "1920" "1080"
        Then I should be notified that it has been successfully created

    @ui
    Scenario: Adding a new section with duplicated code
        And I create a new section with data "new section" "NEW-SECTION" "1920" "1080"
        Then I should be notified that it has been successfully created
        And I am on new section page
        And I create a new section with data "new section2" "NEW-SECTION" "1920" "1080"
        Then I should see error about not unique code
