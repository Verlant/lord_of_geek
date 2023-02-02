<?php

function my_autoloader($class)
{
    if (substr($class, 0, 2) == 'M_') {
        include_once 'App/modele/' . $class . '.php';
    } else {
        include_once 'App/controleur/' . $class . '.php';
    }
}

function autoLoad()
{
    spl_autoload_register('my_autoloader');
}
