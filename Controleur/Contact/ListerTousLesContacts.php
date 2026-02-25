<?php

namespace R401\TP5\Controleur\Contact;

use R401\TP5\Modele\Contact\ContactDAO;

class ListerTousLesContacts {
    private readonly ContactDAO $contactDAO;

    public function __construct() {
        $this->contactDAO = ContactDAO::getInstance();
    }

    public function execute(): array {
        return $this->contactDAO->selectAllContacts();
    }
}