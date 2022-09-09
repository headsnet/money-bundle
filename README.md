![Build Status](https://github.com/headsnet/money-bundle/actions/workflows/ci.yaml/badge.svg)
[![Latest Stable Version](https://poser.pugx.org/headsnet/money-bundle/v)](//packagist.org/packages/headsnet/money-bundle)
[![Total Downloads](https://poser.pugx.org/headsnet/money-bundle/downloads)](//packagist.org/packages/headsnet/money-bundle)
[![License](https://poser.pugx.org/headsnet/money-bundle/license)](//packagist.org/packages/headsnet/money-bundle)

Money Bundle
==

A Symfony bundle to integrate [Money PHP](https://github.com/moneyphp/money) into your application.

## Summary Of Features


- **Twig Extensions** - display and manipulate Money objects in Twig templates


- **Doctrine Support** - persist Money objects in your storage layer


- **Custom Serializer** - serialize Money objects to and from string or array values


- **Custom Form Type** - use Money objects in form data classes

## Installation

Simply install with Composer in the usual way.

```bash
composer require headsnet/money-bundle
```

Then add to your `bundles.php` file.

```php
Headsnet\MoneyBundle\HeadsnetMoneyBundle::class => ['all' => true]
```

## Doctrine

The bundle provides a custom Doctrine Type for the `Currency` element of the Money object, and then a Doctrine 
Embeddable for use in your models.

The data type for the `amount` column is set to `integer` which is evidently a contentious issue as the Money object 
uses strings internally, but having the database use an integer type allows native sorting and summing etc.

## Forms

The bundle provides a form type with a Data Transformer, that extends the Symfony `MoneyType`.

The field will render a Money field, with the Money value object converted to readable values.

## Twig

### Formatters

The bundle provides a Twig filter which formats a Money object in to a number with a currency symbol.

```twig
{{ object.amount|money }}        # Renders e.g. "€10.00"
```

### Manipulation

The bundle also provides a Twig utility that allows you to create a Money object directly in the template.

```twig
money(AMOUNT, 'CURRENCY_CODE')
```

This is generally useful for creating a variable which you then add values to in a loop. E.g.

```twig
{% set total = money(0, 'EUR') %}

{% for line in order.lines %}

	{% set total = total.add(line.cost) %}

{% endfor %}

Total: {{ total|money }}

```

## Serializer

The bundle provides a Symfony normalizer for the Money object.

```php

$amount = Money::EUR(200);

$serializer->serialize($amount, 'json'); // ==> '{"amount":"200","currency":"EUR"}'

```

## Contributing

Contributions are welcome. Please submit pull requests with one fix/feature per
pull request.

Composer scripts are configured for your convenience:

```
> composer cs         # Run coding standards checks
> composer cs-fix     # Fix coding standards violations
```

### Licence

This code is released under the MIT licence. Please see the LICENSE file for more information.

