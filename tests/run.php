<?php

// all we need to do is include the bootstrap
require dirname(__FILE__) . '/../app/boot/bootstrap.php';
Europa_Loader::addPath(dirname(__FILE__));

$tests = new Test;
$tests->run();

if ($assertions = $tests->assertions()) {
    echo "Tests failed:\n";
    foreach ($assertions as $assertion) {
        echo '  '
           , $assertion->getTestFile()
           , '('
           , $assertion->getTestLine()
           , '): '
           , $assertion->getMessage()
           , '. In: '
           , $assertion->getTestClass()
           , '->'
           , $assertion->getTestMethod()
           , "\n";
    }
} else {
    echo "Tests passed!\n";
}