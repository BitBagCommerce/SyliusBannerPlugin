@showing_banners
Feature: showing banners in correct order
  In order to see banners on homepage
  As an Customer
  I want to see banners in correct order

  Background:
    Given the store operates on a single channel in "United States"
    And The store has section with code "TEST-SECTION"
    And The store has active ad with code "TEST-AD" and 100 priority and "first ad" name
    And The store has banner with image "troll.jpg" alt "new image1" and link "/products" in "TEST-SECTION" section and "TEST-AD" ad with priority 50 in the "en_US" locale
    And The store has banner with image "ford.jpg" alt "new image2" and link "/products" in "TEST-SECTION" section and "TEST-AD" ad with priority 100 in the "en_US" locale

  @ui
  Scenario: I see 2 banners from 1 ad in banners priority order
    When I show homepage with the locale "English (United States)"
    Then I see 2 banners on homepage
    And Banner "ford.jpg" should be 1 in order
    And Banner "troll.jpg" should be 2 in order

  @ui
  Scenario: I see 4 banners from 2 ad in ad and banners priority order
    Given The store has active ad with code "TEST-AD2" and 200 priority and "second ad" name
    And The store has banner with image "mugs.jpg" alt "new image1" and link "/products" in "TEST-SECTION" section and "TEST-AD2" ad with priority 5 in the "en_US" locale
    And The store has banner with image "lamborghini.jpg" alt "new image2" and link "/products" in "TEST-SECTION" section and "TEST-AD2" ad with priority 10 in the "en_US" locale
    And I show homepage with the locale "English (United States)"
    When I see 4 banners on homepage
    Then Banner "lamborghini.jpg" should be 1 in order
    And Banner "mugs.jpg" should be 2 in order
    And Banner "ford.jpg" should be 3 in order
    And Banner "troll.jpg" should be 4 in order

  @ui
  Scenario: I see 3 banners from 2 ad in ad and banners priority order
    Given The store has non active ad with code "TEST-AD2" and 200 priority and "second ad" name
    And The store has banner with image "mugs.jpg" alt "new image1" and link "/products" in "TEST-SECTION" section and "TEST-AD2" ad with priority 5 in the "en_US" locale
    And The store has banner with image "lamborghini.jpg" alt "new image2" and link "/products" in "TEST-SECTION" section and "TEST-AD2" ad with priority 10 in the "en_US" locale
    And I show homepage with the locale "English (United States)"
    When I see 2 banners on homepage
    And Banner "ford.jpg" should be 1 in order
    And Banner "troll.jpg" should be 2 in order
