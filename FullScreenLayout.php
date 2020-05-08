<?php 
class FullScreenLayout {
	private $headerHTML, $footerHTML;
	function header() {
		$this->headerHTML = <<<EOT
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
			<meta http-equiv="x-ua-compatible" content="ie=edge">
			<link rel="icon" href="../assets/img/target.png" type="image/gif" sizes="16x16">
			<title>CRUD</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
			<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
			<link href="../assets/css/mdb.min.css" rel="stylesheet">
			<link href="../assets/css/style.css" rel="stylesheet">
			
			<script type="text/javascript" src="../assets/js/jquery-3.2.1.min.js"></script>
			<script type="text/javascript" src="../assets/js/popper.min.js"></script>
			<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
			
			<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();   
			});
			</script>
			<style>

			</style>
		</head>
		<body>
			<nav class="navbar">
				<a class="navbar-brand" href="../view/index.php">Asset Management</a>
				<a href="../view/create.php">
					<button type="button" class="btn btn-primary btn-sm" >
					<i class="fa fa-plus"></i>&nbsp;ADD
				</button>
				</a>
			</nav>
			<div class="container-fluid">
EOT;
		return $this->headerHTML;
	}
	
	function footer() {
		$year = date('Y');
		$this->footerHTML = <<<EOT
			</div>
			<footer class="page-footer">
				<div class="footer-copyright py-3 text-center">
					© $year Copyright Reserved
					<a href="../view/index.php"></a>
				</div>
			</footer>
		</body>
		</html>
EOT;
		return $this->footerHTML;
	}
}
?>