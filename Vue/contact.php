<?php


use R401\TP5\Controleur\Contact\ListerTousLesContacts;
use R401\TP5\Controleur\Contact\RechercherLesContacts;

if (isset($_GET['recherche'])) {
    $command = new RechercherLesContacts($_GET['recherche']);
} else {
    $command = new ListerTousLesContacts();
}
$contacts = $command->execute();

?>

<h1>Contacts</h1>
<div class="container">
    <form action="contact" method="get">
        <div class="row">
            <div class="invCol-80">
                <input type="search" name="recherche"
                       placeholder="Rechercher" <?= isset($_GET['recherche']) ? 'value="' . $_GET['recherche'] . '"' : '' ?>/>
            </div>
            <div class="invCol-20">
                <input class="filter-button" type="submit" value="Filtrer">
            </div>
        </div>
    </form>
</div>

<div class="overflow container">
    <table style="width: 100%">
        <tr>
            <th style="width:10%">Nom</th>
            <th style="width:10%">Prenom</th>
            <th style="width:20%">Adresse</th>
            <th style="width:6%">Code Postal</th>
            <th style="width:10%">Ville</th>
            <th style="width:10%">Téléphone</th>
            <th style="width:10%">Actions</th>
        </tr>

        <?php foreach ($contacts as $contact) {
            if (isset($_GET['modifier_contact_id']) && $contact->getContactId() == $_GET['modifier_contact_id']) {
                ?>
                <tr>
                    <form action="contact/modifier" method="post">
                        <td><input type=text name="nom" value="<?php echo $contact->getNom() ?>"/></td>
                        <td><input type=text name="prenom" value="<?php echo $contact->getPrenom() ?>"></td>
                        <td><input type=text name="adresse" value="<?php echo $contact->getAdresse() ?>"></td>
                        <td><input type=text name="codePostal" placeholder="31000" value="<?php echo $contact->getCodePostal() ?>"></td>
                        <td><input type=text name="ville" value="<?php echo $contact->getVille() ?>"></td>
                        <td><input type=text name="telephone" placeholder="0123456789" value="<?php echo $contact->getTelephone() ?>"></td>
                        <td class="actions">
                            <button class="update" type="submit" name="id"
                                    value="<?php echo $contact->getContactId() ?>">
                                Mettre à jour
                            </button>
                        </td>
                    </form>
                </tr>
                <?php
            } else {
                ?>
                <tr>
                    <td><?php echo $contact->getNom() ?></td>
                    <td><?php echo $contact->getPrenom() ?></td>
                    <td><?php echo $contact->getAdresse() ?></td>
                    <td><?php echo $contact->getCodePostal() ?></td>
                    <td><?php echo $contact->getVille() ?></td>
                    <td><?php echo $contact->getTelephone() ?></td>
                    <td class="actions">
                        <form action="contact" method="get">
                            <button class="update" type="submit" name="modifier_contact_id"
                                    value="<?php echo $contact->getContactId() ?>">
                                Modifier
                            </button>
                        </form>
                        <form action="contact/supprimer" method="post">
                            <button class="delete" type="submit" name="id"
                                    value="<?php echo $contact->getContactId() ?>"
                                    onclick="return confirm('Voulez-vous vraiment supprimer ce contact?')">Supprimer
                            </button>
                        </form>
                    </td>
                </tr>
            <?php }
        } ?>
        <tr>
            <form action="contact/ajouter" method="post">
                <td><input type=text name="nom"/></td>
                <td><input type=text name="prenom"></td>
                <td><input type=text name="adresse"></td>
                <td><input type=text name="codePostal" placeholder="31000"></td>
                <td><input type=text name="ville"></td>
                <td><input type=text name="telephone" placeholder="0123456789"></td>
                <td class="actions">
                    <button class="create" type="submit" name="id">
                        Ajouter
                    </button>
                </td>
            </form>
        </tr>
    </table>
    <?php
    echo count($contacts) . " contacts </p>";
    ?>
</div>
