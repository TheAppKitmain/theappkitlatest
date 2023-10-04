
<?php $taskid = $dataList['taskid'];
$timeline =  \App\InternalUpdates::find($taskid);
 ?>
 <p>{!!$timeline->notes!!}</p>
<p>Status : Done</p>