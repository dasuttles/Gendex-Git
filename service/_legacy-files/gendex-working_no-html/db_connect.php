<?php
    mysql_connect("107.170.165.230", "dasuttles", "eris2323") or die("Error connecting to database: ".mysql_error());
    /*
        localhost - it's location of the mysql server, usually localhost
        root - your username
        third is your password
         
        if connection fails it will stop loading the page and display an error
    */
     
    mysql_select_db("gendex") or die(mysql_error()); 
     
?>