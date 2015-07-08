<?php

require_once 'Word.php';
require_once 'Letter.php';

$word = new Word(' Кількість  ');

var_dump($word->getLetters());
var_dump($word->isNoun());
