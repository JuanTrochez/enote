<?php
class Security {

    function logged(){
            if (isset($_SESSION['user'])) {
                    return true;
            }
            else{
                    return false;
            }
    }
}
