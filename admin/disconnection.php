<?php

session_start(); // initialize la session
session_unset(); // desactive la session
session_destroy(); 
setcookie('auth', time()-1,'/', null, false, true);

header('location: index.php');

?>