<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Ventes</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="style.css">
    <!-- Include jsPDF and html2canvas libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
</head>
<body>
    <nav>
        <ul id="left">
            <li class="left">A propos</li>
            <li class="left"><a href="../produit/index.html">Produits</a></li>
            <li class="left"><a href="../vente/index.php">Ventes</a></li>
            <li class="left"><a href="#">Requetes</a></li>
            <li class="left">Aide</li>
            <li class="right"><a href="../connexion/index.html">Deconnexion</a></li>
        </ul>
    </nav>
    <main>
        <button id="convertToPdf" class="btn btn-danger">Convertir la page en PDF</button>
        <h1>Rechercher des ventes effectuées à une date donnée</h1>
        <form method="post">
            <label for="requete">Date:</label>
            <input type="date" name="requete" id="requete">
            <input type="submit" value="Recherche">
        </form>
        <table>
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Date</th>
                    <th>Annuler une vente</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include("../connect.php");
                session_start();
                $id = $_SESSION['id'];
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $requete_date = isset($_POST['requete']) ? $_POST['requete'] : null;
                    if ($requete_date) {
                        $stmt = $cnx->prepare("SELECT DP, QV, DV FROM vent WHERE DP = ?");
                        $stmt->bind_param("s", $requete_date);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                            while ($donnees = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($donnees['DP']) . "</td>";
                                echo "<td>" . htmlspecialchars($donnees['QV']) . "</td>";
                                echo "<td>" . htmlspecialchars($donnees['DV']) . "</td>";
                                echo "<td>
                                <form method='post' action='annuler.php'>
                                    <input type='hidden' name='id' value='" . htmlspecialchars($donnees['id']) . "'>
                                    <button type='submit' class='btn btn-danger'>Annuler</button> 
                                </form>  
                                      </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4'>Aucune vente trouvée pour cette date.</td></tr>";
                        }

                        $stmt->close();
                    } else {
                        echo "<tr><td colspan='4'>Aucune date n'a été fournie.</td></tr>";
                    }
                }
            ?>
            </tbody>
        </table>
    </main>
    <script>
        document.getElementById('convertToPdf').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            html2canvas(document.body).then(canvas => {
                let pdf = new jsPDF('p', 'pt', 'letter');
                let imgData = canvas.toDataURL('image/png');
                let imgWidth = 595.28; 
                let pageHeight = 841.89; 
                let imgHeight = canvas.height * imgWidth / canvas.width;
                let heightLeft = imgHeight;
                let position = 0;
                
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;

                while (heightLeft >= 0) {
                    position = heightLeft - imgHeight;
                    pdf.addPage();
                    pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                    heightLeft -= pageHeight;
                }

                pdf.save('ventes.pdf');
            });
        });
    </script>
    <footer>
        <p>&copy 2024 Tous droits réservés.</p>
        <p>Site web créé par <a href="mailto:malali3b@gmail.com">malali3b@gmail.com</a></p>
    </footer>
</body>
</html>
