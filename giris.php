<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hoşgeldiniz!</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

  </head>
  <style type="text/css">
  	body{
  		font-family: Ubuntu;
  		background-color: #FF7F50;
  	}
  </style>
  <body>

    <div class="container-fluid">
    <div class="row" style="background-color:#A52A2A; margin-top:80px; padding:30px; text-align:center; font-size:20px; color:#DEB887;">
    	<div class="col-md-12" ></div>
    </div>

	<div class="row" style="margin-top:50px;">
		<div class="col-md-4"></div>
		<div class="col-md-4">

			<div class="panel panel-default" style="background-color:#A52A2A; border-color:rgb(52,58,74);" >
				<div class="panel-heading" style="background-color:#DEB887; border:none;">
					<h3 class="panel-title">
						<span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;
						Giriş Formu
					</h3>
				</div>
				<div class="panel-body" style="padding:30px;">
					<form role="form" action="giris.php" method="POST">
						<div class="input-group" style="margin-bottom:20px;">
  							<span class="input-group-addon" id="basic-addon1" style="background-color:#DEB887;">
  								<span  class="glyphicon glyphicon-user"></span>
  							</span>
			  					<input type="text" name="k_adi" class="form-control" placeholder="Kullanıcı Adı" aria-describedby="basic-addon1">
						</div>
						<div class="input-group" style="margin-bottom:20px;">
		  					<span class="input-group-addon" id="basic-addon1" style="background-color:#DEB887;">
		  						<span class="glyphicon glyphicon-lock"></span>
		  					</span>
		  					<input type="password" name="k_sifre" class="form-control" placeholder="Parola" aria-describedby="basic-addon1">
						</div>
						
						
						<input type="submit" class="btn btn-default" name="istek" value="Giriş Yap" style="background-color:#DEB887;">
					</form>
				</div>
			</div>

		</div>
		<div class="col-md-4"></div>
	</div>
</div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>

<?php 
	session_start();
	if(isset($_SESSION['kid'])){ // Eger giris yapilmissa yazilar.php sayfasina yonlendirilir.
		header("Location:yazilar.php");
	}

	$baglanti = mysql_connect("localhost","user","pass");
	mysql_select_db("proje",$baglanti);
	
	if(isset($_POST["istek"])) { //isset fonksiyonu degisken bos mu dolu mu diye kontrol etmektedir.
		$k_adi = htmlentities(mysql_real_escape_string($_POST['k_adi']));
		$k_sifre = htmlentities(mysql_real_escape_string($_POST['k_sifre']));

		$sql = "select * from kullanici where kadi='$k_adi' and sifre='$k_sifre';";
		$satir = mysql_query($sql,$baglanti);
		$row = mysql_fetch_assoc($satir);

		if ($row) {
			$_SESSION['kid'] = $row['id'];
			header("Location:yazilar.php");
		}
		else{
			header("Location:giris.php");
		}
	}
?>