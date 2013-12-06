<?php 
/*
* Use of construct()
*/

include_once '../../../ObjectFileSystem.php';
$Objects = new ObjectFileSystem('./Objects', 'Objects');
$Objects->var = 0;
$Objects->make();

$Objects->Test1();
print $Objects->var; print ' : index.php <br />';
print '<br />';

// The above example will output:
//1 : construct() in Test1.php
//2 : construct() in Test1/A.php
//3 : construct() in Test1/A/B.php
//4 : main() in Test1.php
//5 : main() Test1/A.php
//6 : main() in Test1/A/B.php
//6 : index.php

?>
