<?php
class ClientModel {
    private $db;
    //pour pouvoir hydrater
    public function __construct($database) {
        $this->db = $database;
    }

    //requete pour cree un client
    public function AjouterClient($data) {
        $query = $this->db->prepare("INSERT INTO clients (prenom, nom, adresse, numero, email, sexe) VALUES (:prenom, :nom, :adresse, :numero, :email, :sexe)");
        return $query->execute([
            ":prenom" => $data['prenom'],
            ":nom" => $data['nom'],
            ":adresse" => $data['adresse'],
            ":numero" => $data['numero'],
            ":email" => $data['email'],
            ":sexe" => $data['sexe'],
        ]);
    }
    
    //requete pour recuperer tous les clients
    public function GetAllClients() {
        $query = $this->db->prepare("SELECT * FROM clients");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //recuperer client par son id
    public function GetClientById($id) {
        $query = $this->db->prepare("SELECT * FROM clients WHERE id = :id");
        $query->execute([":id" => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Correct method to get admin details
    public function GetAdminById($id) {
        $query = $this->db->prepare("SELECT * FROM administrateur WHERE id = :id");
        $query->execute([":id" => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    // Correct method to update admin password
    public function ModifierAdmin($id, $data) {
        $query = $this->db->prepare("UPDATE administrateur SET passwd_admin = :passwd_admin WHERE id = :id");
        return $query->execute([
            ":id" => $id,
            ":passwd_admin" => $data['passwd_admin'],
        ]);
    }


    //requete pour modifier un client 
    public function ModifierClient($id, $data) {
        $query = $this->db->prepare("UPDATE clients SET prenom = :prenom, nom = :nom, adresse = :adresse, numero = :numero, email = :email, sexe = :sexe WHERE id = :id");
        return $query->execute([
            ":id" => $id,
            ":prenom" => $data['prenom'],
            ":nom" => $data['nom'],
            ":adresse" => $data['adresse'],
            ":numero" => $data['numero'],
            ":email" => $data['email'],
            ":sexe" => $data['sexe']
        ]);
    }

    //requete pour supprimer un client 
    public function SupprimerClient($id) {
        $query = $this->db->prepare("DELETE FROM clients WHERE id = :id");
        return $query->execute([":id" => $id]);
    }
    
    //requete pour filtrer les clients par nom, adresse et numero
    public function FiltrerClients($query = '') {
        $query = '%' . $query . '%';  // Encapsule la requête dans des jokers pour la recherche partielle
        $stmt = $this->db->prepare("
            SELECT * FROM clients
            WHERE 
                nom LIKE :query OR
                prenom LIKE :query OR
                numero LIKE :query OR
                adresse LIKE :query
        ");
        $stmt->execute([':query' => $query]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    //requete pour trier les clients par nom adresse, nmerero et statut
    public function TrierClients($criteres = 'nom', $ordre = 'ASC') {
        // Validation des critères et de l'ordre pour éviter les injections SQL
        $criteres = in_array($criteres, ['nom', 'adresse', 'numero']) ? $criteres : 'nom';
        $ordre = strtoupper($ordre) === 'DESC' ? 'DESC' : 'ASC';
    
        $query = $this->db->prepare("
            SELECT * FROM clients
            ORDER BY $criteres $ordre
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //requete pour imprimer une liste de clients par PDF ou CSV 
    //requete pour cree un rapport pour les clients 

    //bloquer ou debloquer client
    public function bloquerdebloquerclient($clientId, $status) {
        $query = "UPDATE clients SET statut = :statut WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':statut', $status);
        $stmt->bindParam(':id', $clientId);
        return $stmt->execute();
    }
    }
?> 
