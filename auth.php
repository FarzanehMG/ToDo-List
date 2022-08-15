<?php

include "bootstrap/init.php";


$home_url = site_url();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $action = $_GET['action'];
    $params = $_POST;
    if($action == 'register'){
        $result=register($params);
        if(!$result){
            message("Error: an error in Registration!");
        }else{
            message("Registration is successfull! Welcom to To Do.<br> <a href='{$home_url}auth.php'>Please Logged In</a>");           
        }
    }elseif($action == 'login'){
        $result=login($params['email'],$params['password']);
        if(!$result){
            message("Error: email or password is incorrect!");
        }else{
            //message("you are now logged in.<br><a href='$home_url'>Manage Your Task</a>");
            redirect(site_url());
        }
    }
}





include "tpl/tpl-auth.php";


