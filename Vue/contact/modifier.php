<?php

use R401\TP5\Controleur\Contact\ModifierContact;

if ($_SERVER['REQUEST_METHOD'] === 'POST'
    && isset($_POST['id'])
    && isset($_POST['nom'])
    && isset($_POST['prenom'])
    && isset($_POST['adresse'])
    && isset($_POST['ville'])
    && isset($_POST['codePostal'])
    && isset($_POST['telephone'])
) {
    $command = new ModifierContact(
        intval($_POST['id']),
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['adresse'],
        $_POST['codePostal'],
        $_POST['ville'],
        $_POST['telephone']
    );
    if ($command->execute()) {
        header('Location: /contact');
    } else {
        error_log("Erreur lors de la modification du contact");
    }
} else {
    error_log("Formulaire incomplet");
    header('Location: /contact');
}
