<?php
  
 $conn=mysqli_connect("localhost","root","",database:"coffee");
    if(!$conn){
        print("Database Not Connected");
    }
    else{
        print("successfully Connected");
    }
?>
