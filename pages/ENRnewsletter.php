<?php
$cnx = new PDO('mysql:host=127.0.0.1;dbname=E5', 'E5user', 'E5pwd');
$req = 'SELECT * FROM INFOLETTRE';
$res = $cnx->prepare($req);
$res->execute();
$res->fetch(PDO::FETCH_OBJ);

function infoLettre(string $mail){
    $req = "INSERT INTO Infolettre(email) VALUES (:mail)";
    $req->bindParam(':mail', $mail);
}