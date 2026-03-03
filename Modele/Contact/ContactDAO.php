<?php

namespace R401\TP5\Modele\Contact;

use PDO;
use R401\TP5\Modele\DatabaseHandler;

class ContactDAO {
    private static ?ContactDAO $instance = null;
    private readonly DatabaseHandler $database;

    private function __construct() {
        $this->database = DatabaseHandler::getInstance();
    }

    public static function getInstance(): ContactDAO {
        if (self::$instance == null) {
            self::$instance = new ContactDAO();
        }
        return self::$instance;
    }

    private function mapToContact(array $dbLine): Contact {
        $builder = new ContactBuilder();
        return $builder->contactId($dbLine['contact_id'])->nom($dbLine['nom'])->prenom($dbLine['prenom'])->adresse($dbLine['adresse'])->codePostal($dbLine['code_postal'])->ville($dbLine['ville'])->telephone($dbLine['telephone'])->build();
    }

    public function selectAllContacts(): array {
        $query = 'SELECT * FROM contact';
        $statement = $this->database->pdo()->prepare($query);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            exit();
        }
    }

    public function selectContactById(int $contactId): Contact {
        $query = 'SELECT * FROM contact WHERE contact_id = :contact_id';
        $statement = $this->database->pdo()->prepare($query);
        $statement->bindValue(':contact_id', $contactId);
        if ($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        } else {
            exit();
        }
    }

    public function searchContacts(string $recherche): array {
        $query = "SELECT * FROM contact WHERE normalized_contact_data LIKE CONCAT('%',:recherche,'%')";
        $statement = $this->database->pdo()->prepare($query);
        $statement->bindValue(':recherche', $recherche);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            exit();
        }
    }

    public function insertcontact(Contact $contactACreer): bool {
        $query = '
            INSERT INTO contact(nom, prenom, adresse, code_postal, ville, telephone, normalized_contact_data)
            VALUES (:nom,:prenom,:adresse,:code_postal,:ville,:telephone, :normalized_contact_data)
        ';
        $statement = $this->database->pdo()->prepare($query);
        $statement->bindValue(':nom', $contactACreer->getNom());
        $statement->bindValue(':prenom', $contactACreer->getPrenom());
        $statement->bindValue(':adresse', $contactACreer->getAdresse());
        $statement->bindValue(':code_postal', $contactACreer->getCodePostal());
        $statement->bindValue(':ville', $contactACreer->getVille());
        $statement->bindValue(':telephone', $contactACreer->getTelephone());
        $statement->bindValue(':normalized_contact_data', $this->normalize($contactACreer));

        return $statement->execute();
    }

    private function normalize(Contact $contact): string {
        return strtolower($contact->getNom()) . ' ' . strtolower($contact->getPrenom()) . ' ' . strtolower($contact->getAdresse()) . ' ' . strtolower($contact->getCodePostal()) . ' ' . strtolower($contact->getVille()) . ' ' . strtolower($contact->getTelephone());
    }

    public function updateContact(Contact $contactAModifier): bool {
        $query = 'UPDATE contact 
                  SET 
                    nom = :nom ,
                    prenom = :prenom,
                    adresse = :adresse,
                    code_postal = :code_postal,
                    ville = :ville,
                    telephone = :telephone,
                    normalized_contact_data = :normalized_contact_data
                  WHERE contact_id = :contact_id';
        $statement = $this->database->pdo()->prepare($query);
        $statement->bindValue(':contact_id', $contactAModifier->getContactId());
        $statement->bindValue(':nom', $contactAModifier->getNom());
        $statement->bindValue(':prenom', $contactAModifier->getPrenom());
        $statement->bindValue(':adresse', $contactAModifier->getAdresse());
        $statement->bindValue(':code_postal', $contactAModifier->getCodePostal());
        $statement->bindValue(':ville', $contactAModifier->getVille());
        $statement->bindValue(':telephone', $contactAModifier->getTelephone());
        $statement->bindValue(':normalized_contact_data', $this->normalize($contactAModifier));


        return $statement->execute();
    }

    public function supprimerContact(string $contactId): bool {
        $query = 'DELETE FROM contact WHERE contact_id = :contact_id';
        $statement = $this->database->pdo()->prepare($query);
        $statement->bindValue(':contact_id', $contactId);
        return $statement->execute();
    }
}