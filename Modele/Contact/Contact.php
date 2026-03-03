<?php

namespace R401\TP5\Modele\Contact;

class Contact {
    private ?int $contactId;
    private string $nom;
    private string $prenom;
    private string $adresse;
    private string $codePostal;
    private string $ville;
    private string $telephone;

    public function __construct(string $nom, string $prenom, string $adresse, string $codePostal, string $ville, string $telephone, ?int $contactId = 0) {
        $this->contactId = $contactId;
        $this->nom = strtoupper($nom);
        $this->prenom = ucfirst(strtolower($prenom));
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->telephone = $telephone;
    }

    public function getContactId(): int {
        return $this->contactId;
    }

    public function setContactId(int $contactId): void {
        $this->contactId = $contactId;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void {
        $this->prenom = $prenom;
    }

    public function getAdresse(): string {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): void {
        $this->adresse = $adresse;
    }

    public function getCodePostal(): string {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): void {
        $this->codePostal = $codePostal;
    }

    public function getVille(): string {
        return $this->ville;
    }

    public function setVille(string $ville): void {
        $this->ville = $ville;
    }

    public function getTelephone(): string {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): void {
        $this->telephone = $telephone;
    }

    public function toArray() {
        return [
            'contactId' => $this->contactId,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'adresse' => $this->adresse,
            'codePostal' => $this->codePostal,
            'ville' => $this->ville,
            'telephone' => $this->telephone
        ];
    }
}

