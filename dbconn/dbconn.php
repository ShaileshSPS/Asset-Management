<?php
class dbconn {
	private $dbHost;
    private $dbUser;
    private $dbPass;
    private $dbName;
    function __construct() {
        $this->dbHost = "localhost";
        $this->dbUser = "root";
        $this->dbPass = "";
        $this->dbName = "assets";
		$this->connection = "";
	}
	public function createConn() {
        $this->connection = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
	}
}
?>