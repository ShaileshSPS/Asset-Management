<?php
class ctrl_crud{
	private $model;
	function __construct(){
		include_once("../model/Crud.php");
		$this->model = new crud();
	}
	public function post($uname, $address, $vehicle, $gender, $country, $place, $file, $file2){
		return $this->_post($uname, $address, $vehicle, $gender, $country, $place, $file, $file2);
	}
	private function _post($uname, $address, $vehicle, $gender, $country, $place, $file, $file2){
		$rval = $this->model->put($uname, $address, $vehicle, $gender, $country, $file, $file2);
		if($rval == 1) {
			return [
				'rval' => $rval,
				'Message' => 'Successfully Inserted'
			];
		} else if($rval == -9) {
			return [
				'rval' => $rval,
				'Message' => 'Empty Values Sent!!'
			];
		} else if ($rval == -20) {
			return [
				'rval' => $rval,
				'Message' => 'DB Connection Error'
			];
		}
	}
	
	public function update($uname, $id, $address, $vehicle, $gender, $country, $file, $file2){
		return $this->_update($uname, $id, $address, $vehicle, $gender, $country, $file, $file2);
	}
	private function _update($uname, $id, $address, $vehicle, $gender, $country, $file, $file2){
		$rval = $this->model->update($uname, $id, $address, $vehicle, $gender, $country, $file, $file2);
		if($rval == 1) {
			return [
				'rval' => $rval,
				'Message' => 'Successfully Inserted'
			];
		} else if($rval == -9) {
			return [
				'rval' => $rval,
				'Message' => 'Empty Values Sent!!'
			];
		} else if ($rval == -20) {
			return [
				'rval' => $rval,
				'Message' => 'DB Connection Error'
			];
		}
	}
}
?>