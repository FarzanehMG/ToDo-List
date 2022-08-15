<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>To Do</title>
  <link rel="stylesheet" href="asset/css/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel"><a href="<?=site_url('?logout')?>"><i class="fa fa-sign-out"></i></a><span class="username"><?= getLoginUser()->name ?? 'UnKnown ' ?><img src ="<?=getLoginUser()->image?>" width="40" height="40"/></span></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">folders</div>
        <ul class ="folder_list">
        <li class="<?= isset($_GET['folder_id']) ? '' : 'active' ?>"><a href="<?= site_url()?>"><i class="fa fa-folder"></i>All</li></a>
          <?php foreach($folders as $folder):?>
            <li class="<?=(($_GET['folder_id']??null) ==$folder->id) ? 'active' : '' ?>">
              <a href="?folder_id=<?= $folder->id?>"><i class="fa fa-folder"></i><?php echo $folder->name ?></a>
              <a href="?delete_folder=<?= $folder->id?>" class ="delete" onclick="return confirm('Are you sure to delete this item?\n<?php echo $folder->name?>')">x</a>
            </li>
          <?php endforeach;?>
          
        </ul>
        <div>
          <input type="text" placeholder="add folder" id="AddFolderInput" class= "newFolderInput"/>
          <button class= "btn clickable" id="AddFolderBtn" >+</button>
        </div>
      </div>
    </div>
    <div class="view">
      <div class="viewHeader">
        <div class="title"><input type="text" placeholder="Task Name" id="AddTaskInput" class= "newTaskInput"/></div>
        <div class="functions">
          <div class="button active">Add New Task</div>
          <div class="button">Completed</div>
          <div class="button inverz"><i class="fa fa-trash-o"></i></div>
        </div>
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul>
            <?php if(sizeof($tasks)>0):?>
              <?php foreach($tasks as $task):?>
              <li class="<?php echo $task->is_done ? 'checked' : ''?>">
              <i data-taskId="<?= $task->id?>" class="isDone clickable fa <?php echo $task->is_done ? 'fa-check-square-o' : 'fa-square-o'?>"></i>
              <span><?php echo $task->title?></span>
                <div class="info">
                  <span class='created-at'>Created At <?php echo $task->created_at?></span>
                  <a href="?delete_task=<?= $task->id?>" class ="delete" onclick="return confirm('Are you sure to delete this item?\n<?php echo $task->title?>')">x</a>
                </div>                
              </li>
              <?php endforeach;?>
            <?php else:?>
              <li>No Tasks Here ...</li>
            <?php endif;?>
          </ul>
        </div>
        
      </div>
    </div>
  </div>
</div>
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="asset/js/script.js"></script>
  <script>
    $(document).ready(function(){
      $('#AddFolderBtn').click(function(e){
        var input = $('input#AddFolderInput');
        $.ajax({
          url:"process/ajaxHandler.php",
          method:"post",
          data:{action:"AddFolder",foldername:input.val()},
          success:function(response){
            if(response == '1'){
              $('<li> <a href="#"><i class="fa fa-folder"></i>'+input.val()+'</a> <a href="?delete_folder=6" class="delete">x</a> </li>').appendTo('ul.folder_list')
            }else{
              alert(response);
            }
          }
        })
      });


      $('#AddTaskInput').on('keypress',function(e){
        if(e.which == 13){
          var input = $('input#AddTaskInput');
          $.ajax({
          url:"process/ajaxHandler.php",
          method:"post",
          data:{action:"AddTask",FolderId:<?= $_GET['folder_id'] ?? 0?>,taskTitle:input.val()},
          success:function(response){
            if(response == '1'){
              location.reload();
            }else{
              alert(response);
            }
          }
        })
        }
      });
      $('#AddTaskInput').focus();

      $('.isDone').click(function(e){
        var tid = $(this).attr('data-taskId');
        $.ajax({
          url:"process/ajaxHandler.php",
          method:"post",
          data:{action:"doneSwitch", taskId : tid},
          success:function(response){
            location.reload();
          }
        })
      });
    });

  </script>
 
            
</body>
</html>
