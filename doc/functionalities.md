# Functionalities

---
## Introduction

---

Plugin allows you to manage banners on your shop. You can create time limited Ad and add to it banners with specific sections and locale.
Thanks that you can plan your marketing action a few moths forwards and don't worry about nothing

## Usage
The plugin allows you to display and change the way images are displayed on the website from the administrator level.

It consists of three elements:

- a section,
- an advertisement,
- a banner.

<div align="center">
    <img src="./images/structure.png"/>
</div>
<br>

#### SECTION
The section identifies the potential location of the image.
It is the section code that is placed in the twig files where the image is to appear.

Example of placing sections in twig files:

For example in layout.html.twig
````php
// templates/bundles/SyliusShopBundle/layout.html.twig
...
<div class="ui container">
    {% block header %}
        <header>
            {{ sylius_template_event('sylius.shop.layout.header') }}
        </header>
    {% endblock %}
    // adding line below
    {% include '@SyliusShop/Homepage/_banner.html.twig'%}
    // -----------------------------------------------------
    {% include '@SyliusShop/_flashes.html.twig' %}

    {{ sylius_template_event('sylius.shop.layout.before_content') }}

    {% block content %}
    {% endblock %}

    {{ sylius_template_event('sylius.shop.layout.after_content') }}
</div>
...
````
````php
// templates/bundles/SyliusShopBundle/Homepage/_banner.html.twig
{% set banners = getActiveAdsBanners("TEST-SECTION", 'en_US' ) %}
    <div class="banners">
        {% for banner in banners %}
            <a href="{{banner.link}}">
                <img class="ui fluid image" src="{{ asset(banner.path) }}" alt="{{banner.alt}}" data-order="{{loop.index}}">
            </a>
        {% endfor %}
    </div>
````
...where "TEST-SECTION" is a SECTION CODE.

#### ADVERTISEMENT
The ad specifies the time and language in which the image is displayed

#### BANNER
Here, a image is added along with a link, and the predefined section and ad are selected.

---
### Display and addition of advertisements
#### Display ads
<div align="center">
    <img src="./images/ads_index.png"/>
</div>
<br>

#### Adding new ad
<div align="center">
    <img src="./images/ads.png"/>
</div>
<br>

---
### Display and addition of sections
#### Display sections
<div align="center">
    <img src="./images/section_index.png"/>
</div>
<br>

#### Adding new section
<div align="center">
    <img src="./images/section.png"/>
</div>
<br>

---
### Display and addition of banners
#### Display banners
<div align="center">
    <img src="./images/banners_index.png"/>
</div>
<br>

#### Adding new banner
<div align="center">
    <img src="./images/banner.png"/>
</div>
<br>
