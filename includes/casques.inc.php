<?php

$cnx = new PDO('mysql:host=127.0.0.1;dbname=nolark', 'nolarkuser', 'nolarkpwd');
$req = 'SELECT casque.id, nom, modele, libelle, prix, classement, image, stock ';
$req .= 'FROM casque INNER JOIN type ON casque.type=type.id ';
$req .= 'INNER JOIN marque ON casque.marque=marque.id ';
$req .= 'WHERE libelle = "' . substr($pageActuelle, 0, -4) . '"';

$res = $cnx->query($req);

echo '<section id="casques">';
while ($ligne = $res->fetch(PDO::FETCH_OBJ)) {
    echo "\t", '<article>', "\n";
    echo "\t\t", '<img src="../images/casques/', $ligne->libelle, '/', $ligne->image, '" alt="', $ligne->modele, '" >', "\n";

    if ((int) $ligne->stock === -1) {
        echo '<p class="stockko"><abbr data-tip="Sur commande uniquement">stock</abbr></p>';
    } else if ((int) $ligne->stock === 0) {
        echo '<p class="stockko"><abbr data-tip="Plus de casques en stock">stock</abbr></p>';
    } else if ((int) $ligne->stock < 10) {
        echo '<p class="stockok"><abbr data-tip="Plus que ', $ligne->stock, ' casques en stock...">stock</abbr></p>';
    } else {
        echo '<p class="stockok"><abbr data-tip="', $ligne->stock, ' casques en stock">stock</abbr></p>';
    }
    echo "\t\t", '<p class="prix">', $ligne->prix, '€</p>', "\n";
    echo "\t\t", '<p class="marque">', $ligne->nom, '</p>', "\n";
    echo "\t\t", '<p class="modele">', $ligne->modele, '</p>', "\n";

    // Si la note est de 5, il faut ajouter un 0 pour correspondre au selecteur CSS
    if ($ligne->classement === 5) {
        echo "\t\t", '<img class="classement classement0', $ligne->classement, '" src="../images/casques/etoiles.gif" alt="Classement ', str_replace('.', ',', $ligne->classement / 10), ' sur 5">', "\n";
    } else {
        echo "\t\t", '<img class="classement classement', $ligne->classement, '" src="../images/casques/etoiles.gif" alt="Classement ', str_replace('.', ',', $ligne->classement / 10), ' sur 5">', "\n";
    }
    echo "\t", '</article>', "\n";
}
echo '</section>';
