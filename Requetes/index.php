<?php
include("../connect.php");
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: ../connexion/index.html");
    exit();
}

$id = $_SESSION['id'];

// Traitement de la recherche par date
$ventes = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['requete'])) {
    $requete_date = $_POST['requete'];
    
    // Valider le format de la date
    if (DateTime::createFromFormat('Y-m-d', $requete_date) !== false) {
        $stmt = $cnx->prepare("SELECT id, DP, QV, DV FROM vent WHERE DATE(DV) = ?");
        $stmt->bind_param("s", $requete_date);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while ($donnees = $result->fetch_assoc()) {
                $ventes[] = $donnees;
            }
        } else {
            $info_message = "Aucune vente trouvée pour la date " . htmlspecialchars($requete_date);
        }
    } else {
        $error_message = "Format de date invalide. Utilisez le format AAAA-MM-JJ.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Ventes</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <style>
        .alert { padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; }
        .alert-success { color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6; }
        .alert-danger { color: #a94442; background-color: #f2dede; border-color: #ebccd1; }
        .alert-info { color: #31708f; background-color: #d9edf7; border-color: #bce8f1; }
    </style>
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
    <main>
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($info_message)): ?>
            <div class="alert alert-info"><?php echo $info_message; ?></div>
        <?php endif; ?>
        
        <button id="convertToPdf" class="btn btn-danger">Convertir la page en PDF</button>
        <h1>Rechercher des ventes effectuées à une date donnée</h1>
        <form method="post">
            <label for="requete">Date:</label>
            <input type="date" name="requete" id="requete" required>
            <input type="submit" value="Recherche">
        </form style="margin-botton=2px">
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
                <?php if (!empty($ventes)): ?>
                    <?php foreach ($ventes as $vente): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($vente['DP']); ?></td>
                            <td><?php echo htmlspecialchars($vente['QV']); ?></td>
                            <td><?php echo htmlspecialchars($vente['DV']); ?></td>
                            <td>
                                <form action="annuler.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette vente ?');">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($vente['id']); ?>">
                                    <button type="submit" class="btn btn-danger">Annuler</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php elseif ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['requete'])): ?>
                    <tr>
                        <td colspan="4">Veuillez sélectionner une date pour afficher les ventes.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
    <script>
        document.getElementById('convertToPdf').addEventListener('click', function () {
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
        <p>&copy 2025 Tous droits réservés.</p>
    </footer>
</body>
</html>
<?php
$cnx->close();
?>