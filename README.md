# Avity
---
Highly Customizable Identicon Generator for PHP.
---

# Installation  
Get it through composer cli.

```
composer require hedronium/avity
```

or by adding it to your `composer.json`
```JSON
{
    "require": {
        "hedronium/avity": "^1.0"
    }
}
```

and running `composer install`

# Getting Started
```PHP
use Hedronium\Avity\Avity;

$avity = Avity::init()->generate()->jpg()->toBrowser();
```

Thats it thats all you really need to generate an Identicon.
The above code will generate an Identicon based on Random values.




# Basic Customization

## Customizing Image Dimensions
You can call the `height($value)` and `width($value)` method on the `Avity` instance
after initialization. Like:

```PHP
$avity = Avity::init();

$avity->height(600)->width(500); // Long Vertical Identicon. WOW!

$avity->generate()->jpg()->toBrowser();
```

Yes, its a Fluent API, method chaining is cool!



## Customizing the Grid
You can call the `rows($value)` and `columns($value)` method on the `Avity` instance
after initialization. Like:

```PHP
$avity = Avity::init();

$avity->rows(3)->columns(3); // 3x3 Grid

$avity->generate()->jpg()->toBrowser();
```

## Padding
You can call the `padding($value)` method on the `Avity` instance


```PHP
$avity = Avity::init();

$avity->padding(100);

$avity->generate()->jpg()->toBrowser();
```

## Style Specific Customizations.
Often the style class used has specific methods that customize its behaviour
which are not directly available on the Avity object for such cases the style
instace can be fetched with the `style()` method on the `Avity` instance.

Like:

```PHP
$avity = Avity::init();

$avity->style()->variedColor()->spacing(10); // `spacing()` & `variedColor()` is a style specific method

$avity->generate()->jpg()->toBrowser();
```




# Generators
`Generators` are objects that generate numbers. These numbers are used by Layouts
to set blocks onto the grid.

Avity comes built in with two generators `Hash` & `Random`

To use a different generator you can pass in an associative array
of options with the `generator` key and the class bane as the value. Like:

```PHP
$avity = Avity::init([
    'generator' => \Hedronium\Avity\Generators\Hash::class
]);
```


available classes:

- `\Hedronium\Avity\Generators\Hash` (_default_)
- `\Hedronium\Avity\Generators\Random`



## The Hash Generator
Once you got the generator setup like above to pass in a value to hash you can call `hash()` on the `Avity` instance.
(it can be anything, like the user's username or email address or id)

```PHP
$avity = Avity::init([
    'generator' => \Hedronium\Avity\Generators\Hash::class
]);

$avity->hash('I like Bananas and I cannot lie.'); // I really like bananas.

$avity->generate()->jpg()->toBrowser();
```

This will generate the same identicon each time you give it the same value to hash.


# Layouts
`Layout` objects use `Generator` objects to set blocks onto the grid.
Avity comes with 3 built in `Layout` classes:

- `\Hedronium\Avity\Layouts\VerticalMirror` (_default_)
- `\Hedronium\Avity\Layouts\HorizontalMirror`
- `\Hedronium\Avity\Layouts\DiagonalMirror`

changing the layout class

```PHP
$avity = Avity::init([
    'layout' => \Hedronium\Avity\Layouts\DiagonalMirror::class
]);
```

# Styles
`Style` objects use `Layout` objects to draw the grid onto a canvas.
Avity comes with 4 built in `Style` classes:

- `\Hedronium\Avity\Styles\Square` (_default_)
- `\Hedronium\Avity\Styles\SquareCircle`
- `\Hedronium\Avity\Styles\Circle`
- `\Hedronium\Avity\Styles\Triangle`

changing the style class

```PHP
$avity = Avity::init([
    'layout' => \Hedronium\Avity\Styles\Triangle::class
]);
```

## spacing()
All built in `Style` classes have a `spacing(_int_ $value)` method that can be
used to set the space between blocks.
Like:

```PHP
$avity = Avity::init();
$avity->style()->spacing(30);
```

## variedColor()
This ones a fun method available to all default `Style` classes. Just call it and see the magic happen.
Like:

```PHP
$avity = Avity::init();
$avity->style()->variedColor();
$avity->generate()->jpg()->toBrowser();
```
