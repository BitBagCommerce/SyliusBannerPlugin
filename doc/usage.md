# Usage

## 1. Twig Extension

When you already have all information set in admin pannel then use:

`getActiveAdsBanners(sectionCode, localCode)` to get all active banners in specific section and locale

or if you want get banners only from one ad then use :

`getActiveAdBanners(sectionCode, localeCode, adCode)`

## 2. Api

use Endpoint :
  `/shop/ads/banners`
 to get all active banners in specific section and locale or if you want get banners only from one ad then use :

`/shop/ad/banners`

## 3. Banners order

All Banners from Twig and API are returning in order from following example : 
- Shop has 2 active ads : 
  - Ad_1 with priority 10
  - Ad_2 with priority 20
- Every Ad has 3 images : 
  - Img_1 with priority 10
  - Img_2 with priority 20
  - Img_3 with priority 30
  
So Returned images will be in order : 

     Ad_2 - Img_3
     Ad_2 - Img_2
     Ad_2 - Img_1
     Ad_1 - Img_3
     Ad_1 - Img_2
     Ad_1 - Img_1
