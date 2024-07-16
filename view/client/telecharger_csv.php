<?php
require_once '../../modele/ClientModel.php'; // Chemin relatif corrigé
require_once '../../config/connexion.php'; // Chemin relatif corrigé

// Initialisation du modèle avec la connexion à la base de données
$model = new ClientModel($db);
$users = $model->GetAllClients();

// Définir l'en-tête pour indiquer que le contenu est un fichier CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=utilisateurs.csv');

// Créer un flux de sortie
$output = fopen('php://output', 'w');

// Écrire la ligne d'en-tête du CSV
fputcsv($output, array('Prenom', 'Nom', 'Email', 'Numero', 'Adresse', 'Sexe'));

// Écrire les données utilisateur dans le CSV
foreach ($users as $user) {
    $prenom = isset($user['prenom']) ? $user['prenom'] : '';
    $nom = isset($user['nom']) ? $user['nom'] : '';
    $email = isset($user['email']) ? $user['email'] : '';
    $numero = isset($user['numero']) ? $user['numero'] : '';
    $adresse = isset($user['adresse']) ? $user['adresse'] : '';
    $sexe = isset($user['sexe']) ? $user['sexe'] : '';
    fputcsv($output, array($prenom, $nom, $email, $numero, $adresse, $sexe));
}

// Fermer le flux de sortie
fclose($output);
?>
