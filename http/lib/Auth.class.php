<?php

abstract class Auth{
    
    abstract function login();  
    
    abstract function logout();
    
    abstract function isLoggedIn();
    
}

?>
