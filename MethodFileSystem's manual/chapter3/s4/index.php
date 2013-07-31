<?php 
/*
 * Use of Instances of MethodFileSystem
 */

include_once '../../../MethodFileSystem.php';
$WrapperFSOOP = new MethodFileSystem('./Wrapper', 'Wrapper');
$WrapperFSOOP->make();
$Wrapper = $WrapperFSOOP('.');

$String = $Wrapper->String();
print $String->toUpper('hello, world!'); print '<br />';

$Bool = $Wrapper->Bool();
if ($Bool->isTrue( pow(3,2) + pow(4,2) == pow(5,2) )) {
	print "3^2 + 4^2 is equal to 5^2";
} else {
	print "3^2 + 4^2 isn't equal to 5^2";
}

// The above example will output:
// HELLO,WORLD!
// 3^2 + 4^2 is equal to 5^2
?>
