<?php
class Security {
    
    function __construct() {
        
    }
    function __destruct() {
        
    }

        function logged(){
            if (isset($_SESSION['user'])) {
                    return true;
            }
            else{
                    return false;
            }
    }
}
