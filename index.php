<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Psr4AutoloaderClass.php';

    function deliver_response($status_code, $status_message, $data=null){ 
        /// Paramétrage de l'entête HTTP 
        http_response_code($status_code); //Utilise un message standardisé en fonction du code HTTP 
        //header("HTTP/1.1 $status_code $status_message"); //Permet de personnaliser le message associé au code HTTP 
        header("Content-Type:application/json; charset=utf-8");//Indique au client le format de la réponse            
        header("Access-Control-Allow-Origin: *");
        $response['status_code'] = $status_code; 
        $response['status_message'] = $status_message; 
        $response['data'] = $data; 
        /// Mapping de la réponse au format JSON 
        $json_response = json_encode($response); 
        if($json_response===false) {
            die('json encode ERROR : '.json_last_error_msg()); 
        } 
        /// Affichage de la réponse (Retourné au client) 
        echo $json_response; 
    }

use R401\TP5\Psr4AutoloaderClass;
use R401\TP5\Controleur\Contact\ListerTousLesContacts;
use R401\TP5\Controleur\Contact\RechercherLesContacts;
use R401\TP5\Utils\Http_response;
use R401\TP5\Controleur\Contact\AjouterContact;

$loader = new Psr4AutoloaderClass;
// register the autoloader
$loader->register();
// register the base directories for the namespace prefix
$loader->addNamespace('R401\TP5', '.');


$uri = strtok($_SERVER["REQUEST_URI"], '?');
$method = $_SERVER["REQUEST_METHOD"];

if($uri === '/contacts') {
    switch($method) {
        case "GET":
           if (isset($_GET['recherche'])) {
                $command = new RechercherLesContacts($_GET['recherche']);
            } else {
                $command = new ListerTousLesContacts();
            }
            $data = $command->execute();
            deliver_response(200, "Donnée récuperée avec succée", $data);
            break;
        case "POST":
            $postedData = file_get_contents('php://input');
            $dataInput = json_decode($postedData, true);
            print_r($dataInput['nom']);
            if (isset($dataInput['nom'])
                && isset($dataInput['prenom'])
                && isset($dataInput['adresse'])
                && isset($dataInput['ville'])
                && isset($dataInput['codePostal'])
                && isset($dataInput['telephone'])
            ) {
                $command = new AjouterContact(
                    $dataInput['nom'],
                    $dataInput['prenom'],
                    $dataInput['adresse'],
                    $dataInput['codePostal'],
                    $dataInput['ville'],
                    $dataInput['telephone']
                );
                if ($command->execute()) {
                    deliver_response(201, "Contact crée avec succées");
                } else {
                    deliver_response(500, "Erreur lors de la création du contact");
                }
            } else {
                deliver_response(400, "Formulaire incomplet");
            }
            break;
        case "PUT":
            echo "Update data";
            break;
        case "DELETE":
            echo "Delete data";
    }
} else {
    deliver_response(400, "Ressource inconnue");
}



?>