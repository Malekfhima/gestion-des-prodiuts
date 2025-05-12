<?php
include("../connect.php");
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: ../connexion/index.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vente_id = isset($_POST['id']) ? $_POST['id'] : null;
    $current_date = date('Y-m-d');

    if ($vente_id) {
        // Démarrer une transaction
        $cnx->begin_transaction();

        try {
            // 1. Récupérer les détails de la vente
            $stmt = $cnx->prepare("SELECT DP, QV, DV FROM vent WHERE id = ?");
            if (!$stmt) throw new Exception("Erreur SELECT vent: ".$cnx->error);
            $stmt->bind_param("i", $vente_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $vente = $result->fetch_assoc();
                $vente_date = date('Y-m-d', strtotime($vente['DV']));
                
                if ($vente_date === $current_date) {
                    $produit = $vente['DP'];
                    $quantite = $vente['QV'];
                    
                    // 2. Supprimer la vente
                    $delete_stmt = $cnx->prepare("DELETE FROM vent WHERE id = ?");
                    if (!$delete_stmt) throw new Exception("Erreur DELETE: ".$cnx->error);
                    $delete_stmt->bind_param("i", $vente_id);
                    $delete_stmt->execute();
                    
                    // 3. Mettre à jour le stock - MODIFIÉ ICI
                    // Supposons que dans 'produit' la colonne s'appelle 'nom_produit' au lieu de 'DP'
                    // et 'quantite_stock' au lieu de 'QS'
                    $update_stmt = $cnx->prepare("UPDATE produit SET qua = qua + ? WHERE nom = ?");
                    if (!$update_stmt) throw new Exception("Erreur UPDATE: ".$cnx->error);
                    $update_stmt->bind_param("is", $quantite, $produit);
                    $update_stmt->execute();
                    
                    $cnx->commit();
                    header("location: index.php");
                    echo "<script>alert('Vente annulée et stock mis à jour avec succès.')</script>";
                } else {
                    $cnx->rollback();
                    echo "Vous ne pouvez annuler que les ventes du jour même.";
                }
            } else {
                $cnx->rollback();
                echo "Vente introuvable.";
            }
        } catch (Exception $e) {
            $cnx->rollback();
            echo "Erreur: ".$e->getMessage();
        }
    } else {
        echo "ID de vente non fourni.";
    }
}
?>