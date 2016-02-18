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
			<div class="col-md-8" >
				<div class="panel panel-default" style="background-color:#A52A2A; border:none;">
					<div class="panel-heading" style="background-color:#DEB887; border:none;">
						<h3 class="panel-title">
							Yazı Başlık ve İçerik Kayıt Yeri
						</h3>
					</div>
					<div class="panel-body" style="padding:30px;">
						<form role="form" action="yazilar.php" method="POST">
							<input type="submit" class="btn btn-default" name="yazi" value="Yazıyı Kaydet" style="background-color:#DEB887; margin-bottom:20px; margin-left:672px;">
							<div class="input-group" style="margin-bottom:20px;">
  								<span class="input-group-addon" id="basic-addon1" style="background-color:#DEB887;">
  								<span  class="glyphicon glyphicon-hand-right"></span>
  								</span>
  								<input type="text" name="k_baslik" class="form-control" placeholder="Yazı Başlığı" aria-describedby="basic-addon1" style="background-color:#F5DEB3">
  							</div>
  							<div class="input-group" style="margin-bottom:20px;">
  								<span class="input-group-addon" id="basic-addon1" style="background-color:#DEB887;">
  								<span class="glyphicon glyphicon-pencil"></span>
  								</span>
  								<textarea wrap="soft" name="icerik" rows="15" class="form-control" placeholder="Yazı İçeriğini Giriniz..." aria-describedby="basic-addon1" style="background-color:#F5DEB3"></textarea>
  							</div>
  							
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default" style="background-color:#A52A2A; border:none;">
					<div class="panel-heading" style="background-color:#DEB887; border:none;">
						<h3 class="panel-title">
							Önceki Yazılarım
						</h3>
					</div>
					<div class="panel-body" style="padding:30px; height:514px; overflow-y: scroll;">
						<?php 
							$baglanti = mysql_connect("localhost","user","pass");
							mysql_select_db("proje",$baglanti);
							session_start();
							$kid = $_SESSION['kid'];

							$sql = "select * from yazilar where kid='$kid';";
							
							$sonuc = mysql_query($sql,$baglanti);
							$i = 1;
							while ($row = mysql_fetch_assoc($sonuc)) {
								echo $i.") "."<a href='yazi_detay.php?id=".$row['yazilarid']."'>".$row['yazibasligi']."</a>&nbsp;&nbsp;&nbsp;<a href='yazi_duzenle.php?id=".$row['yazilarid']."'><span class='glyphicon glyphicon-pencil'></a></span>&nbsp;&nbsp;&nbsp;<a href='yazi_sil.php?id=".$row['yazilarid']."'><span class='glyphicon glyphicon-remove'></a><br>";
								$i++;
							} 
						?>
					</div>
				</div>
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

	if(isset($_POST['yazi'])) {
		$konu_baslik = htmlentities(mysql_real_escape_string($_POST['k_baslik'])); 
		$konu_icerik = htmlentities(mysql_real_escape_string($_POST['icerik'])); 
		$kid = $_SESSION['kid'];

		$sql = "insert into yazilar(kid,yazibasligi,icerik) values('$kid','$konu_baslik','$konu_icerik');";
		mysql_query($sql,$baglanti);

		header("Location:yazilar.php");
	}
?>