<?php

require './vendor/autoload.php';

use Alister\MotionPictureSolutions\CategoryTree;

$c = new CategoryTree;

$c->addCategory('A', NULL);
$c->addCategory('B', 'A');
$c->addCategory('C', 'A');
$c->addCategory('D', 'C');
$c->addCategory('E', 'C');
$c->addCategory('F', 'C');
$c->addCategory('G', 'C');
$c->addCategory('H', 'G');
$c->addCategory('X', NULL);
$c->addCategory('Y', 'X');
$c->addCategory('Z1', 'Y');
$c->addCategory('Z2', 'Y');

//$c->addCategory('Z2', 'A'); // InvalidArgumentException
//$c->addCategory('W', 'V'); // InvalidArgumentException

echo implode(',', $c->getChildren('A')) . PHP_EOL; //B,C
echo implode(',', $c->getChildren('C')) . PHP_EOL; //D,E,F,G
echo implode(',', $c->getChildren('Y')) . PHP_EOL; //Z1,Z2
echo implode(',', $c->getPath('H')) . PHP_EOL; //H,G,C,A
