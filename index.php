<?php

include "bootstrap/init.php";

if(isset($_GET['logout'])){
    logOut();
}

if(!isLoggedIn()){
    redirect(site_url('auth.php'));
}


if(isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])){
    $deleteCount = deleteFolder($_GET['delete_folder']);
    //echo "$deleteCount folders succesfully deleted" ;
}

if(isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])){
    $deleteCount = deleteTask($_GET['delete_task']);
    //echo "$deleteCount tasks succesfully deleted" ;
}


$folders = getFolders();


$tasks = getTasks();







include "tpl/tpl-index.php";





//<?php foreach ($folders as $folder):
