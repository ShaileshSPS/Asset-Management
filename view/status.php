<?php
class status {
	public $id;
	function __construct() {
		include_once("../model/Crud.php");
		$this->modelObj = new crud();
	}
	public function status(){
		$rval = $this->modelObj->status($_GET['id']);
		if($rval == 5) {
			header("location:../view/index.php");
		}
	}
}
$statusObj = new status();
echo $statusObj->status();
?>