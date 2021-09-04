<?php echo 'Hello Hello i\'m under the water... gulu gulu gulu gulu'; 



$strStreet = "123 1/2 S. Main St. Apt. 1";
#$strRegEx = "/^[a-z0-9 ,#-'\/]{3,50}$/i";
 $strRegEx = '/^[a-z0-9 ,#-\'\/.]{3,50}$/i';
 if (preg_match($strRegEx, $strStreet) ) {
  print "good address";
 }
 else{
     echo "bad";
 }







?>

