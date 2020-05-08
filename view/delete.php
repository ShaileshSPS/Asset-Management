<?php
class delete {
	function __construct() {
		include_once("../model/Crud.php");
		$this->modelObj = new crud();
	}
	public function delete(){
		$rval = $this->modelObj->delete($_GET['id']);
		if($rval == 0) {
			header("location:../view/index.php");
		}
	}
}
$deleteObj = new delete();
echo $deleteObj->delete();
?>