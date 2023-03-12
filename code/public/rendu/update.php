<?php
require_once 'fonction.ini.php';
$connexion = connexion();

if($_POST){
    if(isset($_POST['id']) && !empty($_POST['id'])
    && isset($_POST['nom']) && !empty($_POST['nom'])
    && isset($_POST['annee']) && !empty($_POST['annee'])
    && isset($_POST['createur']) && !empty($_POST['createur'])
    && isset($_POST['age']) && !empty($_POST['age'])){

        $id = strip_tags($_POST['id']);
        $nom = strip_tags($_POST['nom']);
        $annee = strip_tags($_POST['annee']);
        $createur = strip_tags($_POST['createur']);
        $age = strip_tags($_POST['age']);

        $sql = 'UPDATE `games` SET `nom`=:nom, `annee`=:annee, `createur`=:createur, `age`=:age WHERE `id`=:id;';

        $query = $connexion->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':annee', $annee, PDO::PARAM_INT);
        $query->bindValue(':createur', $createur, PDO::PARAM_STR);
        $query->bindValue(':age', $age, PDO::PARAM_INT);

        $query->execute();

        $_SESSION['message'] = "Jeu modifié";

        header('Location: read.php');
        
    }else{
        $_SESSION['erreur'] = "Le formulaire est incomplet";
    }
}

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
    }
}else{
    $_SESSION['erreur'] = "URL invalide";
    header('Location: read.php');
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un jeu</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <?php
                    if(!empty($_SESSION['erreur'])){
                        echo '<div class="alert alert-danger" role="alert">
                                '. $_SESSION['erreur'].'
                            </div>';
                        $_SESSION['erreur'] = "";
                    }
                ?>
                <h1>Modifier un jeu</h1>
                <form method="post">
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" value="<?= $jeu['nom']?>">
                    </div>
                    <div class="form-group">
                        <label for="annee">Année</label>
                        <input type="number" id="annee" name="annee" class="form-control" value="<?= $jeu['annee']?>">
                    </div>
                    <div class="form-group">
                        <label for="createur">Créateur</label>
                        <input type="text" id="createur" name="createur" class="form-control" value="<?= $jeu['createur']?>">
                    </div>
                    <div class="form-group">
                        <label for="age">Âge</label>
                        <input type="number" id="age" name="age" class="form-control" value="<?= $jeu['age']?>">
                    </div>
                    <input type="hidden" value="<?= $jeu['id']?>" name="id">
                    <button class="btn btn-primary">Envoyer</button>
                </form>
            </section>
        </div>
    </main>
</body>
</html>