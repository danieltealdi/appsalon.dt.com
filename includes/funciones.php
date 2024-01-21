<?php

function debuguear($variable): string
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html): string
{
    $s = htmlspecialchars($html);
    return $s;
}
function isAuth()
{
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}
function esUltimo(string $actual, string $proximo): bool {

    if($actual !== $proximo) {
        return true;
    }
    return false;
}
function isAdmin():void
{
    //debuguear($_SESSION);
    if($_SESSION['admin']!=='1') {
        header('Location: /');
    }
}
 