<?php
require_once 'fonction.ini.php';
$connexion = connexion();

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = strip_tags($_GET['id']);

    $sql = 'SELECT * FROM `games` WHERE `id` = :id;';

    $query = $connexion->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();

    $jeu = $query->fetch();

    if(!$jeu){
        $_SESSION['erreur'] = "Cet id n'existe pas";
        header('Location: read.php');
        die();
    }

    $sql = 'DELETE FROM `games` WHERE `id` = :id;';

    $query = $connexion->prepare($sql);

    $query->bindValue(':id', $id, PDO::PARAM_INT);

    $query->execute();
    $_SESSION['message'] = "Jeu supprimé";
    header('Location: read.php');

}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: read.php');
}
?>