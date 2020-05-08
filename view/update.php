<?php
error_reporting(0);
include '../FullScreenLayout.php';
$CurrentURL = $_SERVER['REQUEST_URI'];
class update
{
	static $POSTFormSubmitted = false;
	private $connObj;
	public $uname, $result;
	function __construct() {
		include_once("../controller/Ctrl_Crud.php");
		$this->connObj = new ctrl_crud();
		
		include_once("../model/Crud.php");
		$this->modelObj = new crud();
	}
	public function getData() {
		global $POSTFormSubmitted;
		if ($POSTFormSubmitted == true) {
			$this->uname = $_POST['form_uname'];
			$this->id = $_GET['id'];
			
			$this->address = $_POST['form_address'];
			$this->vehicle = $_POST['vehicle'];
			$this->gender = $_POST['form-gender'];
			$this->country = $_POST['country'];

			$this->file = $_FILES['select_image'];
			$this->file2 = '';
		}
	}
	public function putData() {
		if ($GLOBALS['POSTFormSubmitted']) {
			$rval = $this->connObj->update($this->uname, $_GET['id'], $this->address, $this->vehicle, $this->gender, $this->country, $this->file, $this->file2);
			
			if($rval['rval'] == 1) {
				echo "<script type='text/javascript'>window.location.href = '../view/index.php';</script>";
				exit();
			}
			$error = <<<EOT
			<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2" style="margin-left: 1rem;">
				<h6 style="color: #fff; font-weight: 400; background: #2196F3; padding: 0.5rem;">
					<i class="fa fa-warning"></i>&nbsp;
					{$rval['Message']}
				</h6>
			</div>
EOT;
			echo $error;
		}
	}
	
	public function updateForm(){
	if(isset($_GET['id'])) {
		$this->result = $this->modelObj->readValue($_GET['id']);
	}

	while($row = $this->result->fetch_assoc()) {
		if($row["gender"]) {
			$selectedM = "checked";
			$selectedF = "";
		} else {
			$selectedM = "";
			$selectedF = "checked";
		}
		
		if(strpos($row['vehicle'], 'Car')) {
			$checkedC = "checked";
		}
		
		if (strpos($row['vehicle'], 'Bike')) {
			$checkedB = "checked";
		}
		$updateHTML = <<<EOT
		<form method="POST" id="add_brand_name" enctype="multipart/form-data">
			<div class="main-form">
				<h3 class="main-text">Create</h3>
				<hr>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<div class="md-form">
						<input type="text" id="form_uname" name="form_uname" value="{$row["user_name"]}" class="form-control" placeholder="Enter Username">
					</div>
					<div class="md-form">
						<textarea type="text" id="form_address" name="form_address" value="" class="form-control md-textarea" rows="3" placeholder="Enter Username">{$row["address"]}
						</textarea>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
							<div class="" style="margin-right: 1rem;">
								<input id="car" type="checkbox" name="vehicle[]" value="Car" {$checkedC}>
								<label for="car"><span><span></span></span>Car</label>
							</div>
							<div class="">
								<input id="bike" type="checkbox" name="vehicle[]" value="Bike" {$checkedB}>
								<label for="bike"><span><span></span></span>Bike</label>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
							<div class="" style="margin-right: 1rem;">
								<input class="form-radio-input" type="radio" name="form-gender" id="form-gender1" value="1" {$selectedM}>
								<label class="form-radio-label" for="form-gender1">Male</label>
							</div>
							<div class="">
								<input class="form-radio-input" type="radio" name="form-gender" id="form-gender2" value="0" {$selectedF}>
								<label class="form-radio-label" for="form-gender2">Female</label>
							</div>
						</div>
						
						<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 col-xl-4">
							<label class="form-radio-label" for="form-gender2">Select Country</label>
							<div class="select-wrapper">
							  <select id="country" name="country" value="" required>
								<option value="India">India</option>
								<option value="South Africa">South Africa</option>
								<option value="New Zealand">New Zealand</option>
							  </select>
							</div>
						</div>
						<script>
							$("select option[value='{$row['country']}']").attr("selected","selected");
						</script>
						<div class="form-group">
						  <label class="col-md-12 control-label" >Select Image (Maximum Image Size 2MB)</label> 
							<div class="col-md-12 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-book"></i></span>
									<input name="select_image"  value="" class="form-control"  type="file" accept="image/*" required>
								</div>
							</div>
						</div>
					</div>
					<button type="submit" class="btn btn-submit btn-sm"><i class="fa fa-save"></i>&nbsp;SAVE</button>
				</div>
			</div>
		</form>
EOT;
		return $updateHTML;
		}
	}
}
$ObjFullScreenLayout = new FullScreenLayout();
echo $ObjFullScreenLayout->header();

$updateObj = new update();
echo $updateObj->updateForm();

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$GLOBALS['POSTFormSubmitted'] = true;
} else {
	$GLOBALS['POSTFormSubmitted'] = false;
}

$updateObj->getData();
$updateObj->putData();

echo $ObjFullScreenLayout->footer();
?>