<?php
function count_cart_elements()
{
    $contador = 0;
    foreach ($_SESSION["cesta"] as $k => $value) {
        $contador += $value;
    }
    return $contador;
}
