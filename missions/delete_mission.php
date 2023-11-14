<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Reste de votre code...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'identifiant de la mission à supprimer
    $id_mission = isset($_POST["id_mission"]) ? intval($_POST["id_mission"]) : 0;

    // Validation de l'identifiant de la mission
    if ($id_mission <= 0) {
        echo "Identifiant de mission non valide.";
        exit;
    }

    // Connexion à la base de données
    $servname = "localhost";
    $username = "root";
    $password = "";
    $dbname = "evaluation2";
    $conn = new mysqli($servname, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Utilisation de requêtes préparées pour éviter les injections SQL
    $sql = "DELETE FROM missions WHERE id_mission=?";
    $stmt = $conn->prepare($sql);

    // Liaison des paramètres
    $stmt->bind_param("i", $id_mission);

    // Exécution de la requête préparée
    if ($stmt->execute()) {
        // Rediriger vers la page d'accueil après la suppression
        header("Location: acceuil.php");
        exit;
    } else {
        echo "Erreur lors de la suppression de la mission : " . $stmt->error;
    }

    // Fermer la déclaration préparée
    $stmt->close();

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer une Mission</title>
</head>
<body>
    <h2>Supprimer une Mission</h2>
    
    <?php
    // Assurez-vous que l'id_mission est défini et est un nombre entier
    if (isset($_GET['id_mission']) && is_numeric($_GET['id_mission'])) {
        $id_mission = $_GET['id_mission'];
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return confirm('Voulez-vous vraiment supprimer cette mission ?');">
        <input type="hidden" name="id_mission" value="<?php echo $id_mission; ?>">
        <p>Voulez-vous vraiment supprimer cette mission ?</p>
        <input type="submit" value="Oui">
    </form>
    <?php } ?>
</body>
</html>
