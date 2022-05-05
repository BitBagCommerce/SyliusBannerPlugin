## Installation


1. *We work on stable, supported and up-to-date versions of packages. We recommend you to do the same.*

```bash
$ composer require bitbag/banner-plugin
```

2. Add plugin dependencies to your `config/bundles.php` file:

```php
return [
    ...
    
    BitBag\SyliusBannerPlugin\BitBagSyliusBannerPlugin::class => ['all' => true],
    ];
```

3. Import required config in your `config/packages/_sylius.yaml` file:
```yaml
# config/packages/_sylius.yaml

imports:
    ...

    - { resource: "@BitBagSyliusBannerPlugin/Resources/config/config.yaml" }
```

4. Import routing in your `config/routes.yaml` file:

```yaml

# config/routes.yaml
...

bitbag_sylius_banner_plugin:
    resource: "@BitBagSyliusBannerPlugin/Resources/config/routing.yaml"
```

5. Finish the installation by updating the database schema and installing assets:

```
$ bin/console doctrine:migrations:diff
$ bin/console doctrine:migrations:migrate
```

## Testing & running the plugin
```bash
$ composer install
$ cd tests/Application
$ yarn install
$ yarn run gulp
$ bin/console assets:install public -e test
$ bin/console doctrine:schema:create -e test
$ bin/console server:run 127.0.0.1:8080 -d public -e test
$ open http://localhost:8080
$ vendor/bin/behat
$ vendor/bin/phpspec run
```
