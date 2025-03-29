<?php

function startsession(){
    if(!isset($_SESSION))
    {
        session_start();
    }

}



?>