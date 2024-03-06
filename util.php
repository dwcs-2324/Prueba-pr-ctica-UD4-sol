<?php
const DURATION_COOKIE_FAMILIAS = 60*60*24*30;
const PAST_SECONDS = 60;


function gestionar_cookie_familia(string $cod_familia)
{
    
    if (!isset($_COOKIE["familias"])) {
        setcookie("familias[0]", $cod_familia, time() + DURATION_COOKIE_FAMILIAS);
    } else {
        $familias_array = $_COOKIE["familias"];
        $count_familias = count($familias_array);
        $index_or_found = array_search($cod_familia, $familias_array);
        if($index_or_found===false){
           //non existe a familia
           setcookie("familias[$count_familias]", $cod_familia, time()+ DURATION_COOKIE_FAMILIAS );
        }
      
    }
    
}

function mostrar_familias() {
    if(isset($_COOKIE["familias"])){
        $familias_array = $_COOKIE["familias"];
        echo "<p> Quizá también te interesen productos de estas categorías...</p>";
        echo "<ul>";
        foreach ($familias_array as $index => $cod_familia) {
          echo "<li>$cod_familia</li>";
        }
        echo "</ul>";
    }
}

function vaciar_carrito(){
    $_SESSION["cesta"] = [];
}

function cerrar_sesion(){
session_start();
  
// unset($_SESSION['nombre']);
// unset($_SESSION['cesta']);

$_SESSION = array();

//Eliminamos la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - PAST_SECONDS,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

    session_destroy();
    
//Eliminamos todas las cookies familias[0], familias[1], etc.

foreach ($_COOKIE as $name => $value) {
    if ($name !== session_name()) {
        for ($i = 0; $i < count($value); $i++) {
            $cookie_name = $name . "[$i]";
            setcookie($cookie_name, '', time() - PAST_SECONDS);
        }
    }
}


}
