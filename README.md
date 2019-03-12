Money Bundle
==

A Symfony bundle to integrate [Money PHP](https://github.com/moneyphp/money) 
and provide various Twig and Doctrine helpers.

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

The bundle provides a Symfony normalizer for the Money type.

```php

$amount = Money::EUR(200);

$serializer->serialize($amount, 'json'); // ==> '{"amount":"200","currency":"EUR"}'

```
