<?php
include("../connect.php");
session_start();
$id = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if ($id) {
        $stmt = $cnx->prepare("DELETE FROM vent WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            echo "Vente annulée avec succès.";
        } else {
            echo "Erreur lors de l'annulation de la vente.";
        }
        $stmt->close();
    } else {
        echo "ID de vente non fourni.";
    }
}
?>