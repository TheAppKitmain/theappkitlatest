
<?php $taskid = $dataList['taskid'];
$timeline =  \App\ToDoList::find($taskid);
 ?>
 <p>{!!$timeline->message!!}</p>
<p>Status : Done</p>