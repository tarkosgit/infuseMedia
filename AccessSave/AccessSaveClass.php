<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/DB/DBClass.php');

class AccessSaveClass{
	private $db = false;
	function __construct(){
		$this->db = new DBClass;
	}
	function __destruct(){
		$this->db->disconnect();
	}
	public function execute($aIP, $aUserAgent, $aURL){
		$result = 0;
		$sql = 'SELECT SF_ACCESS_SAVE(?, ?, ?)';
		$stmt = $this->db->link()->prepare($sql);
		$stmt->bind_param('sss', $aIP, $aUserAgent, $aURL);
		$stmt->execute();
		$count = 0;
		$stmt->bind_result($count);
		if ($stmt->fetch()) {
			$result = $count;
		}
		$stmt->close();
		return $result;
	}
}
?>