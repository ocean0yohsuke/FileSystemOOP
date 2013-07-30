<?php
/*
 * Use of base class
 */

include_once '../../../ObjectFileSystem.php';
$Objects = new ObjectFileSystem('./Objects', 'Objects');
$Objects->make();

$Objects->Test();

//The above example will output:
//Hello world

?>