<?php
error_reporting(0);
include '../FullScreenLayout.php';
$CurrentURL = $_SERVER['REQUEST_URI'];
class view	{
	public $id;
	function __construct() {
		include_once("../model/Crud.php");
		$this->modelObj = new crud();
		$this->result = $this->modelObj->view($_GET['id']);
	}
	public function viewForm()	{
	$viewHTML = <<<EOT
	<div class="main-form">
		<table class="table table-bordered">
			<tr>
				<th>User ID</th>
				<th>User Name</th>
				<th>Address</th>
				<th>Country</th>
				<th>Vehicle</th>
				<th>Gender</th>
			</tr>
EOT;
	while($row = $this->result->fetch_assoc()) {
	$vehi = unserialize($row["vehicle"]);
	$viewHTML .= <<<EOT
			<tr>
				<td>{$row["user_id"]}</td>
				<td>{$row["user_name"]}</td>
				<td>{$row["address"]}</td>
				<td>{$row["country"]}</td>
				<td>
EOT;
	foreach($vehi as $val) {
	$viewHTML .= <<<EOT
					{$val}
EOT;
	}
	if($row["gender"] == 1) {
	$viewHTML .= <<<EOT
				<td>Male</td>
EOT;
	} else {
	$viewHTML .= <<<EOT
				<td>Female</td>
EOT;
	}
	$viewHTML .= <<<EOT
			</tr>
EOT;
	}
	$viewHTML .= <<<EOT
		</table>
	</div>
EOT;
	return $viewHTML;
	}
}
$ObjFullScreenLayout = new FullScreenLayout();
echo $ObjFullScreenLayout->header();

$viewObj = new view();
echo $viewObj->viewForm();

echo $ObjFullScreenLayout->footer();
?>