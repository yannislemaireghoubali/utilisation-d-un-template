<?php
try{
    $cnx = new PDO('mysql:host=127.0.0.1','dbname=e5', 'e5utilisateur', 'e5utilisateur');
    $req = 'SELECT * FROM INFOLETTRE';
    $res = $cnx->prepare($req);
    $res->execute();
    $res->fetch(PDO::FETCH_OBJ);
}
catch (PDOException $e) {
    echo 'Erreur: ' . $e->getMessage();
}

function infolettre(string $email){
    $req = "INSERT INTO Infolettre(email) VALUES (:email)";
    $req->bindParam(':email', $email);
    $req->execute();
    echo 'Bonjour ' . htmlspecialchars($_POST[$email]) . '!';
    $message = "Bienvenue !!";
    $message2 = wordwrap($message);
    mail($email, 'Mon Sujet', $message2);
}

function setConsentement(string $email){
    $req = "UPDATE INFOLETTRE SET EMAIL = :email";
    $req->bindParam(':email', $email);
    $req->execute();
}

function removeConsentement(string $email){
    $req = "DELETE FROM infolettre where email = :email";
    $req->bindParam(':email', $email);
    $req->execute();
}

?>

<footer>
    <p>&copy;2023 E5 - Créé par <a href="lemairey83@gmail.com">Yannis Lemaire</a> - Page chargée le <?php
        setlocale(LC_ALL, 'fr-FR.utf8', 'fra');
        date_default_timezone_set('Europe/Paris');
        echo strftime("%A %d %B");
        ?> à <?php echo strftime("%Hh%M"); ?><p>
</footer>