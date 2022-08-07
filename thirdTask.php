<?php 

class thirdTask
{

	public function parse($string,$separator){
		$string=explode($separator, $string);
		foreach ($string as $part) {
			preg_match_all('/[0-9]+/', $part, $numbers);
			echo($part.'='.count($numbers[0])."<br>");
		}
	}

	public function saveFile($filename){
		move_uploaded_file($filename['tmp_name'], 'files/'.$filename['name']);

		if(file_exists('files/'.$filename['name'])){
			echo('<img width="20px"src="serverFiles/green.png"><br>');
			$file=file_get_contents('files/'.$filename['name']);
			$this->parse($file,$_POST['separator']);
			return $file;
		}
		
		echo('<img width="20px"src="serverFiles/red.jpg"><br>');
		return false;

	}

	public function returnView(){
		$page=file_get_contents('views/thirdTask.html');
		echo $page;
	}
}

$thirdTask=new thirdTask;
$thirdTask->returnView();
if(isset($_FILES['file']) && isset($_POST['separator'])){
	$text=$thirdTask->saveFile($_FILES['file']);
}
?>