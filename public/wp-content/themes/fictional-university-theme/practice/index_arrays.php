<?php
// array is a collection of multiple values
$names = array('Ben','Holly','Nanny Plum','Kind Thistle','Queen Thistle');
$count = 0;
//Looping
while($count < count($names)){
    echo "<p>Hi, My name is $names[$count]</p>";
    $count++;
}
?>