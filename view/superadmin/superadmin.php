<?php
require_once('../../config/connexion.php');
require_once('../../modele/SuperAdminModel.php');
require_once('../../controller/SuperAdminController.php');

$database = new Database();
$connect = $database->getConnection();

$model = new SuperAdminModel($connect);
$controller = new SuperAdminController($model);

$stats = $controller->getStats();
$admins = $controller->getAllAdmins();
$clients = $controller->getAllClients();

if ($stats === null || $admins === null || $clients === null) {
    die('Erreur: Les données n\'ont pas pu être récupérées.');
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_admin'])) {
    $prenom = htmlspecialchars($_POST['prenom']);
    $nom = htmlspecialchars($_POST['nom']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $login_admin = htmlspecialchars($_POST['login_admin']);
    $passwdAdmin = htmlspecialchars($_POST['passwdAdmin']);
    $success = $controller->addAdmin($prenom, $nom, $adresse, $login_admin, $passwdAdmin);

    if ($success) {
        echo '<script>alert("Administrateur ajouté avec succès.");</script>';
        $admins = $controller->getAllAdmins(); // Mettre à jour la liste des admins
    } else {
        echo '<script>alert("Erreur lors de l\'ajout de l\'administrateur.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footers.css">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="../../public/css/superadmins.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Accueil | SUPER ADMINISTRATEURS</title>
</head>
<body>
    <?php include '../../view/header.php'; ?>
    <br><br><br><br><br>
    <div class="barreee">
        <div class="logo-holder">
            <div class="bg"></div>
            <div class="bar"></div>
            <div class="bar fill1"></div>
            <div class="bar fill2"></div>
            <div class="bar fill3"></div>
            <div class="bar fill4"></div>
            <div class="bar fill1"></div>
            <div class="bar fill5"></div>
            <div class="bar fill6"></div>
            <div class="bar"></div>
        </div>
    </div>
    <div class="container">
        <a href="javascript:history.go(-1)">RETOUR</a>
        <h1 class="balisse">Bienvenue sur la page d'accueil<br> SUPERADMIN</h1>
        <div class="container1" id="adminButton">
            <i class="fas fa-user-shield icon"></i> <!-- Icône pour Admin -->
            <button><?php echo htmlspecialchars($stats['numberOfAdmins']); ?></button>
            <p>Total</p>
            <p>Admin</p>
        </div>
        <div class="container2" id="clientButton">
            <i class="fas fa-user icon"></i> <!-- Icône pour Client -->
            <button><?php echo htmlspecialchars($stats['numberOfClients']); ?></button>
            <p>Total</p>
            <p>Client</p>
        </div>
        <div class="container3" id="addAdminBtn">
            <i class="fas fa-user-plus icon"></i>
            <button onclick="openAddAdminModal()">Ajouter <br> Admin</button>
        </div>
    </div>

    <!-- Modale pour les Admins -->
    <div id="adminModal" class="modal">
        <div class="modal-content">
            <span class="close" id="adminClose">&times;</span>
            <h2>Liste des Admins</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($admins as $admin) {
                        echo "<tr>";
                        echo "<td data-label='ID'>" . htmlspecialchars($admin['id']) . "</td>";
                        echo "<td data-label='Prénom'>" . htmlspecialchars($admin['prenom']) . "</td>";
                        echo "<td data-label='Nom'>" . htmlspecialchars($admin['nom']) . "</td>";
                        echo "<td data-label='Email'>" . htmlspecialchars($admin['email']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modale pour les Clients -->
    <div id="clientModal" class="modal">
        <div class="modal-content">
            <span class="close" id="clientClose">&times;</span>
            <h2>Liste des Clients</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($clients as $client) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($client['id']) . "</td>";
                        echo "<td>" . htmlspecialchars($client['prenom']) . "</td>";
                        echo "<td>" . htmlspecialchars($client['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($client['email']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modale pour ajouter un administrateur -->
    <div id="addAdminModal" class="modal">
        <div class="modal-content1">
            <span class="close" id="addAdminClose">&times;</span>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <input type="text" id="prenom" name="prenom" placeholder="Prénom" required><br><br>
                <input type="text" id="nom" name="nom" placeholder="Nom" required><br><br>
                <input type="text" id="adresse" name="adresse" placeholder="Adresse"><br><br>
                <input type="text" id="login_admin" name="login_admin" placeholder="Login administrateur" required><br><br>
                <input type="password" id="passwdAdmin" name="passwdAdmin" placeholder="Mot de passe administrateur" required><br><br>
                <input type="submit" name="add_admin" value="Ajouter administrateur">
            </form>

        </div>
    </div>
    <br><br><br><br><br><br>
    <?php include '../../view/footer.php'; ?>
    <script src="../../public/js/superadmin.js" defer></script>

</body>
</html>
