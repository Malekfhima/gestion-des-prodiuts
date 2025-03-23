<?php
session_start();
$id = $_SESSION['id'];
include("../connect.php");
$req = "SELECT code, nom, prix, qua FROM produit WHERE id = '$id';" or die("problème L4");
$res = mysqli_query($cnx, $req);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav>
        <ul id="left">
            <li class="left">A propos</li>
            <li class="left"><a href="../produit/index.html">Produits</a></li>
            <li class="left"><a href="../vente/index.php">Ventes</a></li>
            <li class="left"><a href="../Requetes/index.php">Requêtes</a></li>
            <li class="left">Aide</li>
            <li class="right"><a href="../connexion/index.html">Déconnexion</a></li>
        </ul>
    </nav>
    <main>
        <h1>Liste des Produits</h1>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($ligne = mysqli_fetch_array($res)) {
                    echo "
                    <tr>
                        <td>$ligne[0]</td>
                        <td>$ligne[1]</td>
                        <td>$ligne[2]</td>
                        <td>$ligne[3]</td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 Tous droits réservés.</p>
        <p>Site web créé par <a href="mailto:malali3b@gmail.com">malali3b@gmail.com</a></p>
    </footer>
</body>
</html>