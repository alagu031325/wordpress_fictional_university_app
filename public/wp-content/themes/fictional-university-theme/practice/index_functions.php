<?php
 // Function definition doesnt do anything - it describes an action or a task
 function greet($name,$color){
    echo "<p> Hi, My name is $name and my favorite color is $color. </p>";
 }
// We can call functions any number of times
 greet("John","blue");
 greet("Jane","green");

?>
<!-- In built wordpress functions -->
<h1><?php bloginfo('name');?></h1>
<p><?php bloginfo('description'); ?></p>