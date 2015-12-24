# Avity - Alpha
Highly Customisable image Generator library
## Features

✓ Generate Square images  
✓ Generate pyramid based images  
✓ Generate Round images  
✓ Generate Color images  
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
- ##### [Hight Customization](#height)
- ##### [Width Customization](#width)
- ##### [Columns Customization](#Columns)
- ##### [Rows Customization](#rows)
- ##### [Padding Customization](#padding)
- ##### [Layout customization (rows)](#layout-rows)
- ##### [Style spacing Customization](#spacing-spacing)
- ##### [Style width Customization](#style-width)
- ##### [Generate image types ](#generate-type)
