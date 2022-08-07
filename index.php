<?php 
$firstDirectory='testDirectory1';
$secondDirectory='testDirectory2';
date_default_timezone_set('Europe/Moscow'); //скрипт выполняется по МСК
ignore_user_abort(true);
set_time_limit(0);


class firstTask
{
	public $firstDirectory;
	public $secondDirectory;
	private $current_directory;
	private $path_to;

	public function __construct($first,$second){
		$this->firstDirectory=$first;
		$this->secondDirectory=$second;
		$this->current_directory=count(scandir($first))>2?$first:$second;
	}

	public function checkTime(){
		if(count(scandir($this->firstDirectory))<=2 && count(scandir($this->secondDirectory))<=2){
			echo 'Обе директории пустые';
			return;
		}

		if(date('h:i')=='04:20'){
			$path_to=$this->firstDirectory==$this->current_directory?$this->secondDirectory:$this->firstDirectory;
			foreach (scandir($this->current_directory) as $file) {
				$this->changeFilesPosition($file,$path_to);
			}
			$this->current_directory=$path_to;
			sleep(60);
		}

		sleep(5);
		$this->checkTime();
	}

	private function changeFilesPosition($file,$path_to){
		if($file!='.' && $file!='..'){
			$path=$this->current_directory.'/'.$file;
			rename($path, $path_to.'/'.$file);
		}

	}
}

$firstTask= new firstTask($firstDirectory,$secondDirectory);
$firstTask->checkTime();
?>