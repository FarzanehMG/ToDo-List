<?php 

include "../bootstrap/init.php";

if(!isAjaxRequest()){
    diepage("Invalid Request!");
}

if(!isset($_POST['action'])|| empty($_POST['action'])){
    diepage("Invalid Action!");
}



switch($_POST['action']){
    case "AddFolder":
        if(!isset($_POST['foldername']) || strlen($_POST['foldername']) < 3){
            echo "نام فولدر باید بزرگتر از 2 حرف باشد.";
            die();
        }
        echo AddFolder($_POST['foldername']);
    break;
    case "AddTask":
        $folderId = $_POST['FolderId'];
        $taskTitle = $_POST['taskTitle'];
        if(!isset($folderId) || empty($folderId)){
            echo "فولدر را انتخاب کنید.";
            die();
        }
        if(!isset($taskTitle) || strlen($taskTitle)<3){
            echo "عنوان تسک باید بزرگتر از 2 حرف باشد.";
            die();
        }
        echo AddTask($taskTitle,$folderId);
    break;
    case "doneSwitch":
        $task_id = $_POST['taskId'];
        if(!isset($task_id) || !is_numeric($task_id)){
            echo "آیدی تسک معتبر نیست.";
            die();
        }
        doneSwitch($task_id);
    break;
    
    default;
        diepage("Invalid Action!");
}










