<?php 

class secondTask
{
	
	public function returnView(){
		$page=file_get_contents('views/secondTask.html');
		echo $page;
	}
}
$secondTask=new secondTask;
$secondTask->returnView();
?>