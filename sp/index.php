<?php
session_start();
$id=$_SESSION['id'];
include("../connect.php");
$req = "SELECT code,nom,prix,qua from produit where(id='$id');" or die("problim L4");
$res = mysqli_query($cnx,$req);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul id="left">
            <li class="left">A propos</li>
            <li class="left"><a href="../produit/index.html">Produits</a></li>
            <li class="left"><a href="../vente/index.php">Vents</a></li>
            <li class="left"><a href="../Requetes/index.php">Requetes</a></li>
            <li class="left">Aide</li>
            <li class="right"><a href="../connexion/index.html">Deconnexion</a></li>
        </ul>
    </nav>
    <main>
        <table class='styled-table'>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <?php
            while($ligne = mysqli_fetch_array($res)){
                echo"
                    <style>
                        #elem1{
                            position:relative;
                            left:10%;
                            background-color: rgba(255,255,255,0.2);
                            color: black;
                        }
                        #elem2{
                            color: black;
                            position:relative;
                            left:15%;
                        }
                        #elem3{
                            color: black;
                            position:relative;
                            left:5%;
                        }
                        #elem4{
                            color: black;
                            position:relative;
                            left:9%;
                        }
                    </style>
                        <tbody>
                            <tr>
                                <td id='elem1'>$ligne[0]</td>
                                <td id='elem2'>$ligne[1]</td>
                                <td id='elem3'>$ligne[2]</td>
                                <td id='elem4'>$ligne[3]</td>
                            </tr>
                        </tbody>";
            }
            ?>
        </table>
    </main>
    <footer>
        <p>&copy 2024 Touts Droits reservée .</p>
        <p>Site web crée par "<a href="mailto:anoirlool@gmail.com">malali3b@gmail.com</a>"</p>
    </footer>
</body>
</html>