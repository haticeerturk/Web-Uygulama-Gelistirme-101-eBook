<?php
	if(!isset($_SESSION['kid'])){ 
        header("Location:giris.php"); 
    } 
     
	session_start();
	$baglanti = mysql_connect("localhost","user","pass");
	mysql_select_db("proje",$baglanti);

	$alinacak = (int)$_GET['id'];
	$kid = $_SESSION['kid'];

	$sql = "delete from yazilar where yazilarid='$alinacak' and kid='$kid';";
	mysql_query($sql,$baglanti);
	
	header("Location:yazilar.php");
?>