<?php
extract($_POST);
$cnx = mysqli_connect("127.0.0.1","root","","ifbreak");
$req5 = "insert into personne (passe,nom,mail,monnaire) values('$mp','$nom','$email','$flous');" or die("probelm l4") ;
$res9 = mysqli_query($cnx,$req5) or die("problim ins");
$nb5 = mysqli_affected_rows($cnx);
sleep(1);
header("location:../connexion/index.html");
mysqli_close($cnx);
?>