<?php
include("../database/connexion.php");
include("../fonction/fonction.php");

// Vérification de la présence du paramètre id
if (isset($_GET["id"])) {
    $user_id = trim($_GET["id"]);

    // Récupérer l'ID de immo
    $stmt = $connexion->prepare("SELECT id FROM immo LIMIT 1");
    $stmt->execute();
    $info_immo = $stmt->fetch(PDO::FETCH_ASSOC);
    $immo_id = $info_immo['id'] ?? null;

    // Vérifier que l'ID immo existe
    if (!$immo_id) {
        header("Location: utilisateurs.php?msg=Aucun immo trouvé.");
        exit();
    }

    try {
        // Vérifier si l'utilisateur est déjà affecté
        $stmt = $connexion->prepare("SELECT COUNT(*) FROM user_immo WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);
        $exists = $stmt->fetchColumn();

        if ($exists) {
            header("Location: utilisateurs.php?msg=Cet utilisateur est déjà affecté à un immo.");
            exit();
        }

        // Générer un UUID
        $id = generateUUID();

        // Insérer l'affectation
        $stmt = $connexion->prepare("INSERT INTO user_immo (id, user_id, immo_id) VALUES (:id, :user_id, :immo_id)");
        $stmt->execute([
            'id' => $id,
            'user_id' => $user_id,
            'immo_id' => $immo_id
        ]);

        header("Location: utilisateurs.php?msg=Affectation réussie !");
        exit();
    } catch (PDOException $e) {
        header("Location: utilisateurs.php?msg=" . urlencode("Erreur : " . $e->getMessage()));
        exit();
    }
} else {
    header("Location: utilisateurs.php?msg=L'ID utilisateur est requis.");
    exit();
}
?>
