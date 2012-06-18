<?php
class Frend_Files {
	var $handle;
	var $content;
	var $dirname;
	var $filename;
	var $filePath;
	var $backupDir;
	var $backupName;
	
	function __construct($filename)
	{	
		$this->dirname = dirname(dirname($_SERVER['SCRIPT_FILENAME']));
		
		$this->backupDir = dirname(dirname(__FILE__)) . '/backups/' . str_ireplace('/', '_', $this->dirname);
		
		if ($filename == '') {
			$filename = 'index.html';
		}
		
		$this->filename = $filename;
		$this->filePath = $this->dirname . '/' . $this->filename;
	}
	
	public function save($userContent)
	{	
		if (FREND_DEMO_MODE) {
			return true;
		}
		
		if (!$this->openFile()) {
			return false;
		}

        $this->backup();

        $this->content = "<!DOCTYPE html>\n<html>\n" . $userContent . "\n</html>";

		if ($this->write()) {
            return true;
		}
		
		return false;
	}
	
	protected function write()
	{  
	   ftruncate($this->handle, 0);
	   return fwrite($this->handle, $this->content);
	}
	
	protected function backup()
	{	   
	   $filenameParts = explode('.', $this->filename);
	   $extension =  '.' . array_pop($filenameParts);
	   $this->backupName = implode('.', $filenameParts) . '.' . date("d-m-Y.H-i-s") . $extension;
	   
   	   $old = fread($this->handle, filesize($this->filePath));

   	   if (!is_dir($this->backupDir)) {
   	       mkdir($this->backupDir);
	   }  
   	   
	   $backup = fopen($this->backupDir . '/' . $this->backupName, 'w');
	   return fwrite($backup, $old);
	}

	protected function openFile()
	{
		if (file_exists($this->filePath)) {
			return $this->handle = fopen($this->filePath, 'r+');
		}
		
		return false;
	}
}