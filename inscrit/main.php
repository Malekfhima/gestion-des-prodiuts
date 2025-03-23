<?php
include("../connect.php");
extract($_POST);
session_start();
$res = mysqli_query($cnx, "SELECT * FROM personne where nom='$nom'");
$nb = mysqli_num_rows($res);
if ($nb > 0) {
    echo "<script>alert('le compte est deja exeicete');</script>";
} else {
    $res = mysqli_query($cnx, "insert into personne (passe,nom,mail,monnaire) values('$mp','$nom','$email','$flous');");
    echo "<script>alert('inscrit fait avec sucssee!!');</script>";
    sleep(1);
    header("location:../connexion/index.html");
    mysqli_close($cnx);
}
?>