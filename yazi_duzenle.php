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
							Yazı Başlık ve İçerik Kayıt Yeri
						</h3>
					</div>
					<div class="panel-body" style="padding:30px;">
						<form role="form" action="yazi_duzenle.php" method="POST">
							<input type="submit" class="btn btn-default" name="yazi" value="Yazıyı Güncelle" style="background-color:#DEB887; margin-bottom:20px; margin-left:654px;">
							<div class="input-group" style="margin-bottom:20px;">
  								<span class="input-group-addon" id="basic-addon1" style="background-color:#DEB887;">
  								<span  class="glyphicon glyphicon-hand-right"></span>
  								</span>
  								<?php
  									session_start();
  									$baglanti = mysql_connect("localhost","user","pass");
									mysql_select_db("proje",$baglanti);

									$alinacak = (int)$_GET['id'];
									$kid = $_SESSION['kid'];

									$sql = "select * from yazilar where yazilarid='$alinacak' and kid='$kid';";
									$sonuc = mysql_query($sql,$baglanti);
									$baslik = mysql_fetch_assoc($sonuc);

  									echo '<input type="text" name="k_baslik" class="form-control" value="'.$baslik["yazibasligi"].'" aria-describedby="basic-addon1" style="background-color:#F5DEB3">';
  								
  									echo "</div>";
  									echo '<div class="input-group" style="margin-bottom:20px;">';
  									echo '<span class="input-group-addon" id="basic-addon1" style="background-color:#DEB887;">
  								<span class="glyphicon glyphicon-pencil"></span>';
  									echo "</span>";
  									echo '<textarea wrap="soft" name="icerik" rows="15" class="form-control" aria-describedby="basic-addon1" style="background-color:#F5DEB3">'.$baslik['icerik'].'</textarea>';
  									echo "</div>"
  							?>
  							<input type="text" value="<?php echo $_GET['id']?>" style="visibility:hidden" name="yid"/>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-2">
				
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>

<?php
	if(!isset($_SESSION['kid'])){ 
        header("Location:giris.php"); 
    } 
    
	$baglanti = mysql_connect("localhost","user","pass");
	mysql_select_db("proje",$baglanti);
	session_start();

	if(isset($_POST['yazi'])) {
		$konu_baslik = htmlentities(mysql_real_escape_string($_POST['k_baslik']));
		$konu_icerik = htmlentities(mysql_real_escape_string($_POST['icerik']));
		$kid = $_SESSION['kid'];
		$hyazi = (int)$_POST['yid'];

		$sql = "update yazilar set yazibasligi='$konu_baslik', icerik='$konu_icerik' where yazilarid='$hyazi' and kid='$kid';";
		mysql_query($sql,$baglanti);

		header("Location:yazilar.php");
	}
?>