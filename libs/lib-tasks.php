<?php defined('BASE_BATH') OR die("Premision Denied!");

/*** Folder Function ***/

function deleteFolder($folder_id)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "delete from folders where id= $folder_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function AddFolder($folder_name)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO  folders (name,user_id) VALUES (:Folder_name,:user_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':Folder_name' =>$folder_name ,':user_id'=> $currentUserId ]);
    return $stmt->rowCount();
}

function getFolders(){
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "SELECT * from folders where user_id = $currentUserId ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(pdo :: FETCH_OBJ);
    return $records ;
}

function deleteTask($task_id)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "delete from tasks where id= $task_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->rowCount();
}

function getTasks(){
    global $pdo;
    $folder=$_GET['folder_id'] ?? null;
    $folderCondition='';
    if(isset($folder) && is_numeric($folder)){
        $folderCondition="and folder_id=$folder";
    }
    $currentUserId = getCurrentUserId();
    $sql = "SELECT * from  tasks where user_id = $currentUserId $folderCondition";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(pdo :: FETCH_OBJ);
    return $records ;
}

function AddTask($title,$FolderId)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "INSERT INTO  tasks (title,user_id,folder_id) VALUES (:title,:user_id,:folder_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':title' =>$title ,':user_id'=> $currentUserId,':folder_id'=>$FolderId ]);
    return $stmt->rowCount();
}

function doneSwitch($task_id)
{
    global $pdo;
    $currentUserId = getCurrentUserId();
    $sql = "update  tasks set is_done= 1 - is_done where  user_id= :userId  and id=:taskId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':userId'=> $currentUserId,':taskId'=>$task_id ]);
    return $stmt->rowCount();
}
