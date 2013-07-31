<?php 
/*
 * Use of some methodfiles and many methodpacks
 */

include_once '../../../MethodFileSystem.php';
$mywork = new MethodFileSystem('./mywork', 'mywork');
$mywork->make();

// output 'I like Japan and Taiwan.<br />I like apples and oranges.<br />'
// Go to ./pack/I_like.php
$mywork('.')->I_like();

//The above example will output:
//I like Japan and Taiwan.
//I like apples and oranges.

?>