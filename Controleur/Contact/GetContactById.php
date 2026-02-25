<?php

namespace R4O1\TP5\Controleur\Contact;

use R401\T5\Modele\Contact\Contact;
use R401\TP5\Modele\Contact\ContactDAO;

class GetContactById {
    private readonly ContactDAO $joueurDAO;
    private readonly int $contactId;

    public function __construct(int $contactId) {
        $this->joueurDAO = ContactDAO::getInstance();
        $this->contactId = $contactId;
    }

    public function execute(): Contact {
        return $this->joueurDAO->selectContactById($this->contactId);
    }
}