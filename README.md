# Avity - Alpha
Highly Customisable image Generator library
## Features

✓ Generate Square images  
✓ Generate pyramid based images  
✓ Generate Round images  
✓ Generate Color images  
✓ Diagonal Mirror images  
✓ Triangle style images  
✓ Generate Custom colored images  
✓ Extendable libray  
✓ Randomly generate image  
✓ Generate image based on hashed value  

## Installation  
Get is through composer  
```
composer require hedronium/avity dev-master
```
### Install Using composer.json
```PHP
{
  "require": {
    "hedronium/avity": "dev-master"
  }
}
```

## Requirements

* PHP 5.4+
* GD2 library
* Imagine library

## Getting started  
```PHP
require_once 'vendor/autoload.php';
use Hedronium\Avity\Avity;

// initialize avity class
$avity = Avity::init();

/*
Generate image in jpeg format and show in browser
*/
$avity->generate()
->jpg()
->toBrowser();
```
## Available Customization
- [Hight Customization](#Image-Height)
- [Width Customization](#Image-Width)
- [Columns Customization](#Image-Columns)
- [Rows Customization](#Image-Rows)
- [Padding Customization](#Image-Padding)
- [Layout customization (rows)](#Layout-Rows)
- [Style spacing Customization](#Style-Spacing)
- [Style width Customization](#Style-Width)
- [Generate image types ](#Generate-Type)

### Image-Height
You Can  change height of image
```PHP
$avity = Avity::init()
->height(400);

$avity->generate()
->jpg()
->toBrowser();
```
### Image-Width
```PHP
$avity = Avity::init()
->width(400);

$avity->generate()
->jpg()
->toBrowser();

```
### Image-Columns
```PHP
$avity = Avity::init()
->columns(400);

$avity->generate()
->jpg()
->toBrowser();
```
### Image-Rows
```PHP
$avity = Avity::init()
->rows(400);

$avity->generate()
->jpg()
->toBrowser();
```
### Image-Padding
```PHP
$avity = Avity::init()
->padding(400);

$avity->generate()
->jpg()
->toBrowser();
```
### Layout-Rows
```PHP
$avity = Avity::init();
$avity->layout()
->rows(8);

$avity->generate()
->jpg()
->toBrowser();
```
### Style-Spacing
```PHP
$avity = Avity::init();
$avity->style()
->spacing(3);

$avity->generate()
->jpg()
->toBrowser();

```
### Style-Width
```PHP
$avity = Avity::init();
$avity->style()->width(300);

$avity->generate()
->jpg()
->toBrowser();
```
### Generate-Type
```PHP
$avity = Avity::init();

// Generate jpg type image
$avity->generate()
->jpg()
->toBrowser();

// Generate png type image
$avity->generate()
->png()
->toBrowser();

//Generate gif type image
$avity->generate()
->png()
->toBrowser();
```
## Generatable images

- [Triangle Style](#Triangle-Style)
- [Squre style](#Square-Style)
- [Circle style](#Circle-Style)

### Triangle-Style
```PHP
use Hedronium\Avity\Avity;
$avity = Avity::init(0, 0, Avity::TRIANGLE_STYLE);
$avity->style();
$avity->generate()->jpg()->toBrowser();
```
### Square-Style  

```PHP
use Hedronium\Avity\Avity;
$avity = Avity::init(0, 0, Avity::SQUARE_STYLE);
$avity->style();
$avity->generate()->jpg()->toBrowser();
```
### Circle-Style
```PHP
use Hedronium\Avity\Avity;
$avity = Avity::init(0, 0, Avity::CIRCLE_STYLE);
$avity->style();
$avity->generate()->jpg()->toBrowser();
```
