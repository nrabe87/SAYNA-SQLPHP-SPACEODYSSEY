*<?php
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

// Récupérer les données des missions depuis la base de données
$sql = "SELECT * FROM missions";
$result = $conn->query($sql);

// Stocker les résultats dans un tableau
$missions = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $missions[] = $row;
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>


<!-- Affichage des Missions -->
<table class="table">
    <thead>
        <tr>
            <th>id</th>
            <th>nom</th>
            <th>vaisseau</th>
            <th>Date de Début</th>
            <th>Date de Fin</th>
            <th>status</th>
        </tr>
    </thead>
    <tbody>
        <!-- Boucle pour afficher chaque mission -->
        <?php foreach ($missions as $mission) : ?>
            <tr>
                <td><?php echo $mission['id_mission']; ?></td>
                <td><?php echo $mission['nom_mission']; ?></td>
                <td><?php echo $mission['id_vaisseau']; ?></td>
                <td><?php echo $mission['date_debut']; ?></td>
                <td><?php echo $mission['date_fin']; ?></td>
                <td><?php echo $mission['statut']; ?></td>
                <td>
                                <!-- Ajouter une mission -->
                <a href="./missions/add_mission.php" title="Ajouter une mission">
                    <i class="fas fa-plus"></i>
                </a>

                <!-- Modifier une mission -->
                <a href="./missions/edit_mission.php" title="Modifier la mission">
                    <i class="fas fa-edit"></i>
                </a>

                <!-- Supprimer une mission-->
                <a href="./missions/delete_mission.php" title="Supprimer la mission">
                    <i class="fas fa-trash"></i>
                </a>
                </td>
            </tr>

        <?php endforeach; ?>

    </tbody>
</table>