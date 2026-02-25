<?php

use R401\TP5\Controleur\Contact\SupprimerContact;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $commmand = new SupprimerContact($_POST['id']);

        if (!$commmand->execute()) {
            error_log("Erreur lors de la suppression du contact");
        }
    }
}

header('Location: /contact');