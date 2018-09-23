# CustomStringExplode

[![Build Status](https://travis-ci.org/AndyDune/CustomStringExplode.svg?branch=master)](https://travis-ci.org/AndyDune/CustomStringExplode)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/andydune/custom-string-explode.svg?style=flat-square)](https://packagist.org/packages/andydune/custom-string-explode)
[![Total Downloads](https://img.shields.io/packagist/dt/andydune/custom-string-explode.svg?style=flat-square)](https://packagist.org/packages/andydune/custom-string-explode)


Explode string using custom user rules.


Installation
------------

Installation using composer:

```
composer require andydune/custom-string-explode
```
Or if composer was not installed globally:
```
php composer.phar require andydune/custom-string-explode
```
Or edit your `composer.json`:
```
"require" : {
     "andydune/custom-string-explode": "^1"
}

```
And execute command:
```
php composer.phar update
```

Instruction
-------------

There is any string we want to convert into array. String may be set of numbers with any delimiters, it can be email set and more.

It is better to see how it work for on specific points. 

## Rule: Numbers

```php
use AndyDune\CustomStringExplode\Rule\Numbers;
use AndyDune\CustomStringExplode\StringContainer;

$numbers = new Numbers();
$explode = new StringContainer($numbers);
$results = $explode->explode('123 13-4 00');

// Result is
$result = [123, 13, 4, 00];

```

## Rule: Emails

```php
use AndyDune\CustomStringExplode\Rule\Email;
use AndyDune\CustomStringExplode\StringContainer;

$rule = new Email();
$explode = new StringContainer($rule);

$results = $explode->explode('Андрей Рыжов,  ;
Andrey Ryzhov,
simple@example.com ,
disposable.style.email.with+symbol@example.com
x@example.com
#!$%&\'*+-/=?^_`{}|~@example.org
"()<>[]:,;@\\\"!#$%&\'-/=?^_`{}| ~.a"@example.org
');

// Result is
$result = [
    'simple@example.com', 
    'disposable.style.email.with+symbol@example.com', 
    'x@example.com', 
    '#!$%&'*+-/=?^_`{}|~@example.org'
];

```

## Rule: NumbersAndLatinLetters

I used it for extract hashes from any texts.

```php
use AndyDune\CustomStringExplode\StringContainer;
use AndyDune\CustomStringExplode\Rule\NumbersAndLatinLetters;

$rule = new NumbersAndLatinLetters();
$explode = new StringContainer($rule);

$results = $explode->explode('adqwdqw123 adasdsa;78
првиетhellow
');

// Result is
$result = [
    'adqwdqw123', 
    'adasdsa', 
    '78', 
    'hellow'
];
```


Create custom rules
----------------
You may build your onw rules for explode strings as you wish. All rules mast implement `RuleAbstract` interface.

Lets look at the code:
```php
namespace AndyDune\CustomStringExplode\Rule;


use AndyDune\CustomStringExplode\StringContainer;

abstract class RuleAbstract
{
    /**
     * @var StringContainer
     */
    protected $container;

    /**
     * @return StringContainer
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param StringContainer $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function format($string)
    {
        return trim($string);
    }

    /**
    * @params string $char current char for check
    * @params string $item previously collected char
    * @params array $array array was colected during previous executions of method
    */
    abstract public function check($char, $item, $array);
}
```

You need to define method `check` surely. This method returns boolean value:

- `true` - current char may be the part of string
- `false` - current char is separator 

Overload method `format` for final check every result array item. It make trim by default. 
Method may returns `null` or `false` if item must be deleted from array.