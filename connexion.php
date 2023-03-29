<?php
function connexion()
{
    $server = 'localhost';
    $name = '<password>';
    $password = '';

    $connexion = new mysqli($server, $name, $password);
    return $connexion;
}
