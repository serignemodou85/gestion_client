<?php
    require_once("../../config/connexion.php");
    require_once("../../modele/ClientModel.php");
    require_once("../../controller/ClientController.php");

    $database = new Database();
    $db = $database->getConnection();

    $model = new ClientModel($db);

    $controller = new ClientController($model);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'adresse' => $_POST['adresse'],
            'numero' => $_POST['numero'],
            'email' => $_POST['email'],
            'sexe' => $_POST['sexe']
        ];
        $controller->AjouterClient($data);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footers.css">
    <link rel="stylesheet" href="../../public/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Acceuil | ADMINISTRATEURS | AJOUT CLIENT</title>
    <style>
        #clientForm{
            margin: -30px;
            margin-left: 60px;

        }
    </style>
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
        <div class="titre">
            <h3>AJOUTER UN CLIENT</h3>
        </div>
        <a href="javascript:history.go(-1)">RETOUR</a>
        <br><br>
        <form id="clientForm" action="" method="post" enctype="multipart/form-data">
            <div class="input-container">
                <input type="text" placeholder="Nom" name="nom" required>
                <span class="required-message">* Champ obligatoire</span>
            </div>
            <div class="input-container">
                <input type="text" placeholder="Prénom" name="prenom" required>
                <span class="required-message">* Champ obligatoire</span>
            </div>
            <div class="input-container">
                <input type="text" placeholder="Adresse" name="adresse" required>
                <span class="required-message">* Champ obligatoire</span>
            </div>
            <div class="input-container">
                <input type="text" placeholder="Numéro de Téléphone" name="numero" required>
                <span class="required-message">* Champ obligatoire</span>
            </div>
            <div class="input-container">
                <input type="email" placeholder="Adresse E-mail" name="email" required>
                <span class="required-message">* Champ obligatoire</span>
            </div>
            <div class="input-container">
                <select name="sexe" id="sexe" required>
                    <option value="" disabled selected>Sexe</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
                <span class="required-message">* Champ obligatoire</span>
            </div>
            <button type="submit">AJOUTER CLIENT</button>
        </form>
        <div class="img_ajout">
            <img src="../../public/image/admin.jpg" alt="">
        </div>
    </div>
    <br>
    <br><br><br><br><br><br>
    <script src="../../public/js/ajoutclient.js" defer></script>

    <?php include '../../view/footer.php'; ?>
</body>
</html>
