<?php   
include("../connect.php");
session_start();
extract($_POST);
$req = "SELECT code from produit where (code='$code');";
$res = mysqli_query($cnx , $req);
$nb = mysqli_num_rows($res);
if($nb>0){
    die("le code est deja existée");
}else{
    $id = $_SESSION['id'];
    $req1 = "SELECT id FROM personne WHERE id = $id";
    $res1 = mysqli_query($cnx , $req1);
    $nb5 = mysqli_num_rows($res1);
    function generateSixDigitNumber() {
        return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    }
    $code = generateSixDigitNumber();
    $res42 = mysqli_query($cnx, "SELECT code from produit where code = '$code'");
    $nb58 = mysqli_num_rows($res);
    while($nb58>0){
    $code = generateSixDigitNumber();
    }
    if($nb5>0){
        $req5 = "insert into produit (qua,code,nom,prix,id) values('$qua','$code','$nom','$prix','$id');";
        $res9 = mysqli_query($cnx,$req5) or die("problim l13");
        $nb5 = mysqli_affected_rows($cnx);
        if($nb5<1) die("problem");
        sleep(1);
        header("location:../produit/index.html");
    }else{
        die("fama moshkla");
    }
}
mysqli_close($cnx);
?>