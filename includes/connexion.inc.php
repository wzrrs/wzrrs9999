<?php

$connect = FALSE;
if (isset($_COOKIE['sid']) && !empty($_COOKIE['sid'])) {
    $sid = $_COOKIE["sid"];
    $sth = $bdd->prepare("select * from utilisateur where sid = :sid");
    $sth->bindValue(':sid', $_COOKIE['sid'], PDO::PARAM_STR);
    $sth->execute();
    $tab = $sth->fetchALL(PDO::FETCH_ASSOC);
    $rowCount = $sth->rowCount();

    if ($rowCount == 0) {
        $connect = FALSE;
    } elseif ($rowCount > 0) {
        $connect = TRUE;
    }
}