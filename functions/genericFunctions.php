<?php

function startsession(){
    if(!isset($_SESSION))
    {
        session_start();
    }

}

function isMethodPost(){
    return $_SERVER['REQUEST_METHOD'] === 'POST';
}

// function redirectTO ()
?>