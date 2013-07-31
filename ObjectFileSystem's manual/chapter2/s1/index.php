<?php
/*
 * Use of many methods
 */

include_once '../../../ObjectFileSystem.php';

$OFS = new ObjectFileSystem('./dir', 'mywork');
$OFS->make();

// output 'Hello '
$OFS->Object1();

// output 'world.'
$OFS->Object2();

//The above example will output:
//Hello world!

?>