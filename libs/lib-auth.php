<?php defined('BASE_BATH') OR die("Premision Denied!");
/*** Auth Function ***/

function getCurrentUserId(){
    return getLoginUser()->id ?? null; 
}

function isLoggedIn(){
    return isset($_SESSION['login']) ? true : false ;
}

function getLoginUser(){
    return  $_SESSION['login'] ?? null ;
}

function getUserByEmail($email){
    global $pdo;
    $sql = "SELECT * from users where email = :email ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email'=>$email]);
    $records = $stmt->fetchAll(pdo :: FETCH_OBJ);
    return $records[0] ?? null;
}

function logOut(){
    unset($_SESSION['login']);
}
function login($email,$pass){
    $user = getUserByEmail($email);
    if(is_null($user)){       
        return false;
    }
    #check the password
    if (password_verify($pass, $user->pass)){
        $user->image = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($user->email)));
        $_SESSION['login'] = $user ;
        return true;
    }
    return false;  
}


function register($userData){
    global $pdo;
    $email = "john@example.com";
    if(filter_var($email, FILTER_VALIDATE_EMAIL) && preg_match("/^[a-zA-Z0-9]{5,}$/", $userData['name'])) {
        $password = password_hash($userData['password'],PASSWORD_BCRYPT);
        $sql = "INSERT INTO  users (name,email,pass) VALUES (:name,:email,:password)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':name'=> $userData['name'] ,':email'=> $userData['email'],':password' =>$password]);
        return $stmt->rowCount() ;
    }else {
        echo("email or name is not a valid!");
    }
    
}

