<?php
include("../connect.php");
session_start();
$id = $_SESSION['id'];
$res = mysqli_query($cnx, "SELECT nom, prix FROM produit WHERE id = '$id';");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST);

    // Collect options and quantities
    $arr1 = [$opt_0, $opt_1, $opt_2];
    $arr2 = [$quant_0, $quant_1, $quant_2];
    $arr = [...$arr1];
    $arp = [...$arr2];
    
    // Current date
    $d = date("Y-m-d");
    
    function button1($arr, $cnx, $j, $arp) {
        $tot = 0;
        echo "<div style=' margin: 20px ;font-weight: bold; position : absolute; top:100px; left : 700px;'>";
        for ($i = 0; $i < $j; $i++) {
            $s = 0;
            $res5000 = mysqli_query($cnx, "SELECT prix from produit where (nom = '$arr[$i]');");
            $t = mysqli_fetch_array($res5000);
            $s = $arp[$i] * $t[0];
            $tot = $tot + $s;
            echo "
            <p class='message' id='m1' style=''>$arr[$i] = $arp[$i] X $t[0] = $s</p><br>
            ";
        }
        echo "<p class='message' id='m2'>montant total : $tot</p></div>";
    }
    
    $error = false;
    $errorMessages = [];
    
    // First, check stock for all products
    for ($i = 0; $i < 3; $i++) {
        if (!empty($arr1[$i]) && !empty($arr2[$i])) {
            // Check stock availability
            $productName = $arr1[$i];
            $quantity = $arr2[$i];
            
            $stockQuery = mysqli_query($cnx, "SELECT qua FROM produit WHERE nom = '$productName'");
            $stockData = mysqli_fetch_array($stockQuery);
            
            if ($stockData && $stockData['qua'] >= $quantity) {
                // Stock is sufficient
                continue;
            } else {
                $error = true;
                $available = $stockData ? $stockData['qua'] : 0;
                $errorMessages[] = "Stock insuffisant pour $productName. Quantité demandée: $quantity, Disponible: $available";
            }
        }
    }
    
    if (!$error) {
        $j = 0;
        // If all stocks are sufficient, proceed with the sale
        for ($i = 0; $i < 3; $i++) {
            if (!empty($arr1[$i]) && !empty($arr2[$i])) {
                // Use prepared statements to prevent SQL injection
                $stmt = $cnx->prepare("INSERT INTO vent (DP, QV, DV) VALUES (?, ?, ?)");
                $stmt->bind_param("sis", $arr1[$i], $arr2[$i], $d);
                
                // Update stock
                $updateStmt = $cnx->prepare("UPDATE produit SET qua = qua - ? WHERE nom = ?");
                $updateStmt->bind_param("is", $arr2[$i], $arr1[$i]);
                
                if ($stmt->execute() && $updateStmt->execute()) {
                    $j++;
                } else {
                    $error = true;
                    $errorMessages[] = "Erreur lors de l'enregistrement de la vente pour " . $arr1[$i];
                }
            }
        }
        
        if (!$error) {
            button1($arr, $cnx, $j, $arp);
        }
    }
    
    // Display error messages if any
    if ($error) {
        echo "<div style='color: red; margin: 20px; font-weight: bold; position: absolute; top: 100px; left: 700px;'>";
        foreach ($errorMessages as $message) {
            echo "<p>$message</p>";
        }
        echo "<p>La vente n'a pas été enregistrée.</p></div>";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="styles2.css">
    <!-- Bootstrap CSS -->
    <link href="" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des ventes en ligne</title>
    <link rel="stylesheet" href="style.css">
    
    <script src="act.js"></script>
</head>

<body>
    <nav>
        <ul id="left">
                <li class="left"><a href="../contact_us/index.html"> A propos</a></li>
                <li class="left"><a href="../produit/index.html">Produits</a></li>
                <li class="left"><a href="../vente/index.php">Ventes</a></li>
                <li class="left"><a href="../Requetes/index.php">Requêtes</a></li>
                <li><a href="../sp/index.php">Afficher les produits</a></li>
                <li class="right"><a href="../logout.php">Déconnexion</a></li>
        </ul>
    </nav>
    <div class="container">
        <!-- Section du formulaire -->
        <div class="form-section">
            <form method="POST" onsubmit="return aff() && act()">
                <div class="buttons">
                    <button type="submit" class="submit-button">Enregistrer les ventes</button>
                    <button type="submit" class="refresh-button" id="act">Actualiser la page</button>
                </div>
                <!-- Product Row Template (hidden by default) -->

                <div class="" id="" style="">
                    <h3>case 1 :</h3>
                    <div>
                        <label for="produit">Produit :</label>
                        <select class="produit" name="opt_0">
                            <option value="">--Sélectionner un produit--</option>
                            <?php
                            $i = 0;
                            $arr = [];
                            mysqli_data_seek($res, 0); // Reset result pointer
                            while ($t = mysqli_fetch_array($res)) {
                                echo "
                                    <option value='$t[0]'>$t[0]</option>
                                ";
                                $i++;
                                $arr = [...$arr, $t[0]];
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="quantite">Quantité :</label>
                        <input name="quant_0" type="number" class="quantite" min="1" placeholder="Entrez la quantité"
                            id="q">
                    </div>
                    <div>
                        <h3>case 2 :</h3>
                        <label for="produit">Produit :</label>
                        <select class="produit" name="opt_1">
                            <option value="">--Sélectionner un produit--</option>
                            <?php
                            for ($j = 0; $j < $i; $j++) {
                                echo "
                                    <option value='$arr[$j]'>$arr[$j]</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="quantite">Quantité :</label>
                        <input name="quant_1" type="number" class="quantite" min="1" placeholder="Entrez la quantité"
                            id="q">
                    </div>
                    <div>
                        <h3>case 3 :</h3>
                        <label for="produit">Produit :</label>
                        <select class="produit" name="opt_2">
                            <option value="">--Sélectionner un produit--</option>
                            <?php
                            for ($j = 0; $j < $i; $j++) {
                                echo "
                                    <option value='$arr[$j]'>$arr[$j]</option>
                                ";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="quantite">Quantité :</label>
                        <input name="quant_2" type="number" class="quantite" min="1" placeholder="Entrez la quantité"
                            id="q">
                    </div>
                </div>
                <div id="inputContainer">
                </div>
            </form>
        </div>

        <!-- Section des ventes -->
        
    </div>
    <footer>
        <p>&copy 2025 Touts Droits reservée .</p>
    </footer>
</body>

</html>