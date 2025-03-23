<?php
session_start();
include("../connect.php");
$id = $_POST['id'];
$requete = ("DELETE FROM 'vente' WHERE id =?");
$res = $cnx->query($requete);
header('Location: ../index.php');
?>