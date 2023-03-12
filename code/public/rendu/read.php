<?php
require_once 'fonction.ini.php';
$connexion = connexion();

$sql = 'SELECT * FROM `games`';

$query = $connexion->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des jeux</title>

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
                <?php
                    if(!empty($_SESSION['message'])){
                        echo '<div class="alert alert-success" role="alert">
                                '. $_SESSION['message'].'
                            </div>';
                        $_SESSION['message'] = "";
                    }
                ?>
                <h1>Liste des jeux</h1>
                <table class="table">
                    <thead>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Année</th>
                        <th>Créateur</th>
                        <th>Âge</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($result as $jeu){
                        ?>
                            <tr>
                                <td><?= $jeu['id'] ?></td>
                                <td><?= $jeu['nom'] ?></td>
                                <td><?= $jeu['annee'] ?></td>
                                <td><?= $jeu['createur'] ?></td>
                                <td><?= $jeu['age'] ?></td>
                                <td><a href="details.php?id=<?= $jeu['id'] ?>"  class="btn btn-info">Voir</a> <a href="update.php?id=<?= $jeu['id'] ?>" class="btn btn-light">Modifier</a> <a href="delete.php?id=<?= $jeu['id'] ?>" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <a href="create.php" class="btn btn-success">Ajouter un jeu</a>
            </section>
        </div>
    </main>
</body>
</html>