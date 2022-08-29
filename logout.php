<?php
session_start();
session_destroy();            
header('location:login.php');      //redirect to login page

?> 