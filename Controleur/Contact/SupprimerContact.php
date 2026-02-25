<?php

namespace R401\TP5\Controleur\Contact;


use R401\TP5\Modele\Contact\ContactDAO;

class SupprimerContact {
    private readonly ContactDAO $contactDAO;
    private readonly string $contactId;

    public function __construct(string $contactId) {
        $this->contactDAO = ContactDAO::getInstance();
        $this->contactId = $contactId;
    }

    public function execute(): bool {
        return $this->contactDAO->supprimerContact($this->contactId);
    }
}