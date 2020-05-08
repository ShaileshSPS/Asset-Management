<?php
class crud
{
	private $dbconnection;
	function __construct(){
		include_once("../dbconn/dbconn.php");
		$this->dbconnection = new dbconn();		
	}
	public function put($uname, $address, $vehicle, $gender, $country, $file, $file2e){
		return $this->_put($uname, $address, $vehicle, $gender, $country, $file, $file2);
	}
	private function _put($uname, $address, $vehicle, $gender, $country, $file, $file2){
		if (empty($uname) || empty($uname) || empty($file)) {
		  return -9;
		}
		
		$array_vehicle = serialize($vehicle);
		
		$this->dbconnection->createConn();
		$connection = $this->dbconnection->connection;
		move_uploaded_file($file["tmp_name"],"../uploads/" . $file["name"]);
	    $file2="uploads/".$file["name"];
		$query = <<<EOT
		INSERT INTO user_info (user_name, address, vehicle, gender, country, path) VALUES ('$uname', '$address', '$array_vehicle', '$gender', '$country', '$file2')
EOT;
		if ($connection->query($query) === TRUE) {
			return 1;
		} else {
			return -20;
		}
	}
	public function read(){
		return $this->_read();
	}
	private function _read(){
		$this->dbconnection->createConn();
		$connection = $this->dbconnection->connection;
		$query = <<<EOT
		SELECT * FROM user_info
EOT;
		$result = $connection->query($query);
		return $result;
	}
	
	public function readValue($id){
		return $this->_readValue($id);
	}
	private function _readValue($id){
		$this->dbconnection->createConn();
		$connection = $this->dbconnection->connection;
		$query = <<<EOT
		SELECT user_name, address, vehicle, gender, country, path FROM user_info where user_id = $id
EOT;
		$result = $connection->query($query);
		return $result;
	}
	
	public function update($uname, $id, $address, $vehicle, $gender, $country, $file, $file2){
		return $this->_update($uname, $id, $address, $vehicle, $gender, $country, $file, $file2);
	}
	private function _update($uname, $id, $address, $vehicle, $gender, $country, $file, $file2){
		if (empty($uname)) {
		  return -9;
		}
		$array_vehicle = serialize($vehicle);
		
		$this->dbconnection->createConn();
		$connection = $this->dbconnection->connection;
		move_uploaded_file($file["tmp_name"],"../uploads/" . $file["name"]);
	    $file2="uploads/".$file["name"];
		$query = <<<EOT
		UPDATE user_info SET user_name = '$uname', address = '$address', vehicle = '$array_vehicle', gender = '$gender', country = '$country', path = '$file2' WHERE user_id = '$id'
EOT;
		if ($connection->query($query) === TRUE) {
			return 1;
		} else {
			return -20;
		}
	}
	public function delete($id){
		return $this->_delete($id);
	}
	private function _delete($id){
		$this->dbconnection->createConn();
		$connection = $this->dbconnection->connection;
		$query = <<<EOT
		DELETE FROM user_info WHERE user_id = $id
EOT;
		if ($connection->query($query) === TRUE) {
			return 0;
		} else {
			return -20;
		}
	}
	public function status($id){
		return $this->_status($id);
	}
	private function _status($id){
		$this->dbconnection->createConn();
		$connection = $this->dbconnection->connection;
		$query = <<<EOT
		UPDATE user_info SET status = NOT status WHERE user_id = $id
EOT;
		$result = $connection->query($query);
		if ($connection->query($result) === FALSE) {
			return 5;
		}
	}
	
	public function view($id){
		return $this->_view($id);
	}
	private function _view($id){
		$this->dbconnection->createConn();
		$connection = $this->dbconnection->connection;
		$query = <<<EOT
		SELECT * FROM user_info where user_id = $id
EOT;
		$result = $connection->query($query);
		return $result;
	}
}
?>