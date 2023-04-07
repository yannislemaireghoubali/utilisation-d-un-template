<?php
$cnx = new PDO('mysql:host=127.0.0.1;dbname=E5', 'E5user', 'E5pwd');
$req = 'SELECT * FROM INFOLETTRE';
$res = $cnx->prepare($req);
$res->execute();
$res->fetch(PDO::FETCH_OBJ);

function infolettre(string $email){
    $req = "INSERT INTO Infolettre(email) VALUES (:email)";
    $req->bindParam(':email', $mail);
    $req->execute();
}

function setConsentement(string $email){
    $req = "UPDATE INFOLETTRE SET EMAIL = :email";
    $req->bindParam(':email', $mail);
    $req->execute();
}

function removeConsentement(string $email){
    $req = "DELETE FROM infolettre where email = :email";
    $req->bindParam(':email', $email);
    $req->execute();
}