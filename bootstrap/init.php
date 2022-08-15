<?php
session_start();
include "constants.php";
include BASE_BATH."bootstrap/config.php";
include BASE_BATH."vendor/autoload.php";
include BASE_BATH."libs/helper.php";



try {
    $pdo = new PDO("mysql:host=$database_config->host;dbname=$database_config->db" , $database_config->user , $database_config->pass);
    
} catch (PDOException $e) {
    diepage('connection faild:'. $e->getMessage());
    
}



include BASE_BATH."libs/lib-auth.php";
include BASE_BATH."libs/lib-tasks.php";
