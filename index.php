<?php

require_once '/src/';

use Hedronium\Avity\Avity;

$avity = Avity::init()
->height(400)
->width(400)
->columns(6)
->rows(6)
->padding(40);

$avity->style()->spacing = 10;

$avity->generate()
->png()
->toBrowser();
