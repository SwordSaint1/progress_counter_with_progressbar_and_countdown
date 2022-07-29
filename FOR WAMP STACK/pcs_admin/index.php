<?php
define('title','Progress Counter Controller');
require 'php/server.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo title; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="text/css" href="Img/icon.png" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="node_modules/materialize-css/dist/css/materialize.min.css">
	<style type="text/css">
		body{
			background-image: url('Img/background.jpg');
			background-attachment: fixed;
			background-size:cover;
			background-repeat: no-repeat;
		}
		form{
			background-color: white;
			margin-top:10%;
			padding: 10px;
			border-radius: 10px;
			opacity: 0.8;
			text-align:center;
		}
		#loginBtn{
		background: #0F2027;  /* fallback for old browsers */
		background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);  /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to right, #2C5364, #203A43, #0F2027); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
		}
		.btn{
			border-radius:20px;
		}
	</style>
</head>
<body>
	<div class="row">
	<div class="container center">
		<form method="POST" style="display: none;">
		<h5 class="header">Progress Counter</h5>
		<div class="row">
			<div class="col s12">
				<div class="input-field">
					<input type="password" name="password"><label>Password</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input type="submit"  class="btn green" id="loginBtn" name="loginBtn" value="Login">
			</div>
		</div>
	</form>
	</div>
	</div>
		


	<!-- JS -->
	<script type="text/javascript" src="node_modules/materialize-css/dist/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="node_modules/materialize-css/dist/js/materialize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('form').fadeIn(500);
			$('#loginBtn').addClass('z-depth-5');
		});
	</script>
</body>
</html>