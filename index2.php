<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Psr4AutoloaderClass.php';

use R401\TP5\Psr4AutoloaderClass;

$loader = new Psr4AutoloaderClass;
// register the autoloader
$loader->register();
// register the base directories for the namespace prefix
$loader->addNamespace('R401\TP5', '.');

if (preg_match('/\.(?:png|jpg|jpeg|gif|ico|css|js)\??.*$/', $_SERVER["REQUEST_URI"])) {
    return false; // serve the requested resource as-is.
} else {
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>R4.01 - TP5</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8"/>
    <link rel="stylesheet" href="/stylesheet.css"/>
    <link rel="icon" type="image/jpg" href="/favicon.jpg">
</head>
<body>
<?php
if ($_SERVER["REQUEST_URI"] === "/") {
    header('Location: /contact');
} else {
    require_once './Vue' . strtok($_SERVER["REQUEST_URI"], '?') . '.php';
}
} ?>
</body>
</html>