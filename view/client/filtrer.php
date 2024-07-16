<?php
require_once("../../config/connexion.php");
require_once("../../modele/ClientModel.php");
require_once("../../controller/ClientController.php");

$database = new Database();
$db = $database->getConnection();
$model = new ClientModel($db);
$controller = new ClientController($model);

$query = $_GET['query'] ?? '';

$clients = $model->FiltrerClients($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footers.css">
    <link rel="stylesheet" href="../../public/css/modifierr.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Acceuil | ADMINISTRATEURS | FILTRAGE</title>
</head>
<body>
    <?php include '../../view/header.php'; ?>
    <br><br><br><br><br>
    <div class="container">
        <a href="javascript:history.go(-1)">RETOUR</a>
        <h3>MODIFIER/SUPPRIMER CLIENT</h3>
        <form method="get" action="">
            <input type="text" name="query" placeholder="Nom, Adresse, ou Numéro" value="<?php echo htmlspecialchars($query); ?>">
            <button type="submit">Filtrer</button>
        </form>
        <br><br>

        <?php
        if (!empty($clients)) {
            echo '<table>';
            echo '<thead><tr><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Numéro</th><th>Email</th><th>Sexe</th><th>Actions</th></tr></thead>';
            echo '<tbody>';
            foreach ($clients as $client) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($client['nom']) . '</td>';
                echo '<td>' . htmlspecialchars($client['prenom']) . '</td>';
                echo '<td>' . htmlspecialchars($client['adresse']) . '</td>';
                echo '<td>' . htmlspecialchars($client['numero']) . '</td>';
                echo '<td>' . htmlspecialchars($client['email']) . '</td>';
                echo '<td>' . htmlspecialchars($client['sexe']) . '</td>';
                echo '<td>';
                echo '<div class="button-group">';
                echo '<form method="post" action="../client/DeleteClient.php" style="display:inline-block;">';
                echo '<input type="hidden" name="delete_id" value="' . $client['id'] . '">';
                echo '<button type="submit">Supprimer</button>';
                echo '</form>';
                echo '<form method="get" action="../client/modifierclient.php" style="display:inline-block;">';
                echo '<input type="hidden" name="edit_id" value="' . $client['id'] . '">';
                echo '<button type="submit">Modifier</button>';
                echo '</form>';
                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Aucun client trouvé.</p>';
        }
        ?>
    </div>
    <br>
    <br><br><br><br><br><br>

    <?php include '../../view/footer.php'; ?>
</body>
</html>
