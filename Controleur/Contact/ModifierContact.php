<?php

namespace R401\TP5\Controleur\Contact;

use R401\TP5\Modele\Contact\ContactDAO;

class ModifierContact {
    private readonly ContactDAO $contactDAO;
    private readonly int $contactId;
    private readonly string $nom;
    private readonly string $prenom;
    private readonly string $adresse;
    private readonly string $codePostal;
    private readonly string $ville;
    private readonly string $telephone;

    public function __construct(
        int    $contactId,
        string $nom,
        string $prenom,
        string $adresse,
        string $codePostal,
        string $ville,
        string $telephone
    ) {
        $this->contactDAO = ContactDAO::getInstance();
        $this->contactId = $contactId;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->telephone = $telephone;
    }

    public function execute(): bool {
        $contactAModifier = $this->contactDAO->selectContactById($this->contactId);

        $contactAModifier->setNom($this->nom);
        $contactAModifier->setPrenom($this->prenom);
        $contactAModifier->setAdresse($this->adresse);
        $contactAModifier->setCodePostal($this->codePostal);
        $contactAModifier->setVille($this->ville);
        $contactAModifier->setTelephone($this->telephone);

        return $this->contactDAO->updateContact($contactAModifier);
    }
}