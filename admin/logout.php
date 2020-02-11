<?php
session_start();
session_destroy();
session_unset();
header('location:http://localhost/projet%20burger/admin/login.php');


?>