<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Space odyssey </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Barre de navigation et autres éléments du thème -->
        <?php include './html/navigation.php'; 
        include './missions/mission.php';
        ?>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Stellar Tech</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="./planete.php" class="nav-link">
                                <i class="nav-icon fas fa-globe"></i>
                                <p>Planètes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="astronauts.php" class="nav-link">
                                <i class="nav-icon fas fa-user-astronaut"></i>
                                <p>Astronautes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./dashboard.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.Menu -->
            </div>
            <!-- /.Sidebar -->
        </aside>

        <!-- Contenu de la page -->
        <div class="content-wrapper">
            <section class="content">w
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Liste des Planètes</h3>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Nom</th>
                                                        <th>Circonférence (km)</th>
                                                        <th>Distance à la Terre (km)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    try {
                                                        $bdd = new PDO('mysql:host=localhost;dbname=evaluation2;charset=utf8', 'root', '');
                                                    } catch (PDOException $e) {
                                                        die('Erreur : ' . $e->getMessage());
                                                    }

                                                    $requete = $bdd->query("SELECT * FROM Planetes");


                                                    //affichage
                                                    while ($resultat = $requete->fetch()) {
                                                        echo "<tr>";
                                                        echo "<td>" . $resultat["id_planete"] . "</td>";
                                                        echo "<td>" . $resultat["nom_planete"] . "</td>";
                                                        echo "<td>" . $resultat["circonférence_km"] . "</td>";
                                                        echo "<td>" . $resultat["distance_terre_km"] . "</td>";
                                                        echo "</tr>";
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>                                    
                                        <tbody>
<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "evaluation2");

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer les données des planètes depuis la base de données
$sql = "SELECT * FROM planets";
$result = $conn->query($sql);

// Vérifier si la requête s'est exécutée correctement
if (!$result) {
    // Gérer l'erreur de requête
    echo "Erreur lors de l'exécution de la requête : " . $conn->error;
} else {
    // Vérifier si le résultat est un objet avant d'accéder à num_rows
    if ($result instanceof mysqli_result) {
        if ($result->num_rows > 0) {
            echo "<table border='1'><thead><tr><th>ID</th><th>Nom</th><th>Circonférence</th><th>Distance à la Terre</th></tr></thead><tbody>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["circumference"] . "</td><td>" . $row["distance_to_earth"] . "</td></tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "0 résultats";
        }

        // Libérer le jeu de résultats
        $result->free();
    } else {
        echo "La requête n'a pas retourné un objet valide.";
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Pied de page et scripts JS du thème -->
        <?php include './html/footer.php'; ?>