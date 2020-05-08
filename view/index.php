<?php
error_reporting(0);
include '../FullScreenLayout.php';
$CurrentURL = $_SERVER['REQUEST_URI'];
class index 
{
	function __construct() {
		include_once("../model/Crud.php");
		$this->model = new crud();
		$this->result = $this->model->read();
	}
	public function indexForm() {
	$indexHTML = <<<EOT
	<p class="page_msg"></p>
	<form method="POST" id="add_brand_name">
		<div class="main-form">
			<table class="table table-bordered">
				<tr>
					<th>ID</th>
					<th>Uname</th>
					
					<th>Address</th>
					<th>Vehicle</th>
					<th>Gender</th>
					<th>Country</th>
					
					<th>Actions</th>
				</tr>
EOT;
	while($row = $this->result->fetch_assoc()) {
	$vehi = unserialize($row["vehicle"]);
	$indexHTML .= <<<EOT
				<tr>
					<td>{$row["user_id"]}</td>
					<td>{$row["user_name"]}</td>
					
					<td>{$row["address"]}</td>
					<td>
EOT;
	foreach($vehi as $val) {
	$indexHTML .= <<<EOT
						{$val}
EOT;
	}
	$indexHTML .= <<<EOT
					</td>
EOT;
		if($row["gender"] == 1) {
	$indexHTML .= <<<EOT
					<td>Male</td>
EOT;
		} else {
	$indexHTML .= <<<EOT
			<td>Female</td>
EOT;
		}
	$indexHTML .= <<<EOT
					<td>{$row["country"]}</td>
					<td>
						<a href="../view/update.php?id={$row["user_id"]}" data-toggle="tooltip" data-placement="top" title="Edit">
							<i class="fa fa-edit"></i>
						</a>&nbsp;
						<a href="../view/delete.php?id={$row["user_id"]}" data-toggle="tooltip" data-placement="top" title="Delete">
							<i class="fa fa-trash-o"></i>
						</a>&nbsp;
						<a href="../view/status.php?id={$row["user_id"]}" data-toggle="tooltip" data-placement="top" title="Active/Deactive">
EOT;
	if($row['status'] == 0) {
	$indexHTML .= <<<EOT
							<i class="fa fa-check-circle" style="color:green"></i>
EOT;
	} else {
	$indexHTML .= <<<EOT
							<i class="fa fa-check-circle" style="color:#ccc"></i>
EOT;
	}
	$indexHTML .= <<<EOT
						</a>&nbsp;
						<a href="../view/view.php?id={$row["user_id"]}" data-toggle="tooltip" data-placement="top" title="View">
							<i class="fa fa-eye"></i>
						</a>&nbsp;
						<a data-placement="top" title="View" data-toggle="modal" data-target="#myModal{$row["user_id"]}">
							<i class="fa fa-file"></i>
						</a>&nbsp;
					</td>
				</tr>
				<div class="modal fade" id="myModal{$row["user_id"]}" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title">{$row["user_name"]} Profile</h4>
								<button type="button" class="close" data-dismiss="modal">&times;</button>
							</div>
							<div class="modal-body">
								<img src="../{$row["path"]}" width="100%">
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-submit" data-dismiss="modal">Close</button>
							</div>&nbsp;
						</div>
					</div>
				</div>
EOT;
	}
	$indexHTML .= <<<EOT
			</table>
		</div>
	</form>
EOT;
	return $indexHTML;
	}
}
$ObjFullScreenLayout = new FullScreenLayout();
echo $ObjFullScreenLayout->header();

$indexObj = new index();
echo $indexObj->indexForm();

echo $ObjFullScreenLayout->footer();
?>