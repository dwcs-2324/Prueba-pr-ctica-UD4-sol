<?php
function count_cart_elements()
{
    $contador = 0;
    foreach ($_SESSION["cesta"] as $k => $value) {
        $contador += $value;
    }
    return $contador;
}

function gestionar_cookie_familia(string $cod_familia)
{
    if (!isset($_COOKIE["familias"])) {
        setcookie("familias[0]", $cod_familia, 60*60*24*30);
    } else {
        $familias = $_COOKIE["familias"];
        $count_familias = count($familias);
        if(array_search($cod_familia, $familias)!==false){
            $_COOKIE[]
        }
    }
}
