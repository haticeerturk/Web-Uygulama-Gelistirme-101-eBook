<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css">
    	body{
    		background-color: #FF7F50;
    		font-family: Ubuntu;
    	}
    </style>
</head>
<body>
	<div class="container-fluid">
		<div class="row" style="margin-top:50px;">
			<div class="col-md-2"></div>
			<div class="col-md-8" >
				<div class="panel panel-default" style="background-color:#A52A2A; border:none;">
					<div class="panel-heading" style="background-color:#DEB887; border:none;">
						<h3 class="panel-title">
							<?php 
								session_start();
								if(!isset($_SESSION['kid'])){ 
								    header("Location:giris.php"); 
								} 	
								
								$baglanti = mysql_connect("localhost","user","pass");
								mysql_select_db("proje",$baglanti);

								$alinacak = (int)$_GET['id'];
								$kid = $_SESSION['kid'];

								$sql = "select * from yazilar where yazilarid='$alinacak' and kid='$kid';";
								$sonuc = mysql_query($sql,$baglanti);
								$baslik = mysql_fetch_assoc($sonuc);
								echo $baslik['yazibasligi'];
									
								echo "</h3>";
								echo "</div>";
								echo "<div class='panel-body' style='padding:30px;'>";
								echo $baslik['icerik'];
						?>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>

