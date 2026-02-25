<?php

namespace R401\TP5\Controleur\Contact;


use R401\TP5\Modele\Contact\ContactBuilder;
use R401\TP5\Modele\Contact\ContactDAO;

class AjouterContact {
    private readonly ContactDAO $contactDAO;
    private readonly string $nom;
    private readonly string $prenom;
    private readonly string $adresse;
    private readonly string $codePostal;
    private readonly string $ville;
    private readonly string $telephone;

    public function __construct(string $nom, string $prenom, string $adresse, string $codePostal, string $ville, string $telephone) {
        $this->contactDAO = ContactDAO::getInstance();
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
        $this->ville = $ville;
        $this->telephone = $telephone;
    }


    public function execute(): bool {
        $builder = new ContactBuilder();
        $contactACreer = $builder
            ->nom($this->nom)
            ->prenom($this->prenom)
            ->adresse($this->adresse)
            ->codePostal($this->codePostal)
            ->ville($this->ville)
            ->telephone($this->telephone)
            ->build();

        return $this->contactDAO->insertContact($contactACreer);
    }
}