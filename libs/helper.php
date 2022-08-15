<?php defined('BASE_BATH') OR die("Premision Denied!");

function diepage($msg){
    echo "<div> $msg </div>";
    die();
}

function message($msg){
    echo "<div> $msg </div>";

}

function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        return true ;
    }
    return false;
}



function dd($var){
    echo "<pre style= 'background: #fdf3f3; color: #ff4242; margin: 10px; padding: 10px; border-radius: 5px; z-index: 999; position: relative; border-left: 5px solid #cf4a4a;'>";
    var_dump($var);
    echo "</pre>";
}

function site_url($uri = ''){
    return BASE_URL.$uri;
}

function redirect($url){
    header("location: $url");
    die();
}

