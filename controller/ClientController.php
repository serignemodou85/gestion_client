<?php

class ClientController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    //Ajouter Client
    public function AjouterClient($data) {
        $this->model->AjouterClient($data);
        header('Location: ../admin/admin.php');
    }

    //Liste Clients
    public function GetAllClients() {
        return $this->model->GetAllClients();
    }
    //Modifier Client
    public function ModifierClient($id, $data) {
        $this->model->ModifierClient($id, $data);
        header('Location: ../client/modifsupp.php');
    }
    //Supprimer Client
    public function SupprimerClient($id) {
        $this->model->SupprimerClient($id);
    }
    
    //filtrer les clients par nom, adresse et numero
    //trier les clients par nom adresse, nmerero et statut
    public function TrierClients($criteres, $ordre) {
        return $this->model->TrierClients($criteres, $ordre);
    }
    
    //imprimer une liste de cleints par PDF ou CSV
    //cree un rapport pour les clients 

    //bloquer client
    public function bloquerdebloquerclient($clientId, $status) {
        return $this->model->bloquerdebloquerclient($clientId, $status);
        header('Location: ../view/bloquedeblo.php');
    }
}