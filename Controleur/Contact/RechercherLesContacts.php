<?php

namespace R401\TP5\Controleur\Contact;


use R401\TP5\Modele\Contact\ContactDAO;

class RechercherLesContacts {
    private readonly ContactDAO $contactDAO;
    private readonly string $recherche;

    public function __construct(string $recherche) {
        $this->contactDAO = ContactDAO::getInstance();
        $this->recherche = $recherche;
    }

    public function execute(): array {
        return $this->contactDAO->searchContacts($this->recherche);
    }
}